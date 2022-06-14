<?php
namespace SimplePay;

use SimplePayStart;
use SimplePayBack;
use SimplePayIpn;
use SimplePayQuery;
use SimplePayRefund;
use SimplePayFinish;


class SimplePay	// extends SimplePayStart
{

    public function start($params)
    {
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'config.php');
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'SimplePayV21.php');
		
		$trx = new SimplePayStart;

		$currency = 'HUF';
		$trx->addData('currency', $currency);
		$trx->addConfig($config);
		$trx->addData('total', $params['amount']);
		$trx->addData('orderRef', $params['order_id'] );
		$trx->addData('threeDSReqAuthMethod', '02');
		$trx->addData('customerEmail', $params['email']);
		$trx->addData('language', 'HU');
		$trx->addData('timeout', @date("c", time() + 1200));
		$trx->addData('methods', array('CARD'));
		$trx->addData('url', $config['URL']);
		
		$trx->addGroupData('invoice', 'name', $params['name']);
		$trx->addGroupData('invoice', 'company', $params['ids']);
		$trx->addGroupData('invoice', 'country', $params['country']);	// hu
		$trx->addGroupData('invoice', 'state', $params['state']);
		$trx->addGroupData('invoice', 'city', $params['city']);
		$trx->addGroupData('invoice', 'zip', $params['zip']);
		$trx->addGroupData('invoice', 'address', $params['address']);
		
		//$trx->addGroupData('urls', 'success', $config['URLS_SUCCESS']);
		//$trx->addGroupData('urls', 'fail', $config['URLS_FAIL']);
		//$trx->addGroupData('urls', 'cancel', $config['URLS_CANCEL']);
		//$trx->addGroupData('urls', 'timeout', $config['URLS_TIMEOUT']);
		
		$trx->formDetails['element'] = 'button'; //'link', 'button'; 'auto': Azonnali átirányítás
		
		$trx->runStart();
		
		$trx->getHtmlForm();
		
		$ret = [
			'request' => $trx->getTransactionBase(),
			'returnDataForm' => $trx->returnData['form'],
			'returnData' => $trx->getReturnData(),
		];

		$ret['returnDataForm'] = str_replace("<button type='submit'>Start SimplePay Payment</button>", "<button type='submit' class='btn btn-lg btn-success'>Tovább a simplepay fizető oldalára</button>", $ret['returnDataForm']);
		
		return $ret;

		
    }

	

	function back()
	{
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'config.php');
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'SimplePayV21.php');

		$trx = new SimplePayBack;

		$trx->addConfig($config);

		$result = [];
		if (isset($_REQUEST['r']) && isset($_REQUEST['s'])) {
			if ($trx->isBackSignatureCheck($_REQUEST['r'], $_REQUEST['s'])) {
				$result = $trx->getRawNotification();
			}
		}

		$ret = [
			'raw' => $result,
			'formatted' => $trx->getFormatedNotification()
		];
		
		return $ret;
	
	}
	
	
	

	function ipn()
	{
		header('Content-Type: application/json; charset=utf-8');
		
		$confirm = null;
		
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'config.php');
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'SimplePayV21.php');

		$json = file_get_contents('php://input');
		$input = (array) json_decode($json);

		$trx = new SimplePayIpn;
		$trx->addConfig($config);

		//check signature and confirm IPN
		//-----------------------------------------------------------------------------------------
		if ($trx->isIpnSignatureCheck($json)) {
			/**
			 * Generates all response
			 * Puts signature into header
			 * Print response body
			 *
			 * Use this OR getIpnConfirmContent
			 */
			$trx->runIpnConfirm();

			/**
			 * Generates all response
			 * Gets signature and response body
			 *
			 * You must set signeature in header and you must print response body!
			 *
			 * Use this OR runIpnConfirm()
			 */
			$confirm = $trx->getIpnConfirmContent();
			
		}

		//debug($trx->isIpnSignatureCheck($json));

		return $confirm;
		//no need to print further information
		exit;
	}



	
	




    public function finish()
    {
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'config.php');
		require_once(ROOT. DS . 'vendor' . DS . 'SimplePay' . DS . 'src' . DS . 'SimplePayV21.php');

		$trx = new SimplePayFinish;
		$trx->addConfig($config);


		//add merchant transaction ID
		//-----------------------------------------------------------------------------------------
		if (isset($_REQUEST['orderRef'])) {
			$trx->addData('orderRef', $_REQUEST['orderRef']);
		}

		//add SimplePay transaction ID
		//-----------------------------------------------------------------------------------------
		if (isset($_REQUEST['transactionId'])) {
			$trx->addData('transactionId', $_REQUEST['transactionId']);
		}

		//add merchant account ID
		//-----------------------------------------------------------------------------------------
		if (isset($_REQUEST['merchant'])) {
			$trx->addConfigData('merchantAccount', $_REQUEST['merchant']);
		}

		//add original total amount
		//-----------------------------------------------------------------------------------------
		if (isset($_REQUEST['originalTotal'])) {
			$trx->addData('originalTotal', $_REQUEST['originalTotal']);
		}

		//add approved total amount
		//-----------------------------------------------------------------------------------------
		if (isset($_REQUEST['approveTotal'])) {
			$trx->addData('approveTotal', $_REQUEST['approveTotal']);
		}

		//add currency
		//-----------------------------------------------------------------------------------------
		$trx->transactionBase['currency'] = 'HUF';

		//start finish
		//-----------------------------------------------------------------------------------------
		$trx->runFinish();


		//test data
		//-----------------------------------------------------------------------------------------
		//print "API REQUEST";
		//print "<pre>";
		//print_r($trx->getTransactionBase());
		//print "</pre>";
		//
		//print "API RESULT";
		//print "<pre>";
		//print_r($trx->getReturnData());
		//print "</pre>";


		$ret = [
			'request' => $trx->getTransactionBase(),
			'returnData' => $trx->getReturnData(),
		];
		
		return $ret;
		
    }














	
}

?>