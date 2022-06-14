<?php

/**
 *  Copyright (C) 2020 OTP Mobil Kft.
 *
 *  PHP version 7
 *
 *  This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category  SDK
 * @package   SimplePayV2_SDK
 * @author    SimplePay IT Support <itsupport@otpmobil.com>
 * @copyright 2020 OTP Mobil Kft.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 * @link      http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */

//Optional error riporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

 //Import config data
require_once 'src/config.php';

//Import SimplePayment class
require_once 'src/SimplePayV21.php';

$trx = new SimplePayQuery();

$trx->addConfig($config);


//add merchant transaction ID
//-----------------------------------------------------------------------------------------
if (isset($_REQUEST['orderRef'])) {
    $trx->addMerchantOrderId($_REQUEST['orderRef']);
}


//add SimplePay transaction ID
//-----------------------------------------------------------------------------------------
if (isset($_REQUEST['transactionId'])) {
    $trx->addSimplePayId($_REQUEST['transactionId']);
}


//add merchant account ID
//-----------------------------------------------------------------------------------------
if (isset($_REQUEST['merchant'])) {
    $trx->addConfigData('merchantAccount', $_REQUEST['merchant']);
}


//get detailed result
//-----------------------------------------------------------------------------------------
//$trx->addData('detailed', true);


//get refunds
//-----------------------------------------------------------------------------------------
//$trx->addData('refunds', true);


//Time interval
//-----------------------------------------------------------------------------------------
/*
$fromInSec = -86400;
$from = @date("c", time() + $fromInSec);
$trx->addData('from', $from);

$untilInSec = 0;
$until = @date("c", time() + $untilInSec);
$trx->addData('until', $until);
*/


//start query
//-----------------------------------------------------------------------------------------
$res = $trx->runQuery();


//test data
//-----------------------------------------------------------------------------------------
print "API REQUEST";
print "<pre>";
print_r($trx->getTransactionBase());
print "</pre>";

print "API RESULT";
print "<pre>";
print_r($trx->getReturnData());
print "</pre>";
