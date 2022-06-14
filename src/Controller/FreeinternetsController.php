<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;

class FreeinternetsController extends AppController{
	public $title = "Díjmentes Internet";
	public $titles = [];

    public function initialize(){
        parent::initialize();

		if (date("Y-m-d") > '2020-11-27') {
			return $this->redirect('/');
		}	

        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Captcha');
        $this->_validViewOptions[] = 'pdfConfig';
		
		$this->titles = [
			1 =>'Tanuló', 
			2 =>'Tanuló II.1. szerinti törvényes képviselője', 
			3 =>'Tanuló által használt előfizetés II.1. szerinti előfizetője', 
			4 =>'Pedagógus-oktató', 
			5 =>'Pedagógus-oktató által használt előfizetés II.1. szerinti előfizetője', 
		];		
		
    }

    public function info() {
		$freeinternet = $this->Freeinternets->find()->where(['cookieId' => $_COOKIE['cookieId'], 'status' => 0])->first();
		if( empty( $freeinternet ) ){
			$freeinternet = $this->Freeinternets->newEntity();			
		}
		
        //if($this->request->is('post')) {
		if ($this->request->is(['patch', 'post', 'put'])) {
			$freeinternet = $this->Freeinternets->patchEntity($freeinternet, $this->request->data);
			$data = $this->request->data;
			if( isset($data['accept']) && $data['accept'] ){
				$freeinternet = $this->Freeinternets->patchEntity($freeinternet, $this->request->data);
				$freeinternet->accept = true;
				$freeinternet->cookieId = $_COOKIE['cookieId'];
				$freeinternet->ip = $this->getUserIP();
				//debug($freeinternet); die();
				if ($this->Freeinternets->save($freeinternet)) {
					return $this->redirect('/dijmentes-internet-adatlap');
				}
				$this->Flash->error(__('Nem sikerült menteni a regisztrációs kérelmet! Kérem használjon másik böngészőprogramot, például FireFox-ot vagy Chrome-t!'));
				
			}else{
				$this->Flash->error(__('Amennyiben nem jelöli be: hogy a "Büntetőjogi felelőssége tudatában ..." kis jelölőnégyzetét, akkor kizárólag papír alapon tudja beadni igényét az ügyfélszolgálatunkon.'));
			}

        }
		
		$this->loadModel('Texts');
		$text = $this->Texts->find()->where(['id' => 1026])->first();
        $this->set('text', $text);

        $this->set(compact('freeinternet', 'captcha'));
        $this->set('_serialize', ['freeinternet']);		
		
		//debug($text); die();
	}




    public function edit($id = null){
		$this->title = 'Díjmentes Internet igénylése';
		$this->set('title', $this->title);
		
		if(!isset($_COOKIE['cookieId']) || $_COOKIE['cookieId'] == ''){
			$this->Flash->error(__('Nem sikerült betölteni a regisztrációs űrlapot! Kérem használjon másik böngészőprogramot, például FireFox-ot vagy Chrome-t!<br>Valamint ne felejtse el engedélyezni a cookie-kat!'));
			return $this->redirect('/dijmentes-internet');
		}
		$freeinternet = $this->Freeinternets->find()->where(['cookieId' => $_COOKIE['cookieId'], 'status' => 0])->first();
		
		if( empty( $freeinternet ) ){
			//$this->Flash->error(__('Nem sikerült betölteni a regisztrációs űrlapot! Kérem használjon másik böngészőprogramot, például FireFox-ot vagy Chrome-t!<br>Valamint ne felejtse el engedélyezni a cookie-kat!'));
			return $this->redirect('/dijmentes-internet');
		}
		
		if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data;
			$captcha = $this->Captcha->getCaptcha();
			
			//$data['entitled_title'] = $this->titles[ $data['entitled_title_id'] ];			
			//debug($data); die();
			
			$error = false;
			foreach($data as $d){
				//debug($d);
				if(isset($d) && empty($d) || trim($d) == ''){
					$error = true;
				}
			}
			
			//debug($error);			
			//debug($data); die();
			
			if( !isset($data['cb1']) || !isset($data['cb2']) ){
				$error = true;
			}

			
			if( strtoupper($data['captcha']) != $captcha){
                $this->Flash->error(__('Hibás biztonsági kódot adott meg! #1'));
				//.$this->redirect('/dijmentes-internet-adatlap');
			}
			
			
			
            $freeinternet = $this->Freeinternets->patchEntity($freeinternet, $data);
			$freeinternet->entitled_title = $this->titles[ $freeinternet->entitled_title_id ];
			
			$freeinternet->status = 1;
			if( $error ){
				$freeinternet->status = 0;
			}
			
			$freeinternet->ip = $this->getUserIP();
			
            if ($this->Freeinternets->save($freeinternet)) {
				//debug($freeinternet); die();
				if( !$error ){
					//die('-- OK --');
					
					$email = new Email('default');
					$email->transport('saghysat');
					$email->template('default', 'default');
					$email->emailFormat('html');
					$email->from(['www@saghysat.hu' => 'Sághy-Sat Kft.']);
					$email->to('support@saghysat.hu');
					//$email->to($this->request->data['email']);
					$email->subject('[WSHU][ADAT][' . $freeinternet->sub_id . '] Díjmentes Internet regisztráció');
					$body = "<h1>Díjmentes Internet regisztráció adatlap!</h1>";
					$body .= "<h3>Igénylő adatlapja:</h3>";
					$body .= "Név: <b>".$freeinternet->name."</b><br>";
					$body .= "Ügyfélszám: <b>".$freeinternet->sub_id."</b><br>";
					$body .= "Település: <b>".$freeinternet->city."</b><br>";
					$body .= "Cím: <b>".$freeinternet->address."</b><br>";
					$body .= "E-mail: <b>".$freeinternet->email."</b><br>";
					$body .= "Telefon: <b>".$freeinternet->phone."</b><br>";
					$body .= "Jogosult neve: <b>".$freeinternet->entitled_name."</b><br>";
					$body .= "Jogosult jogcíme: <b>".$freeinternet->entitled_title."</b><br>";
					$body .= "Jogosult ig. név: <b>".$freeinternet->entitled_card_name."</b><br>";
					$body .= "Jogosult ig. száma: <b>".$freeinternet->entitled_card_number."</b><br>";
					$body .= "Jogosult települése: <b>".$freeinternet->entitled_city."</b><br>";
					$body .= "Jogosult címe: <b>".$freeinternet->entitled_address."</b><br>";
					$body .= "Okt. int. neve : <b>".$freeinternet->entitled_institution_name."</b><br>";
					$body .= "Okt. int. OM száma : <b>".$freeinternet->entitled_institution_OM."</b><br>* * *";
					
					$email->send($body);

					return $this->redirect('/dijmentes-internet-regisztralva');
				}else{
					//die('-- NEM OK --');
					$this->Flash->error(__('Kérem minden adatot adjon meg, valamint ne felejtse el bejelölni a jelölőnényzeteket'));
					//.$this->redirect('/dijmentes-internet-adatlap');
				}
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }

		$this->loadModel('Texts');
		$text = $this->Texts->find()->where(['id' => 1027])->first();
        $this->set('text', $text);

		$captcha = $this->Captcha->generateCaptcha(3,1);
		
        $this->set(compact('freeinternet', 'captcha'));
        $this->set('_serialize', ['freeinternet']);

    }


	public function message($id) {
		$this->loadModel('Texts');
        $text = $this->Texts->get($id);
        if($text){
            $this->set('text_title',$text['title']);
            $this->set('text_body',$text['text']);
        }
	}




	public function getUserIP()
	{
		// Get real visitor IP behind CloudFlare network
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
				  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
				  $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}


	public function resend()
	{
		return $this->redirect('/');
		die('xXx');
		$ids = [
			//'ID008578',
			//'ID006248',
			//'ID001314',
			//'ID004783',
			//'ID003437',
			//'ID005235',
		];
	
		$nets = $this->Freeinternets->find()->where(['sub_id IN ' => $ids]);
		$i = 0;
		$error = 0;
		foreach($nets as $freeinternet){

			$email = new Email('default');
			$email->transport('saghysat');
			$email->template('default', 'default');
			$email->emailFormat('html');
			$email->from(['www@saghysat.hu' => 'Sághy-Sat Kft.']);
			$email->to('support@saghysat.hu');
			//$email->to($this->request->data['email']);
			$email->subject('[WSHU][ADAT][' . $freeinternet->sub_id . '] Díjmentes Internet regisztráció: ' . $freeinternet->name);
			$body = "<h1>Díjmentes Internet regisztráció adatlap!</h1>";
			$body .= "<h3>Igénylő adatlapja:</h3>";
			$body .= "Név: <b>".$freeinternet->name."</b><br>";
			$body .= "Ügyfélszám: <b>".$freeinternet->sub_id."</b><br>";
			$body .= "Település: <b>".$freeinternet->city."</b><br>";
			$body .= "Cím: <b>".$freeinternet->address."</b><br>";
			$body .= "E-mail: <b>".$freeinternet->email."</b><br>";
			$body .= "Telefon: <b>".$freeinternet->phone."</b><br>";
			$body .= "Jogosult neve: <b>".$freeinternet->entitled_name."</b><br>";
			$body .= "Jogosult jogcíme: <b>".$freeinternet->entitled_title."</b><br>";
			$body .= "Jogosult ig. név: <b>".$freeinternet->entitled_card_name."</b><br>";
			$body .= "Jogosult ig. száma: <b>".$freeinternet->entitled_card_number."</b><br>";
			$body .= "Jogosult települése: <b>".$freeinternet->entitled_city."</b><br>";
			$body .= "Jogosult címe: <b>".$freeinternet->entitled_address."</b><br>";
			$body .= "Okt. int. neve : <b>".$freeinternet->entitled_institution_name."</b><br>";
			$body .= "Okt. int. OM száma : <b>".$freeinternet->entitled_institution_OM."</b><br>* * *";
			
			//if($email->send($body)){
			//	$i++;				
			//}else{
			//	$error++;
			//}
			
			//debug($body);
			
		}
		
		echo "<hr>";
		echo "OK: " . $i;
		echo "<hr>";
		echo "Error: " . $error;
		echo "<hr>";
		die('Resend OK!');

	}
	
}
