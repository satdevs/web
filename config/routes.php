<?php
use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    //$routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    //$routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    //$routes->fallbacks('DashedRoute');
    $routes->addExtensions(['pdf','rss','xml','json']);

	$routes->connect('/', ['controller' => 'Posts', 'action' => 'index','home']);

    //$routes->connect('/api/simplePays/*',		  	  ['controller' => 'Apis', 'action' => 'simplePays' ]);
    //$routes->connect('/api/simplePay/*',	  	  	  ['controller' => 'Apis', 'action' => 'simplePay' ]);
    //$routes->connect('/apidev/simplePays/*',	  	  ['controller' => 'Apidevs', 'action' => 'simplePays' ]);
    //$routes->connect('/apidev/simplePay/*',	  	  	  ['controller' => 'Apidevs', 'action' => 'simplePay' ]);

    $routes->connect('/simplepay',                    ['controller' => 'Simplepays', 'action' => 'pay' ]);
    $routes->connect('/simplepay/back',               ['controller' => 'Simplepays', 'action' => 'back' ]);
    $routes->connect('/simplepay/success',            ['controller' => 'Simplepays', 'action' => 'success' ]);
    $routes->connect('/simplepay/fail',            	  ['controller' => 'Simplepays', 'action' => 'fail' ]);
    $routes->connect('/simplepay/cancel',             ['controller' => 'Simplepays', 'action' => 'cancel' ]);
    $routes->connect('/simplepay/timeout',            ['controller' => 'Simplepays', 'action' => 'timeout' ]);
    $routes->connect('/simplepay/ipn',            	  ['controller' => 'Simplepays', 'action' => 'ipn' ]);
    $routes->connect('/simplepay/checkIpn/*',		  ['controller' => 'Simplepays', 'action' => 'checkIpn' ]);


    $routes->connect('/interest',                     ['controller' => 'SzlaProductDescs', 'action' => 'interest' ]);
    $routes->connect('/individual',                   ['controller' => 'SzlaProductDescs', 'action' => 'get_individual_package' ]);

    $routes->connect('/getOffers',                    ['controller' => 'Newproducts', 'action' => 'getOffers' ]);
    $routes->connect('/getChannels',                  ['controller' => 'Newproducts', 'action' => 'getChannels' ]);
    $routes->connect('/sendOffer',                    ['controller' => 'Newproducts', 'action' => 'sendOffer' ]);
    $routes->connect('/getNewCaptcha',                ['controller' => 'Newproducts', 'action' => 'getNewCaptcha' ]);

    $routes->connect('/erdeklodes/*',                 ['controller' => 'SzlaProductDescs', 'action' => 'individual_user_details' ]);
    //$routes->connect('/internet.html',   ['controller' => 'Texts', 'action' => 'view', 104 ]);
    //$routes->connect('/internet.html',   ['controller' => 'Pages', 'action' => 'display', 'internet']);


//    $routes->connect('/csomagok/*',        ['controller' => 'SzlaProductDescs', 'action' => 'show_services' ]);
    $routes->connect('/akciok.html',         ['controller' => 'Posts', 'action' => 'index','category',9 ]);
    $routes->connect('/csomagok/*',          ['controller' => 'Newproducts', 'action' => 'index' ]);
    $routes->connect('/egyedi-csomag/*',     ['controller' => 'Newproducts', 'action' => 'individual' ]);



    $routes->connect('/csomag/*',                     	['controller' => 'SzlaProductDescs', 'action' => 'show_package' ]);
    //$routes->connect('/csomag-osszeallitas.html',     ['controller' => 'SzlaProductDescs', 'action' => 'individual_package' ]);
    $routes->connect('/csomag-osszeallitas2.html',    	['controller' => 'SzlaProductDescs', 'action' => 'individual_package2' ]);
    $routes->connect('/dokumentumok.html',            	['controller' => 'Uploads', 'action' => 'index' ]);
    $routes->connect('/impresszum.html',              	['controller' => 'Texts', 'action' => 'view', 1 ]);
    $routes->connect('/aszf.html',                    	['controller' => 'Texts', 'action' => 'view', 2 ]);
    $routes->connect('/adatkezelesi-nyilatkozat.html',	['controller' => 'Texts', 'action' => 'view', 3 ]);
    $routes->connect('/cookie-tajekoztato.html',      	['controller' => 'Texts', 'action' => 'view', 4 ]);   //5-ös a nyilatkozat ami Cell-ből lesz kiírva a /dokumentumok.html alatt
    $routes->connect('/gyik.html',                    	['controller' => 'Texts', 'action' => 'view', 6 ]);
    $routes->connect('/gyik',                    		['controller' => 'Texts', 'action' => 'view', 6 ]);
    $routes->connect('/tarsszolgaltatoknak.html',     	['controller' => 'Texts', 'action' => 'view', 7 ]);

    $routes->connect('/setup-econ-box.html',           	['controller' => 'Texts', 'action' => 'view', 1031 ]);
    $routes->connect('/setup-samsung-tv-1.html',       	['controller' => 'Texts', 'action' => 'view', 1032 ]);
    $routes->connect('/setup-samsung-tv-2.html',       	['controller' => 'Texts', 'action' => 'view', 1033 ]);
    $routes->connect('/setup-triax-box.html',       	['controller' => 'Texts', 'action' => 'view', 1034 ]);


    $routes->connect('/gyerek-a-neten.html',      	 	['controller' => 'Texts', 'action' => 'view', 1038 ]);


    $routes->connect('/rtlmost',   						['controller' => 'Texts', 'action' => 'view', 1020]);
    $routes->connect('/rtlmostplusz', 					['controller' => 'Texts', 'action' => 'view', 1020]);
    $routes->connect('/rtlmost.html',   				['controller' => 'Texts', 'action' => 'view', 1020]);
    $routes->connect('/rtlmostplusz.html',   			['controller' => 'Texts', 'action' => 'view', 1020]);

    $routes->connect('/pdfszamla',					    ['controller' => 'Pdfinvoices', 'action' => 'info']);
    $routes->connect('/pdfszamla-adatlap',		    	['controller' => 'Pdfinvoices', 'action' => 'add']);

    $routes->connect('/dijmentes-internet',		    	['controller' => 'Freeinternets', 'action' => 'info']);
    $routes->connect('/dijmentes-internet-adatlap',	   	['controller' => 'Freeinternets', 'action' => 'edit']);
    $routes->connect('/dijmentes-internet-regisztralva',['controller' => 'Freeinternets', 'action' => 'message', 1028 ]);

    $routes->connect('/activate/*',					    ['controller' => 'Pdfinvoices', 'action' => 'activate']);
    $routes->connect('/deactivate/*',				    ['controller' => 'Pdfinvoices', 'action' => 'deactivate']);
    $routes->connect('/pdfdeactivate-confirmed/*',		['controller' => 'Pdfinvoices', 'action' => 'deactivate-confirmed']);
    $routes->connect('/pdfszamla-sikeres-regisztracio',	['controller' => 'Pdfinvoices', 'action' => 'pdfMessage',1022]);
    $routes->connect('/pdfszamla-hibauzenet',		   	['controller' => 'Pdfinvoices', 'action' => 'pdfMessage',1023]);
    $routes->connect('/pdfszamla-sikeres-aktivalas',	['controller' => 'Pdfinvoices', 'action' => 'pdfMessage',1024]);
    $routes->connect('/pdfszamla-sikeres-deaktivalas',	['controller' => 'Pdfinvoices', 'action' => 'pdfMessage',1025]);


    $routes->connect('/internetextra2022/*',				['controller' => 'Internetextras', 'action' => 'add']);


    $routes->connect('/GINOP-2.1.8-17-2017-01681.html',	['controller' => 'Texts', 'action' => 'view', 1019 ]);
//#####################################################################################################

    $routes->connect('/mobil.html',      ['controller' => 'Pages', 'action' => 'display', 'mobil']);
    $routes->connect('/kapcsolat.html',  ['controller' => 'Messages', 'action' => 'add']);
    $routes->connect('/hirek.html',      ['controller' => 'Posts', 'action' => 'index', 'all']);
    $routes->connect('/login',           ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/login.html',      ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/logout',          ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/logout.html',     ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/profil',          ['controller' => 'Users', 'action' => 'profil']);
    $routes->connect('/regisztracio.html', ['controller' => 'Users', 'action' => 'add']);
    $routes->connect('/elfelejtett-jelszo.html', ['controller' => 'Users', 'action' => 'requestnewpassword']);
    $routes->connect('/uj-jelszo-generalas/*', ['controller' => 'Users', 'action' => 'generatenewpassword']);
//#####################################################################################################
    //$routes->connect('/download/*',      ['controller' => 'Uploads', 'action' => 'download', 'admin'=>false, 'prefix'=>false]);
    $routes->connect('/download/*',      ['controller' => 'Uploads', 'action' => 'download']);
    $routes->connect('/files/*',         ['controller' => 'Abouts', 'action' => 'wrongURL']);
//#####################################################################################################
    //$routes->connect('/posts/feed', array('controller' => 'posts', 'action' => 'index', 'url' => array('ext' => 'rss') ) );
    Router::connect('/posts/feed', array('controller' => 'posts', 'action' => 'index', 'url' => array('ext' => 'rss') ) );
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->fallbacks('InflectedRoute');

});

Router::prefix('admin', function($routes) {
    $routes->addExtensions(['pdf','csv','xlsx']);
    $routes->connect('/', ['controller'=>'Messages', 'action'=>'index']);
    $routes->connect('/profil', ['controller' => 'Users', 'action' => 'profil']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/changepassword', ['controller' => 'Users', 'action' => 'changepassword']);
    $routes->connect('/elfelejtett-jelszo.html', ['controller' => 'Users', 'action' => 'requestnewpassword']);
    $routes->connect('/generatenewpassword/*', ['controller' => 'Users', 'action' => 'generatenewpassword']);

    $routes->fallbacks('InflectedRoute');
});

Plugin::routes();





