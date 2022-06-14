<?php
namespace App\Controller;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Utility\Text;
use Cake\Controller\Component\CookieComponent;
//use Cake\Datasource\ConnectionManager;

class AppController extends Controller{

	public $admin = false;
	public $simplePayMaintenance = false;

	public $servicegroup = [
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

	public function beforeFilter(Event $event){
		$this->loadComponent('My');
		//$this->loadComponent('Cookie');
		//$components = array('Cookie');

		$this->loadModel('SzlaCities');
		$cities = $this->SzlaCities->find('list',[
			'order'=>['SzlaCities.name'=>'asc'],
			'conditions' => ['SzlaCities.headstation_id >=' => 1]
		]);

		$this->set('cities', $cities);

		//debug($this->request->params['pass'][0]); die();

		$city_id = 0;
		if(isset($this->request->params['pass'][0]) && $this->request->params['pass'][0]>0){
			$city_id = (int) $this->request->params['pass'][0];
		}

		//if( ($this->request->session()->read('currentCityId')!==Null && $this->request->session()->read('currentCityId')>0)
		if(
			($city_id!==Null && $city_id>0) &&
			( isset($this->request->params['pass'][0]) &&
			($this->request->session()->read('currentCityId')!=$this->request->params['pass'][0])) &&
			$city_id>0
		){

			$foundCity = false;
			foreach($cities as $key=>$city){	// Ha a kért city_id benne van a listában, akkor ...
				if($this->request->params['pass'][0] == $key){
					$foundCity = true;
					break;
				}
			}
			if($foundCity){
				$this->request->session()->write(['currentCityId' => $this->request->params['pass'][0]]);
			}else{
				//$this->request->session()->write(['currentCityId' => 'no']);
			}

			//if(!($this->request->params['controller']=='Texts' && $this->request->params['action']=='view' && $this->request->params['pass'][0]==1020)){
			//	$this->request->session()->write(['currentCityId' => $this->request->params['pass'][0]]);
			//}

		}


		if(!isset($_COOKIE['cookieId']) || isset($_COOKIE['cookieId']) && strlen($_COOKIE['cookieId'])!=128){
			$uuid = Text::uuid();
			$uuid = preg_replace('/-/', $this->My->generateRandomString(24), $uuid, 1);
			$uuid = preg_replace('/-/', $this->My->generateRandomString(24), $uuid, 1);
			$uuid = preg_replace('/-/', $this->My->generateRandomString(24), $uuid, 1);
			$uuid = preg_replace('/-/', $this->My->generateRandomString(24), $uuid, 1);
			$this->set('cookie_id',$uuid);
		}

		//$this->Auth->allow(['index', 'view']);
		$this->set('admin',$this->admin);
		$this->set('servicegroup',$this->servicegroup);
		//$this->viewBuilder()->layout('admin');

		//debug($_COOKIE['currentCityId']); die();

		$this->set('simplePayMaintenance', $this->simplePayMaintenance);

	}


	public function initialize(){
		parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Flash');

		$uri = '';
		if( !empty( $_SERVER['REQUEST_URI'] ) ){
			$uri = $_SERVER['REQUEST_URI'];
		}

		//debug($_SERVER["HTTP_HOST"]);
		//debug($_SERVER["SERVER_NAME"]);

		if( $_SERVER['REQUEST_SCHEME'] != 'https' && !($_SERVER["HTTP_HOST"]=='saghy-upgrade.loc' || $_SERVER["SERVER_NAME"]=='saghy-upgrade.loc' || $_SERVER["HTTP_HOST"]=='saghy.loc' || $_SERVER["HTTP_HOST"]=='www.saghy.loc' || $_SERVER["SERVER_NAME"]=='saghy.loc' || $_SERVER["SERVER_NAME"]=='www.saghy.loc') ){
			return $this->redirect('https://www.saghysat.hu' . $uri);
		}
		

/*
		$this->loadModel('SzlaCities');
		$cities = $this->SzlaCities->find('list',[
			'order'=>['SzlaCities.name'=>'asc'],
			'conditions' => ['SzlaCities.headstation_id >=' => 1]
		]);

		//foreach($cities as $city){
		//	if( $this->request->params['pass'][0]) ...
		//}

		$this->set('cities', $cities);
*/

		//$session = $this->getRequest()->getSession();
		//$name = $session->read('User.name');

		//$name = $this->getRequest()->getSession()->read('User.name');

		/*
		$this->request->session()->write(['alma' => "Valami"]);
		echo $this->request->session()->read('alma');
		die();
		*/

		//if($this->request->cookies['currentCityId']!=0){
		//	$this->set('currentCityId', $this->request->cookies['currentCityId']);
		//	$this->request->session()->write(['currentCityId' => $this->request->cookies['currentCityId']]);
		//}

		//debug($this->request->cookies['currentCityId']);
		//die();

	}

	public function beforeRender(Event $event){
		if (!array_key_exists('_serialize', $this->viewVars) &&
			in_array($this->response->type(), ['application/json', 'application/xml'])
		) {
			$this->set('_serialize', true);
		}
	}


	public function getCurrentCityIdByVisitorIP(){
		$this->loadModel('NaSubscribers');
		$this->loadModel('NaDhcpLeasesLast');
		$this->loadModel('SzlaCities');
		$ip = $_SERVER['REMOTE_ADDR'];
		$dhcp = $this->NaDhcpLeasesLast->find()->select(['cpe_id'])->order(['date'=>'desc'])->where(['cpeip'=>$ip])->first();
		$currentCityId = 0;
		if($dhcp['cpe_id']){
			$subscriber = $this->NaSubscribers->find()->select(['id','city'])->where(['id'=>$dhcp['cpe_id']])->first()->toArray();
			$currentCity = $subscriber['city'];
			$cities = $this->SzlaCities->find()->select(['id','name'])->where(['name'=>$currentCity])->first()->toArray();
			$currentCityId = $cities['id'];
		}
		//if($currentCityId = 0){
		//	$currentCityId = 72;
		//}
		return $currentCityId;

	}//getCurrentCityByUserId()


}
