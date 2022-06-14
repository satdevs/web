<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;

//use SimpleLiveUpdate;
//use SimpleIpn;
//use SimpleBackRef;

//require_once(ROOT. DS . 'vendor' . DS . 'simplepay' . DS . 'src' . DS . 'SimplePayV21.php');

class SimplePayComponent extends Component {
	
	public $orderCurrency = 'HUF';
	
	protected $_defaultConfig = [
        'sandbox' => true
    ];

	public function initialize(array $config){
		require_once(ROOT. DS . 'vendor' . DS . 'simplepay' . DS . 'src' . DS . 'SimplePayV21.php');
		
		$trx = new SimplePayStart;
		
		//debug( $this->request );
		die('xxxx');
		
	//
	//	$this->setConfig("sandbox", Configure::read('Env.sandbox'));
	//
	//	if($this->config('sandbox') == true){
	//		$this->config('SimplePay', Configure::read('SimplePaySandbox'));
	//	}else{
	//		$this->config('SimplePay', Configure::read('SimplePay'));
	//	}
	//	
	//	
	}
	
	
	public function startPayment($user, $order) {
		//debug($user);
		//debug($order);

		$trx = new SimplePayStart;

		$trx->addData('total', 25);
	
/*	
		$lu = new SimpleLiveUpdate($this->config('SimplePay'), $this->orderCurrency);
		$lu->setField("ORDER_REF", $order['id']); 
		
		//foreach($order->course_bundles as $courseBundle){
			$lu->addProduct(array(
		    	'name' 	=> $order['name'],      //product name [ string ]
				'code' 	=> $order['code'],      //merchant systemwide unique product ID [ string ]
				'info' 	=> $order['info'],     	//product description [ string ]
				'price' => $order['price'],     //product price [ HUF: integer | EUR, USD decimal 0.00 ]
				'vat' 	=> $order['vat'],       //product tax rate [ in case of gross price: 0 ] (percent)
				'qty' 	=> $order['qty']    	//product quantity [ integer ] 
			));
		//}
	
		//Billing data
    	$lu->setField("BILL_FNAME", $order->user->first_name);
    	//$lu->setField("BILL_LNAME", $order->user->last_name);
    	$lu->setField("BILL_EMAIL", $order->user->email); 
    	$lu->setField("BILL_PHONE", "36201234567");
    	//$lu->setField("BILL_COMPANY", "Company name");          		// optional
    	//$lu->setField("BILL_FISCALCODE", " ");                  		// optional
    	$lu->setField("BILL_COUNTRYCODE", "HU");
    	$lu->setField("BILL_STATE", "");
    	$lu->setField("BILL_CITY", $order->user->billing_city); 
    	$lu->setField("BILL_ADDRESS", $order->user->billing_address); 
    	//$lu->setField("BILL_ADDRESS2", "Second line address");      	// optional
    	$lu->setField("BILL_ZIPCODE", $order->user->billing_zip_code);          
		
    	//Delivery data
    	$lu->setField("DELIVERY_FNAME", $order->user->first_name); 
    	$lu->setField("DELIVERY_LNAME", $order->user->last_name); 
    	$lu->setField("DELIVERY_EMAIL", ""); 
    	$lu->setField("DELIVERY_PHONE", "36201234567"); 
    	$lu->setField("DELIVERY_COUNTRYCODE", "HU");
    	$lu->setField("DELIVERY_STATE", "");
    	$lu->setField("DELIVERY_CITY", $order->user->billing_city);
    	$lu->setField("DELIVERY_ADDRESS", $order->user->billing_address); 
    	//$lu->setField("DELIVERY_ADDRESS2", "Second line address");  	// optional
    	$lu->setField("DELIVERY_ZIPCODE", $order->user->billing_zip_code); 
    	
    	$display = $lu->createHtmlForm('SimplePayForm', 'auto', 'Start Payment');   // format: link, button, auto (auto is redirects to payment page immediately )
		//$lu->errorLogger(); 	
		echo $display;
*/	
		exit;
	}
	
	/*	
	public function backref() {
		$orderCurrency = (isset($_REQUEST['order_currency'])) ? $_REQUEST['order_currency'] : 'N/A';
		$orderRef = (isset($_REQUEST['order_ref'])) ? $_REQUEST['order_ref'] : 'N/A'; 	
		
		$backref = new SimpleBackRef($this->config('SimplePay'), $orderCurrency );		
		$backref->order_ref = $orderRef;
		
		return [
			'checkResponse' => $backref->checkResponse(),
			'backStatusArray' => $backref->backStatusArray
		];
	}
	
	public function checkPayment() {
		
		$ipn = new SimpleIpn($this->config('SimplePay'), $this->orderCurrency);		
		if($ipn->validateReceived()){	
			$ipn->confirmReceived();	 
		}
		return $ipn;
	}
	*/
	
	
}