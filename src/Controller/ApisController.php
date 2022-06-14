<?php  // https://stackoverflow.com/questions/28518238/how-can-i-use-my-own-external-class-in-cakephp-3-0
namespace App\Controller;
use App\Controller\AppController;

use SimplePay\SimplePay;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class ApisController extends AppController{

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
		$this->viewBuilder()->layout('api');
    }

	
	//http://saghy.loc/api/getSimplePays/MjAyMC0xMS0yNA==		2020-11-24
    public function simplePays($hash = null) {
		return $this->redirect('/');
		die();
		Configure::write('debug', true); //it will avoid any extra output
		$ret = [];
		$xml = '';
		$i=1;
		$news = Null;
		$decoded_hash = '';

		$decoded_hash = base64_decode( $hash );
		if(empty($hash) || date("Y-m-d") != $decoded_hash){
			return $this->redirect('/');
		}
		
		$this->loadModel('Simplepays');
		$pays = $this->Simplepays->find('all', ['order' => ['Simplepays.id' => 'desc']])
			->where([
				//'retEvent' => "SUCCESS",
				'ipnStatus' => "FINISHED",
				'winszlaStatus' => "NEW"
			]);


		//debug($pays->toArray());

		$this->set('pays', $pays);

    }

	// https://www.saghysat.hu/api/setSimplePay
    public function simplePay($invoiceBiz=Null, $hash=Null) {
		return $this->redirect('/');
		die();
		Configure::write('debug', false);

		$decoded_hash 	= '';
		$conditions 	= ['id' => 0];
		$message 		= '-';

		$this->loadModel('Simplepays');
		$simplepaysTable = TableRegistry::get('Simplepays');

		if ($this->request->is(['get']) && $invoiceBiz !== Null && $hash !== Null) {

			$decoded_hash = base64_decode( $hash );
			if(empty($hash) || date("Y-m-d") != $decoded_hash){
				return $this->redirect('/');
			}
			
		}

		if($invoiceBiz !== Null){
			$conditions = ['invoiceBiz' => $invoiceBiz];
		}

		if(isset($this->request->data['orderRef'])){
			$conditions = ['id' => $this->request->data['orderRef']];
		}
		
		$simplepay = $this->Simplepays->find()->where($conditions)->first();

		if($simplepay === null){
			$message = "MISSING RECORD";
		}
		
		// ------ set the status --------
		if ($this->request->is(['post'])) {
			$decoded_hash = base64_decode( $this->request->data['hash'] );
			
			if(substr($decoded_hash, 0, 10) == date("Y-m-d") && substr($decoded_hash, 10) == $simplepay->ipnSalt){

				if($simplepay !== null){
					if($this->request->data['invoiceId'] != null && $this->request->data['invoiceBiz'] != null && $this->request->data['invoiceUser'] != null){
						$simplepay->winszlaStatus 		= 'PAID';
						$simplepay->invoiceId 			= $this->request->data['invoiceId'];
						$simplepay->invoiceBiz 			= $this->request->data['invoiceBiz'];
						$simplepay->invoiceUser			= $this->request->data['invoiceUser'];
						$simplepay->invoiceInsertDate 	= date('Y-m-d H:i:s');
						if($simplepaysTable->save($simplepay)){
							$message = 'SAVED';
						}else{
							$message = 'HAS BEEN NOT SAVED';
						}
					}
				}
				
			}else{
				$message = 'DECODED HASH ERROR';
			}
			
		} // POST

		// ------ get the status --------
		$ret = '<?xml version="1.0" encoding="UTF-8"?>';
		$ret .= "<SimplePay>";
			$ret .= "<item>";
				$ret .= "<invoiceId>";
					$ret .= $simplepay->invoiceId;
				$ret .= "</invoiceId>";
				$ret .= "<transactionId>";
					$ret .= $simplepay->transaction_id;
				$ret .= "</transactionId>";
				$ret .= "<winszlaStatus>";
					if($simplepay->winszlaStatus !== null){
						$ret .= $simplepay->winszlaStatus;
					}else{
						$ret .= 'EMPTY';
					}
				$ret .= "</winszlaStatus>";
				$ret .= "<message>";
					$ret .= $message;
				$ret .= "</message>";
			$ret .= "</item>";
		$ret .= "</SimplePay>";

		echo $ret;

		die();
		
		//$this->set('simplepay', $simplepay);

    }

}
