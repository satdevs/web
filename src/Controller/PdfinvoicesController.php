<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Utility\Xml;
use Cake\Core\Configure;

/*
	PdfSzlaIgenyUserName / PdfSzlaIgenyPassword
	winktv@saghysat.hu / FdfMqhhxad3D
*/


class PdfinvoicesController extends AppController{
	public $title 		= "PDF Számla igénylése";
	public $debug 		= false;
	public $onlyForMe 	= false;

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
		//$this->loadComponent('RequestHandler');
        $this->loadComponent('Captcha');
        $this->loadComponent('My');
        $this->_validViewOptions[] = 'pdfConfig';
    }


    public function deactivate($pHash=Null) {
		$uid 	= substr($pHash,0,64);
		$hash 	= substr($pHash,64);
		if($hash == Null){
			$this->Flash->warning(__('Hibás linkre kattintott! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #1)'));
			return $this->redirect('/pdfszamla-hibauzenet');
		}

		if(strlen($uid)!=64 && strlen($hash)!=64){
			$this->Flash->warning(__('Hibás linkre kattintott! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #2)'));
			return $this->redirect('/pdfszamla-hibauzenet');
		}

		$pdfinvoicesTable = TableRegistry::get('Pdfinvoices');
		$pdfinvoice = $pdfinvoicesTable->get($uid);

		if($pdfinvoice===Null){
			$this->Flash->warning(__('Nem létező PDF számla igény! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #3)'));
			return $this->redirect('/pdfszamla-hibauzenet');
		}

		if($pdfinvoice->hash !== $hash){
			$this->Flash->warning(__('Az deaktiváló link határideje lejárt! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #4)'));
			return $this->redirect('/pdfszamla-hibauzenet');
		}

		if($pdfinvoice->deactivated !== Null){
			$this->Flash->warning(__('Ön már deaktiválta PDF számla igényét! (Hibakód: #5)'));
			return $this->redirect('/pdfszamla-hibauzenet');
		}

		$this->set('hash',$pHash);
	}


    public function deactivateConfirmed($hash=Null) {

		//debug($hash); die();

		//debug($_SERVER);
		//debug($_SERVER['SERVER_NAME']);
		//debug($_SERVER['HTTP_HOST']);
		//debug($_SERVER['REQUEST_SCHEME']);
		//die();

        if ($this->request->is('get')) {

			$uid 	= substr($hash,0,64);
			$hash 	= substr($hash,64);

			if($hash == Null){
				$this->Flash->warning(__('Hibás linkre kattintott! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #1)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			if(strlen($uid)!=64 && strlen($hash)!=64){
				$this->Flash->warning(__('Hibás linkre kattintott! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #2)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			$pdfinvoicesTable = TableRegistry::get('Pdfinvoices');
			$pdfinvoice = $pdfinvoicesTable->get($uid);

			if($pdfinvoice===Null){
				$this->Flash->warning(__('Nem létező PDF számla igény! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #3)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			if($pdfinvoice->hash !== $hash){
				$this->Flash->warning(__('Az deaktiváló link határideje lejárt! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #4)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			if($pdfinvoice->hash == $hash){
				$pdfinvoice->deactivated = new Time( date("Y-m-d H:i:s") );	// Bootstrapban beáűllítva a timezone Budapestre
				$pdfinvoice->hash = str_replace( "-", strtolower($this->My->generateRandomString(8)), Text::uuid() );
				if($pdfinvoicesTable->save($pdfinvoice)){

					$email = new Email('default');
					$email->transport('saghysat');
					$email->template('default', 'default');
					$email->emailFormat('html');
					$email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);

					$email->to($pdfinvoice->email);
					$email->subject('PDF számla igénylés deaktiválva');
					$re  = "<h3>Kedves ".$pdfinvoice->name."!</h3>";
					$re .= "<p>PDF számla igényét sikeresen deaktiváltuk.</p>";

					$re .= "<p>Ha a jövőben ismét szertetné PDF formátumban megkapni a számláit, kérem regisztrálja újból az igényét.<br>";
					$re .= "</p>";

					$re .= "<p>A PDF számla igényléséhez kérem kattintson az alábbi linkre.</p>";

					$re .= '<a href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/pdfszamla" style="text-decoration: none; color: blue; font-weight: bold;">PDF számla igénylése</a> oldalon';

					$re .= "<p>";
						$re .= "<b>Sághy-Sat Kft.</b><br>";
						$re .= "7754 Bóly, Ady E. u. 9.<br>";
						$re .= "Tel.: <b>+36 69/368-162</b><br>";
						$re .= "Email: <b>info@saghysat.hu</b><br>";
					$re .= "</p>\n";
					$re .= "<hr>\n";
					$re .= "<p>Amint azt tudják, az internet segítségével eljuttatott e-maileket harmadik személy is kiküldheti, tartalmát megváltoztathatja. Ez okból az e-mail formájában küldött leveleink nem jogköteles nyilatkozatok. Ezen e-mail tartalma és mellékletei bizalmasan kezelendők és jogilag védettek. Az e-mail tartalma kizárólag a címzettnek szól. Ennek továbbítása, másolat készítése harmadik személy általi egyéb felhasználása nem engedélyezett. Ezért kérjük, amennyiben a jelen e-mail nem Önnek lett címezve, tájékoztatás után törölje postaládájából. ";
					$re .= "Ha a gazdasági esemény megtörténik, ha a szolgáltatást megrendelik, azaz legalább a megrendelés véglegesedik, akkor a ránk vonatkozó adatvédelmi előírásoknak, mint Partnerünk felé, maradéktalanul eleget teszünk. Addig cégünk ezeket az adatokat bizalmasan kezeli, de további kapcsolatfelvétel hiányában rögzítésre, tárolásra nem kerülnek.";
					$re .= "</p><p>\n";
					$re .= "As you are aware, messages sent by e-mail can be manipulated by third parties. For this reason our e-mail messages are generally not legally binding. This electronic message (including any attachments) contains confidential information and may be privileged or otherwise protected from disclosure. The information is intended to be for the use of the intended addressee only. Please be aware that any disclosure, copy, distribution or use of the contents of this message is prohibited. If you have received this e-mail in error please notify me immediately by reply e-mail and delete this message and any attachments from your system. ";
					$re .= "If the economic event happens, if the service is ordered it means at least the order is finalized, we will fully comply the data protection regulations towards to our Partner. Until then our company keeps those datas confidential, but it will be not stored in the absence of further contact.</p>\n";

					if($this->debug){
						echo $re;
						debug($pdfinvoice);
					}else{
						$email->send($re);
					}

					// ############### AKTIVÁLVA saját részre elküldeni #######################
					$email = new Email('default');
					$email->transport('saghysat');
					$email->template('default', 'default');
					$email->emailFormat('html');
					//$email->from([$pdfinvoice->email => $pdfinvoice->name]);
					//$email->from(['www@saghysat.hu' => 'PDF számla igénylés']);
					$email->from('www@saghysat.hu', 'PDF számla igénylés: '.$pdfinvoice->name);
					//$email->returnPath($pdfinvoice->email, $pdfinvoice->name);
					$email->replyTo($pdfinvoice->email, $pdfinvoice->name);

					//$email->subject('PDF számla igénylés DEAKTIVÁLVA: '.$pdfinvoice->sub_id." / ".$pdfinvoice->name);
					$email->subject('[WSHU][PDF]['.$pdfinvoice->sub_id."] PDF számla lemondása");

					$re  = "<h3>PDF számla igény <span style='color: red; font-weight: bold;'>DEAKTIVÁLVA</span>!</h3>";
					$re .= "<p>";
						$re .= "Neve: <b>".$pdfinvoice->name."</b><br>";
						$re .= "Ügyfélszám: <b>".$pdfinvoice->sub_id."</b><br>";
						$re .= "Email: <a href='mailto:".$pdfinvoice->email."'><b>".$pdfinvoice->email."</b></a><br>";
						$re .= "Település: <b>".$pdfinvoice->city."</b><br>";
						$re .= "Cím: <b>".$pdfinvoice->address."</b><br>";
						$re .= "Telefonszám: <b>".$pdfinvoice->phone."</b><br>";
						$re .= "Típus: <b>".$pdfinvoice->type."</b><br>";
						$re .= "Adószám: <b>".$pdfinvoice->taxnumber."</b><br>";
						$re .= "<hr>";

						if($pdfinvoice->cb1==1){$cb1="X"; }else{$cb1="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb2==1){$cb2="X"; }else{$cb2="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb3==1){$cb3="X"; }else{$cb3="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb4==1){$cb4="X"; }else{$cb4="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb5==1){$cb5="X"; }else{$cb5="&nbsp;&nbsp;&nbsp;";}
						$re .= "<b>[".$cb1."]</b> *Hozzájárul, hogy a szolgáltatáshoz kapcsolódó információkkal megkeressük.<br>";
						$re .= "<b>[".$cb2."]</b> Hozzájárul, hogy marketing ajánlatokkal Email-ben megkeressük.<br>";
						$re .= "<b>[".$cb3."]</b> Hozzájárul, hogy a megadott adatokat 3. félnek átadjuk marketing szempontjából.<br>";
						$re .= "<b>[".$cb4."]</b> *Hozzájárul, hogy a megadott telefonszámon szóban illetve SMS-ben a szolgáltatáshoz kapcsolódóan megkeressük.<br>";
						$re .= "<b>[".$cb5."]</b> *Adatkezelési szabályzatot elolvasta és tudomásul vette.<br>";
					$re .= "</p>\n";
					$re .= "<hr>\n";
					$re .= "<p>[TServices: 1,2]<p>";
					$re .= "<p>#pdfszamlalemondas<p>";
					$re .= "<hr>\n";


					if($this->debug){
						echo $re;
						debug($pdfinvoice);
					}else{
						if($this->onlyForMe){
							$email->to('zsolt@saghysat.hu');
							$email->send($re);
						}else{
							$email->to('info@saghysat.hu');
							$email->send($re);
							$email->to('zsolt@saghysat.hu');
							$email->send($re);
						}
					}

				}
			}
		}
		return $this->redirect('/pdfszamla-sikeres-deaktivalas');
	}


    public function activate($hash=Null) {

        if ($this->request->is('get')) {

			$uid 	= substr($hash,0,64);
			$hash 	= substr($hash,64);

			if($hash == Null){
				$this->Flash->warning(__('Hibás linkre kattintott! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #1)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			if(strlen($uid)!=64 && strlen($hash)!=64){
				$this->Flash->warning(__('Hibás linkre kattintott! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #2)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			$pdfinvoicesTable = TableRegistry::get('Pdfinvoices');
			$pdfinvoice = $pdfinvoicesTable->get($uid);

			if($pdfinvoice===Null){
				$this->Flash->warning(__('Nem létező PDF számla igény! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #3)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			if($pdfinvoice->hash !== $hash){
				$this->Flash->warning(__('Az aktiváló link határideje lejárt! Kérem vegye fel a kapcsolatot ügyfélszolgálatunkkal! (Hibakód: #4)'));
				return $this->redirect('/pdfszamla-hibauzenet');
			}

			if($pdfinvoice->hash == $hash){
				$pdfinvoice->activated = new Time( date("Y-m-d H:i:s") );	// Bootstrapban beáűllítva a timezone Budapestre
				$pdfinvoice->hash = str_replace( "-", strtolower($this->My->generateRandomString(8)), Text::uuid() );
				if($pdfinvoicesTable->save($pdfinvoice)){

					$email = new Email('default');
					$email->transport('saghysat');
					$email->template('default', 'default');
					$email->emailFormat('html');
					$email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);
					$email->to($pdfinvoice->email);
					$email->subject('PDF számla igénylés aktiválva');
					$re  = "<h3>Kedves ".$pdfinvoice->name."!</h3>";
					$re .= "<p>PDF számla igényét sikeresen aktiváltuk.</p>";

/*
					$re .= "<p>Email számla igényének lemondását minden levél végén található lemondás gombra kattintva teheti meg a későbbiekben.</p>";
					$re .= "<p>A PDF számla igényének deaktiváláshoz kérem kattintson az alábbi (piros) gombra.</p>";
					$re .= '<a href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/deactivate/'.$pdfinvoice->id.$pdfinvoice->hash.'" style="text-decoration: none; color: white;">';
						$re .= '<div style="text-align: center; width: 400px; background: red; color: white; padding: 10px; font-size: 20px; font-family: Arial; font-weight: bold;">';
							$re .= "PDFszámla igénylés lemondása";
						$re .= "</div>";
					$re .= "</a>";
*/
					//$re	.= "<p>A megadott elérhetőségek egyikén hamarosan felvesszük Önnel a kapcsolatot és megbeszéljük a további részleteket.</p>\n";

					$re .= "<hr>";
					$re .= "<p>";
						$re .= "<b><u>Az Ön által megadott adatok:</u></b><br>";
						$re .= "Neve: <b>".$pdfinvoice->name."</b><br>";
						$re .= "Ügyfélszám: <b>".$pdfinvoice->sub_id."</b><br>";
						$re .= "Email: <b>".$pdfinvoice->email."</b><br>";
						$re .= "Település: <b>".$pdfinvoice->city."</b><br>";
						$re .= "Cím: <b>".$pdfinvoice->address."</b><br>";
						$re .= "Telefonszám: <b>".$pdfinvoice->phone."</b><br>";
						$re .= "Típus: <b>".$pdfinvoice->type."</b><br>";
						$re .= "Adószám: <b>".$pdfinvoice->taxnumber."</b><br>";
						$re .= "<br>";
						if($pdfinvoice->cb1==1){$cb1="X"; }else{$cb1="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb2==1){$cb2="X"; }else{$cb2="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb3==1){$cb3="X"; }else{$cb3="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb4==1){$cb4="X"; }else{$cb4="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb5==1){$cb5="X"; }else{$cb5="&nbsp;&nbsp;&nbsp;";}
						$re .= "<b>[".$cb1."]</b> *Hozzájárul, hogy a szolgáltatáshoz kapcsolódó információkkal megkeressük.<br>";
						$re .= "<b>[".$cb2."]</b> Hozzájárul, hogy marketing ajánlatokkal Email-ben megkeressük.<br>";
						$re .= "<b>[".$cb3."]</b> Hozzájárul, hogy a megadott adatokat 3. félnek átadjuk marketing szempontjából.<br>";
						$re .= "<b>[".$cb4."]</b> *Hozzájárul, hogy a megadott telefonszámon szóban illetve SMS-ben a szolgáltatáshoz kapcsolódóan megkeressük.<br>";
						$re .= "<b>[".$cb5."]</b> *Adatkezelési szabályzatot elolvasta és tudomásul vette.<br>";
					$re .= "</p>\n";
					$re .= "<hr>";
					$re .= "<p>";
						$re .= "<b>Sághy-Sat Kft.</b><br>";
						$re .= "7754 Bóly, Ady E. u. 9.<br>";
						$re .= "Tel.: <b>+36 69/368-162</b><br>";
						$re .= "Email: <b>info@saghysat.hu</b><br>";
					$re .= "</p>\n";
					$re .= "<hr>\n";
					$re .= "<p>Amint azt tudják, az internet segítségével eljuttatott e-maileket harmadik személy is kiküldheti, tartalmát megváltoztathatja. Ez okból az e-mail formájában küldött leveleink nem jogköteles nyilatkozatok. Ezen e-mail tartalma és mellékletei bizalmasan kezelendők és jogilag védettek. Az e-mail tartalma kizárólag a címzettnek szól. Ennek továbbítása, másolat készítése harmadik személy általi egyéb felhasználása nem engedélyezett. Ezért kérjük, amennyiben a jelen e-mail nem Önnek lett címezve, tájékoztatás után törölje postaládájából. ";
					$re .= "Ha a gazdasági esemény megtörténik, ha a szolgáltatást megrendelik, azaz legalább a megrendelés véglegesedik, akkor a ránk vonatkozó adatvédelmi előírásoknak, mint Partnerünk felé, maradéktalanul eleget teszünk. Addig cégünk ezeket az adatokat bizalmasan kezeli, de további kapcsolatfelvétel hiányában rögzítésre, tárolásra nem kerülnek.";
					$re .= "</p><p>\n";
					$re .= "As you are aware, messages sent by e-mail can be manipulated by third parties. For this reason our e-mail messages are generally not legally binding. This electronic message (including any attachments) contains confidential information and may be privileged or otherwise protected from disclosure. The information is intended to be for the use of the intended addressee only. Please be aware that any disclosure, copy, distribution or use of the contents of this message is prohibited. If you have received this e-mail in error please notify me immediately by reply e-mail and delete this message and any attachments from your system. ";
					$re .= "If the economic event happens, if the service is ordered it means at least the order is finalized, we will fully comply the data protection regulations towards to our Partner. Until then our company keeps those datas confidential, but it will be not stored in the absence of further contact.</p>\n";

					if($this->debug){
						echo $re;
						debug($pdfinvoice);
					}else{
						$email->send($re);
					}

					// ############### AKTIVÁLVA saját részre elküldeni #######################
					$email = new Email('default');
					$email->transport('saghysat');
					$email->template('default', 'default');
					$email->emailFormat('html');

					$email->from('www@saghysat.hu', 'PDF számla igénylés: '.$pdfinvoice->name);
					//$email->returnPath($pdfinvoice->email, $pdfinvoice->name);
					$email->replyTo($pdfinvoice->email, $pdfinvoice->name);

					$email->subject('[WSHU][PDF]['.$pdfinvoice->sub_id."] PDF számla igénylés");

					$re  = "<h3>PDF számla igény <span style='color: green; font-weight: bold;'>AKTIVÁLVA</span>!</h3>";
					$re .= "<p>";
						$re .= "Neve: <b>".$pdfinvoice->name."</b><br>";
						$re .= "Ügyfélszám: <b>".$pdfinvoice->sub_id."</b><br>";
						$re .= "Email: <a href='mailto:".$pdfinvoice->email."'><b>".$pdfinvoice->email."</b></a><br>";
						$re .= "Település: <b>".$pdfinvoice->city."</b><br>";
						$re .= "Cím: <b>".$pdfinvoice->address."</b><br>";
						$re .= "Telefonszám: <b>".$pdfinvoice->phone."</b><br>";
						$re .= "Típus: <b>".$pdfinvoice->type."</b><br>";
						$re .= "Adószám: <b>".$pdfinvoice->taxnumber."</b><br>";
						$re .= "<hr>";

						if($pdfinvoice->cb1==1){$cb1="X"; }else{$cb1="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb2==1){$cb2="X"; }else{$cb2="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb3==1){$cb3="X"; }else{$cb3="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb4==1){$cb4="X"; }else{$cb4="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb5==1){$cb5="X"; }else{$cb5="&nbsp;&nbsp;&nbsp;";}
						$re .= "<b>[".$cb1."]</b> *Hozzájárul, hogy a szolgáltatáshoz kapcsolódó információkkal megkeressük.<br>";
						$re .= "<b>[".$cb2."]</b> Hozzájárul, hogy marketing ajánlatokkal Email-ben megkeressük.<br>";
						$re .= "<b>[".$cb3."]</b> Hozzájárul, hogy a megadott adatokat 3. félnek átadjuk marketing szempontjából.<br>";
						$re .= "<b>[".$cb4."]</b> *Hozzájárul, hogy a megadott telefonszámon szóban illetve SMS-ben a szolgáltatáshoz kapcsolódóan megkeressük.<br>";
						$re .= "<b>[".$cb5."]</b> *Adatkezelési szabályzatot elolvasta és tudomásul vette.<br>";
					$re .= "</p>\n";
					$re .= "<hr>\n";
					$re .= "<p>[TServices: 1,2]<p>";
					$re .= "<p>#pdfszamla<p>";
					$re .= "<hr>\n";

					if($this->debug){
						echo $re;
						debug($pdfinvoice);
					}else{
						if($this->onlyForMe){
							$email->to('zsolt@saghysat.hu');
							$email->send($re);
						}else{
							$email->to('info@saghysat.hu');
							$email->send($re);
							$email->to('zsolt@saghysat.hu');
							$email->send($re);
						}
					}


				}
			}
		}
		return $this->redirect('/pdfszamla-sikeres-aktivalas');
	}

	public function pdfMessage($id) {
		$this->loadModel('Texts');
        $text = $this->Texts->get($id);
        if($text){
            $this->set('text_title',$text['title']);
            $this->set('text_body',$text['text']);
        }
	}

    public function add() {

		$this->loadModel('Texts');
        $text = $this->Texts->get(3);
        if($text){
            $this->set('gdpr_title',$text['title']);
            $this->set('gdpr_body',$text['text']);
        }

		$checkInputOk = true;

        $pdfinvoice = $this->Pdfinvoices->newEntity();
        if ($this->request->is('post')) {

            $pdfinvoice = $this->Pdfinvoices->patchEntity($pdfinvoice, $this->request->data);

			//debug( $this->request->data['captcha'] );
			//debug( strtoupper($this->Captcha->getCaptcha()) );

			//if( !(isset($this->request->data['captcha']) && strtoupper($this->strip_tags_content($this->request->data['captcha']))==strtoupper($this->Captcha->getCaptcha())) ){
			if( strtoupper($this->strip_tags_content($this->request->data['captcha'])) != strtoupper($this->Captcha->getCaptcha()) ){
				$captcha = $this->Captcha->generateCaptcha(3,1);
				$checkInputOk = false;
			}



			$pdfinvoice->id = str_replace( "-", strtolower($this->My->generateRandomString(8)), Text::uuid() );
			$pdfinvoice->hash = str_replace( "-", strtolower($this->My->generateRandomString(8)), Text::uuid() );

			$pdfinvoice->name 		= $this->strip_tags_content($this->request->data['name']);
			$pdfinvoice->sub_id		= $this->strip_tags_content($this->request->data['sub_id']);
			$pdfinvoice->email 		= $this->strip_tags_content($this->request->data['email']);
			$pdfinvoice->city 		= $this->strip_tags_content($this->request->data['city']);
			$pdfinvoice->address 	= $this->strip_tags_content($this->request->data['address']);
			$pdfinvoice->phone 		= $this->strip_tags_content($this->request->data['phone']);

			if(isset($this->request->data['taxnumber']) && $this->request->data['taxnumber']!=''){
				$pdfinvoice->taxnumber	= $this->strip_tags_content($this->request->data['taxnumber']);
			}

			$pdfinvoice->cb1 = 0;
			$pdfinvoice->cb2 = 0;
			$pdfinvoice->cb3 = 0;
			$pdfinvoice->cb4 = 0;
			$pdfinvoice->cb5 = 0;

			if(isset($this->request->data['cb1']) && $this->request->data['cb1']=='on' ){
				$pdfinvoice->cb1 = 1;
			}
			if(isset($this->request->data['cb2']) && $this->request->data['cb2']=='on' ){
				$pdfinvoice->cb2 = 1;
			}
			if(isset($this->request->data['cb3']) && $this->request->data['cb3']=='on' ){
				$pdfinvoice->cb3 = 1;
			}
			if(isset($this->request->data['cb4']) && $this->request->data['cb4']=='on' ){
				$pdfinvoice->cb4 = 1;
			}
			if(isset($this->request->data['cb5']) && $this->request->data['cb5']=='on' ){
				$pdfinvoice->cb5 = 1;
			}

			//debug($pdfinvoice);
			//debug($this->Captcha->getCaptcha());
			//die();

			if($checkInputOk===true){

				if ($this->Pdfinvoices->save($pdfinvoice)) {

					// ################################# VISSZAIGAZOLÁS ############################################
					$email = new Email('default');
					$email->transport('saghysat');
					$email->template('default', 'default');
					$email->emailFormat('html');
					$email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);
					$email->to($pdfinvoice->email);
					$email->subject('Visszaigazolás PDF számla igénylésről');
					$re  = "<h3>Tisztelt Előfizetőnk!</h3>";
					$re .= "<p>PDF számla igényét megkaptuk.</p>";
					$re .= "<p>Az aktiváláshoz kérem kattintson az alábbi (zöld) gombra.</p>";


					$re .= '<a href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/activate/'.$pdfinvoice->id.$pdfinvoice->hash.'" style="text-decoration: none; color: white;">';
						$re .= '<div style="text-align: center; width: 400px; background: green; color: white; padding: 10px; font-size: 20px; font-family: Arial; font-weight: bold;">';
							$re .= "Email cím aktiválása";
						$re .= "</div>";
					$re .= "</a>";

					//debug($pdfinvoice->id);
					//debug($pdfinvoice->hash);
					//echo $re;
					//die();

					//$re	.= "<p>A megadott elérhetőségek egyikén hamarosan felvesszük Önnel a kapcsolatot és megbeszéljük a további részleteket.</p>\n";

					$re .= "<p>";
						$re .= "<b>Sághy-Sat Kft.</b><br>";
						$re .= "7754 Bóly, Ady E. u. 9.<br>";
						$re .= "Tel.: <b>+36 69/368-162</b><br>";
						$re .= "Email: <b>info@saghysat.hu</b><br>";
					$re .= "</p>\n";
					$re .= "<hr>\n";
					$re .= "<p>Amint azt tudják, az internet segítségével eljuttatott e-maileket harmadik személy is kiküldheti, tartalmát megváltoztathatja. Ez okból az e-mail formájában küldött leveleink nem jogköteles nyilatkozatok. Ezen e-mail tartalma és mellékletei bizalmasan kezelendők és jogilag védettek. Az e-mail tartalma kizárólag a címzettnek szól. Ennek továbbítása, másolat készítése harmadik személy általi egyéb felhasználása nem engedélyezett. Ezért kérjük, amennyiben a jelen e-mail nem Önnek lett címezve, tájékoztatás után törölje postaládájából. ";
					$re .= "Ha a gazdasági esemény megtörténik, ha a szolgáltatást megrendelik, azaz legalább a megrendelés véglegesedik, akkor a ránk vonatkozó adatvédelmi előírásoknak, mint Partnerünk felé, maradéktalanul eleget teszünk. Addig cégünk ezeket az adatokat bizalmasan kezeli, de további kapcsolatfelvétel hiányában rögzítésre, tárolásra nem kerülnek.";
					$re .= "</p><p>\n";
					$re .= "As you are aware, messages sent by e-mail can be manipulated by third parties. For this reason our e-mail messages are generally not legally binding. This electronic message (including any attachments) contains confidential information and may be privileged or otherwise protected from disclosure. The information is intended to be for the use of the intended addressee only. Please be aware that any disclosure, copy, distribution or use of the contents of this message is prohibited. If you have received this e-mail in error please notify me immediately by reply e-mail and delete this message and any attachments from your system. ";
					$re .= "If the economic event happens, if the service is ordered it means at least the order is finalized, we will fully comply the data protection regulations towards to our Partner. Until then our company keeps those datas confidential, but it will be not stored in the absence of further contact.</p>\n";

					if($this->debug){
						echo $re;
					}else{
						$email->send($re);
					}

/*
					// ################################# SAJÁT RÉSZRE ############################################
					// ################################# SAJÁT RÉSZRE ############################################
					// ################################# SAJÁT RÉSZRE ############################################
					$email = new Email('default');
					$email->transport('saghysat');
					$email->template('default', 'default');
					$email->emailFormat('html');

					$email->from('www@saghysat.hu', 'PDF számla igénylés: '.$pdfinvoice->name);
					//$email->returnPath($pdfinvoice->email, $pdfinvoice->name);
					$email->replyTo($pdfinvoice->email, $pdfinvoice->name);

					$email->subject('PDF számla igénylése: #'.$pdfinvoice->sub_id.' - '.$pdfinvoice->name);

					$re = "<h3>PDF számla igénylése</h3>";
					$re .= "<p>";
						$re .= "Neve: <b>".$pdfinvoice->name."</b><br>";
						$re .= "Ügyfélszám: <b>".$pdfinvoice->sub_id."</b><br>";
						$re .= "Email: <a href='mailto:".$pdfinvoice->email."'><b>".$pdfinvoice->email."</b></a><br>";
						$re .= "Település: <b>".$pdfinvoice->city."</b><br>";
						$re .= "Cím: <b>".$pdfinvoice->address."</b><br>";
						$re .= "Telefonszám: <b>".$pdfinvoice->phone."</b><br>";
						$re .= "Típus: <b>".$pdfinvoice->type."</b><br>";
						$re .= "Adószám: <b>".$pdfinvoice->taxnumber."</b><br>";
						$re .= "<hr>";

						if($pdfinvoice->cb1==1){$cb1="X"; }else{$cb1="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb2==1){$cb2="X"; }else{$cb2="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb3==1){$cb3="X"; }else{$cb3="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb4==1){$cb4="X"; }else{$cb4="&nbsp;&nbsp;&nbsp;";}
						if($pdfinvoice->cb5==1){$cb5="X"; }else{$cb5="&nbsp;&nbsp;&nbsp;";}
						$re .= "<b>[".$cb1."]</b> *Hozzájárul, hogy a szolgáltatáshoz kapcsolódó információkkal megkeressük.<br>";
						$re .= "<b>[".$cb2."]</b> Hozzájárul, hogy marketing ajánlatokkal Email-ben megkeressük.<br>";
						$re .= "<b>[".$cb3."]</b> Hozzájárul, hogy a megadott adatokat 3. félnek átadjuk marketing szempontjából.<br>";
						$re .= "<b>[".$cb4."]</b> *Hozzájárul, hogy a megadott telefonszámon szóban illetve SMS-ben a szolgáltatáshoz kapcsolódóan megkeressük.<br>";
						$re .= "<b>[".$cb5."]</b> *Adatkezelési szabályzatot elolvasta és tudomásul vette.<br>";

					$re .= "</p>\n";
					$re .= "<hr>\n";
					$re .= "";	// Folyt.köv., ha kell

					// https://www.w3resource.com/php-exercises/php-basic-exercise-5.php
					$ip_address = "";
					if (!empty($_SERVER['HTTP_CLIENT_IP'])){				//whether ip is from share internet
						$ip_address = "HTTP_CLIENT_IP: ".$_SERVER['HTTP_CLIENT_IP'];
					}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){		//whether ip is from proxy
						$ip_address = "HTTP_X_FORWARDED_FOR: ".$_SERVER['HTTP_X_FORWARDED_FOR'];
					}else{													//whether ip is from remote address
						$ip_address = "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR'];
					}
					$re .= $ip_address;
					$re .= "<hr>\n";

					if($this->debug){
						echo $re;
						debug($pdfinvoice);
					}else{
						if($this->onlyForMe){
							$email->to('zsolt@saghysat.hu');
							$email->send($re);
						}else{
							$email->to('info@saghysat.hu');
							$email->send($re);
							$email->to('zsolt@saghysat.hu');
							$email->send($re);
						}
					}
*/

					$this->Flash->success(__('PDF Számla igényét megkaptuk! A megadott elérhetőségek egyikén hamarosan felkeressük Önt.'));
					return $this->redirect('/pdfszamla-sikeres-regisztracio');
				} else {
					$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az megadott adatokat és mentse újra! (Hibakód: #2)'));
				}

			} else {
				$this->Flash->error("Adatok mentése nem sikerült. Kérem ellenőrizze a megadott adatokat és mentse újra! (Hibakód: #1)<br>Egy lehetséges ok a mentés sikertelensésére, hogy hibás Cookie-kat tárol a böngészője. Kérem törölje őket majd frissítse az oldalt és töltse ki újra az adatlapot.");
			}


        }
		$captcha = $this->Captcha->generateCaptcha(3,1);

        $this->set(compact('pdfinvoice','captcha'));
        $this->set('_serialize', ['pdfinvoice']);
    }



	public function strip_tags_content($string) {
		// ----- remove HTML TAGs -----
		$string = preg_replace ('/<[^>]*>/', ' ', $string);
		// ----- remove control characters -----
		$string = str_replace("\r", '', $string);
		$string = str_replace("\n", ' ', $string);
		$string = str_replace("\t", ' ', $string);
		$string = str_replace(";", ' ', $string);
		$string = str_replace("*", ' ', $string);
		$string = str_replace("%", ' ', $string);
		$string = str_replace("_", ' ', $string);
		$string = str_replace("SELECT", ' ', $string);
		$string = str_replace("DROP", ' ', $string);
		$string = str_replace("TRUNCATE", ' ', $string);
		$string = str_replace("STOP", ' ', $string);
		$string = str_replace("START", ' ', $string);
		$string = str_replace("FROM", ' ', $string);
		$string = str_replace("DELIMITER", ' ', $string);
		$string = str_replace("name", ' ', $string);
		// ----- remove multiple spaces -----
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		return $string;

		//return strip_tags($string);
		/*
		return strip_tags(preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '.', $string));
		*/
	}

    public function info() {
		$this->loadModel('Texts');
        $text = $this->Texts->get(1021);
        if($text){
            $this->set('text_title',$text['title']);
            $this->set('text_body',$text['text']);
        }
	}

}



/*
CB:
- Hozzájárulok ahhoz, hogy a Sághy-Sat Kft a szolgáltatáshoz kapcsolódó információkkal megkeressen. - Kötelező
- Marketing ajánlatokkal (1 v 2 oldalas PDF a számlahátoldalakkal vagy sem)
- Hozzájáruk, hogy 3. félnek marketing szempontjából a megadott adatait átadjuk
- A megadott telefonszámon szóban illetve SMS-ben a szolgáltatáshoz kapcsolódóan megkeressük. - kötelező
- Adatkezelési szabályzatot elolvastam és tudomásul vettem.

* A fenti űrlap kitöltésével tudomásul veszem, h a Sághy-Sat kft a számláimat ezután Emailban juttatja el részemre.
* Link, h le tudja mondani.
*/
