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


class InternetextrasController extends AppController{
	public $title = "1000 Mbps-os Internet Extra csomag igénylése";
	//public $debug 		= false;
	//public $onlyForMe 	= false;

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
		//$this->loadComponent('RequestHandler');
        //$this->loadComponent('Captcha');
        //$this->loadComponent('My');
    }

    public function add($hash=null) {

		if($hash == null){
			return $this->redirect(['controller' =>'Texts', 'action' => 'view', 1036, "12bdf5a77i2bgf7xb2b67i2bgf7x43397i2bgf7x92e57i2bgf7x99e5b9fc2b0cf7194f547g1x87f28f9a7g1x87f245117g1x87f28e667g1x87f28"]);
		}

		$id   = substr($hash,  0, 64);
		$hash = substr($hash, 64, 64);
		
		$alreadyAccepted = $this->Internetextras->find('all', [
			'conditions' => [
				'pdf_id' 	=> $id,
				'pdf_hash'	=> $hash
			]
		])->first();

		if($alreadyAccepted !== null){
			return $this->redirect(['controller' =>'Texts', 'action' => 'view', 1036, $id . $hash]);
		}

		$this->loadModel('Pdfinvoices');

		$record = $this->Pdfinvoices->find('all', [
			'conditions' => [
				'id' => $id,
				'hash' => $hash
			]
		])->first();
		
		if(empty($record)){
			return $this->redirect(['controller' =>'Texts', 'action' => 'view', 1036, $id . $hash]);
		}
		
		$this->loadModel('Texts');
		$text = $this->Texts->get(3);
		if($text){
			$this->set('gdpr_title',$text['title']);
			$this->set('gdpr_body',$text['text']);
		}
		
        $internetextra = $this->Internetextras->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->data;
			$data['pdf_id'] = $record->id;
			$data['pdf_hash'] = $record->hash;
            $internetextra = $this->Internetextras->patchEntity($internetextra, $data);
            if ($this->Internetextras->save($internetextra)) {
				
				$email = new Email('default');
				$email->transport('saghysat');
				$email->template('default', 'default');
				$email->emailFormat('html');
				
				$re  = "<h3>Kedves ".$internetextra->name."!</h3>";
				
				$re .= "<p>1000 Mbps-os Internet Extra csomag igényét rögzítettük.</p>";
				
				$re .= "<p></p>";
				$re .= "<p>Köszönjük.</p>";

				$re .= "<p>";
					$re .= "<b>Sághy-Sat Kft.</b><br>";
					$re .= "7754 Bóly, Ady E. u. 9.<br>";
					$re .= "Tel.: <b>+36 69/368-162</b><br>";
					$re .= "Email: <b>info@saghysat.hu</b><br>";
				$re .= "</p>\n";
				$re .= "<p></p>";
				$re .= "<p></p>";
				$re .= "<hr>\n";
				$re .= "<p style='color: gray;'>Amint azt tudják, az internet segítségével eljuttatott e-maileket harmadik személy is kiküldheti, tartalmát megváltoztathatja. Ez okból az e-mail formájában küldött leveleink nem jogköteles nyilatkozatok. Ezen e-mail tartalma és mellékletei bizalmasan kezelendők és jogilag védettek. Az e-mail tartalma kizárólag a címzettnek szól. Ennek továbbítása, másolat készítése harmadik személy általi egyéb felhasználása nem engedélyezett. Ezért kérjük, amennyiben a jelen e-mail nem Önnek lett címezve, tájékoztatás után törölje postaládájából. ";
				$re .= "Ha a gazdasági esemény megtörténik, ha a szolgáltatást megrendelik, azaz legalább a megrendelés véglegesedik, akkor a ránk vonatkozó adatvédelmi előírásoknak, mint Partnerünk felé, maradéktalanul eleget teszünk. Addig cégünk ezeket az adatokat bizalmasan kezeli, de további kapcsolatfelvétel hiányában rögzítésre, tárolásra nem kerülnek.";
				$re .= "</p>\n";
				$re .= "<p style='color: gray;'>As you are aware, messages sent by e-mail can be manipulated by third parties. For this reason our e-mail messages are generally not legally binding. This electronic message (including any attachments) contains confidential information and may be privileged or otherwise protected from disclosure. The information is intended to be for the use of the intended addressee only. Please be aware that any disclosure, copy, distribution or use of the contents of this message is prohibited. If you have received this e-mail in error please notify me immediately by reply e-mail and delete this message and any attachments from your system. ";
				$re .= "If the economic event happens, if the service is ordered it means at least the order is finalized, we will fully comply the data protection regulations towards to our Partner. Until then our company keeps those datas confidential, but it will be not stored in the absence of further contact.";
				$re .= "</p>\n";

				$email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);
				$email->subject('1000 Mbps-os Internet Extra csomag igényét rögzítettük');

				$email->to($internetextra->email);
				$email->send($re);

				$email->to('zsolt@saghysat.hu');
				$email->send($re);

				// ############### AKTIVÁLVA saját részre elküldeni #######################
				$email = new Email('default');
				$email->transport('saghysat');
				$email->template('default', 'default');
				$email->emailFormat('html');
				
				//$email->from([$internetextra->email => $internetextra->name]);
				//$email->from('info@saghysat.hu', '1000 Mbps-os Internet Extra csomag igénylés: '.$internetextra->name);
				//$email->from(['support@saghysat.hu' => '']);
				//$email->returnPath($internetextra->email, $internetextra->name);
				//$email->replyTo($internetextra->email, $internetextra->name); // ??? kommentelve ???
				//$email->subject('PDF számla igénylés DEAKTIVÁLVA: '.$internetextra->custno." / ".$internetextra->name);

				$re  = "<h3>1000 Mbps-os Internet Extra csomag igénylés: <span style='color: red; font-weight: bold;'>AKTIVÁLVA</span>!</h3>";
				$re .= "<p>";
					$re .= "Neve: <b>".$internetextra->name."</b><br>";
					$re .= "Ügyfélszám: <b>".$internetextra->custno."</b><br>";
					$re .= "Email: <a href='mailto:".$internetextra->email."'><b>".$internetextra->email."</b></a><br>";
					$re .= "Település: <b>".$internetextra->city."</b><br>";
					$re .= "Cím: <b>".$internetextra->address."</b><br>";
					$re .= "<hr>";

					if($internetextra->accept==1){$accept="X"; }else{$accept="&nbsp;&nbsp;&nbsp;";}
					if($internetextra->cb5==1){$cb5="X"; }else{$cb5="&nbsp;&nbsp;&nbsp;";}
					$re .= "<b>[".$accept."]</b> *1000 Mbps-os Internet Extra csomag igénylelve.<br>";
					$re .= "<b>[".$cb5."]</b> *Adatkezelési szabályzatot elolvasta és tudomásul vette.<br>";
				$re .= "</p>\n";
				$re .= "<hr>\n";
				$re .= "<p>[TServices: 3]<p>";
				$re .= "<p>#1000MbpsInternetExtraCsomag<p>";
				$re .= "<hr>\n";

				$email->from('info@saghysat.hu', 'Web űrlap');
				$email->subject('[WSHU][1000IE]['.$internetextra->custno."] 1000 Mbps-os Internet Extra csomag igénylés");

				$email->to('support@saghysat.hu');
				$email->send($re);

				$email->to('zsolt@saghysat.hu');
				$email->send($re);

                return $this->redirect(['controller' =>'Texts', 'action' => 'view', 1037, $id . $hash]);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
		
        $this->set(compact('internetextra', 'record'));
        $this->set('_serialize', ['internetextra']);
    }

}
