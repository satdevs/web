<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;

class MessagesController extends AppController{
	public $title = "Kapcsolat";
	public $debug = false;	// Hogy épp tesztelem-e az üzenetküldést vagy sem. Elküldi a leveleket vagy sem. true teszt üzemmód, nem küld leveleket, false éles, tehát küld.

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Captcha');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function add($teszt=null) {
		if($teszt=='teszt'){
			//$this->Captcha->getCaptcha('teszt');
			//debug($this->request);
			//die();
		}
		
		//$this->Flash->warning('Karbantartás!!! Az üzenetküldés átmenetileg nem elérhető Kérem nézzen vissza később!');
		$text['title'] = '';
		$text['text'] = '';
		$content 	= '';
		$re 		= '';		
		$this->set('tab',1);
		$this->loadModel('Texts');
        $text = $this->Texts->get(3);
		$this->set('gdpr_title',$text['title']);
		$this->set('gdpr_body',$text['text']);

        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
			
            $this->request->data['readed'] = 0;
            $message = $this->Messages->patchEntity($message, $this->request->data);
            if ($this->Captcha->getCaptcha()==strtoupper($message->captcha) && $this->Messages->save($message)) {

/*				
				$error = false;

				// https://stackoverflow.com/questions/1161708/php-detect-whitespace-between-strings
				if(preg_match('/\s/',$this->request->data['name'])==0){
					$error = true;
					$message .= "• A teljes nevét legyen szíves megadni!\n";
				}
				
				if(!preg_match("/^[a-zA-ZíÍéÉáÁűŰőŐúÚöÖüÜóÓäÄ ]*$/", $data->name)){
					$error = true;
					$message .= "• A név csak betűkből és szóközökből állhat!\n";
				}
				
				if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
					$error = true;
					$message .= "• Hibás Email formátum!\n";
				}else{
					$domain_name = substr(strrchr($data->email, "@"), 1);	//$domain = explode('@', $email)[1];
					if (!checkdnsrr($domain_name, 'MX')) {			
						$error = true;
						$message .= "• Hibás domain név az Email címben! A '".$domain_name."' nem létezik!\n";
					}
				}
				
				if (!preg_match("/^[0-9]*$/", $data->zip)) {
					$error = true;
					$message .= "• Az irányítószám csak számokból állhat!\n!";
				}
				
				if (!preg_match("/^[a-zA-ZíÍéÉáÁűŰőŐúÚöÖüÜóÓäÄ]*$/", $data->city)) {
					$error = true;
					$message .= "• A településnév csak betűkből állhat!\n";
				}
				
				if (!preg_match("/^[a-zA-Z0-9íÍéÉáÁűŰőŐúÚöÖüÜóÓäÄ\,\.\/ ]*$/", $data->address)) {
					$error = true;
					$message .= "• A cím csak betűket, számokat és szóközöket tartalmazhat!\n";
				}

				if (!preg_match("/^[\+0-9]*$/", $data->phone)) {
					$error = true;
					$message .= "• A telefonszám csak számokból és + jelből állhat!\n";
				}
				
				if ($this->Captcha->getCaptcha()!=strtoupper($data->captcha) ){
					$error = true;
					$message .= "• Hibás biztonsági kódot adott meg. Kérem adja meg az új kódot!\n";
				}

				if (!preg_match("/^[0-9\,]*$/", $data->ids)) {
					$error = true;
					$message .= "• Hibás ID-ket küldött az AJAX által! ".$data->ids."\n";
				}		
				
				if($error){
					$this->redirect(['action' => 'add']);
					$this->Captcha->generateCaptcha(3,8);
					//return $this->redirect(['action' => 'add']);
				}
				
	*/			
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
                $email = new Email('default');
                $email->transport('saghysat');
                $email->template('default', 'default');
                $email->emailFormat('html');
                $email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);
                $email->to($this->request->data['email']);
                $email->subject('Üzenet küldés visszaigazolás a saghysat.hu weboldalról');

                $this->loadModel('Messagethemes');
                $messagetheme = $this->Messagethemes->get($this->request->data['messagetheme_id']);
                //$link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/admin/login';

				$re  = "Tisztelt Érdeklődő!<br>\n";
				$re .= "<p>Üzenetét megkaptuk.<br>";
				$re	.= 	"A megadott elérhetőségek egyikén hamarosan felvesszük Önnel a kapcsolatot és megbeszéljük a további részleteket.\n";
				$re .= "</p>\n";
				$re .= "<p>";
				$re .= 	"<b>Sághy-Sat Kft.</b><br>";
				$re .= 	"7754 Bóly, Ady E. u. 9.<br>";
				$re .= 	"Tel.: <b>+36 69/368-162</b><br>";
				$re .= 	"Email: <b>info@saghysat.hu</b><br>";
				$re .= "</p>\n";
				$re .= "<p>Amint azt tudják, az internet segítségével eljuttatott e-maileket harmadik személy is kiküldheti, tartalmát megváltoztathatja. Ez okból az e-mail formájában küldött leveleink nem jogköteles nyilatkozatok. Ezen e-mail tartalma és mellékletei bizalmasan kezelendők és jogilag védettek. Az e-mail tartalma kizárólag a címzettnek szól. Ennek továbbítása, másolat készítése harmadik személy általi egyéb felhasználása nem engedélyezett. Ezért kérjük, amennyiben a jelen e-mail nem Önnek lett címezve, tájékoztatás után törölje postaládájából. ";
				$re .= "Ha a gazdasági esemény megtörténik, ha a szolgáltatást megrendelik, azaz legalább a megrendelés véglegesedik, akkor a ránk vonatkozó adatvédelmi előírásoknak, mint Partnerünk felé, maradéktalanul eleget teszünk. Addig cégünk ezeket az adatokat bizalmasan kezeli, de további kapcsolatfelvétel hiányában rögzítésre, tárolásra nem kerülnek.";
				$re .= "</p><p>\n";
				$re .= "As you are aware, messages sent by e-mail can be manipulated by third parties. For this reason our e-mail messages are generally not legally binding. This electronic message (including any attachments) contains confidential information and may be privileged or otherwise protected from disclosure. The information is intended to be for the use of the intended addressee only. Please be aware that any disclosure, copy, distribution or use of the contents of this message is prohibited. If you have received this e-mail in error please notify me immediately by reply e-mail and delete this message and any attachments from your system. ";
				$re .= "If the economic event happens, if the service is ordered it means at least the order is finalized, we will fully comply the data protection regulations towards to our Partner. Until then our company keeps those datas confidential, but it will be not stored in the absence of further contact.</p>\n";
                if(!$this->debug){
					$email->send($re);					
				}
                


				if(isset($this->request->data['tab']) && $this->request->data['tab']=='1'){
					$content = '<h3>Látogatói üzenet</h3>';
				}
                $content 	.= "Neve: <b>".$this->strip_tags_content($this->request->data['name'])."</b><br>";
                $content 	.= "Email címe: <b>".$this->strip_tags_content($this->request->data['email'])."</b><br>";
                $content 	.= "Telefonszáma: <b>".$this->strip_tags_content($this->request->data['phone'])."</b><br>";
                $content 	.= "Cím: <b>".$this->strip_tags_content($this->request->data['address'])."</b><br>";
                $content 	.= "Téma: <b>".$this->strip_tags_content($messagetheme->name)."</b><br>";
                $content 	.= "Üzenet:<br>";
                $content 	.= "<b>".$this->strip_tags_content($this->request->data['body'])."</b><br>";
				$content .= "<hr>\n";
				
				// https://www.w3resource.com/php-exercises/php-basic-exercise-5.php
				if (!empty($_SERVER['HTTP_CLIENT_IP'])){				//whether ip is from share internet
					$ip_address = "HTTP_CLIENT_IP: ".$_SERVER['HTTP_CLIENT_IP'];
				}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){		//whether ip is from proxy
					$ip_address = "HTTP_X_FORWARDED_FOR: ".$_SERVER['HTTP_X_FORWARDED_FOR'];
				}else{													//whether ip is from remote address
					$ip_address = "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR'];
				}
                $content .= $ip_address;
				$content .= "<hr>\n";

                $email->from([$message->email => $message->name]);
                $email->subject('Üzenet a saghysat.hu weboldalról');

				$email->to('info@saghysat.hu');
				if(!$this->debug){
					if($email->send($content)){
						$this->Flash->success(__('Üzenetét megkaptuk. Válaszunkkal hamarosan felkeressük Önt a megadott elérhetőségek egyikén.'));
					}else{
						$this->Flash->error(__('Üzenet küldés nem sikerült! Kérem nézze át az adatokat s küldje újra!'));
					}

					$email->to('saghyt@saghysat.hu');
					$email->send($content);
					
					$email->to('zsolt@saghysat.hu');
					$email->send($content);
				}else{
					$this->Flash->success(__('Üzenetét megkaptuk. Válaszunkkal hamarosan felkeressük Önt a megadott elérhetőségek egyikén.'));
				}				
				
				$captcha = $this->Captcha->generateCaptcha(8,8);	//------------ Új kódot generál a beérkezés után, hogy nehogy ugyanazt még egyszer fel lehessen használni. ------------------
				
                return $this->redirect(['action' => 'add']);
            } else {
				if( $this->Captcha->getCaptcha() != strtoupper($message->captcha) ){
					$this->Flash->error(__('Hibás biztonsági kód! Kérem írja be újra az új kódot!'));
				}else{
					$this->Flash->error(__('Üzenetét nem sikerült elküldeni. Kérem ellenőrizze az adatokat és próbálja újra!'));
				}
				$this->Captcha->generateCaptcha(8,8);
            }
        }
        $messagethemes = $this->Messages->Messagethemes->find('list', ['limit' => 20]);
        $this->set('method','Üzenet küldése a Sághy-Sat Kft-nek');
		
		$captcha = $this->Captcha->generateCaptcha(3,10);
        $this->set(compact('message', 'messagethemes','captcha'));
        $this->set('_serialize', ['message']);
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
	
	
	//{"id":1,"name":"KTV","sla":72}
	//{"id":2,"name":"DigiKtv","sla":72}
	//{"id":3,"name":"Internet","sla":72}
	//{"id":4,"name":"Telefon","sla":72}
    public function message_customer($teszt=null) {
		$this->viewBuilder()->template('add');
		$this->set('tab',2);
		$catv_id	= 1;
		$digi_id	= 2;
		$net_id	 	= 3;
		$tel_id	 	= 4;
		$services_ids = '';
		$content 	= '';
		$re 		= '';
		
		
		if($teszt=='teszt'){
			//debug($_SESSION);
		}
		
        $message = $this->Messages->newEntity();
        if ($this->request->is('post')) {
			
            $this->request->data['readed'] = 0;
            $message = $this->Messages->patchEntity($message, $this->request->data);
			
			$message->cb_catv	 	= 0;
			$message->cb_net	 	= 0;
			$message->cb_tel	 	= 0;
			$message->cb_digi	 	= 0;
	
			if(isset($this->request->data['cb_catv']) && $this->request->data['cb_catv']=='on' ){
				$message->cb_catv	 	= 1;
			}
			if(isset($this->request->data['cb_net']) && $this->request->data['cb_net']=='on' ){
				$message->cb_net	 	= 1;
			}
			if(isset($this->request->data['cb_tel']) && $this->request->data['cb_tel']=='on' ){
				$message->cb_tel	 	= 1;
			}
			if(isset($this->request->data['cb_digi']) && $this->request->data['cb_digi']=='on' ){
				$message->cb_digi	 	= 1;
			}
			
			if(isset($this->request->data['tab']) && $this->request->data['tab']=='1'){
				$message->name 			= $this->request->data['name'];
				$message->email 		= $this->request->data['email'];
				$message->phone 		= $this->request->data['phone'];
				$message->address 		= $this->request->data['address'];
				$message->subject 		= $this->request->data['subject'];
				$message->body 			= $this->request->data['body'];
				$message->captcha		= $this->request->data['captcha'];
			}else{
				if(isset($this->request->data['tab']) && $this->request->data['tab']=='2'){
					$message->customer_id 	= $this->request->data['customer_id'];
					$message->name 			= $this->request->data['name2'];
					$message->email 		= $this->request->data['email2'];
					$message->phone 		= $this->request->data['phone2'];
					$message->address 		= $this->request->data['address2'];
					$message->subject 		= $this->request->data['subject2'];
					$message->body 			= $this->request->data['body2'];
					$message->captcha		= $this->request->data['captcha'];
				}else{
					$this->Flash->error(__('Technikai hiba! Hibás TAB azonosító!'));
					return $this->redirect(['action' => 'message_customer']);					
				}
			}
			
			//$this->request->data['name2'] = Null;
			//$this->request->data['email2'] = Null;
			//$this->request->data['phone2'] = Null;
			//$this->request->data['address2'] = Null;
			//$this->request->data['subject2'] = Null;
			//$this->request->data['body2'] = Null;
			//$this->request->data['captcha'] = Null;
			$message->readed = 0;
			
			//debug($this->Captcha->getCaptcha());
			//debug(strtoupper($message->captcha));
			//die();
			
			//$this->Flash->success($this->Captcha->getCaptcha().' <-> '.strtoupper($message->captcha));
			
            if ($this->Captcha->getCaptcha()==strtoupper($message->captcha) && $this->Messages->save($message)) {

                $email = new Email('default');
                $email->transport('saghysat');
                $email->template('default', 'default');
                $email->emailFormat('html');
                $email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);
                $email->to($message->email);
                $email->subject('Üzenet küldés visszaigazolás a saghysat.hu weboldalról');

				$re  = "Tisztelt Érdeklődő!<br>\n";
				$re .= "<p>Üzenetét megkaptuk.<br>";
				$re	.= 	"A megadott elérhetőségek egyikén hamarosan felvesszük Önnel a kapcsolatot és megbeszéljük a további részleteket.\n";
				$re .= "</p>\n";
				$re .= "<p>";
				$re .= 	"<b>Sághy-Sat Kft.</b><br>";
				$re .= 	"7754 Bóly, Ady E. u. 9.<br>";
				$re .= 	"Tel.: <b>+36 69/368-162</b><br>";
				$re .= 	"Email: <b>info@saghysat.hu</b><br>";
				$re .= "</p>\n";
				$re .= "<hr>\n";
				$re .= "<p>Amint azt tudják, az internet segítségével eljuttatott e-maileket harmadik személy is kiküldheti, tartalmát megváltoztathatja. Ez okból az e-mail formájában küldött leveleink nem jogköteles nyilatkozatok. Ezen e-mail tartalma és mellékletei bizalmasan kezelendők és jogilag védettek. Az e-mail tartalma kizárólag a címzettnek szól. Ennek továbbítása, másolat készítése harmadik személy általi egyéb felhasználása nem engedélyezett. Ezért kérjük, amennyiben a jelen e-mail nem Önnek lett címezve, tájékoztatás után törölje postaládájából. ";
				$re .= "Ha a gazdasági esemény megtörténik, ha a szolgáltatást megrendelik, azaz legalább a megrendelés véglegesedik, akkor a ránk vonatkozó adatvédelmi előírásoknak, mint Partnerünk felé, maradéktalanul eleget teszünk. Addig cégünk ezeket az adatokat bizalmasan kezeli, de további kapcsolatfelvétel hiányában rögzítésre, tárolásra nem kerülnek.";
				$re .= "</p><p>\n";
				$re .= "As you are aware, messages sent by e-mail can be manipulated by third parties. For this reason our e-mail messages are generally not legally binding. This electronic message (including any attachments) contains confidential information and may be privileged or otherwise protected from disclosure. The information is intended to be for the use of the intended addressee only. Please be aware that any disclosure, copy, distribution or use of the contents of this message is prohibited. If you have received this e-mail in error please notify me immediately by reply e-mail and delete this message and any attachments from your system. ";
				$re .= "If the economic event happens, if the service is ordered it means at least the order is finalized, we will fully comply the data protection regulations towards to our Partner. Until then our company keeps those datas confidential, but it will be not stored in the absence of further contact.</p>\n";
				if(!$this->debug){
					$email->send($re);
				}
				
				
				//----------- NEKÜNK IS ELKÜLDENI ---------------				
				if(isset($this->request->data['tab']) && $this->request->data['tab']=='2'){
					$content = '<h3>Előfizetői üzenet</h3>';
				}
				
				$cb_catv = " ";
				$cb_net	 = " ";
				$cb_tel	 = " ";
				$cb_digi = " ";
				$services_ids = '';
				
				
				if($message->cb_catv==1){$cb_catv = "X"; $services_ids .= $catv_id.',';}
				if($message->cb_digi==1){$cb_digi = "X"; $services_ids .= $digi_id.',';}
				if($message->cb_net==1){ $cb_net  = "X"; $services_ids .= $net_id.',';}
				if($message->cb_tel==1){ $cb_tel  = "X"; $services_ids .= $tel_id.',';}
				
                $content .= "[".$cb_catv."] Kábel TV<br>";
                $content .= "[".$cb_net."] Internet<br>";
                $content .= "[".$cb_tel."] Telefon<br>";
                $content .= "[".$cb_digi."] Digitális TV<br><br>";

                $content .= "Ügyfélszám: <b>".$this->strip_tags_content($message->customer_id)."</b><br>";
                $content .= "Neve: <b>".$this->strip_tags_content($message->name)."</b><br>";
                $content .= "Email címe: <b>".$this->strip_tags_content($message->email)."</b><br>";
                $content .= "Telefonszáma: <b>".$this->strip_tags_content($message->phone)."</b><br>";
                $content .= "Cím: <b>".$this->strip_tags_content($message->address)."</b><br>";
				
				if(isset($this->request->data['tab']) && $this->request->data['tab']=='1'){
					$this->loadModel('Messagethemes');
					$messagetheme = $this->Messagethemes->get($this->request->data['messagetheme_id']);
					$content 	.= "Téma: <b>".$this->strip_tags_content($messagetheme->name)."</b><br>";
				}
				
                $content .= "Üzenet:<br>";
                $content .= "<b>".$this->strip_tags_content($message->body)."</b><br>";
				$content .= "<hr>\n";
				
				// https://www.w3resource.com/php-exercises/php-basic-exercise-5.php
				if (!empty($_SERVER['HTTP_CLIENT_IP'])){				//whether ip is from share internet
					$ip_address = "HTTP_CLIENT_IP: ".$_SERVER['HTTP_CLIENT_IP'];
				}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){		//whether ip is from proxy
					$ip_address = "HTTP_X_FORWARDED_FOR: ".$_SERVER['HTTP_X_FORWARDED_FOR'];
				}else{													//whether ip is from remote address
					$ip_address = "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR'];
				}
                $content .= $ip_address;
				$content .= "<hr>\n";
				
				//$content .= "<br>";
				if(strlen($services_ids)>0){
					$services_ids = substr($services_ids,0,-1);
				}				
				//[Services: 1,2,4]
                $content .= "[TServices: ".$services_ids."]";
				
                $email->from([$message->email => $message->name]);
                $email->subject('[WSHU]['.$message->customer_id.'] Üzenet a saghysat.hu weboldalról!');

				$email->to('info@saghysat.hu');
				if(!$this->debug){
					if($email->send($content)){
						$this->Flash->success(__('Üzenetét megkaptuk. Válaszunkkal hamarosan felkeressük Önt a megadott elérhetőségek egyikén.'));
					}else{
						$this->Flash->error(__('Üzenet küldés nem sikerült! Kérem nézze át az adatokat s küldje újra!'));
					}				
				
					$email->to('saghyt@saghysat.hu');
					$email->send($content);

					$email->to('zsolt@saghysat.hu');
					$email->send($content);
				}else{
					$this->Flash->success(__('Üzenetét megkaptuk. Válaszunkkal hamarosan felkeressük Önt a megadott elérhetőségek egyikén..'));
				}				

				//------------ Új kódot generál a beérkezés után, hogy nehogy ugyanazt még egyszer fel lehessen használni. ------------------
				$captcha = $this->Captcha->generateCaptcha(8,8);

                return $this->redirect(['action' => 'message_customer']);
            } else {
				//if( $this->Captcha->getCaptcha() != strtoupper($message->captcha) ){
					$message->name 			= '';
					$message->email 		= '';
					$message->phone 		= '';
					$message->address 		= '';
					$message->subject 		= '';
					$message->body 			= '';
					$message->captcha		= '';
					$captcha = $this->Captcha->generateCaptcha(6,10);
					$this->set('captcha', $captcha);
					
					$this->Flash->error(__('Hibás biztonsági kód. Kérem írja be újra az új kódot!'));
				//}else{
				//	$this->Flash->error(__('Üzenetét nem sikerült elküldeni. Kérem ellenőrizze az adatokat és próbálja újra!'));
				//}
            }
        }
        $messagethemes = $this->Messages->Messagethemes->find('list', ['limit' => 20]);
        $this->set('method','Üzenet küldése a Sághy-Sat Kft-nek');
		$captcha = $this->Captcha->generateCaptcha(3,10);
        $this->set(compact('message', 'messagethemes','captcha'));
        $this->set('_serialize', ['message']);
    }

}
