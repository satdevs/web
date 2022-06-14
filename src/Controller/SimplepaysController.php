<?php  // https://stackoverflow.com/questions/28518238/how-can-i-use-my-own-external-class-in-cakephp-3-0
namespace App\Controller;
use App\Controller\AppController;

use SimplePay\SimplePay;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class SimplepaysController extends AppController{
	public $title 	= "Számla befizetése";
	public $params 	= [];

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Captcha');
    }
	
    public function back() {
		$this->title = 'Fizetés folyamatban...';
		$this->set('title', $this->title);
		$data = [];
		$saveError = false;
		
		$sp = new SimplePay;
		$back = $sp->back();

		//'order_id'	=> (string) $simplepay->ids . '-' . $simplepay->id,	// #rec
		// Pl.: IDS10012340-17202
        $simplepay = $this->Simplepays->find()->where(['id' => substr($back['raw']['o'], strpos($back['raw']['o'], '-')+1 )])->first();
		
		$simplepay->retResponseCode  = $back['raw']['r'];
		$simplepay->retTransactionId = $back['raw']['t'];
		$simplepay->retEvent 		 = $back['raw']['e'];	// SUCCESS, FAIL, TIMEOUT, CANCEL
		$simplepay->retMercant 		 = $back['raw']['m'];
		$simplepay->retOrderId 		 = $back['raw']['o'];	
		
		$simplepay = $this->Simplepays->patchEntity($simplepay, $data);
		if(!$this->Simplepays->save($simplepay)) {
			$saveError = true;
			$message['saveError'] = '<span style="color: red; font-weight: bold;">Az adatokat nem sikerült menteni!<br>Kérjük, jelezze ügyfélszolgálatunknak a képernyőn látható paraméterekkel!</span>';
		}

		$message = $back['raw'];
		$message['success'] = false;
		$message['thx'] = 'Kérem várjon!';	// A switch-ek között majd felülíródik...
		
		switch( $back['raw']['e'] ){
			case 'SUCCESS':
				$this->title = 'Fizetés folyamatban...';
				$message['success'] = true;
				$message['thx'] 	= 'Köszönjük befizetését!';
				$message['message'] = 'Kérem várjon!';
				break;
			case 'FAIL':
				$this->title = 'Sikertelen fizetés!';
				$this->loadModel('SimplepayErrorcodes');
				$errorCode = $this->SimplepayErrorcodes->find()->where(['id' => $back['raw']['r']])->first();
				if(!empty($errorCode)){
					$message['thx'] 	= $errorCode->name;
				}else{
					$message['thx'] 	= 'Sikertelen fizetés!';
				}
				$message['message'] = 'Sikertelen fizetés!';
				break;
			case 'TIMEOUT':
				$this->title = 'Sikertelen fizetés!';
				$this->loadModel('SimplepayErrorcodes');
				$errorCode = $this->SimplepayErrorcodes->find()->where(['id' => $back['raw']['r']])->first();
				if(!empty($errorCode)){
					$message['thx'] 	= $errorCode->name;
				}else{
					$message['thx'] 	= 'Időtúllépés! &rarr; Lejárt a rendelkezésr álló idő! Kérjük próbálja később!';
				}
				$message['message'] = 'Sikertelen fizetés!';
				break;
			case 'CANCEL':
				$this->title = 'Sikertelen fizetés!';
				$this->loadModel('SimplepayErrorcodes');
				$errorCode = $this->SimplepayErrorcodes->find()->where(['id' => $back['raw']['r']])->first();
				if(!empty($errorCode)){
					$message['thx'] 	= $errorCode->name;
				}else{
					$message['thx'] 	= 'Megszakított fizetés!';
				}
				$message['message'] = 'Sikertelen fizetés!';
				break;
			default:
				$this->title = 'Sikertelen fizetés!';
				$message['message'] = 'Nem jött válasz a SimplePay szerverétől!';
				$message['thx'] 	= 'Kérem ellenőrizze bankszámláját a levonásról és jelezze nekünk a hibát az ügyfélszolgálatunkra.<br>tel.: +36 <b>69/696-696</b><br>E-mail: <b>info@saghysat.hu</b>';
				break;
		}

		$this->set('title', $this->title);
		$this->set('message', $message);
		
	}








	// An optional sender
	public function domain_exists($email, $record = 'MX'){
		list($user, $domain) = explode('@', $email);
		return checkdnsrr($domain, $record);
	}


	
    public function pay()
	{
		$error = false;
		$message = '';

		$text['title'] = '';
		$text['text'] = '';
		$this->loadModel('Texts');
        $text = $this->Texts->get(3);
		$this->set('gdpr_title',$text['title']);
		$this->set('gdpr_body',$text['text']);

        $simplepay = $this->Simplepays->newEntity();
        if ($this->request->is('post')) {

			// Előellenőrzés, hogy minden mezőben van-e adat
			foreach($this->request->data as $d){
				if( trim($d) == '' ){
					$error = true;
					$message .= '• Kérem minden adatot adjon meg!<br>';
				}		
			}

			// ----------- form kezelése ---------
            $simplepay = $this->Simplepays->patchEntity($simplepay, $this->request->data);
			
			//----------- IDS ellenőrzése -------------
			$simplepay->ids = trim($simplepay->ids);
			
			if(!$error){
				if( substr($simplepay->ids, 0, 3) != 'IDS'){
					$error = true;
					$message .= '• Nem adta meg vagy helytelenül adta meg az IDS előtagot!<br>';
				}
			}
			
			if(!$error){	// IDS10012345
				if( strlen($simplepay->ids) != 11 ){
					$error = true;
					$message .= '• Kérem, hogy pontosan annyi karaktert adjon meg, amennyi a számlán van a befizető azonosítónál!<br>';
				}
			}
			//echo strlen($simplepay->ids). ' karaktert adott meg!<br>';

			if(!$error){
				$num = (int) substr($simplepay->ids, 3);			
				if( $num != substr($simplepay->ids, 3) ){
					$error = true;
					$message .= '• Kérem, csak számokat adjon meg az IDS után!<br><i>Megjegyzés: a nulla az nem "o" betű!</i><br>';
				}
			}

			if(!$error){
				if(!$this->luhnVerify(substr($simplepay->ids, 3))){
					$error = true;
					$message .= '• Kérem ellenőrizze a megadott befizetőazonosítót!<br>';
				}
			}
			//--------- /.IDS ellenőrzése -------------


			//--------- Név ellenőrzése ---------------
			if(!$error){
				//if(!preg_match("/^[a-zA-ZíÍéÉáÁűŰőŐúÚöÖüÜóÓßäÄ'-]+$/", $simplepay->name)){				
				// 
				//if(!preg_match("/^([\-\.íÍéÉáÁűŰőŐúÚöÖüÜóÓßäÄa-zA-Z'-]+)$/",$simplepay->name)){
				//	$error = true;
				//	$message .= '• A név mezőnek legalább egy szóközt kell tartalmaznia!<br>';
				//	$message .= '• A név mező nem tartalmazhat számokat és egyéb speciális karaktereket!<br>';
				//}
			}
			//------- /.Név ellenőrzése ---------------


			//------- E-mail ellenőrzése --------------
			if(!$error){
				if(!filter_var($simplepay->email, FILTER_VALIDATE_EMAIL)) {
					$error = true;
					$message .= '• Kérem ellenőrizze a megadott e-mail címet!<br>';
				}
				if(!$this->domain_exists($simplepay->email)) {
					$error = true;
					$message .= '• Kérem létező e-mail címet adjon meg!<br>';
				}
			}
			//------- /.E-mail ellenőrzése --------------
			

			//------- Összeg ellenőrzése ----------------
			if(is_int($simplepay->amount) == false)
			{
				$error = true;
				$message .= '• A megadott összeg mezőt ne hagyja üresen!<br>&nbsp;&nbsp;-&nbsp;A megadott összeg nem tartalmazhat szóközt és egyéb karaktereket a számokon kívül!<br>';
			}else{
				if($simplepay->amount <= 0){
					$error = true;
					$message .= '• A megadott összeg csak pozitív egész szám lehet!<br>';
				}
			}
			//------- /.Összeg ellenőrzése --------------


			if(!isset($simplepay->cb_gdpr) || (isset($simplepay->cb_gdpr) && $simplepay->cb_gdpr != 'on') ){
				$error = true;
				$message .= '• Az adatkezelési tájékoztatót el kell fogadni! Kérem jelölje be jelölőnégyzetet!<br>';
			}

			//$error = true;	// TESZT

			//die('<br>xxxx');
			// =========================== Ha az adatok helyesek, akkor mehet a befizetés ===========================
			if(!$error){
			
				// Pl.: IDS10012345
				//      01234567890
				$sub_id = (int) substr( $simplepay->ids, 4, 6);
				
				$this->loadModel('SzlaSubs');
				$sub = $this->SzlaSubs->find()->contain(['SzlaCities', 'SzlaStreets'])->where(['SzlaSubs.id' => $sub_id])->first();
				
				if( empty($sub)){
					$this->Flash->error(__('Nem találtam az ügyféladatokat. Hibás befizetőazonosítót adott meg!<br>Amennyiben jól adta meg, kérjük hívja ügyfélszolgálatunkat a +36&nbsp;69/696-696 telefonszámon!'));
					//$this->redirect(['action' => 'pay']);
				}else{

					$simplepay->sub_id 	= $sub->id;
					$simplepay->name 	= $sub->name;
					$simplepay->city 	= $sub->szla_city->name;
					$simplepay->zip 	= $sub->szla_city->irsz;
					$simplepay->state 	= $sub->szla_city->name;
					$simplepay->address	= $sub->szla_street->name . " " . $sub->HSZ;
					$simplepay->country = 'hu';
				
					if ($this->Simplepays->save($simplepay)) {
						
// ###########################################################################################################################
						$sp = new SimplePay;
// ###########################################################################################################################

						// SimplePay paraméterek
						$this->params = [
							'order_id'	=> (string) $simplepay->ids . '-' . $simplepay->id,	// #rec
							'ids'		=> $simplepay->ids,
							'amount'	=> $simplepay->amount,
							'name' 		=> $simplepay->name,
							'state'		=> $simplepay->state,
							'zip' 		=> $simplepay->zip,
							'city' 		=> $simplepay->city,
							'address'	=> $simplepay->address,
							'country'	=> $simplepay->country,
							'email'		=> $simplepay->email,
						];
						
						// SimplePay hívása
						$startReturn = $sp->start($this->params);					

						$spsTable = TableRegistry::get('Simplepays');
						$sp = $spsTable->get($simplepay->id);
						
						// ----------------------- Naplózás ---------------------
						$sp->request 			= print_r( $startReturn['request'], true);
						$sp->returnDataForm 	= print_r( $startReturn['returnDataForm'], true);
						$sp->returnData 		= print_r( $startReturn['returnData'], true);
						// /.--------------------- Naplózás ---------------------

						
						if( isset( $startReturn['returnData']['transactionId'] ) )
						{
							$sp->transaction_id = $startReturn['returnData']['transactionId'];
						}
						
						if( isset( $startReturn['returnData']['transactionId'] ) ){
							if($spsTable->save($sp))
							{								
								//$responseBody = json_decode( $startReturn['returnData']['responseBody'] );
								//if( !empty( $responseBody->paymentUrl ) ){
								//	return $this->redirect($responseBody->paymentUrl);									
								//}
								if( !empty( $startReturn['returnData']['paymentUrl'] ) ){
									return $this->redirect( $startReturn['returnData']['paymentUrl'] );
								}
								//$this->startButton($startReturn['returnDataForm']);
							}
						}else{
							$this->Flash->error(__('Hiányzó tranzakció azonosító!'));
						}

						//$this->Flash->error(__('Nem sikerült a SimplePay válaszokat menteni!'));
						
					} else {
						$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
					}

				}

			}else{
				$this->Flash->error( $message );
			}
			
        }
		
		
		$this->loadModel('Texts');
		$gdpr = $this->Texts->find()->where(['id' => 1029])->first();
		
        $this->set(compact('simplepay', 'gdpr'));
        $this->set('_serialize', ['simplepay']);
    }


	/*
	// Redirecttel megy e helyett!
	public function startButton($button)
	{
		$this->viewBuilder()->template('startButton');
		$form = 'Hibás kommunikácó a SimplePay szerverével!<br><b>Átmenetileg nem lehetséges a fizetés!</b>';
		if( isset( $button ) )
		{
			$form = $button;
		}
		$this->set('form', $form);
	}
	*/

		




    public function ipn() {
		$error = false;
		$errorText = '';
		$saveError = false;
		$data = [];
		
		$sp = new SimplePay;
		$ipnReturn = $sp->ipn();

		$f = print_r($ipnReturn, true);		
		$file = fopen("/var/www/saghysat/logs/simplepay/IPN_RETURN_" . date("Ymd_His") . ".log","w");
		echo fwrite($file, $errorText . "\n" . $f );
		fclose($file);		

		$ipn = json_decode( $ipnReturn['confirmContent'] );

		$f = print_r($ipn, true);
		$file = fopen("/var/www/saghysat/logs/simplepay/IPN_" . date("Ymd_His") . ".log","w");
		echo fwrite($file, $errorText . "\n" . $f );
		fclose($file);		

		
		if( empty( $ipnReturn['signature'] ) ){
			$errorText = 'Hiányzó ipnReturn[signature]';
			$error = true;
		}
		if(empty($ipn->orderRef)){
			$errorText = 'Hiányzó ipn->orderRef';
			$error = true;
		}

		if($error){
			$f = print_r($ipnReturn, true);		
			$file = fopen("/var/www/saghysat/logs/simplepay/IPN_ERROR_" . date("Ymd_His") . ".log","w");
			echo fwrite($file, $errorText . "\n" . $f );
			fclose($file);		
		}

		if(!$error){
			$simplepay = $this->Simplepays->find()->where(['id' => substr($ipn->orderRef, strpos($ipn->orderRef, '-')+1 )])->first();
			$data['ipnSignature'] 	 	= $ipnReturn['signature'];
			$data['ipnStatus'] 		 	= $ipn->status;
			$data['ipnSalt'] 		 	= $ipn->salt;
			$data['ipnOrderRef'] 	 	= $ipn->orderRef;
			$data['ipnMethod'] 		 	= $ipn->method;
			$data['ipnMerchant'] 	 	= $ipn->merchant;
			$data['ipnTransactionId']	= $ipn->transactionId;
			$data['ipnFinishDate'] 	 	= new Time($ipn->finishDate);
			$data['ipnPaymentDate']  	= new Time($ipn->paymentDate);
			$data['ipnReceiveDate']  	= new Time($ipn->receiveDate);
			
			$simplepay = $this->Simplepays->patchEntity($simplepay, $data);
			if(!$this->Simplepays->save($simplepay)) {
				$saveError = true;
			}

			$f = print_r($data, true);		
			$file = fopen("/var/www/saghysat/logs/simplepay/IPN_SAVE_" . date("Ymd_His") . ".log","w");
			echo fwrite($file, $f );
			fclose($file);		

		}else{
			$f = print_r($ipnReturn, true);		
			$file = fopen("/var/www/saghysat/logs/simplepay/ERROR_" . date("Ymd_His") . ".log","w");
			echo fwrite($file, $f );
			fclose($file);		
		}
		
		
		if($saveError){
			$f = print_r($ipn, true);
			$file = fopen("/var/www/saghysat/logs/simplepay/IPN-SAVE_ERROR_" . date("Ymd_His") . ".log","w");
			echo fwrite($file, print_r($f, true) );
			fclose($file);		
		}
		
		exit;
	}

	
	// AJAX-szal 2 mp-ként kérdezi le, hogy visszajött-e az IPN.
    public function checkIpn($orderRef = null)
	{
		$success = false;
		$this->autoRender = false;
        $this->response->disableCache();
		if ($this->request->is(['post', 'ajax'])) {
			$data = $this->request->input('json_decode');
			$pay = $this->Simplepays->find()
				->where([
					'id' => substr($data->orderRef, strpos($data->orderRef, '-')+1 ),
					'retEvent' => "SUCCESS",
					'ipnStatus' => "FINISHED",	// Csak sikeresség esetén íródik be a FINISHED érték.
					'winszlaStatus' => "NEW",
				])->first();

			if(!empty($pay)){
				$success = true;
			}

			$response = [
				'success'	=> $success
			];
			$this->response->body(json_encode($response));
			return $this->response;
		}
		die();
	}
	





	/*
	
    public function success() {


		exit;
	}







    public function fail() {
		$sp = new SimplePay;
		$finishReturn = $sp->finish();
		
		debug('fail');
		debug($finishReturn);
		exit;
	}






    public function cancel() {
		$sp = new SimplePay;
		$finishReturn = $sp->finish();
		debug('cancel');
		debug($finishReturn);
		exit;
	}

    public function timeout() {
		$sp = new SimplePay;
		$finishReturn = $sp->finish();
		debug('timeout');
		debug($finishReturn);
		exit;
	}



*/








	
	// https://stackoverflow.com/questions/1418964/generating-luhn-checksums
	public function luhn($number, $iterations = 1)
	{
		while ($iterations-- >= 1)
		{
			$stack = 0;
			$number = str_split(strrev($number), 1);

			foreach ($number as $key => $value)
			{
				if ($key % 2 == 0)
				{
					$value = array_sum(str_split($value * 2, 1));
				}

				$stack += $value;
			}

			$stack %= 10;

			if ($stack != 0)
			{
				$stack -= 10;
			}

			$number = implode('', array_reverse($number)) . abs($stack);
		}

		return $number;
	}

	public function luhnVerify($number, $iterations = 1)
	{
		$result = substr($number, 0, - $iterations);

		if ($this->luhn($result, $iterations) == $number)
		{
			return $result;
		}

		return false;
	}


	/* Credit: https://github.com/hbattat/verifyEmail */
	// https://www.labnol.org/code/20152-validate-email-address
	function verifyEmail($toemail, $fromemail, $getdetails = false)
	{
		// Get the domain of the email recipient
		$email_arr = explode('@', $toemail);
		$domain = array_slice($email_arr, -1);
		$domain = $domain[0];

		// Trim [ and ] from beginning and end of domain string, respectively
		$domain = ltrim($domain, '[');
		$domain = rtrim($domain, ']');

		if ('IPv6:' == substr($domain, 0, strlen('IPv6:'))) {
			$domain = substr($domain, strlen('IPv6') + 1);
		}

		$mxhosts = array();
			// Check if the domain has an IP address assigned to it
		if (filter_var($domain, FILTER_VALIDATE_IP)) {
			$mx_ip = $domain;
		} else {
			// If no IP assigned, get the MX records for the host name
			getmxrr($domain, $mxhosts, $mxweight);
		}

		if (!empty($mxhosts)) {
			$mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
		} else {
			// If MX records not found, get the A DNS records for the host
			if (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
				$record_a = dns_get_record($domain, DNS_A);
				 // else get the AAAA IPv6 address record
			} elseif (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
				$record_a = dns_get_record($domain, DNS_AAAA);
			}

			if (!empty($record_a)) {
				$mx_ip = $record_a[0]['ip'];
			} else {
				// Exit the program if no MX records are found for the domain host
				$result = 'invalid';
				$details .= 'No suitable MX records found.';

				return ((true == $getdetails) ? array($result, $details) : $result);
			}
		}

		// Open a socket connection with the hostname, smtp port 25
		$connect = @fsockopen($mx_ip, 25);

		if ($connect) {

				  // Initiate the Mail Sending SMTP transaction
			if (preg_match('/^220/i', $out = fgets($connect, 1024))) {

						  // Send the HELO command to the SMTP server
				fputs($connect, "HELO $mx_iprn");
				$out = fgets($connect, 1024);
				$details .= $out."n";

				// Send an SMTP Mail command from the sender's email address
				fputs($connect, "MAIL FROM: <$fromemail>rn");
				$from = fgets($connect, 1024);
				$details .= $from."n";

							// Send the SCPT command with the recepient's email address
				fputs($connect, "RCPT TO: <$toemail>rn");
				$to = fgets($connect, 1024);
				$details .= $to."n";

				// Close the socket connection with QUIT command to the SMTP server
				fputs($connect, 'QUIT');
				fclose($connect);

				// The expected response is 250 if the email is valid
				if (!preg_match('/^250/i', $from) || !preg_match('/^250/i', $to)) {
					$result = 'invalid';
				} else {
					$result = 'valid';
				}
			}
		} else {
			$result = 'invalid';
			$details .= 'Could not connect to server';
		}
		if ($getdetails) {
			return array($result, $details);
		} else {
			return $result;
		}
	}








}
