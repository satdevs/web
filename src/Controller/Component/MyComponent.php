<?php
/*
	public function generateId(){
	public function sendEmail($params=Null){}
	public function sendLocalMail($params=Null){}
	public function getText($name=Null){	
	public function getTextFromEmailTemplates($name=Null){
	public function generateRandomString($length = 8) {
	public static function normalizeString($str = ''){
	public function print_array($array, $die=null)	{
	public function super_unique($array) {
	function resizePhoto($height, $src_filename, $dest_filename, $src_path, $dest_path, $quality=60){
	private function loadModel($model) {		
	public function passwordtest($pass) {
	public function getCompany($content) {		
	function logUserLogin($event='login'){


*/


namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Network\Session;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\View\Helper\TextHelper;
use Cake\I18n\Date;
use Cake\I18n\Time;

class MyComponent extends Component{

	public $components = ['Session', 'Flash', 'Cookie', 'Auth'];

	public function initialize(array $config) {
		parent::initialize($config);
	}


	//------------- /config/app.php -ban van beállítva ------------
	public function getCompany($content) {
		//debug(Configure::read('Company.'.$content));
		$this->loadModel('Setups');
		$company = $this->Setups->get(1);
		switch ($content) {
			case 'name': 		$ret = $company->name; 		break;
			case 'zip': 		$ret = $company->zip; 		break;
			case 'city': 		$ret = $company->city; 		break;
			case 'address': 	$ret = $company->address; 	break;
			case 'email': 		$ret = $company->email; 	break;
			case 'adminemail': 	$ret = $company->adminemail;break;
			case 'phone': 		$ret = $company->phone; 	break;
			case 'phone2': 		$ret = $company->phone2; 	break;
			case 'boss': 		$ret = $company->boss; 		break;
			case 'boss2': 		$ret = $company->boss2; 	break;			
			default: $ret = '---'; break;
		}
		return $ret; // Configure::read('Company.'.$content);
	}


	//------------------------------------ 64 hosszú -----------------------------------
	public function generateId(){
		return str_replace("-", $this->generateRandomString(8), Text::uuid());
	}

	public function sendLocalMail($params=Null){
		if(!$params){ return false; }
		$ret = [];
		$this->loadModel('Users');
		$this->loadModel('Mails');
		$this->loadModel('Setups');
		$mailtext = $this->getTextFromEmailTemplates($params['template']);
		//------------------------------------------------------------------------- ÜZENET összeállítása ---------------------
		$subject = $mailtext['subject'];
		$body 	 = $mailtext['body'];
		foreach($params as $key=>$value){
			$subject = str_replace("{{".$key."}}", $value, $subject);
			$body 	 = str_replace("{{".$key."}}", "<b>".$value."</b>", $body);
		}
		//----------------------------------------------------------------------- /.ÜZENET összeállítása ----------------------
		//-------- Ha csak az adminoknak kell elküldeni, akkor nem küldi el a halandó usernek ----------------- 2018.04.13. ---
		//if(!isset($params['only2admins']) || (isset($params['only2admins']) && $params['only2admins']==FALSE)){
			
			//debug($params);	die();

			$user = $this->Users->findByEmail($params['email'])->first();
			$admin = $this->Users->findByEmail($this->getCompany('adminemail'))->first();

			$mailsTable = TableRegistry::get('Mails');
			$mail = $mailsTable->newEntity();
			$mail->id 			= str_replace("-", $this->generateRandomString(8), Text::uuid());
			if(!isset($user->id)){
				$mail->to_id 		= 'admin';
			}else{
				$mail->to_id 		= $user->id;
			}

			$mail->system_mail = 1;
			if(isset($params['system_mail'])){
				$mail->system_mail 	= $params['system_mail'];
				if(!isset($admin->id)){
					$mail->user_id 		= 'admin';	//Ez az ID-je, amit kézzel írtam be
				}else{
					$mail->user_id 		= $admin->id;					
				}
			//}else{
			//	$mail->system_mail 	= 1;
			//	$mail->user_id 		= $this->Auth->user('id');
			}
			$mail->name 		= $subject;
			$mail->body 		= $body;
			$mail->readed 		= 0;
			if(isset($params['only_admins']) && $params['only_admins']==true){	//Ha csak az adminoknak, akkor nem kell küldeni az email címre,
				//------														//  egyébként igen.
			}else{
				if($mailsTable->save($mail)){
					$ret[] = $mail->to_id;
				}
			}
		//}
		//-------------------------------- Mentés a helyi levelező rendszerbe ---------------------------------

		//==================== Adminoknak is elküldeni ========================================================
		//--- Azért nem kell ez a rész most ide, mertz a mails táblát kiteszem, hogy az adminok el tudják olvasni az összeset, ha kell ---
		if((isset($params['cc_admins']) && $params['cc_admins']==true) || (isset($params['only_admins']) && $params['only_admins']==true)):
			$admins = $this->Users->find('all',['conditions'=>['usergroup_id'=>1]]);	//--- Másolat küldése az adminoknak is ---
			$mailsTable = TableRegistry::get('Mails');	//--------------- Mentés helyi levelező rendszerbe is -----
			foreach($admins as $admin):
				$mail = $mailsTable->newEntity();
				$mail->id 			= str_replace("-", $this->generateRandomString(8), Text::uuid());
				$mail->system_mail  = 1;
				$mail->user_id 		= $this->Auth->user('id');
				$mail->to_id 		= $admin->id;
				if(isset($params['system_mail']) && $params['system_mail']==1){
					$mail->name 	= __('System: ').$subject;
				}else{
					$mail->name 	= $subject;
				}
				$mail->body 		= $body;
				$mail->readed 		= 0;
				if($mailsTable->save($mail)){
					$ret[] = $mail->to_id;
				}
			endforeach;
		endif; // Ha az adminoknak is kell küldeni belőle...
		
		if(isset($params['bcc_for_everyone']) && $params['bcc_for_everyone']==TRUE):
			$evrybody = $this->Users->find('all',['conditions'=>['email !='=>$params['email']]]);
			$mailsTable = TableRegistry::get('Mails');
			foreach($evrybody as $user):
				$mail = $mailsTable->newEntity();
				$mail->id 			= str_replace("-", $this->generateRandomString(8), Text::uuid());
				$mail->system_mail  = 1;
				$mail->user_id 		= $this->Auth->user('id');
				$mail->to_id 		= $user->id;
				if(isset($params['system_mail']) && $params['system_mail']==1){
					$mail->name 	= __('System: ').$subject;
				}else{
					$mail->name 	= $subject;
				}
				$mail->body 		= $body;
				$mail->readed 		= 0;
				if($mailsTable->save($mail)){
					$ret[] = $mail->to_id;
				}
			endforeach;
		endif;
		
		return $ret;	//Akinek elküldte, auzoknak az ID-jét adja vissza
	}	
	
	
	//========================================================================= EMAIl küldés ============================
	// 	$param = [
	// 		'template' 		=> 'signup',			// A mailtemplates táblában a név
	// 		'email' 		=> 						// Kinek küldeni
	// 		'cc_admins' 	=> 						// Ha az adminoknak is el kell küldeni
	// 		'template' 		=> 'signup',			// A mailtemplates táblában a név
	//		'params'		=> ['mit'=>'mit mire'] helyettesítsen a címben és a szövegben egyaránt
	// 	];
	public function sendEmail($params=Null){
		if(!$params){ return false; }
		$this->loadModel('Users');
		$this->loadModel('Mails');
		$mailtext = $this->getTextFromEmailTemplates($params['template']);
		//------------------------------------------------------------------------- EMAIL összeállítása ----------------------
		$subject = $mailtext['subject'];
		$body 	 = $mailtext['body'];
		foreach($params as $key=>$value){
			$subject = str_replace("{{".$key."}}", $value, $subject);
			$body 	 = str_replace("{{".$key."}}", "<b>".$value."</b>", $body);
		}
		//$body = str_replace("\n", "<br>\n", $body);	//Kivéve, mert sok volt az enter, de lehet, h visszakerül ... 2018.07.04.
		
		//$body = $this->Text->autoParagraph($body);
		//$body = Cake\View\Helper\TextHelper::autoParagraph($body);
		//Cake\View\Helper\TextHelper::autoParagraph($body);
		//----------------------------------------------------------------------- /.EMAIL összeállítása -------------------------		
		if($_SERVER['HTTP_HOST']=='agroria.loc'){
			if(isset($params['noflash']) && $params['noflash']==false){
				$this->Flash->success('<b>'.$subject.'</b><br>'.$body, ['escape'=>FALSE]);
			}
		}else{
			$email = new Email('default');
			$email->emailFormat('html');
			$email->from([$this->getCompany('adminemail') => $this->getCompany('name')]);
			$email->to($params['email']);
			$email->subject($mailtext['subject']);
			if(isset($params['only_admins']) && $params['only_admins']==true){	//Ha csak az adminoknak, akkor nem kell küldeni az email címre,
				//------														//  egyébként igen.
			}else{
				if(!$email->send($body)){
					if(isset($params['noflash']) && $params['noflash']==false){
						$this->Flash->error(__("We couldn't send Email to Your address!"));	
					}
				}
			}

			//----------- Send to admins -------------
			if((isset($params['cc_admins']) && $params['cc_admins']==true) || (isset($params['only_admins']) && $params['only_admins']==true)):
				$admins = $this->Users->find('all',['conditions'=>['usergroup_id'=>1, 'notice_by_mail'=>1]]);
				foreach($admins as $admin){
					$email->subject('Másolat: '.$mailtext['subject']);
					$email->to($admin->email);
					$email->send($body);
				}
			endif;
			//----------- /.Send to admins -----------
			
			
			//----------- Send to everybody -------------
			if(isset($params['bcc_for_everyone']) && $params['bcc_for_everyone']==TRUE):
				$evrybody = $this->Users->find('all',[
					'conditions'=>[
						'email !='=>$params['email'],
						'notice_by_mail'=>1
					]
				]);
				foreach($evrybody as $user){
					$email->subject($mailtext['subject']);
					$email->to($user->email);
					$email->send($body);
				}
			endif;
			//----------- /.Send to everybody -----------
			//- /.Másolat küldése az adminoknak is ---
			if(isset($params['noflash']) && $params['noflash']==false){
				$this->Flash->success(__('We are sent you an Email. Please check your Emails include the spam folder.'));
			}
		}
	}
	//======================================================================== /.EMAIl küldés ============================
	


	//--------------- getText() ---------------------
	public function getText($name=Null){
		$this->loadModel('Txts');
		$name = __($name);
		if(!$this->Cookie->read('lang')){
			$this->Cookie->write('lang', 'hu');
		}
		$txt = $this->Txts->findByNameAndLang($name, $this->Cookie->read('lang'))->first();
		if(isset($txt) && $txt !==FALSE){
			return $txt;
		}else{
			return Null;
		}
	}
	//--------------- /getText() ---------------------

	//--------------- getText() ---------------------
	public function getTextFromEmailTemplates($name=Null){
		$this->loadModel('Mailtemplates');
		if(!$this->Cookie->read('lang')){
			$this->Cookie->write('lang', 'hu');
		}
		$txt = $this->Mailtemplates->findByNameAndLang( $name, $this->Cookie->read('lang') )->first();
		if(isset($txt) && $txt !==FALSE){
			/*
			$textsTable = TableRegistry::get('Mailtemplates');
			$text = $textsTable->get($txt->id);
			$text->last_used = new \DateTime(date('Y-m-d H:i:s'));
			$textsTable->save($text);
			*/
			$text = $this->Mailtemplates->get($txt->id);
			//$date = new Date('2015-06-15');
			//$text->last_used->setTimezone(new \DateTimeZone('Europe/Budapest'));
			$text->last_used = new \DateTime(date('Y-m-d H:i:s'));
			$this->Mailtemplates->save($text);
			return $text;
		}else{
			return Null;
		}
/*
*/
	}
	//--------------- /getText() ---------------------
	

	
	//-------- Adott hosszban állít elő véletlen karakterláncot --------------------
	public function generateRandomString($length = 8) {
		//$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		//$characters = "0123456789ABCDEFGHIJKLMNOPRSTUVXYZ";
		$characters = "123456789ABCDEFGHIJKL123456789MNPRSTUVXYZ123456789ABCDEFGHIJKL123456789MNPRSTUVXYZ";
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			if( rand(0,9) >=5 ){
				$randomString .= strtolower($characters[rand(0, $charactersLength - 1)]);
			}else{
				$randomString .= $characters[rand(0, $charactersLength - 1)];	    		
			}
		}
		//return '123456789A';
		//return 'BCDEFGHIJK';
		//return 'LMNPRSTUVX';
		//return 'NPRSTUVXYZ';
		return $randomString;
	}

	//-------- Stringet alakít át pl.: Szóközöket helyettesíti _ -val és még sok minden más...
	public static function normalizeString($str = ''){
		$str = strip_tags($str); 
		$str = preg_replace('/[\r\n\t ]+/', ' ', $str);
		$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
		$str = iconv('utf-8','iso-8859-2//TRANSLIT', $str);	//Zs.
		$str = strtolower($str);
		$str = iconv('iso-8859-2','utf-8//TRANSLIT', $str);	//Zs.
		$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
		$str = htmlentities($str, ENT_QUOTES, "utf-8");
		$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
		$str = str_replace(' ', '-', $str);
		$str = rawurlencode($str);
		$str = str_replace('%', '-', $str);
		return $str;
	}

	//http://php.net/manual/en/function.array-multisort.php
	//---------- Több dimenziós tömb sorbarendezése...
	//Pl.: $descartes = $this->My->array_msort($descartes, array('catv'=>SORT_DESC, 'net'=>SORT_DESC, 'tel'=>SORT_DESC));
	public function array_msort($array, $cols)	{
		$colarr = array();
		foreach ($cols as $col => $order) {
			$colarr[$col] = array();
			foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
		}
		$eval = 'array_multisort(';
		foreach ($cols as $col => $order) {
			$eval .= '$colarr[\''.$col.'\'],'.$order.',';
		}
		$eval = substr($eval,0,-1).');';
		eval($eval);
		$ret = array();
		foreach ($colarr as $col => $arr) {
			foreach ($arr as $k => $v) {
				$k = substr($k,1);
				if (!isset($ret[$k])) $ret[$k] = $array[$k];
				$ret[$k][$col] = $array[$k][$col];
			}
		}
		return $ret;
	}


	//--------------------------- DESCARTES SZORZAT RÉSZHALMAZÁNAK KIIRATÁSA ------------------------
	public function print_array($array, $die=null)	{
		echo "<pre>";
		$bg = "";
		$i = 0;
		// width="80%" 
		echo '<table border="1" align="center" cellpadding="0" cellspacing="0" style="border: 3px double #ccc;">';
		$first = true;
		foreach ($array as $d) {
			//if($bg != $d['net']){
			//	$bgcolor =  "#ffffff";
			//}
			if($first){
				echo "<tr>";
				echo '<th style="background: #efefef; color: #888; padding: 5px 10px; border: 1px solid #ccc; border-bottom: 1px solid #333;">#</th>';
				foreach ($d as $row => $value) {
					echo '<th style="padding: 5px 10px; border: 1px solid #ccc; border-bottom: 1px solid #333;">'.$row.'</th>';
					$first = false;
				}
				echo "</tr>";
			}
			echo "<tr>";
				echo '<td align="center" style="font-size: 16px; padding: 5px; background: #efefef; color: #888; border: 1px solid #ccc;">#'.$i++."</td>";
				foreach ($d as $row => $value) {
					$align = "center";
					if(gettype($value)=="string"){
						$align = "left";
					}
					$color = "#000";
					if(gettype($value)=="integer" && $value==0){
						$color = "#ccc";
					}
					echo '<td align="'.$align.'" style="color: '.$color.';font-size: 16px; padding: 5px 10px; font-weight: bold;  border: 1px solid #ccc;">'.$value."</td>";
				}
			echo "</tr>";
			//$bg = $d['net'];
		}
		echo "</table>";
		//--------------------------- /.DESCARTES SZORZAT RÉSZHALMAZÁNAK KIIRATÁSA ------------------------
		if($die){
			die();
		}
	}


	//--------------- ARRAY SUPER UNIQUE - ERROR!!!!! ----------------------
	public function super_unique($array) {
	  $result = array_map("unserialize", array_unique(array_map("serialize", $array)));
	  foreach ($result as $key => $value)	  {
		if ( is_array($value) )	    {
		  $result[$key] = super_unique($value);
		}
	  }
	  return $result;
	}
	//--------------- /.ARRAY SUPER UNIQUE ----------------------

	
	//resizePhoto(500,'IMG00012.JPG','gallery/resized/','tmp/')
	//$wd=$image_atts[0]*($height/$image_atts[1]);
	//https://www.daniweb.com/programming/web-development/threads/499839/resizing-an-image-in-php
	function resizePhoto($height, $src_filename, $dest_filename, $src_path, $dest_path, $quality=60){
		$image_path=$src_path.$src_filename;
		$image_atts=getimagesize($image_path); //echo "<pre>"; print_r($image_atts); die();    //Array([0] => 1920 [1] => 1080 [2] => 2 [3] => width="1920" height="1080" [bits] => 8 [channels] => 3 [mime] => image/jpeg )
		if(!$image_atts[0]){
			$this->Flash->error('Hibás képfájl. Nem tudom feldolgozni:'.$src_filename.'<br>'.$image_path.'<br>');
			return false;
		}
		$wd=$image_atts[0]*($height/$image_atts[1]);
		$img=imagecreatetruecolor($wd,$height);
		$white=imagecolorallocate($img,255,255,255);
		$src=imagecreatefromjpeg($image_path);
		imagecopyresampled($img,$src,0,0,0,0,$wd,$height,$image_atts[0],$image_atts[1]);
		$src_filename=$dest_path.$src_filename;
		return imagejpeg($img, $dest_path.DS.$dest_filename, $quality);
		//return $src_filename;
	}


	private function loadModel($model) {
		$this->$model = TableRegistry::get($model);
	}

	//------------------------------------- PASSWORD TEST() ------------------- Utálom az ELSEIF-et ;-) -----------------
	public function passwordtest($pass) {
		if (!empty($pass)) {
			if (ctype_alnum($pass)) { //check if string is alphanumeric
				if (7 < strlen($pass)){ //check if string meets 8 or more characters
					if (strcspn($pass, '0123456789') != strlen($pass)){ //check if string has numbers
						if (strcspn($pass, 'abcdefghijklmnopqrstuvwxyz') != strlen($pass)) { //check if string has small letters
							if (strcspn($pass, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') != strlen($pass)) { //check if string has capital letters
								return ['error'=>0, 'message'=>__('Password passed')];
							}else{
								return ['error'=>1, 'message'=>__('No capital letter in password')];
							}
						}else{
							return ['error'=>2, 'message'=>__('No small letter in password')];
						}
					}else{
						return ['error'=>3, 'message'=>__('No number in password')];
					}
				}else{
					return ['error'=>4, 'message'=>__('Password is too short')];
				}
			}else{
				return ['error'=>5, 'message'=>__('Password has special character')];
			}
		}else{
			return ['error'=>6, 'message'=>__('Password field is empty')];
		}
	}
	//----------------------------------- /.PASSWORD TEST() -------------------

/*
	public function passtest2($pass) {   
		if (empty($pass)){ //check if string is empty
			return "<br />Password field is empty";
		}elseif (!ctype_alnum($pass)){ //check if string is alphanumeric
			return "<br />Password has special character";
		}elseif (strlen($pass) < 8) { //check if string meets 8 or more characters
			return "<br />Password is short";
		}elseif (strspn($pass, '0123456789') != strlen($pass)){ //check if string has numbers
			return "<br />No number";
		}elseif (strspn($pass, 'abcdefghijklmnopqrstuvwxyz') != strlen($pass)) { //check if string has small letters
			return "<br />No small letter";
		}elseif (strspn($pass, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') != strlen($pass)) { //check if string has capital letters
			return "<br />No capital letter";
		}else{
			return "<br />Password passed";
		}
	}
*/


	
	function logUserLogin($event='login'){
		if(!($this->Auth->user('email') == 'zsolt@saghysat.hu' || $this->Auth->user('email') == 'zsfoto@gmail.com')){
			$userloginsTable = TableRegistry::get('Userlogins');
			$userlogin = $userloginsTable->newEntity();
			$userlogin->user_id = $this->Auth->user('id');
			$userlogin->email = $this->Auth->user('email');
			$userlogin->name = $this->Auth->user('name');
			$userlogin->event = $event;
			if ($userloginsTable->save($userlogin)) {
				//$id = $userlogin->id;
			}
		}
	}


	################################################################### SNIPETS ##################################################################
	################################################################### SNIPETS ##################################################################
	################################################################### SNIPETS ##################################################################
	################################################################### SNIPETS ##################################################################
	//----------------------------------------------- UNIQE ID GENERÁLÁSA ------------------
	//http://codingkala.com/how-to-create-five-digit-unique-id-in-php/
	//$uniqueId = substr(md5(time() * mt_rand()),5);
	//debug(mt_rand());
	//debug($uniqueId);
	//die();
	//--------------------------------------------- /.UNIQE ID GENERÁLÁSA ------------------
	
	################################################################# /.SNIPETS ##################################################################
	################################################################# /.SNIPETS ##################################################################
	################################################################# /.SNIPETS ##################################################################
	################################################################# /.SNIPETS ##################################################################
	
	
	
}

?>