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
 * @package   SimplePayV2
 * @author    SimplePay IT Support <itsupport@otpmobil.com>
 * @copyright 2020 OTP Mobil Kft.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html  GNU GENERAL PUBLIC LICENSE (GPL V3.0)
 * @link      http://simplepartner.hu/online_fizetesi_szolgaltatas.html
 */

$config = [
    //HUF
    'HUF_MERCHANT' => "OMS51091901",            //merchant account ID (HUF)
    'HUF_SECRET_KEY' => "T0Bf2b7xj1L6L57z0323XuX7X2Z7uu8g",          //secret key for account ID (HUF)
    
    //EUR
    'EUR_MERCHANT' => "",            //merchant account ID (EUR)
    'EUR_SECRET_KEY' => "",          //secret key for account ID (EUR)

    //USD
    'USD_MERCHANT' => "",            //merchant account ID (USD)
    'USD_SECRET_KEY' => "",          //secret key for account ID (USD)

    'SANDBOX' => true,

    //common return URL
	
    'URL' => $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/simplepay/back',

    //optional uniq URL for events
/*
    'URLS_SUCCESS' 	=> $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/simplepay/success',    //url for successful payment
    'URLS_FAIL' 	=> $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/simplepay/fail',       //url for unsuccessful
    'URLS_CANCEL' 	=> $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/simplepay/cancel',     //url for cancell on payment page
    'URLS_TIMEOUT' 	=> $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/simplepay/timeout',    //url for payment page timeout
*/

    'GET_DATA' => (isset($_GET['r']) && isset($_GET['s'])) ? ['r' => $_GET['r'], 's' => $_GET['s']] : [],
    'POST_DATA' => $_POST,
    'SERVER_DATA' => $_SERVER,

    'LOGGER' => true,                              //basic transaction log
    //'LOG_PATH' => WWW_ROOT . 'logs' . DS . 'simplepay',                           //path of log file
    'LOG_PATH' => '/var/www/saghysat/logs/simplepay/',                           //path of log file

    //3DS
    'AUTOCHALLENGE' => true,                      //in case of unsuccessful payment with registered card run automatic challange
];

