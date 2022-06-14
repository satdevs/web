<?php
//namespace App\Controller;
namespace App\Controller\Admin;
use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller{

	public $admin = TRUE;
    public $broadcasts  = array(
                'Analóg'=>'Analóg',
                'Digitális'=>'Digitális'
    );
    public $packageorders  = array(
                '1' => '1 - Mini csomag',
                '2' => '2 - Családi csomag',
                '3' => '3 - Bővített csomag'
    );
    public $languages   = array(
                'magyar' => 'magyar',
                'angol'	 => 'angol',
                'német'  => 'német',
                'horvát' => 'horvát',
                '-' => '---'
    );
    public $type = array(
                'termék' => 'termék',
                'csomag' => 'csomag',
                '-' => '---'
    );
	public $servicegroups = [
		'1' => 'Kábel TV',
		'2' => 'Internet',
		'4' => 'Telefon',
		'8' => 'Csomagok',
		'9' => 'Havidíj ellenében nézhető digitális csomagok',
		'108' => 'Egyéni csomagösszeállítás',
		'201' => 'Általános Szerződési Feltételek',
		'501' => 'Egyéb',
		'601' => 'Á.SZ.F.',
		
	];
	public $to_price = [
		'0' => '0 - Üres',
		'1' => '1 - Akciós csomag',
		//'2' => '2 - Telefon solo',
		//'3' => '3 - Telefon duo',
		'4' => '4 - DUO CSOMAG',
		'5' => '5 - Mini kombó csomag',
		'6' => '6 - Családi kombó csomag',
		'7' => '7 - Maxi kombó csomag',
		'9' => '9 - Digitális akció',
	];


	public function initialize(){
		parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');
		$this->loadComponent(
			'Auth',
			[
				'authorize' => 'Controller',
				'loginAction' => [ 'controller' => 'Users', 'action' => 'login' ],
				'loginRedirect' => ['controller' => 'Messages', 'action' => 'index' ],
				'logoutRedirect' => ['controller' => 'Users','action' => 'login'],
				'authenticate' => [
					'Form' => [
						'fields' => [
							'username' => 'email',
							'password' => 'password'
						],
						'scope' => [
							'confirmed' => 1,
							'enabled'   => 1
						],
					],
				],
				'authError' => 'Az oldal további részeinek használatához be kell jelentkezned!',
				'RequestHandler' => [
					'viewClassMap' => [
						'xlsx' => 'CakeExcel.Excel'
					]
				],
			]);

		// Allow the display action so our pages controller
		// continues to work.
		// $this->Auth->allow(['display']);

	}
	public function beforeFilter(Event $event){
		$this->set('admin',$this->admin);

        $this->set('languages', $this->languages );
        $this->set('broadcasts', $this->broadcasts );
        $this->set('packageorders', $this->packageorders );
        $this->set('type', $this->type );
        $this->set('servicegroups', $this->servicegroups );
        $this->set('to_price', $this->to_price );
		
		$this->viewBuilder()->layout('admin');
		
		
		
	}

	public function beforeRender(Event $event){
		if (!array_key_exists('_serialize', $this->viewVars) &&
			in_array($this->response->type(), ['application/json', 'application/xml'])
		) {
			$this->set('_serialize', true);
		}
	}

	public function isAuthorized($user){
		if (isset($user['group_id']) && $user['group_id'] == 1) { // Admin can access every action
			return true;
		}
		return false;   // Default deny
	}

	//resizePhoto(500,'IMG00012.JPG','gallery/resized/','tmp/')
	//$wd=$image_atts[0]*($height/$image_atts[1]);
	//https://www.daniweb.com/programming/web-development/threads/499839/resizing-an-image-in-php
	public function resizePhoto($height, $src_filename, $dest_filename, $src_path, $dest_path, $quality=60){
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

}
