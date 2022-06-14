<?php  // https://stackoverflow.com/questions/28518238/how-can-i-use-my-own-external-class-in-cakephp-3-0
namespace App\Controller;
use App\Controller\AppController;

use SimplePay\SimplePay;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Core\Configure;

class ApisController extends AppController{

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
    }

	
	//http://saghy.loc/api/getSimplePays/MjAyMC0xMS0yNA==		2020-11-24
    public function getSimplePays($hash = null) {
		Configure::write('debug', false); //it will avoid any extra output
		$ret = [];
		$xml = '';
		$i=1;
		$news = Null;

		$decoded = base64_decode( $hash );
		if(empty($hash) || date("Y-m-d") != $decoded){
			return $this->redirect('/');
		}
		
		$this->loadModel('Simplepays');
		$pays = $this->Simplepays->find('all', ['order' => ['Simplepays.id' => 'desc']])
			->where([
				'retEvent' => "SUCCESS",
				'ipnStatus' => "FINISHED",
				'winszlaStatus' => "NEW"
			]);


		//debug($pays->toArray());

		$this->set('pays', $pays);

    }




}
