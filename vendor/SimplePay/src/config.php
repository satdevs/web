<?php
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

    'SANDBOX' => false,

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

