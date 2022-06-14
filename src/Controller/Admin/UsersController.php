<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;

class UsersController extends AppController{

//    public $components = array('PhpExcel');
    public $components = array('Captcha');

	public function beforeFilter(Event $event){
		parent::beforeFilter($event);
		$this->set('title', 'Felhasználók');
		$this->Auth->allow(['logout','requestnewpassword','generatenewpassword']);
	}

	public function initialize(){       //PDF-hez kellett
		parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->_validViewOptions[] = 'pdfConfig';
	}

	/*
	public function addlog(){
		
		$this->log('AddLog: '.print_r($this->request->data, true) );
		$this->log('CAKEPHP COOKIE: '.print_r($_COOKIE['CAKEPHP'], true) );
		die();
	}
	*/
	
	
	public function login(){
		$this->viewBuilder()->layout('login');
		$this->set('title','Bejelentkezés');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				//$this->log('LOGGED IN: '.print_r($this->request->data, true) );
				//$this->log('COOKIE: '.print_r($_COOKIE, true) );
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('Hibás email és jelszó páros!');
		}
	}
	
	
	//Jelszó csere, ahogy a neve is mutatja ;-)
	public function changepassword(){
		$this->set('captchaHTML',$this->Captcha->generateCaptcha(4,10));	//Paraméterek: karakterek száma, max rnd. távolság
		//$captcha = $this->Captcha->getCaptcha();							//A CAPTCHA értéke session-ből

		$this->set('title','Jelszó módosítása');
		$this->viewBuilder()->layout('login');
  		$user =$this->Users->get($this->Auth->user('id'));
        if (!empty($this->request->data)) {
            $user = $this->Users->patchEntity($user, [
                    'password_old'  	=> $this->request->data['password_old'],
                    'password'      	=> $this->request->data['password_new'],
                    'password_new'      => $this->request->data['password_new'],
                    'password_confirm'  => $this->request->data['password_confirm']
                ],
                ['validate' => 'password']		// <-- a model béli validationPassword megíhvása. Orig.: The ‘validate’ =>’password’ part of the code is the equivalent of calling the ‘validationPassword’ method in the UsersTable. If you write something like ‘validate’ =>’someOtherMethod’ you should create ‘validationSomeOtherMethod’.
            );
            if ($this->Users->save($user)) {
                $this->Flash->success('Jelszavát sikeresen módosította!');
                $this->redirect('/admin');
            } else {
                $this->Flash->error('Hiba történt a jelszó mentése közben. Kérem ellenőrizze az adatokat és mentse újra!');
            }
        }
        $this->set('user',$user);
	}

	//requestnewpassword() emailt küld egy linkkel, ha rákattint a felhasználó, akkor email megy a generát új jelszóval
	public function generatenewpassword($user_id=Null, $request_code=Null){
		$users = TableRegistry::get('Users');
		$query = $users
					->find()
					->select(['id','email', 'name','request_code'])
					->where(['id =' => $user_id, 'request_code =' => $request_code]);

		foreach ($query as $user) {}

		if(isset($user->id) && isset($user->email) && isset($user->name) && isset($user->request_code)){
				$newpassword = $this->generateRandomString(8);
				$userRecord = $this->Users->find()->where(['id' => $user_id])->first();
		 		$user = $this->Users->patchEntity($userRecord, [
		 			'password' => $newpassword,
		 			'chgpassword' => 1, //Jelszó módosítás kikényszerítése, ha bejelentkezett az új, generált jelszóval
		 			'request_code' => 'New password has been generated on '.date("Y-m-d H:i:s").'!'
		 		]);
		        $this->Users->save($user);
				$this->autoRender = false;
				$email = new Email('default');
				$email->transport('saghysat');
				$email->template('default', 'default');
				$email->emailFormat('html');
				$email->from(['info@saghysat.hu' => 'Sághy-Sat']);
				$email->to($user->email);
				$email->subject('Új jelszó');
				$link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/admin/login';
				$content  = "Tisztelt ".$user->name."!<br>\n";
				$content .= 'Az Ön új jelszava: '.$newpassword."<br>\n";
				$content .= "Bejelentkezhet a következő címen: ".$link."<br>\n<br>\n";
				$content .= "<b>Üdvözlettel: Sághy-Sat Kft.</b><br>\n";
				$content .= "7754 Bóly, Ady E. u. 9.<br>\n";
				$content .= "Tel.: +36 69/368-162<br>\n";
				$content .= "<br>\n";

				if($email->send($content)){
					$this->Flash->success(__('Kedves '.$user->name.'! Az új jelszavát elküldtük a megadott email címre! Kérem ellenőrizze a postáját. Amennyiben nem találná az email-t, ne felejtse el megnézni a levélszemetek között is.'));
				}else{
					$this->Flash->error(__('Email küldés nem sikerült!'));
				};

		}else{
			$this->Flash->error(__('Hibás linkre kattintott vagy lejárt az érvényessége!'));
		}

		return $this->redirect(['action' => 'login']);
	}


	//Új jelszó kérése: email megy, linkre kattintva hívódik meg a generatenewpassword() és elküldi az új email-t, amivel be tud lépni
	public function requestnewpassword(){
		$this->viewBuilder()->layout('login');
		$this->set('title','Új jelszó igénylése');

		if ($this->request->is('post')) {
			$users = TableRegistry::get('Users');
			$query = $users
						->find()
						->select(['id', 'email', 'name'])
						->where(['email =' => $this->request->data['email']]);

			foreach ($query as $user) {}

			if(isset($user->id) && isset($user->email) && isset($user->name)){
				$request_code = $this->generateRandomString(128);
				$query = $users->query();
				$query->update()
						->set(['request_code' => $request_code])
						->where(['id' => $user->id])
						->execute();

				$this->autoRender = false;
				$email = new Email('default');
				$email->transport('saghysat');
				$email->template('default', 'default');
				$email->emailFormat('html');
				$email->from(['info@saghysat.hu' => 'Sághy-Sat']);
				$email->to($user->email);
				$email->subject('Jelszó megújítási kérelem');

				$link = '<a href="'.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/admin/generatenewpassword/'.$user->id.'/'.$request_code.'">';
					$link .= $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/admin/generatenewpassword/'.$user->id.'/'.$request_code;
				$link .= '</a>';

				$content  = "<h1>Tisztelt ".$user->name."!</h1>\n";
				$content .= "<b>Amennyiben Ön kérte a jelszó megújítását, akkor kattintson az alábbi linkre:</b><br>\n";
				$content .= $link."<br>\n";
				$content .= "Ha nem Ön kérte, akkor hagyja e levelet figyelmen kívül.<br>\n";
				$content .= "<b>Üdvözlettel: Sághy-Sat Kft.</b><br>\n";
				$content .= "7754 Bóly, Ady E. u. 9.<br>\n";
				$content .= "Tel.: +36 69/368-162<br>\n";
				$content .= "<br>\n";

				if($email->send($content)){
					$this->Flash->success(__('A megadott email címre elküldtük a jelszó helyreállítási kérelmi email-t! Kérem ellenőrizze a postáját. Amennyiben nem találná az email-t, ne felejtse el megnézni a levélszemetek között is.'));
				}else{
					$this->Flash->error(__('Email küldés nem sikerült!'));
				};
			}

			return $this->redirect(['action' => 'login']);
		}
	}

	private function generateRandomString($length = 8) {
	    $characters = '()-_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function profil(){
		$user = $this->Users->get($this->request->session()->read('Auth.User.id'), [
			//'contain' => []
		]);

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if($user['files'][0]['tmp_name']!=''){
				foreach ($user['files'] as $u) {    //Egyszer fut csak le, mert ... de ez a kód jó a multi uploadhoz is
					$tmp_name = $u['tmp_name'];
					$src_path = WWW_ROOT.'images'.DS.'uploads'.DS.'users'.DS;
					$dest_path = $src_path;
					$name = $u['name'];
					$ext = pathinfo($name, PATHINFO_EXTENSION);
					$user->avatar_ext = $ext;
					move_uploaded_file($tmp_name, $dest_path.$user->id.'.'.$ext);
				}            
			}            
			if ($this->Users->save($user)) {
				$this->Flash->success('Adatok mentése: Ok');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$groups = $this->Users->Groups->find('list', ['limit' => 10]);
		$this->set(compact('user', 'groups'));
		$this->set('_serialize', ['user']);
	}

	public function index(){
		$this->loadComponent('Paginator');
		$this->paginate = [
			'contain' => ['Groups'],
			'limit' => 20,
			'orders' => [
				'User.id' => 'desc',
				//'User.name' => 'asc',                
			],
			'conditions' => [
				'AND' => [
					'Users.email NOT IN' => ['zsfoto@gmail.com','zsolt@saghysat.hu']
				]
			]
		];
		$users = $this->paginate($this->Users);
		$this->set(compact('users'));
		$this->set('_serialize', ['users']);
	}

	public function logout(){
		$this->Flash->success('Sikeresen kijelentkeztél!');
		return $this->redirect($this->Auth->logout());
	}


	public function add(){
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {

			$id = Text::uuid();
			$rand = $this->generateRandomString(32);
			$pos = strpos($id, "-");
			$id = substr_replace($id,$rand,$pos,1);
			$rand = $this->generateRandomString(16);
			$pos = strpos($id, "-");
			$id = substr_replace($id,$rand,$pos,1);
			$rand = $this->generateRandomString(32);
			$pos = strpos($id, "-");
			$id = substr_replace($id,$rand,$pos,1);
			$rand = $this->generateRandomString(16);
			$pos = strpos($id, "-");
			$id = substr_replace($id,$rand,$pos,1);

			$this->request->data['id'] = $id;
			$this->request->data['request_code'] = $this->generateRandomString(128);
			$this->request->data['enabled']     = 1;    //Alapesetben beléphet, de az admin letilthatja később
			$this->request->data['confirmed']   = 1;    //Adminban ez nem kell ->: Emailben érkező linkre kell kattintani és akkor álíltódik 1-esre
			//$this->request->data['group_id']    = 1;    //Alapesetben előfizető az illető. Admin feljebb tolhatja a ranglétrán ;-)

			$user = $this->Users->patchEntity($user, $this->request->data);
			foreach ($user['files'] as $u) {    //Egyszer fut csak le, mert ... de ez a kód jó a multi uploadhoz is
				$tmp_name = $u['tmp_name'];
				$src_path = WWW_ROOT.'images'.DS.'uploads'.DS.'users'.DS;
				$dest_path = $src_path;
				$name = $u['name'];
				$ext = pathinfo($name, PATHINFO_EXTENSION);
				$user->avatar_ext = $ext;
				move_uploaded_file($tmp_name, $dest_path.$user->id.'.'.$ext);
			}
			if ($this->Users->save($user)) {
				$this->Flash->success('Adatok mentése: Ok');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$groups = $this->Users->Groups->find('list', ['limit' => 200]);
		$this->set(compact('user', 'groups'));
		$this->set('_serialize', ['user']);
	}

	public function edit($id = null){
		$user = $this->Users->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->Users->patchEntity($user, $this->request->data);
			if($user['files'][0]['tmp_name']!=''){
				foreach ($user['files'] as $u) {
					$tmp_name = $u['tmp_name'];
					$dest_path = WWW_ROOT.'images'.DS.'uploads'.DS.'users'.DS;
					$name = $u['name'];
					$ext = pathinfo($name, PATHINFO_EXTENSION);
					$user->avatar_ext = $ext;
					if( file_exists($dest_path.$user->id.'.'.$ext)){ unlink($dest_path.$user->id.'.'.$ext); }
					move_uploaded_file($tmp_name, $dest_path.$user->id.'.'.$ext);
				}
				$user['avatar_ext'] = $ext;
			}

			if ($this->Users->save($user)) {
				$this->Flash->success('Adatok mentése: Ok');
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$groups = $this->Users->Groups->find('list', ['limit' => 200]);
		$this->set(compact('user', 'groups'));
		$this->set('_serialize', ['user']);
	}

	public function delete($id = null){
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->Users->get($id);
		if ($this->Users->delete($user)) {
			$dest_path = WWW_ROOT.'images'.DS.'uploads'.DS.'users'.DS;
			if( file_exists($dest_path.$id.'.'.$user->avatar_ext)){ @unlink($dest_path.$id.'.'.$user->avatar_ext); }
			$this->Flash->success('Törlés: Ok');
		} else {
			$this->Flash->error('Nem sikerült a törlés! Kérem próbálja újra!');
		}
		return $this->redirect(['action' => 'index']);
	}


	public function view($id = null){
		$user = $this->Users->get($id, [
			'contain' => ['Groups']
		]);

		$this->viewBuilder()->options([
			'pdfConfig' => [
				'orientation' => 'portrait',
				'filename' => 'User_'.$id,
				'margin' => [
					'bottom' => 0,
					'left'   => 0,
					'right'  => 0,
					'top'    => 0
				],
				'orientation' => 'landscape',
				'encoding'  => 'UTF-8',
			]
		]);

/*
		$this->pdfConfig = [
			'orientation'   => 'portrait',
			'filename'      => 'User_' . $id . '.pdf'
		];

		//$pdf = $CakePdf->write(APP . 'files' . DS . 'newsletter.pdf');
		//Configure::write('CakePdf.crypto', 'CakePdf.Pdftk');
		Configure::write('CakePdf', array(
			'download'  => false,
		));
		//$pdf = $CakePdf->write(APP . 'files' . DS . 'newsletter.pdf');
/*
			'engine' => 'CakePdf.WkHtmlToPdf',
			'binary' => '/usr/local/bin/wkhtmltopdf',
			//'binary' => 'C:\\Progra~1\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
			'margin' => [
				'bottom' => 5,
				'left' => 10,
				'right' => 10,
				'top' => 10
			],
			'orientation' => 'portrait',
			'encoding'  => 'UTF-8',
			'routes' =>true

*/



/*
		Configure::write('CakePdf', array(
			'engine' => 'CakePdf.WkHtmlToPdf',
			'binary' => '/usr/local/bin/wkhtmltopdf',
			//'binary' => 'C:\\Progra~1\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
			'margin' => [
				'bottom' => 5,
				'left' => 10,
				'right' => 10,
				'top' => 10
			],
			'orientation' => 'portrait',
			'encoding'  => 'UTF-8',
			'download'  => true,
			'routes' =>true
		));

/*
		Configure::write('CakePdf', [
			'engine' => 'CakePdf.WkHtmlToPdf',
			//'engine' => 'CakePdf.tcpdf',
			//'binary' => '/usr/local/bin/wkhtmltopdf',
			'binary' => 'C:\\Progra~1\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
			'options' => [
				'print-media-type' => false,
				'outline' => true,
				'dpi' => 96
			],             
			'margin' => [
				'bottom' => 5,
				'left' => 10,
				'right' => 10,
				'top' => 10
			],
			'orientation' => 'landscape',
			'download' => true
		]);

		$this->viewBuilder()->options([
			'pdfConfig' => [
				'orientation' => 'portrait',
				'filename' => 'saghysat_'.date("Ymd_His")
			]
		]);
*/

		$groups = $this->Users->Groups->find('list', ['limit' => 20]);
		$this->set(compact('user', 'groups'));
		$this->set('_serialize', ['user']);
	}



	//########################################################################################################################
	//########################################################################################################################
	//##                                            Plugin functions()                                                      ##
	//########################################################################################################################
	//########################################################################################################################
	public function export_to_excel($filename="export_users.xlsx"){
		//$this->set('data',$this->Tests->find('all'));
		//$this->response->download("users_export.xls");
		$options = [
			//'limit'   => 2,
			'order' => [
				//'<%= $currentModelName %>.id' => 'asc',
				//'<%= $currentModelName %>.xxx' => 'asc',
			],
			'conditions' => [
				//'<%= $currentModelName %>.id' => '1',
				//'<%= $currentModelName %>.xxx' => 'asc',
			]
		];
		$this->Users->recursive = -1;
		$users = $this->Users->find('all',$options);
		foreach ($users as $user) {
			$user->created = strtotime($user->created->i18nFormat('yyyy-MM-dd HH:mm:ss'));
			$user->modified = strtotime($user->modified->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		}
		$this->set(compact('users'));
		$this->set('_serialize', ['users']);
		$this->set('filename', $filename);
	}

	public function export($filename="export_users.xlsx"){      //Törölni
		//$this->set('data',$this->Tests->find('all'));
		//$this->response->download("users_export.xls");
		$options = [
			//'limit'   => 2,
			'order' => [
				//'<%= $currentModelName %>.id' => 'asc',
				//'<%= $currentModelName %>.xxx' => 'asc',
			],
			'conditions' => [
				//'<%= $currentModelName %>.id' => '1',
				//'<%= $currentModelName %>.xxx' => 'asc',
			]
		];
		$this->Users->recursive = -1;
		$users = $this->Users->find('all',$options);
		foreach ($users as $user) {
			$user->created = strtotime($user->created->i18nFormat('yyyy-MM-dd HH:mm:ss'));
			$user->modified = strtotime($user->modified->i18nFormat('yyyy-MM-dd HH:mm:ss'));
		}
		$this->set(compact('users'));
		$this->set('_serialize', ['users']);
		$this->set('filename', $filename);
	}

	public function export_to_csv($filename="export_users.csv") {
		$options = [
			//'limit'   => 2,
			'order' => [
				//'<%= $currentModelName %>.id' => 'asc',
				//'<%= $currentModelName %>.xxx' => 'asc',
			],
			'conditions' => [
				//'<%= $currentModelName %>.id' => '1',
				//'<%= $currentModelName %>.xxx' => 'asc',
			]
		];
		$this->Users->recursive = -1;
		$users = $this->Users->find('all', $options);
		foreach ($users as $user) {
			//$user->created = $user->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$user->modified = $user->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			$user->created = $user->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$user->modified = $user->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize = 'users';
		$_header = ['ID', 'Name', 'Email', 'Created', 'Modified'];
		$_extract = ['id', 'name', 'email', 'created', 'modified' ];
		$_header = ['ID', 'Name'];      //Ezeket a mezőket írja ki a CSV-be
		$_extract = ['id', 'name'];     //  -"-
		//$_footer = ['Totals', '400', '$3000'];
		$_delimiter = chr(9); //tab
		$_delimiter = ';';
		$_enclosure = '"';
		$_newline = "\r\n";
		$_eol = "\r\n";
		$_bom = true;
		$this->response->download($filename); // <= setting the file name
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('users', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
/*
		$data = [
			['a', 'b', 'c'],
			[1, 2, 3],
			['you', 'and', 'me'],
		];
		$_serialize = 'data';
		$_header = ['Column 1', 'Column 2', 'Column 3'];
		$_footer = ['Totals', '400', '$3000'];
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('data', '_serialize', '_header', '_footer'));
*/
	}



	public function sendemail() {           //Email küldés
		$this->autoRender = false;
		$email = new Email('default');
		$email->transport('saghysat');

		$email->template('default', 'default');
		$email->emailFormat('html');

		$email->from(['zsolt@saghysat.hu' => 'Zsolt - CakePhp3 Email']);
		$email->to('zsolt@saghysat.hu');
/*
		$email->attachments([
			'zsolt.jpg' => [                                            //A file neve a levélben
				'file' => WWW_ROOT.'img'.DS.'avatars'.DS.'zsolt.jpg',   //Valós csatoléandó file neve
				'mimetype' => 'image/jpeg',                             //Pl.: application/pdf, image/jpeg, forrás: https://www.sitepoint.com/web-foundations/mime-types-complete-list/
				//'contentId' => Text::uuid()                           //Content ID
			]
		]);
*/
		$email->subject('CakePhp3 Email - Tárgy mező');
		$email->send('Levél tartalom');
	}

}
?>