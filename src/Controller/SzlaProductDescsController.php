<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

class SzlaProductDescsController extends AppController{
	public $title = "Szolgáltatásaink";
	public $components = array('My');
	public $html_offers = '';

	public function initialize(){
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}

	public function individualUserDetails($cookie=null){
		if(!isset($cookie)){
			$cookie=$_COOKIE['cookieId'];
		}
		$this->set('title', 'Érdeklődés szolgáltatásainkról');
		$content = "";
		$this->loadModel("Interests");
        $this->loadModel('Interestdetails');
        $interest = $this->Interests->find('all', ['conditions'=>['cookie'=>$cookie, 'status'=>0 ]])->first();
        $interestdetails = $this->Interestdetails->find('all', [
        	'conditions'=>[
        		'interest_id'=>$interest->id
        	]
        ]);

        if($interest){
	        if ($this->request->is(['patch', 'post', 'put'])) {
	        	$this->request->data['status'] = 1;
	            $interest = $this->Interests->patchEntity($interest, $this->request->data);
	            if ($this->Interests->save($interest)) {
	            	//------- Email küldése ------------
	                //$link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/admin/login';

	                $email = new Email('default');
	                $email->transport('saghysat');
	                $email->template('default', 'default');
	                $email->emailFormat('html');
	                $email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);
	                $email->subject('Érdeklődés a www.saghysat.hu weboldalról.');

	                //$content .= "<h2>Tisztelt ".$interest['name']."!</h2>";
	                $content .= "<h2>Érdeklődés a saghysat.hu weboldalról</h2>";
	                //$content .= "Érdeklődést köszönjük. Válaszunkkal hamarosan felkeressük Önt a megadott elérhetőségek egyikén.<br>";
	                //$content .= "Érdeklődést köszönjük. Válaszunkkal hamarosan felkeressük Önt a megadott elérhetőségek egyikén.<br>";
	                //$content .= "<br>";
	                //$content .= "<b>Az Ön által megadott elérhetőségek:</b><br>";
	                $content .= "<b>Megadott elérhetőségek:</b><br>";
	                $content .= "Neve: <b>".$interest['name']."</b><br>";
	                $content .= "Település: <b>".$interest['city']."</b><br>";
	                $content .= "Utca, házszám: <b>".$interest['address']."</b><br>";
	                $content .= "Telefon: <b>".$interest['phone']."</b><br>";
	                $content .= "Email: <b>".$interest['email']."</b><br>";

	                //$content .= "Az Ön üzenete:<br>";
	                $content .= "Üzenete:<br>";
	                //$content .= "<b>".preg_replace("#\n#","\\r",$interest['message'])."</b><br><br>";
	                $content .= "<b>".str_replace("\n","<br>",$interest['message'])."</b><br><br>";
					
					$interestdetails = $this->Interestdetails->find('all', [
			        	'order'=>[ 'product_group'=>'asc' ],
			        	'conditions'=>[ 'interest_id'=>$interest->id ]
			        ]);

					//------------------ Szolgáltatások listázása -----------------
					$content .= '<br><h3>Kiválasztott szolgáltatások, mely(ek)ről szeretne bővebb felvilágosítást kapni:</h3>';

					//$this->Interests->save($interest)
					//$interest = $this->Interests->get( $interest->id );

		    		$content .= "<b>".$interest->package_name."</b>";
		    		$content .= "<ul>";
			    	foreach ($interestdetails as $interestdetail) {
						if($interestdetail->product_group<=4){
				    		$content .= '<li>'.$interestdetail->name.'</li>';
				    	}
					}
		    		$content .= "</ul>";
		    		$content .= 'Fizetendő: <span style="font-weight: bold; font-size: 18px;">'.$interest->price_services.'</span>&nbsp;Ft/hó<br><br>';
					//------------------ /.Szolgáltatások listázása -----------------


					//------------------ Digitálsi csomagok listázása ---------------
					if($interest->price_digitals > 0){
						//$content .= '<br><h3>Havidíj ellenében nézhető digitális csomagjaink:</h3>';
						$content .= '<br><h3>Havidíj ellenében nézhető digitális csomagok:</h3>';
			    		$content .= "<ul>";
				    	foreach ($interestdetails as $interestdetail) {
							if($interestdetail->product_group==9){
					    		$content .= '<li>'.$interestdetail->name.'</li>';
					    	}
						}
			    		$content .= "</ul>";
			    		$content .= 'Fizetendő: <span style="font-weight: bold; font-size: 18px;">'.$interest->price_digitals.'</span>&nbsp;Ft/hó<br><br>';
			    	}
					//------------------ /.Digitálsi csomagok listázása ---------------

					$content .= 'Összesen:  <span style="font-weight: bold; font-size: 24px;">'.$interest->price_total.'</span>&nbsp;Ft/hó<br>';
					$content .= "<br>";
					$content .= "<br>";
	                $content .= "Üdvözlettel:<br><b>Sághy-Sat Kft.</b><br>";
	                $content .= "<b>7754 Bóly, Ady E. u. 9.</b><br>";
	                $content .= "Tel.: <b>+36 69/368-162</b><br>";


	                $email->to('zsolt@saghysat.hu');
	                $email->send($content);

	                //$email->to('saghyt@saghysat.hu');
	                //$email->send($content);
	                //$email->to('info@saghysat.hu');
	                //$email->send($content);

					//----------- Status 2-re állítása. ----------------
					$interestTable = TableRegistry::get('Interests');
					$query = $interestTable->query();
					$query->update()->set(['status'=>2])->where(['cookie'=>$_COOKIE['cookieId'], 'status'=>1])->execute();
					//----------- /.Interest FEJ mentése vagy létrehozása ----------------

	            	//------- /.Email küldése ------------
	                $this->Flash->success(__('Köszönjük érdeklődését! Érdeklődése feldolgozásra került. Hamarosan felvesszük Önnel a kapcsolatot.'));
	                return $this->redirect("/csomag-osszeallitas.html");
	            } else {
	                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
	            }
	        }
	        $this->set(compact('interest','interestdetails'));
	        $this->set('_serialize', ['interest']);
		}else{
            $this->Flash->warning(__('Hibás címre kattintott!'));
            return $this->redirect("/csomag-osszeallitas.html");
        }

	}


/*
################################################################################################################################################
									 █████       ██     █████    ██      ██	          ██
									█     █            █     █     ██  ██ 	        ████
									█     █      ██    █     █       ██     	  ██  ██
									███████      ██    ███████       ██  	          ██
									█     █  █   ██    █     █     ██  ██             ██
									█     █  █████     █     █   ██      ██	          ██  ██
									   A-J-A-X  --  getIndividualPackage
################################################################################################################################################
*/	public function interest(){
		if ($this->request->is(['post', 'ajax'])) {
			Configure::write('debug', 0); //it will avoid any extra output
			$success = false;
			$message = "";
			$this->response->disableCache();
			$teszt 				 = ""; //------------------- TESZT VÁLTOZÓ -------------------------
			$conn = ConnectionManager::get('winszla_web');
			$this->autoRender = false;
			$data = $this->request->input('json_decode');				//Adatok az AJAX-ból
			$price_services	= (integer) $data[9980];	//Az árakat csak számozott index-szel lehetett áthozni JS-ből.
			$price_digitals = (integer) $data[9982];	//s így ezek megkapták ezt a magas számú indexet...
			$package_name 	= $data[9981];

			$currentCityId 	= 0;
			$headstation_id = 0;
			//------------ Fejállomáshoz meghatározása ------------
			if(isset($_COOKIE['currentCityId'])){
				$currentCityId  = $_COOKIE['currentCityId'];
			}
			$this->loadModel('SzlaCities');
			$city = $this->SzlaCities->get($currentCityId);
			if($city->headstation_id){
				$headstation_id = $city->headstation_id;			
			}
			//------------ /. Fejállomáshoz meghatározása ------------
			
			//------------ Fejállomáshoz tartozó tételek lekérdezése ------------
			$descs = $this->SzlaProductDescs->find('all')
					->contain(['SzlaProducts'])
					->where(['headstation_id'=>$headstation_id])
					->toArray();
			//------------ /.Fejállomáshoz tartozó tételek lekérdezése ------------

			$this->loadModel("Interests");
			$this->loadModel("Interestdetails");
			//----------- Interest FEJ mentése vagy létrehozása ----------------
	        $interest =$this->Interests->find('all', ['conditions'=>['cookie'=>$_COOKIE['cookieId'], 'status'=>0 ]])->first();
	        if(!$interest){
				$interest = $this->Interests->newEntity();
				$newinterest['status']		= 0;
	        }
			$newinterest['cookie'] 			= $_COOKIE['cookieId'];
			$newinterest['city'] 			= $city->name;
			$newinterest['package_name']	= $package_name;

			$newinterest['price_services'] 	= $price_services;
			$newinterest['price_digitals'] 	= $price_digitals;
			$price_total 					= $price_services + $price_digitals;
			$newinterest['price_total'] 	= $price_total;
			$interest = $this->Interests->patchEntity($interest, $newinterest);
			if($this->Interests->save($interest)){
				$message = "Sikerült"; //.$interest;
				$success = true;
			}else{
				$message = "Nem sikerült menteni"; //.$interest;
			}
			//----------- /.Interest FEJ mentése vagy létrehozása ----------------

			$this->Interestdetails->deleteAll(['interest_id' => $interest->id]);
			$selected = [];
			
			foreach ($descs as $desc) {
				if( $data[$desc->id] ){
					$selected[] = $desc->id;
					$interestdetail = $this->Interestdetails->newEntity();
					$newinterestdetail['interest_id'] 	= $interest->id;
					$newinterestdetail['productdesc_id']= $desc->id;
					$newinterestdetail['product_id']	= $desc->product_id;
					$newinterestdetail['name']			= $desc->name;
					$newinterestdetail['product_group']	= $desc->szla_product->csoport;
					$newinterestdetail['product_name']	= $desc->szla_product->nev;
                    $interestdetail = $this->Interestdetails->patchEntity($interestdetail, $newinterestdetail);
            		if($this->Interestdetails->save($interestdetail)){
						$success = true;
            		}else{
            			$message = "Sajnos nem sikerült az adatok mentése!\nKérem próbálja meg újra vagy picivel később!\n\nKöszönjük megértését!";
            			$success = false;
            			//break;
            		}
				}
			}

			$response = [
				'success'		=> $success,
				'message'		=> $message,
				'priceservices'	=> $price_services,
				'pricedigitals'	=> $price_digitals,
				'pricetotal'	=> $price_total,
				'packagename'	=> $package_name

			];

			$this->response->body(json_encode($response));
			return $this->response;

		}




		return;
	}	// /.interest fg()




/*
################################################################################################################################################
################################################################################################################################################
################################################################################################################################################
	http://cake3.loc/szla_product_descs/offers
	//Paraméterek: |Minimum összeg| amitől drágábbat mutat majd, |TV|,|NET|,|TEL| van-e kiválasztva és annak a POS-értéke, hogy azonos vagy nagyobbat ajánljon | Hányat mutasson...
	//$this->offers($product//xxxxxs_price, $catv_pos, $net_pos, $tel_pos, $catv_id, $net_id, $tel_id, $digitals_ids, 8);	//Ez a $this->html_offers változó értékét feltölti HTML sjánló listával...,
*/	public function offers($min_price=0,$p_catv_pos=null,$p_net_pos=null,$p_tel_pos=null,$p_catv_id=null,$p_net_id=null,$p_tel_id=null,$p_digital_ids=null,$p_digitals_price=0, $p_count=null){
		$count_service = count( $p_catv_id )+count( $p_net_id )+count( $p_tel_id );
		$count_digital = count( $p_digital_ids );
		if($count_service>3){$count_service=3;}
		if($count_digital>3){$count_digital=3;}

		//------------ Fejállomáshoz meghatározása ------------
		$this->loadModel('SzlaCities');
		$currentCityId 	= 0;
		$headstation_id = 0;
		if(isset($_COOKIE['currentCityId'])){
			$currentCityId  = $_COOKIE['currentCityId'];
		}
		$this->loadModel('SzlaCities');
		$city = $this->SzlaCities->get($currentCityId);
		$headstation_id = $city->headstation_id;
		if($headstation_id > 2){
			return;	//Hiba kijavítása után, ezt innen ki kell venni. Nem működik valamiért a 2-nél nagyobb fejállomások esetén az SQL lekérdezés...
		}
		//------------ /. Fejállomáshoz meghatározása ------------
		
		//$headstation_id = 1 ;	//TESZT!

		//------------ Fejállomáshoz tartozó tételek lekérdezése ------------
		$descs = $this->SzlaProductDescs->find('all')
				->contain(['SzlaProducts'])
				//->order(['szla_product.csoport'=>'asc', 'pos'=>'asc'])
				->where(['to_price'=>0 ])
				->orWhere(function ($exp, $q) { return $exp->isNull('to_price'); })
				->andWhere([
					'headstation_id'=>$headstation_id,
					'individual' => 1,
					//'visible' => 1,
					'SzlaProducts.csoport <='=>4,
								//['OR'=>[ ['SzlaProducts.csoport <='=>4], ['SzlaProducts.csoport <='=>9]]  ],
				])
				->toArray();
/*
		//------------ Fejállomáshoz tartozó tételek lekérdezése ------------
		//$headstation_id = 1;
		$descs = $this->SzlaProductDescs->find('all')
				->contain(['SzlaProducts'])
				->where(['headstation_id'=>$headstation_id])
				->toArray();
*/
		$t1 = [];
		foreach ($descs as $desc) {
			$t1[] = [
				'id'			=> $desc->id,
				'net_without_tv_id' => $desc->net_without_tv_id,
				'product_id'	=> $desc->product_id,
				'pos'			=> $desc->pos,
				'group'			=> $desc->szla_product->csoport,
				'name'			=> $desc->name,
				'price'			=> $desc->szla_product->ft,
				'content'		=> $desc->contents,
				'description'	=> $desc->description,
				'visible'		=> $desc->visible,
			];
		}
		
		//------------ Fejállomáshoz tartozó tételek lekérdezése ------------
		$descs2 = $this->SzlaProductDescs->find('all')
				->contain(['SzlaProducts'])
				//->order(['szla_product.csoport'=>'asc', 'pos'=>'asc'])
				->where(['to_price'=>0 ])
				->orWhere(function ($exp, $q) { return $exp->isNull('to_price'); })
				->andWhere([
					'headstation_id'=>$headstation_id,
					//'individual' => 1,
					'net_without_tv_id >=' => 1,
					'SzlaProducts.csoport <='=>4,
								//['OR'=>[ ['SzlaProducts.csoport <='=>4], ['SzlaProducts.csoport <='=>9]]  ],
				])
				->toArray();

		foreach ($descs2 as $desc) {
			$t1[] = [
				'id'			=> $desc->id,
				'net_without_tv_id' => $desc->net_without_tv_id,
				'product_id'	=> $desc->product_id,
				'pos'			=> $desc->pos,
				'group'			=> $desc->szla_product->csoport,
				'name'			=> $desc->name,
				'price'			=> $desc->szla_product->ft,
				'content'		=> $desc->contents,
				'description'	=> $desc->description,
				'visible'		=> $desc->visible,
			];
		}

		//$this->My->print_array($t1, true);	// Tömb kiiratása. Paraméterek: Tömb, die()
		//------------ /.Fejállomáshoz tartozó tételek lekérdezése ------------

		//------------ Akció ID meghatározása ---------------------------------
		$to_price = 1;
		$product = $this->SzlaProductDescs->find('all')
				->contain(['SzlaProducts'])
				->order(['SzlaProducts.csoport'=>'asc', 'pos'=>'asc'])
				->where(['headstation_id'=>$headstation_id, 'to_price'=>$to_price ])
				->toArray();		//Ezért: $product[0]->product_id;
		//------------ /.Akció ID meghatározása ---------------------------------

		//------------ Akció-ban szereplő tételek ----------------------------
		$this->loadModel('SzlaAkcios');
		$akcios = $this->SzlaAkcios->find('all')
				->order(['cikk'=>'asc'])
				->where(['focikk'=>$product[0]->product_id])
				->toArray();
		foreach ($akcios as $akcio) {
			$akc[$akcio->cikk] = [$akcio->akcios_kedv, $akcio->duo_kedv, $akcio->trio_kedv];
		}
		//$this->My->print_array($akc, true);	// Tömb kiiratása. Paraméterek: Tömb, die()
		//------------ /.Akció-ban szereplő tételek ----------------------------

		//--------------------------- DESCARTES SZORZAT RÉSZHALMAZÁNAK ELŐÁLLÍTÁSA ------------------------
		$catv=[]; $net=[]; $tel=[]; $descartes = [];
		foreach ($t1 as $k1) {
			foreach ($t1 as $k2) {
				foreach ($t1 as $k4) {
					if( 
						//($k1['group'] == 1) && ($k2['group'] == 2) && ($k4['group'] == 4)

						( ($k1['group'] == 1) && ($k2['group'] == 2) ) ||
						( ($k1['group'] == 1) && ($k4['group'] == 4) ) ||
						( ($k2['group'] == 2) && ($k4['group'] == 4) ) ||
						( ($k1['group'] == $k2['group']) && ($k2['group'] == $k4['group'] ) )
					)
					{
							$catv_id	= $k1['id'];
							$catv_without_tv_id= $k1['net_without_tv_id'];
							$catv_prod_id=$k1['product_id'];
							$catv		= $k1['name'];
							$catv_price	= $k1['price'];
							$catv_pos	= $k1['pos'];
							$catv_content= $k1['content'];

							$net_id 	= $k2['id'];
							$net_without_tv_id= $k2['net_without_tv_id'];
							$net_prod_id= $k2['product_id'];
							$net    	= $k2['name'];
							$net_price 	= $k2['price'];
							$net_pos 	= $k2['pos'];
							$net_content= $k2['content'];

							$tel_id		= $k4['id'];
							$tel_without_tv_id= $k4['net_without_tv_id'];
							$tel_prod_id= $k4['product_id'];
							$tel		= $k4['name'];
							$tel_price	= $k4['price'];
							$tel_pos	= $k4['pos'];
							$tel_content= $k4['content'];

							if($k1['group'] != 1){
								$catv_id = 0;
								$catv_without_tv_id= 0;
								$catv_prod_id = 0;
								$catv = "";
								$catv_price	= 0;
								$catv_pos	= 0;
								$catv_content= '';
							}
							if($k2['group'] != 2){
								$net_id = 0;
								$net_without_tv_id= 0;
								$net_prod_id = 0;
								$net = "";
								$net_price	 = 0;
								$net_pos	 = 0;
								$net_content = '';
							}
							if($k4['group'] != 4){
								$tel_id = 0;
								$tel_without_tv_id= 0;
								$tel_prod_id = 0;
								$tel = "";
								$tel_price	= 0;
								$tel_pos	= 0;
								$tel_content= '';
							}
							$count = 0;
							if($catv_id != ""){ $count++; }
							if($net_id != ""){  $count++; }
							if($tel_id != ""){ $count++;  }
							if($count > 3){ $count = 3; }
							$catv_akc	= 0;
							$net_akc	= 0;
							$tel_akc	= 0;
							if(isset($akc[$catv_prod_id][$count-1])){
								$catv_akc	= $akc[$catv_prod_id][$count-1];
							}
							if(isset($akc[$net_prod_id][$count-1])){
								$net_akc	= $akc[$net_prod_id][$count-1];
							}
							if(isset($akc[$tel_prod_id][$count-1])){
								$tel_akc	= $akc[$tel_prod_id][$count-1];
							}
							if($k1['group'] == 1 || $k2['group'] == 2){

if( ($catv_id == 0 && $net_without_tv_id > 0) || ($catv_id > 0 && $net_without_tv_id == 0) ){

								$descartes[] = [
									'catv_id'		=> $catv_id,
									'catv2_id' 		=> 0,	//nem kell, csak a konzisztencia miatt, amúgy is hibás ez itt
									'catv_prod_id' 	=> $catv_prod_id,
									'catv'			=> $catv,
									//'catv_price'	=> $catv_price,
									'catv_akc_price'=> $catv_price + $catv_akc,
									'catv_pos'		=> $catv_pos,
									'catv_content'	=> $catv_content,
									//'1'				=> '█',

									'net_id'		=> $net_id,
									'net2_id' 		=> $net_without_tv_id,
									'net_prod_id'	=> $net_prod_id,
									'net'			=> $net,
									'net_akc_price'	=> $net_price + $net_akc,
									'net_pos'		=> $net_pos,
									'net_content'	=> $net_content,
									//'2'				=> '█',

									'tel_id'		=> $tel_id,
									'tel2_id' 		=> 0,	//nem kell, csak a konzisztencia miatt, amúgy is hibás ez itt
									'tel_prod_id'	=> $tel_prod_id,
									'tel'			=> $tel,
									'tel_akc_price'	=> $tel_price + $tel_akc,
									'tel_pos'		=> $tel_pos,
									'tel_content'	=> $tel_content,
									//'3'				=> '█',

									////'catv_akc'		=> $catv_akc,

									//'net_price'		=> $net_price,
									//'net_akc'		=> $net_akc,

									
									//'tel_price'		=> $tel_price,
									//'tel_akc'		=> $tel_akc,
									'total'			=> ($catv_price + $catv_akc)+($net_price + $net_akc)+($tel_price + $tel_akc),
									'count'			=> $count,
								];
}	//if( ($catv_id == 0 && $net_without_tv_id > 0) || ($catv_id > 0 && $net_without_tv_id == 0) )


							}


					}
				}
			}
		}
		$descartes = array_unique($descartes, SORT_REGULAR);	// <- Duplikált tételek kizárása

		//$descartes = $this->My->array_msort($descartes, array('catv_id'=>SORT_ASC, 'net_id'=>SORT_ASC, 'tel_id'=>SORT_ASC));
		//$this->My->print_array($descartes, true);	// Tömb kiiratása. Paraméterek: Tömb, die()

		//$descartes = $this->My->array_msort($descartes, array('catv_prod_id'=>SORT_ASC, 'net_prod_id'=>SORT_ASC, 'tel_prod_id'=>SORT_ASC));
		//$this->My->print_array($descartes, true);	// Tömb kiiratása. Paraméterek: Tömb, die()

		if(isset($p_catv_pos) && $p_catv_pos > 0){
			$descartes = $this->My->array_msort($descartes, ['net_pos'=>SORT_ASC,'tel_pos'=>SORT_ASC]);
		}
		if(isset($p_net_pos) && $p_net_pos > 0){
			$descartes = $this->My->array_msort($descartes, ['catv_pos'=>SORT_ASC,'tel_pos'=>SORT_ASC]);
		}
		if( (isset($p_catv_pos) && $p_catv_pos > 0) && (isset($p_net_pos) && $p_net_pos > 0 ) ){
			$descartes = $this->My->array_msort($descartes, ['catv_pos'=>SORT_ASC, 'net_pos'=>SORT_ASC, 'tel_pos'=>SORT_ASC ]);
		}
		//--------------------------- /.DESCARTES SZORZAT RÉSZHALMAZÁNAK ELŐÁLLÍTÁSA ------------------------


		//----------- Függőségek lekérdezése ------------------- //Azért utána van, mert könnyebb keve3sebb tételen átmenni, mint az array_unique előtt több tételen...
		$this->loadModel('SzlaProductDepends');
		$depends = $this->SzlaProductDepends->find('all',['order'=>['tv'=>'asc','net'=>'asc','tel'=>'asc'], 'conditions'=>['headstation_id'=>$headstation_id]]);
		$deps = [];
		foreach ($depends as $dep) {
			$deps[] = ['catv_id'=>$dep->tv, 'net_id'=>$dep->net, 'tel_id'=>$dep->tel];
		}
		//$this->My->print_array($deps, true);	// Tömb kiiratása. Paraméterek: Tömb, die()
		//----------- /.Függőségek lekérdezése -------------------

		//----------- ███████████████████████████████████████████████████████████████████████████████████████████ ---------------
		//----------- Függőségek törlése a DESCARTES szorzat részhalmazából, azaz szűrés a függősgi tábla szerint ---------------
		$tmp = [];
		$offer_count = 0;
		foreach ($descartes as $descart) {
			$continue = "no";

			if( $descart['net_id'] == 0 && $descart['tel_id'] == 0 ){		//Csak TV vagy 
				$continue = "ok";
			}
			if( $descart['catv_id'] == 0 && $descart['tel_id'] == 0 ){		//Csak net
				$continue = "ok";
			}
			if( ($descart['net_id'] != 0 && $descart['catv_id'] != 0) && $descart['tel_id'] == 0 ){
				$continue = "ok";
			}
			foreach ($deps as $dep) {
				//------ Csevely, azaz a TV a feltétele -------
				if( $dep['catv_id'] == $descart['catv_id'] && $dep['net_id'] == $descart['net_id'] && $dep['tel_id'] == $descart['tel_id'] ){
					$continue = "ok";
					break;
				}
				//------ Csevely, azaz a TV a feltétele -------
				if( $dep['net_id'] == 0 && $descart['catv_id'] == $dep['catv_id'] && $descart['tel_id'] == $dep['tel_id']){
					$continue = "ok";
					break;
				}
				//------ Csak TV a solo-hoz ----
				if( ($dep['net_id'] == -1 && $descart['net_id'] == 0) && $descart['catv_id'] == $dep['catv_id'] && $descart['tel_id'] == $dep['tel_id']){
					$continue = "ok";
					break;
				}
				//------ Csak NET a solo-hoz ----
				if( ($dep['catv_id'] == -1 && $descart['catv_id'] == 0) && $descart['net_id'] == $dep['net_id'] && $descart['tel_id'] == $dep['tel_id']){
					$continue = "ok";
					break;
				}
			}

			if($descart['total'] <= $min_price){	//Hogy az aktuális kiválasztás ne legyen benne ezért van kizárva az '=' jellel...
				 $continue = "no";
			}
			if(isset($p_catv_pos) && $descart['catv_pos'] < $p_catv_pos ){		//Mikor zárja ki a rekordot...
				$continue = "no";
			}
			if(isset($p_net_pos) && $descart['net_pos'] < $p_net_pos ){		//Mikor zárja ki a rekordot...
				$continue = "no";
			}
			if(isset($p_tel_pos) && $descart['tel_pos'] < $p_tel_pos ){		//Mikor zárja ki a rekordot...
				$continue = "no";
			}

			if(isset($p_count) && $p_count <= $offer_count){		//Tételek száma mennyi lehet max
				//$continue = "no";
			}

			if($continue=="no"){	//Ha nem folytatható
				continue;			//Nem megjelenített rekord, mert itt visszaugrik a ciklusfejhez
			}
			$offer_count++;
			$tmp[] = $descart;
		}
		$descartes = $tmp;
		unset($tmp);

		if(isset($p_catv_pos) && $p_catv_pos > 0){
			$descartes = $this->My->array_msort($descartes, ['net_pos'=>SORT_ASC,'total'=>SORT_ASC]);
		}
		if(isset($p_net_pos) && $p_net_pos > 0){
			$descartes = $this->My->array_msort($descartes, ['catv_pos'=>SORT_ASC,'total'=>SORT_ASC]);
		}
		if( (isset($p_catv_pos) && $p_catv_pos > 0) && (isset($p_net_pos) && $p_net_pos > 0 ) ){
			//$descartes = $this->My->array_msort($descartes, ['catv_pos'=>SORT_ASC, 'net_pos'=>SORT_ASC, 'tel_pos'=>SORT_ASC ]);
			//$descartes = $this->My->array_msort($descartes, ['tel_pos'=>SORT_ASC, 'total'=>SORT_ASC ]);
			$descartes = $this->My->array_msort($descartes, ['total'=>SORT_ASC ]);
		}
		$descartes = $this->My->array_msort($descartes, ['total'=>SORT_ASC ]);
/*		//--- DEBUG ---
		echo '<div style="float: left; margin-left: 200px;">';
			$this->My->print_array($descartes, false);	// Tömb kiiratása. Paraméterek: Tömb, die()
		echo '</div>';
		echo '<div style="float: left; margin-left: 10px;">';
			$this->My->print_array($deps, false);	// Tömb kiiratása. Paraméterek: Tömb, die()
		echo '</div>';
		echo '<div style="clear: both;"></div>';
*/
		//----------- /.Függőségek törlése a DESCARTES szorzat részhalmazából ---------------


		//█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ 
		// █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █   Csomagok legkérdezése   █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █
		//█ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ █ 

		//Telefon SOLO lekérdezése
		$telefon_solo_akcio_id = 0;
		$telefon_solo_akcio_name = "";
		$akcios_desc_records = $this->SzlaProductDescs->find('all')
								->contain(['SzlaProducts'])
								->where(['headstation_id'=>$headstation_id, 'to_price >'=>1 ])
								->toArray()
								;

		$count_tv 	= 0;
		$count_net 	= 0;
		$count_tel 	= 0;
		$ids 		= "";
		foreach ($akcios_desc_records as $service) {
			$services[] = [ 'id'=>$service->product_id, 'name'=>$service->name, 'price'=>$service->szla_product->ft ];
			$ids .= $service->product_id.",";
			if($service->szla_product->csoport == 1 ){
				$count_tv++;
				$catv_id = $service->product_id;
			}
			if($service->szla_product->csoport == 2 ){
				$count_tv++;
				$net_id = $service->product_id;
			}
			if($service->szla_product->csoport == 4 ){
				$tel_tv++;
				$catv_id = $service->product_id;
			}
			if($service->szla_product->csoport == 9 ){
				$count_digi++;
			}

		}
		$ids = substr($ids, 0, -1);
		//$ids = '344,347,345,346,329';

		$conn = ConnectionManager::get('winszla_web');
		$packages = $conn->execute(
			'SELECT
				akcios.focikk, akcdescs.name AS AkcName, descs.id AS DescId, akcios.cikk, descs.name AS DescName,
				descs.headstation_id AS HeadId,	
				descs.pos AS Pos,
				products.ft+akcios.akcios_kedv+descs.licenc_price AS AkcFt1,
				products.ft+akcios.duo_kedv+descs.licenc_price 	  AS AkcFt2,
				products.ft+akcios.trio_kedv+descs.licenc_price   AS AkcFt3
			FROM akcios
				LEFT JOIN products ON products.id = (akcios.cikk) 
				LEFT JOIN product_descs AS descs ON descs.product_id = (akcios.cikk) 
				LEFT JOIN product_descs AS akcdescs ON akcdescs.product_id = (akcios.focikk) 
			WHERE
				akcios.focikk IN ('.$ids.')
				AND descs.headstation_id = :headstation_id
				AND akcdescs.headstation_id = :headstation_id
			ORDER BY
				akcios.focikk ASC, Pos ASC',
			['headstation_id'=>$headstation_id]
		);

		//Megszámolja, hogy hány tétel van kiválasztva
		//$count_service = 2;

		$t_akc = [];
		foreach($packages as $row){
			$t_akc[$row['focikk']][] = $row['cikk'];
		}
		$akcios_count = [];
		foreach ($t_akc as $key => $value) {
			$akcios_count[$key] = count($t_akc[$key]);
			if( $akcios_count[$key]>3 ){
				$akcios_count[$key] = 3;
			}
			//debug( $key );				//Akció ID - focikk
			//debug( $akcios_count[$key] );	//Tételszám
		}
		
		

		//Teszt
		//$count_service = 2;
		//$count_digital = 1;

		// * * * * Rendbeteszi a tömböt, mert meg van zavarodva valamiért * * * *
		foreach($descartes as $dkey => $descart):	
			$tmp[] = $descart;
		endforeach;
		$descartes = $tmp;
		unset($tmp);
		// * * * * /.Rendbeteszi a tömböt, mert meg van zavarodva valamiért * * * *


		foreach ($descartes as $dkey => $dvalue) {			//1. Veszünk egy tételt a descartesből
			$price = 0;
			foreach ($packages as $pkey => $pvalue) {			//Végigpörgetjük, hogy van-e az akciós csomagok között teljes egyezés
				if($dvalue['count'] == 3){
					if( in_array($dvalue['catv_prod_id'], $t_akc[ $pvalue['focikk'] ] ) && in_array($dvalue['net_prod_id'], $t_akc[ $pvalue['focikk'] ] ) && in_array($dvalue['tel_prod_id'], $t_akc[ $pvalue['focikk'] ] ) ) {
						$descartes[$dkey]['AkcName'] = $pvalue['AkcName'];
						$price += $pvalue['AkcFt3'];
						$descartes[$dkey]['total'] = $price;
					}
				}

				//-- DUO csomag: TV+NET
				if($dvalue['count'] == 2 && count($t_akc[ $pvalue['focikk'] ])==2 ){
					if( (in_array($dvalue['catv_prod_id'], $t_akc[ $pvalue['focikk'] ] ) && in_array($dvalue['net_prod_id'], $t_akc[ $pvalue['focikk'] ] ))  && $dvalue['tel_prod_id']==0){
						$descartes[$dkey]['AkcName'] = $pvalue['AkcName'];
						$price += $pvalue['AkcFt2'];
						$descartes[$dkey]['total'] = $price;
					}
				}

				//-- DUO csomag: TV+TEL
				if($dvalue['count'] == 2 && count($t_akc[ $pvalue['focikk'] ])==2 ){
					if( (in_array($dvalue['catv_prod_id'], $t_akc[ $pvalue['focikk'] ] ) && in_array($dvalue['tel_prod_id'], $t_akc[ $pvalue['focikk'] ] ))  && $dvalue['net_prod_id']==0){
						$descartes[$dkey]['AkcName'] = $pvalue['AkcName'];
						$price += $pvalue['AkcFt2'];
						$descartes[$dkey]['total'] = $price;
					}
				}

				//-- DUO csomag: NET+TEL
				if($dvalue['count'] == 2 && count($t_akc[ $pvalue['focikk'] ])==2 ){
					if( (in_array($dvalue['net_prod_id'], $t_akc[ $pvalue['focikk'] ] ) && in_array($dvalue['tel_prod_id'], $t_akc[ $pvalue['focikk'] ] ))  && $dvalue['catv_prod_id']==0){
						$descartes[$dkey]['AkcName'] = $pvalue['AkcName'];
						$price += $pvalue['AkcFt2'];
						$descartes[$dkey]['total'] = $price;
					}
				}

			}
		}

		$this->html_offers = '';
		$bgcolor = 'fff';
		$package_name = '';
		$descartes = $this->My->array_msort($descartes, ['total'=>SORT_ASC]);

/*
		$this->html_offers = '';
		foreach ($descartes as $descart):
			$this->html_offers .= $descart['total'];
			$this->html_offers .= ', ';
		endforeach;

		echo $this->html_offers;
*/

		// http://cake3.loc/szla_product_descs/offers/9430
		// http://cake3.loc/szla_product_descs/offers/9295/2/2/0/371/374/0/0/0/3

		//$this->My->print_array($packages, false);	// Tömb kiiratása. Paraméterek: Tömb, die()		

		//$descartes = $this->My->array_msort($descartes, ['total'=>SORT_ASC]);

		$tmp = [];
		//$p_count = 10;
		$count = 0;
		foreach ($descartes as $descart) {
			if(isset($descart['AkcName']) && $descart['AkcName'] != '' ){
				if( $min_price < $descart['total']){
					$count++;
					if($count > $p_count){
						break;
					}
					$tmp[] = $descart;				
				}
			}
		}
		foreach ($descartes as $descart) {
			if(!isset($descart['AkcName']) || $descart['AkcName'] == '' ){
				if( $min_price < $descart['total']){
					$count++;
					if($count > $p_count){
						break;
					}
					$tmp[] = $descart;				
				}
			}
		}
		
		//$this->My->print_array($descartes, true);	// Tömb kiiratása. Paraméterek: Tömb, die()		
		
		$descartes = $tmp;
		unset($tmp);

		//$this->My->print_array($descartes, false);	// Tömb kiiratása. Paraméterek: Tömb, die()		
		$descartes = $this->My->array_msort($descartes, ['total'=>SORT_ASC]);
		
		//$this->My->print_array($descartes, true);	// Tömb kiiratása. Paraméterek: Tömb, die()		

		// ***** function offers($min_price=0,$p_catv_pos=null,$p_net_pos=null,$p_tel_pos=null,$p_catv_id=null,$p_net_id=null,$p_tel_id=null,$p_digital_ids=null,$p_digitals_price=0, $p_count=null){

		foreach ($descartes as $descart):
			
			// xxxxx
			if($descart['total'] <= $min_price){
				continue;
			};

			if(isset($descart['AkcName']) ){
				$package_name = ''.$descart['AkcName'];
			}else{
				$package_name = '';				
			}

			if($bgcolor=='fff'){
				$bgcolor = 'eee';
			}else{
				$bgcolor='fff';
			}

			$this->html_offers .= '<div class="row" style="background: #'.$bgcolor.'; padding-top: 20px;">
										<div class="col-lg-7 col-md-5 col-sm-8 col-xs-8 text-left">
											<h4 style="color: green; font-weight: bold;">'.$package_name.'</h4>
											<ul>'."\n\t\t\t\t\t\t\t\t";

			//$this->html_offers .= '<li><b>XXX: '.$min_price.' - '.$descart['total'].'</b></li>'."\n";

			if($descart['catv'] != ''){
				$this->html_offers .= '				<li><b>'.$descart['catv'].'</b>'."\n\t\t\t\t\t\t\t\t\t\t\t\t\t".'<ul style="list-style-type:none"><li><i>'.$descart['catv_content'].'</i></li></ul>'."\n\t\t\t\t\t\t\t\t\t\t\t\t".'</li>'."\n";
			}
			if($descart['net'] != ''){
				$this->html_offers .= '				<li><b>'.$descart['net'].'</b>'."\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t".'<ul style="list-style-type:none"><li><i>'.$descart['net_content'].'</i></li></ul>'."\n\t\t\t\t\t\t\t\t\t\t\t\t".'</li>'."\n";
			}
			if($descart['tel'] != ''){
				$this->html_offers .= '				<li><b>'.$descart['tel'].'</b>'."\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t".'<ul style="list-style-type:none"><li><i>'.$descart['tel_content'].'</i></li></ul>'."\n\t\t\t\t\t\t\t\t\t\t\t\t".'</li>'."\n";
			}
			$this->html_offers .= '
											</ul>
										</div>
										<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 text-center" style="border-left: 0px solid lightgray;">
											<h4><b>'.$descart['total'].' Ft</b></h4>
										</div>
										<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 text-center">
											<button type="button" onClick="javascript:interest('.$descart['catv_id'].','.$descart['net_id'].','.$descart['tel_id'].','.$descart['total'].",'".$package_name."')\"".' class="btn btn-success btn-lg interest-button"><span catv_id="'.$descart['catv_id'].'" net_id="'.$descart['net_id'].'" tel_id="'.$descart['tel_id'].'" class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;&nbsp;Érdekel</button>
										</div>
									</div>
									<div class="row" style="background: #'.$bgcolor.'; padding-top: 0px;">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
											<p>A csomag árához hozzáadódik még a választott digitális csomagok ára:
											<b><span style="font-weight: bold;" class="offer-digitals-price">'.$p_digitals_price.'</span></b>&nbsp;Ft.<br/>
											Összesen fizetendő: <span style="font-weight: bold;" class="offer-total">'.($p_digitals_price+$descart['total']).'&nbsp;Ft</span></p>
										</div>
									</div>';
		endforeach;		

		$this->autoRender = false;
		return;

	} /*
################################################################################################################################################
################################################################################################################################################
################################################################################################################################################
*/



/*
################################################################################################################################################
									 █████       ██     █████    ██      ██	
									█     █            █     █     ██  ██ 	
									█     █      ██    █     █       ██    	
									███████      ██    ███████       ██  	
									█     █  █   ██    █     █     ██  ██
									█     █  █████     █     █   ██      ██	
									   A-J-A-X  --  getIndividualPackage
################################################################################################################################################
*/	public function getIndividualPackage(){
		if ($this->request->is(['post', 'ajax'])) {
			Configure::write('debug', 0); //it will avoid any extra output
			$this->response->disableCache();
			$teszt 				 = ""; //------------------- TESZT VÁLTOZÓ -------------------------
			$conn = ConnectionManager::get('winszla_web');
			$total_price 		 = 0;
			$total_price_service = 0;
			$total_price_digi 	 = 0;
			$this->autoRender = false;
			$data = $this->request->input('json_decode');				//Adatok az AJAX-ból
			$html_tv 		= "";	$count_tv 		= 0;
			$html_net 		= "";	$count_net 		= 0;
			$html_tel		= "";	$count_tel 		= 0;
			$html_digi		= "";	$count_digi 	= 0;
			$html 			= "";	$count_selected = 0;
			$price 			= 0;
			$other	 		= "";
			$other_price	= 0;
			$digitals_ids	= [];
			$currentCityId 	= 0;
			$headstation_id = 0;
			if(isset($_COOKIE['currentCityId'])){
				$currentCityId  = $_COOKIE['currentCityId'];
			}
			$this->loadModel('SzlaCities');
			$city = $this->SzlaCities->get($currentCityId);
			$headstation_id = $city->headstation_id;

			//-- Szolgáltatások lekérdezése --
			$services = $this->SzlaProductDescs->find('all')
				->contain(['SzlaProducts'])
				->order(['SzlaProductDescs.id'=>'asc'])
				->where(['headstation_id'=>$headstation_id])
				->toArray()
					;

			//AKCIÓS CSOMAG ID lekérése
			$service_akcio_id = 0;
			$service_akcio_name = "";
			$service_akcios = $this->SzlaProductDescs->find('all')				
				->where(['headstation_id'=>$headstation_id, 'to_price'=>1 ])	//-- Akció a szolgáltatásokra
				->toArray()
					;
			foreach($service_akcios as $service_akcio){
				$service_akcio_id = $service_akcio->product_id;
				$service_akcio_name = $service_akcio->name;
			}

			//Telefon SOLO lekérdezése
			$telefon_solo_akcio_id = 0;
			$telefon_solo_akcio_name = "";
			$telefon_solo_akcios = $this->SzlaProductDescs->find('all')
				->where(['headstation_id'=>$headstation_id, 'to_price'=>2 ])
				->toArray()
			;
			foreach($telefon_solo_akcios as $telefon_solo_akcio){
				$telefon_solo_akcio_id = $telefon_solo_akcio->product_id;
				$telefon_solo_akcio_name = $telefon_solo_akcio->name;
			}

			//Telefon DUO lekérdezése
			$telefon_duo_akcio_id = 0;
			$telefon_duo_akcio_name = "";
			$duo_akcios = $this->SzlaProductDescs->find('all')					
				->where(['headstation_id'=>$headstation_id, 'to_price'=>3 ])
				->toArray()
					;
			foreach($duo_akcios as $duo_akcio){
				$telefon_duo_akcio_id = $duo_akcio->product_id;
				$telefon_duo_akcio_name = $duo_akcio->name;
			}


			//DUO CSOMAG lekérdezése
			$duo_csomag_akcio_id = 0;
			$duo_csomag_akcio_name = "";
			$duo_csomag_akcios = $this->SzlaProductDescs->find('all')					
				->where(['headstation_id'=>$headstation_id, 'to_price'=>4 ])
				->toArray()
					;
			foreach($duo_csomag_akcios as $duo_csomag_akcio){
				$duo_csomag_akcio_id = $duo_csomag_akcio->product_id;
				$duo_csomag_akcio_name = $duo_csomag_akcio->name;
			}


			//MINI KOMBO lekérdezése
			$mini_kombo_id = 0;
			$mini_kombo_name = "";
			$mini_kombos = $this->SzlaProductDescs->find('all')					
				->where(['headstation_id'=>$headstation_id, 'to_price'=>5 ])
				->toArray()
					;
			foreach($mini_kombos as $mini_kombo){
				$mini_kombo_id 		= $mini_kombo->product_id;
				$mini_kombo_name 	= $mini_kombo->name;
			}

			//CSALÁDI KOMBO lekérdezése
			$csaladi_kombo_id = 0;
			$csaladi_kombo_name = "";
			$csaladi_kombos = $this->SzlaProductDescs->find('all')					
				->where(['headstation_id'=>$headstation_id, 'to_price'=>6 ])
				->toArray()
					;
			foreach($csaladi_kombos as $csaladi_kombo){
				$csaladi_kombo_id = $csaladi_kombo->product_id;
				$csaladi_kombo_name = $csaladi_kombo->name;
			}

			//MAXI KOMBO lekérdezése
			$maxi_kombo_id = 0;
			$maxi_kombo_name = "";
			$maxi_kombos = $this->SzlaProductDescs->find('all')					
				->where(['headstation_id'=>$headstation_id, 'to_price'=>7 ])
				->toArray()
					;
			foreach($maxi_kombos as $maxi_kombo){
				$maxi_kombo_id = $maxi_kombo->product_id;
				$maxi_kombo_name = $maxi_kombo->name;
			}

			//Digi akciós csomag lekérése
			$digi_akcio_id = 0;
			$digi_akcio_name = "";
			$digi_akcios = $this->SzlaProductDescs->find('all')					
				->where(['headstation_id'=>$headstation_id, 'to_price'=>9 ])
				->toArray()
					;
			foreach($digi_akcios as $digi_akcio){
				$digi_akcio_id = $digi_akcio->product_id;
				$digi_akcio_name = $digi_akcio->name;
			}

			//Melyik kapcsoló lett kiválasztva és csak azoknak az ID-nek a tömbjét hozza létre...
			$selected_ids = [];			
			foreach ($data as $id => $selected) {
				if( $selected==1 ){
					$selected_ids[] = $id;
				}
			}
			//-- Eddig ok


			//===================== ÁR KISZÁMÍTÁSA ===========================
			$catv_id=0; $net_id=0; $tel_id=0;	//Plusz a kiválasztott termék ID-k megadása majd naplózása lejjebb
			$catv_pos=0; $net_pos=0; $tel_pos=0;
			$desc_catv_id=0; $desc_net_id=0; $desc_tel_id=0;
			//Melyikből hány kapcsoló van bejelölve
			foreach ($services as $service):
				if( in_array( $service->id, $selected_ids ) ){
					if($service->szla_product->csoport == 1 ){
						$count_tv++;
						$catv_id = $service->product_id;
						$catv_pos = $service->pos;
						$desc_catv_id=$service->id;
					}
					if($service->szla_product->csoport == 2 ){
						$count_net++;
						$net_id = $service->product_id;
						$net_pos = $service->pos;

					$desc_net_id=$service->id;

					$service->product_id;
						$min_price>pos;
						$desc_tel_id=$service->id;
					}
					if($service->szla_product->csoport == 9 ){
						$count_digi++;
					}
				}
			endforeach;
			$count_selected = $count_tv + $count_net + $count_tel;

			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			//---- Ez a rész utólag került a kódba, hogy ha van NET TV nélkül, akkor a "net_without_tv_id"-ben lévő ID mondja meg, hogy az árat hogyan is kell(ene) kiszámolni...
			$new_teszt = "NEM talált";
			if($count_tv==0 && $count_net > 0){	//Ha csak NET-et választott, akkor a TV nélküli áttal számoljon
				$old_net_id 		= $net_id;
				$old_desc_net_id 	= $desc_net_id;
				foreach ($services as $service):	// --- net_without_tv_id ---
					if( in_array( $service->net_without_tv_id, $selected_ids ) ){
						if($service->szla_product->csoport == 2 ){
							$net_id 	 = $service->product_id;
							$desc_net_id = $service->id;
							$new_teszt = "Megtalálta: ".$desc_net_id." - ".$net_id." - ".$service->szla_product->ft;
							break;
						}
					}
				endforeach;
				$new_teszt = $desc_net_id." :: ".$net_id." :: " ;
				foreach ($selected_ids as $key => $value) {
					$new_teszt .= $value.", ";
					if($value == $old_desc_net_id){
						$selected_ids[$key] = $desc_net_id;
						$new_teszt = $selected_ids[$key];
						break;
					}
				}
			}
			//---- /.Ez a rész utólag került a kódba, hogy ha van NET TV nélkül, akkor a "net_without_tv_id"-ben lévő ID mondja meg, hogy az árat hogyan is kell(ene) kiszámolni...
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################
			##################################################################################################

			//---------------- LEKÉRÉS NAPLÓZÁSA: - id-k az előző ciklusban kapnak értéket -------------------------------
			$this->loadModel('Populars');
			$popularsTable = TableRegistry::get('Populars');
			$popular = $popularsTable->newEntity();
			$popular->catv 	= $catv_id;
			$popular->net 	= $net_id;
			$popular->tel 	= $tel_id;
			$popular->cookie_id = $_COOKIE['cookieId'];
			$popularsTable->save($popular);
			//---------------- /.LEKÉRÉS NAPLÓZÁSA -------------------------------

			foreach ($services as $service) {
				if( in_array( $service->id, $selected_ids ) ){
					$found = false;
					$result = $conn->execute(
					   'SELECT cikk.id AS CikkId, cikk.ft+akc.akcios_kedv AS AkcFt1, cikk.ft+akc.duo_kedv AS AkcFt2, cikk.ft+akc.trio_kedv AS AkcFt3
						FROM akcios AS akc
							LEFT JOIN products AS cikk ON cikk.id = akc.cikk
						WHERE 
							akc.focikk = :akcio_id AND akc.cikk = :product_id
						',
						['akcio_id'=>$service_akcio_id, 'product_id'=>$service->product_id]
					);	//execute

					foreach ($result as $row) {
						if( $count_selected>3 ){	//Ezekkel van megcímezve a megfelelő ár oszlop
							$count_selected = 3;	//Max 3
						}
						if($count_digi>3){
							$count_digi = 3;	//Max 3
						}
						if($service->szla_product->csoport == 1 ){
							//$html_tv 	= "<li>".$service->name." ".$row['AkcFt'.$count_selected]."</li>\n";
							$html_tv 	= "<li>".$service->name."</li>\n";
							$total_price_service += $row['AkcFt'.$count_selected];
						}
						if($service->szla_product->csoport == 2 ){
							//$html_net 	= "<li>".$service->name." ".$row['AkcFt'.$count_selected].' / '.$count_selected."</li>\n";
							//$html_net 	= "<li>".$service->name." ".$row['AkcFt'.$count_selected].' / '.$count_selected.' / '.$row['CikkId']."</li>\n";
							$html_net 	= "<li>".$service->name."</li>\n";
							$total_price_service += $row['AkcFt'.$count_selected];
						}
						if($service->szla_product->csoport == 4 ){
							//$html_tel	= "<li>".$service->name." ".$row['AkcFt'.$count_selected]."</li>\n";
							$html_tel	= "<li>".$service->name."</li>\n";
							$total_price_service += $row['AkcFt'.$count_selected];
						}
						$found = true;
					}


if(!$found){
					//----- DIGI - 9 ----------
					$result = $conn->execute(
					   'SELECT
							cikk.id AS CikkId, cikk.ft+akc.akcios_kedv AS AkcFt1, cikk.ft+akc.duo_kedv AS AkcFt2, cikk.ft+akc.trio_kedv AS AkcFt3
						FROM akcios AS akc
							LEFT JOIN products AS cikk ON cikk.id = akc.cikk
						WHERE 
							akc.focikk = :akcio_id AND akc.cikk = :product_id
						',
						['akcio_id'=>$digi_akcio_id, 'product_id'=>$service->product_id]
					);	//execute

					foreach ($result as $row) {
						if($count_digi>3){
							$count_digi = 3;	//Max 3
						}
						if($service->szla_product->csoport == 9 ){
							//$html_digi	.= "<li>".$service->name." ".($row['AkcFt'.$count_digi]+$service->licenc_price)."</li>\n";
							$html_digi	.= "<li>".$service->name."</li>\n";
							$total_price_digi += ($row['AkcFt'.$count_digi]+$service->licenc_price);
							$digitals_ids[] = $service->id;
						}
						$found = true;
					}	// foreach(row)
					//----- /. DIGI - 9 ----------
}


// Telefon solo, duo, lebeszélhető 1000 és 1200 lekérdezés miatt
if(!$found){
					$result = $conn->execute(
						'SELECT DISTINCT descs.product_id AS CikkId, products.ft AS ProdFt, 
							products.ft+akcios.akcios_kedv AS AkcFt1, products.ft+akcios.duo_kedv AS AkcFt2, products.ft+akcios.trio_kedv AS AkcFt3
						FROM products
							LEFT JOIN akcios ON products.id = akcios.cikk
							LEFT JOIN products akc ON akc.id = akcios.focikk
							LEFT JOIN product_descs descs ON descs.product_id = products.id
							LEFT JOIN product_descs akcdescs ON akcdescs.product_id = akcios.focikk
							where products.id=:product_id AND descs.headstation_id=:headstation_id AND (akcdescs.headstation_id=:headstation_id or akcdescs.headstation_id is null)
						',
						['product_id'=>$service->product_id, 'headstation_id'=>$service->headstation_id]
					);	//execute

					foreach ($result as $row) {
						if($service->szla_product->csoport == 4 ){
							//$html_tel	= "<li>".$service->name." ".$row['ProdFt']."</li>\n";
							$html_tel	= "<li>".$service->name."</li>\n";
							$total_price_service += $row['ProdFt'];
						}
						$found = true;
					}
}
// /.Telefon solo, duo lekérdezés miatt


				}	// /.if( in_array( $service->id, $selected_ids ) )
			} // /.foreach ($services as $service)


			//================ CSOMAGOK SZERINTI LEKÉRDEZÉS =================

			//Egyéb csomagok lekérdezése, hátha bennük van

//████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
//████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
//████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████
//████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████

			//--------------------------------------- Duó csomag ---------------------------------------------------------
			$found = false;
			$name = "";
			$ids = "";
			$count = 0;
			foreach ($services as $service):
				if( in_array( $service->id, $selected_ids ) ){
					if($service->szla_product->csoport <= 4 ){	//KTV, Net, Telefon és nincs benne a csomag és a Digitális...
						$ids .= $service->product_id.",";
						$name = $service->name;
						$count++;
					}
				}		
			endforeach;
			$ids = substr($ids, 0, -1); //Utolsó "," levágása
			if($count>3){	//Max 3!
				$count=3;
			}
			$sql = 'SELECT
					akc.focikk AS FoCikkId, akc.cikk AS CikkId,
					cikk.ft+akc.akcios_kedv AS AkcFt1, cikk.ft+akc.duo_kedv AS AkcFt2, cikk.ft+akc.trio_kedv AS AkcFt3
				FROM akcios AS akc
					LEFT JOIN products AS cikk ON cikk.id = akc.cikk
				WHERE 
					akc.focikk = '.$duo_csomag_akcio_id.' AND akc.cikk IN ('.$ids.')';

			$duo_csomag_akcios = $conn->execute( $sql );	//execute
			$post_count = 0;
			$other_price = 0;
			foreach ($duo_csomag_akcios as $duo_csomag_akcio) {
				$other_price += $duo_csomag_akcio['AkcFt'.$count];
				//$other .= '<li>DUO Csomag - '.$duo_csomag_akcio['AkcFt'.$count].'</li>';
				$post_count++;
			}
			if($count == $post_count && $count == 2){
				$other .= '<li>'.$duo_csomag_akcio_name.'</li>';
				$package_name = $duo_csomag_akcio_name;
				$found = true;
			}

			//--------------------------------------- MINI KOMBO csomag ---------------------------------------------------------
if(!$found){
			$ids = "";
			$count = 0;
			foreach ($services as $service):
				if( in_array( $service->id, $selected_ids ) ){
					if($service->szla_product->csoport <= 4 ){	//KTV, Net, Telefon és nincs benne a csomag és a Digitális...
						$ids .= $service->product_id.",";
						$name = $service->name;
						$count++;
					}
				}		
			endforeach;
			$ids = substr($ids, 0, -1); //Utolsó "," levágása
			if($count>3){	//Max 3!
				$count=3;
			}
			$sql = 'SELECT
					akc.focikk AS FoCikkId, akc.cikk AS CikkId,
					cikk.ft+akc.akcios_kedv AS AkcFt1, cikk.ft+akc.duo_kedv AS AkcFt2, cikk.ft+akc.trio_kedv AS AkcFt3
				FROM akcios AS akc
					LEFT JOIN products AS cikk ON cikk.id = akc.cikk
				WHERE 
					akc.focikk = '.$mini_kombo_id.' AND akc.cikk IN ('.$ids.')';

			$mini_kombos = $conn->execute( $sql );	//execute
			$post_count = 0;
			$other_price = 0;
			foreach ($mini_kombos as $mini_kombo) {
				$other_price += $mini_kombo['AkcFt'.$count];
				$post_count++;
			}
			if($count == $post_count && $count == 3){
				$other .= '<li>'.$mini_kombo_name.'</li>';
				$package_name = $mini_kombo_name;
				$found = true;
			}
}
			//--------------------------------------- CSALÁDI KOMBO csomag ---------------------------------------------------------
if(!$found){
			$ids = "";
			$count = 0;
			foreach ($services as $service):
				if( in_array( $service->id, $selected_ids ) ){
					if($service->szla_product->csoport <= 4 ){	//KTV, Net, Telefon és nincs benne a csomag és a Digitális...
						$ids .= $service->product_id.",";
						$name = $service->name;
						$count++;
					}
				}		
			endforeach;
			$ids = substr($ids, 0, -1); //Utolsó "," levágása
			if($count>3){	//Max 3!
				$count=3;
			}
			$sql = 'SELECT
					akc.focikk AS FoCikkId, akc.cikk AS CikkId,
					cikk.ft+akc.akcios_kedv AS AkcFt1, cikk.ft+akc.duo_kedv AS AkcFt2, cikk.ft+akc.trio_kedv AS AkcFt3
				FROM akcios AS akc
					LEFT JOIN products AS cikk ON cikk.id = akc.cikk
				WHERE 
					akc.focikk = '.$csaladi_kombo_id.' AND akc.cikk IN ('.$ids.')';

			$csaladi_kombos = $conn->execute( $sql );	//execute
			$post_count = 0;
			$other_price = 0;
			foreach ($csaladi_kombos as $csaladi_kombo) {
				$other_price += $csaladi_kombo['AkcFt'.$count];
				//$other .= '<li>Családi: - '.$maxi_kombo['AkcFt'.$count].'</li>';
				$post_count++;
			}
			if($count == $post_count && $count == 3){
				$other .= '<li>'.$csaladi_kombo_name.'</li>';
				$package_name = $csaladi_kombo_name;
				$found = true;
			}
}

			//--------------------------------------- MAXI KOMBO csomag ---------------------------------------------------------
if(!$found){
			$ids = "";
			$count = 0;
			foreach ($services as $service):
				if( in_array( $service->id, $selected_ids ) ){
					if($service->szla_product->csoport <= 4 ){	//KTV, Net, Telefon és nincs benne a csomag és a Digitális...
						$ids .= $service->product_id.",";
						$name = $service->name;
						$count++;
					}
				}		
			endforeach;
			$ids = substr($ids, 0, -1); //Utolsó "," levágása
			if($count>3){	//Max 3!
				$count=3;
			}
			$sql = 'SELECT
					akc.focikk AS FoCikkId, akc.cikk AS CikkId,
					cikk.ft+akc.akcios_kedv AS AkcFt1, cikk.ft+akc.duo_kedv AS AkcFt2, cikk.ft+akc.trio_kedv AS AkcFt3
				FROM akcios AS akc
					LEFT JOIN products AS cikk ON cikk.id = akc.cikk
				WHERE 
					akc.focikk = '.$maxi_kombo_id.' AND akc.cikk IN ('.$ids.')';

			$maxi_kombos = $conn->execute( $sql );	//execute
			$post_count = 0;
			$other_price = 0;
			foreach ($maxi_kombos as $maxi_kombo) {
				$other_price += $maxi_kombo['AkcFt'.$count];
				//$other .= '<li>Maxi: - '.$maxi_kombo['AkcFt'.$count].'</li>';
				$post_count++;
			}
			if($count == $post_count && $count == 3){
				$other .= '<li>'.$maxi_kombo_name.'</li>';
				$package_name = $maxi_kombo_name;
				$found = true;
			}
}

			$teszt = $sql;
			//$other = '<li>'.$name.' - <b>'.$other_price.'</b> Ft</li>';

			$teszt = "Nincs csomag";
			if($found){
				$teszt = "Van csomag";
			}

			//--------------------- Csomagok szerinti lekérdezés ------------------------

			$html = $html_tv . $html_net . $html_tel;

			//$price = $total_price_service;	//TESZT
			
			//$price = "Found:<br>".$teszt;
			//===================== /.ÁR KISZÁMÍTÁSA ===========================

			$products_price	= $total_price_service;
			$digitals_list	= $html_digi;
			$digitals_price	= $total_price_digi;
			$products_list	= $html;
			$total_price = $total_price_service + $total_price_digi;
			if($found){
				$products_list	= $other;
				$products_price	= $other_price;
				$total_price = $other_price + $total_price_digi;
			}

			//Ez a $this->html_offers változó értékét feltölti HTML sjánló listával...,
			// a Fenti fg() meghívása: public function offers($min_price=0,$p_catv_pos=null,$p_net_pos=null,$p_tel_pos=null,$p_catv_id=null,$p_net_id=null,$p_tel_id=null,$p_digital_ids=null,$p_digitals_price=0, $p_count=null){
			$this->offers($products_price, $catv_pos, $net_pos, $tel_pos, $catv_id, $net_id, $tel_id, $digitals_ids, $digitals_price, 3 );

			//$offersArray = [$products_price, $catv_pos, $net_pos, $tel_pos, $catv_id, $net_id, $tel_id, $digitals_ids, $digitals_price, 3];

			$mainInterestButton = '<button id="mainOrder" '.
					'onClick="javascript:interest('
					.$desc_catv_id.','
					.$desc_net_id.','
					.$desc_tel_id.','
					.$products_price.",'".$package_name."')\""
					." type='button' class='btn btn-success btn-lg'>"
					."<span class='glyphicon glyphicon-shopping-cart'></span>"
					.'&nbsp;&nbsp;&nbsp;Érdekel'
					.'</button>'
					;

/*
			$package_name = $new_teszt;
			$products_list = "<li>".$new_teszt."</li>";
			$package_name = "asasa";
			$found = true;
*/
			$response = [
				'mainInterestButton' 	=> $mainInterestButton,
				'productslist' 			=> $products_list,		//'productslist' 	=> $products_list.'<li>'.$count_net.'</li>',
				'productsprice' 		=> $products_price,
				'digitalslist'			=> $digitals_list,
				'digitalsprice' 		=> $digitals_price,
				'htmloffers' 			=> $this->html_offers,
				'totalprice'			=> $total_price,
				'found' 				=> $found,
				'packagename' 			=> $package_name,
				'offersArray' 			=> $offersArray
			];

			$this->response->body(json_encode($response));
			return $this->response;
		}else{
			$this->redirect('/');
		}

	} /*
################################################################################################################################################
								  ██	 █████       ██     █████    ██      ██	
								██ 		█     █            █     █     ██  ██ 	
							  ██		█     █      ██    █     █       ██    	
							██			███████      ██    ███████       ██  	
						  ██ 			█     █  █   ██    █     █     ██  ██
						██   			█     █  █████     █     █   ██      ██	
									   /.A-J-A-X  --  getIndividualPackage
################################################################################################################################################
*/


/*
################################################################################################################################################
													INDIVIDUAL_PACKAGE
################################################################################################################################################
*/	public function individualPackage( $akcio_id=Null, $niceURI=Null ) {
		$this->set('title', 'Egyéni csomag összeállítás');
		$this->loadModel('SzlaProductDepends');
		$headstation_id = 0;

		$conn = ConnectionManager::get('winszla_web');
		if($this->request->here != "/csomag-osszeallitas.html"){
			$this->redirect("/");
		}
		$szlaProductDesc = $this->SzlaProductDescs->newEntity();	//Combo-hoz kell
		$selectedCity = Null;
		$currentCityId 	= 72;  //Babarc - Null;
		if(isset($_COOKIE['currentCityId'])){
			$currentCityId  = $_COOKIE['currentCityId'];
		}
		$currentCity 	= Null;
		$services 		= [];

		//$this->loadModel('NaSubscribers');
		//$this->loadModel('NaDhcpLeasesLast');
		$this->loadModel('SzlaCities');
		$cities = $this->SzlaCities->find('list')->select(['id','name'])->order(['name'=>'asc'])->where(['headstation_id >'=>0])->toArray();
		if( isset($currentCityId) && $currentCityId>0 ){   //Szándékosan nem else ág!
			$selectedCity = $this->SzlaCities->find()->select(['id','name','headstation_id'])->where(['id'=>$currentCityId, 'headstation_id >'=>0])->first();
			if(isset($selectedCity->id)){  //Ha van ilyen település (hátha valaki próbálkozik az ID-vel)
				$currentCityId  = $selectedCity->id;
				$currentCity    = $selectedCity->name;
			}
		}

		//----------------------------- KábelTV, Internet, Telefon lekérdezése --------------------------------
		//----------------------- Szolgáltatások lekérdezése és kiiratása ---------------------

		$services = $this->SzlaProductDescs->find('all')
					->contain(['SzlaProducts'])
					//->select(['id','headstation_id','servicegroup','pos','product_id','name','contents','description','type'])
					->order(['headstation_id'=>'asc', 'servicegroup'=>'asc', 'pos'=>'asc'])
					->where(['headstation_id'=>$selectedCity->headstation_id, 'individual'=>1 ])
					->toArray()
					;

		$packages=[];
		foreach ($services as $service) :

			//Az adott termék, mely csomagokban érhető még el és mennyiért
			$result = $conn->execute(
			   'SELECT DISTINCT akc.nev AS AkcName,
					akcdescs.variable AS Variable,
					descs.id AS DescId, products.csoport AS DescGroup, products.id AS ProdId, akc.id AS AkcId, descs.name AS DescName, descs.product_id AS DescProdId, products.nev AS ProdName, products.ft AS ProdFt,
					products.ft+akcios.akcios_kedv AS AkcKedv, products.ft+akcios.duo_kedv AS DuoKedv, products.ft+akcios.trio_kedv AS TrioKedv,
					descs.headstation_id AS HeadstationId
				FROM products
					LEFT JOIN akcios ON products.id = akcios.cikk
					LEFT JOIN products akc ON akc.id = akcios.focikk
					LEFT JOIN product_descs descs ON descs.product_id = products.id
					LEFT JOIN product_descs akcdescs ON akcdescs.product_id = akcios.cikk 	-- focikk volt itt
				WHERE products.id=:product_id 
					AND descs.headstation_id=:headstation_id 
					AND (akcdescs.headstation_id=:headstation_id OR akcdescs.headstation_id IS NULL)
				',
				['product_id'=>$service->product_id, 'headstation_id'=>$service->headstation_id]
			);	//execute
			// -- AND akcdescs.variable = 0

			$headstation_id = $service->headstation_id;
			//foreach ($result as $row) {
			//	debug($row);
			//}
			//die();

			foreach ($result as $row) {
				$r = $service->product_id;
				$packages[$r][] = [
					'DescId' 	 		=> $row['DescId'],
					'Variable' 	 		=> $row['Variable'],
					'DescGroup' 	 	=> $row['DescGroup'],
					'HeadstationId' 	=> $row['HeadstationId'],
					'ProdId' 	 		=> $row['ProdId'],
					'DescProdId' 		=> $row['DescProdId'],
					'AkcId' 			=> $row['AkcId'],
					'DescName' 	 		=> $row['DescName'],
					'ProdName' 	 		=> $row['ProdName'],
					'AkcName' 	 		=> $row['AkcName'],
					'ProdFt' 	 		=> $row['ProdFt'],
					'AkcKedv' 	 		=> $row['AkcKedv'],
					'DuoKedv' 	 		=> $row['DuoKedv'],
					'TrioKedv' 	 		=> $row['TrioKedv'],
				];
			}	//kis foreach, tömb feltöltés

			//if($packages[$service->product_id][0]['DescGroup']==2){
				//echo '<h2 align="center">'.$service->name."</h2>";
				//debug($packages[$service->product_id]);
			//}
			//die();

		endforeach;	//services foreach, descs bejárása




		//----------------------------- /.KábelTV, Internet, Telefon lekérdezése --------------------------------

		//----------------------------- Függések ----------------------------------------
		$depends = $this->SzlaProductDepends->find('all', ['conditions'=>['SzlaProductDepends.headstation_id'=>$selectedCity->headstation_id]]);

		//----------------------------- /.Függések ----------------------------------------



		//----------------------------- CÍM beállítása ----------------------------------------
		switch( $niceURI ){
			case "csomagok.html";
				$this->set('title', 'Elérhető csomagjaink '.$currentCity.' településen');
				break;
			case "kabeltv.html";
				$this->set('title', 'Elérhető kábel TV szolgáltatásaink '.$currentCity.' településen');
				break;
			case "internet.html";
				$this->set('title', 'Elérhető Internet szolgáltatásaink '.$currentCity.' településen');
				break;
			case "telefon.html";
				$this->set('title', 'Elérhető telefon szolgáltatásaink '.$currentCity.' településen');
				break;
		}	//switch


		$this->set(compact('szlaProductDesc', 'currentCity', 'currentCityId', 'cities','services','packages', 'depends','headstation_id'));
		$this->set('_serialize', ['szlaProductDesc']);
		$this->set('niceURI',$niceURI);

	} /*
################################################################################################################################################
													INDIVIDUAL_PACKAGE
################################################################################################################################################
*/

/*
################################################################################################################################################
													SHOW_PACKAGE
################################################################################################################################################
*//*	public function show_package( $akcio_id=Null, $niceURI=Null ) {
		if($niceURI != 'csomag-tartalma.html'){	//Ha valaki hackelne pl....
			$this->redirect('/');
		}
		$conn = ConnectionManager::get('winszla_web');

		$package = $conn->execute(
			'SELECT descs.id AS DescId, descs.headstation_id AS DescHeadstationId, descs.name AS DescName, products.id AS ProdId, products.nev AS ProdName, akc.nev AS AkcName, products.ft AS ProdFt, products.ft+akcios.akcios_kedv AS AkcKedv, products.ft+akcios.duo_kedv AS DuoKedv, products.ft+akcios.trio_kedv AS TrioKedv
			FROM products
				LEFT JOIN akcios ON products.id = akcios.cikk
				LEFT JOIN products akc ON akc.id = akcios.focikk
				LEFT JOIN product_descs descs ON descs.product_id = products.id
			WHERE akcios.focikk=:akcio_id
			',
			['akcio_id'=>$akcio_id]
		);	//execute
 //AND descs.headstation_id = 1
		foreach ($package as $p) {
			$item = $p;
			break;
		}

		$headstation_id = 1;
		$currentCityId = $_COOKIE['currentCityId'];
		if(isset($currentCityId) && $currentCityId>0){
			$this->loadModel('SzlaCities');
			$city = $this->SzlaCities->get($currentCityId);
			//debug($city->headstation_id);
			$this->set('city_name', $city->name);
			$this->set('headstation_id', $city->headstation_id);
		}else{
			$this->set('city_name', '');
			$this->set('headstation_id', 0);
		}
		$package_name = $item['AkcName'];
		$this->set('title', ''.$package_name.' csomag');

		$this->set(compact('szlaProductDesc', 'currentCity', 'currentCityId', 'cities', 'package'));
		$this->set('_serialize', ['szlaProductDesc']);
		$this->set('niceURI',$niceURI);
	}
*//*
################################################################################################################################################
													/.SHOW_PACKAGE
################################################################################################################################################
*/




/*
#######################################################################################################################################
									SHOW_SERVICES - CSOMAGOK/TERMÉKEK LEKÉRDEZÉSE KIIRATÁSA
#######################################################################################################################################
*/	public function showServices( $city_id=Null, $niceURI=Null ) {
		$conn = ConnectionManager::get('winszla_web');
		if(isset($niceURI) && !($niceURI=="csomagok.html" || $niceURI=="kabeltv.html" || $niceURI=="internet.html" || $niceURI=="telefon.html")){	//Ide jön még
			$this->redirect("/");
		}
		$szlaProductDesc = $this->SzlaProductDescs->newEntity();	//Combo-hoz kell
		$currentCityId 	= 0;
		$currentCity 	= Null;
		$services 		= [];


		//$this->loadModel('NaSubscribers');
		//$this->loadModel('NaDhcpLeasesLast');
		$this->loadModel('SzlaCities');
		$cities = $this->SzlaCities->find('list')->select(['id','name','headstation_id'])->order(['name'=>'asc'])->where(['headstation_id >'=>0])->toArray();
		if( isset($city_id) && $city_id>0 ){   //Szándékosan nem else ág!
			$selectedCity = $this->SzlaCities->find()->select(['id','name','headstation_id'])->where(['id'=>$city_id, 'headstation_id >'=>0])->first();
			if(isset($selectedCity->id)){  //Ha van ilyen település (hátha valaki próbálkozik az ID-vel)
				$currentCityId  = $selectedCity->id;
				$currentCity    = $selectedCity->name;
				$headstation_id = $selectedCity->headstation_id;
			}
		}

		//----------------------------- KábelTV, Internet lekérdezése --------------------------------
		if($niceURI == 'kabeltv.html' || $niceURI == 'internet.html'){
			//----------------------- Szolgáltatások lekérdezése és kiiratása ---------------------
			if(isset($selectedCity->id)){  //Ha van ilyen település (hátha valaki próbálkozik az ID-vel)
				$services = $this->SzlaProductDescs->find('all')
							->contain(['SzlaProducts'])
							//->select(['id','headstation_id','servicegroup','pos','product_id','name','contents','description','type'])
							->order(['headstation_id'=>'asc', 'servicegroup'=>'asc', 'pos'=>'asc'])
							->where(['headstation_id'=>$selectedCity->headstation_id, 'visible'=>1 ])
							->toArray()
							;

				$price 		=[];
				$digiprice	=[];
				$packages 	= [];
				foreach ($services as $service) :

					//Ár lekérdezése
					$result = $conn->execute(
					   'SELECT
							descs.name AS DescName, cikk.ft+akc.akcios_kedv AS AkcFt1, descs.licenc_price AS LicencPrice
						FROM akcios AS akc
							LEFT JOIN products AS cikk ON cikk.id = akc.cikk
							LEFT JOIN products AS focikk ON focikk.id = akc.focikk
							LEFT JOIN product_descs AS descs ON descs.product_id = akc.focikk
						WHERE 
							cikk.id = :product_id
							AND descs.headstation_id = :headstation_id
							AND descs.to_price = 1
						',
						['product_id'=>$service->product_id, 'headstation_id'=>$service->headstation_id]
					);	//execute
					//debug( $service );


					foreach ($result as $row) {
						$r = $service->product_id;
						$price[$r][] = [
							'AkcFt1' 	 	=> $row['AkcFt1'],
							'LicencPrice' 	=> $row['LicencPrice'],
						];
					}	//kis foreach, tömb feltöltés


					//--- DIGItális csomagok árának lekérdezése, mert ez nem fejálomásfüggő ---
					//Digi akciós csomag lekérése
					$digi_akcios = $this->SzlaProductDescs->find('all')					
						->where(['headstation_id'=>$headstation_id, 'to_price'=>9 ])
						->toArray()
							;
					$digi_akcio_id = null;
					foreach($digi_akcios as $digi_akcio){
						$digi_akcio_id = $digi_akcio->product_id;
					}

					if(isset($digi_akcio_id) && $digi_akcio_id != 0){
						$result = $conn->execute(
						   'SELECT cikk.ft+akc.akcios_kedv AS AkcFt1
							FROM akcios AS akc
								LEFT JOIN products AS cikk ON cikk.id = akc.cikk
							WHERE 
								akc.focikk = :akcio_id AND akc.cikk = :product_id
							',
							['akcio_id'=>$digi_akcio_id, 'product_id'=>$service->product_id]
						);	//execute

						foreach ($result as $row) {
							$r = $service->product_id;
							$digiprice[$r][] = [
								'AkcFt1' 	 	=> $row['AkcFt1'],
								'LicencPrice' 	=> $service->licenc_price,
							];
						}	//kis foreach, tömb feltöltés
					}	//if isset

					//Az adott termék, mely csomagokban érhető még el és mennyiért
					$result = $conn->execute(
					   'SELECT descs.id AS DescId, descs.name AS DescName
						FROM akcios AS akc
							LEFT JOIN products AS cikk ON cikk.id = akc.cikk
							LEFT JOIN products AS focikk ON focikk.id = akc.focikk
							LEFT JOIN product_descs AS descs ON descs.product_id = akc.focikk
						WHERE 
							cikk.id = :product_id
							AND descs.headstation_id = :headstation_id
							AND (descs.to_price is null OR descs.to_price=0)						    
						ORDER BY
							cikk.id ASC
						',
						['product_id'=>$service->product_id, 'headstation_id'=>$service->headstation_id]
					);	//execute

					foreach ($result as $row) {
						$packages[$service->product_id][] = [
							'DescId' 	 	=> $row['DescId'],
							'DescName' 	 	=> $row['DescName']
						];
					}	//kis foreach, tömb feltöltés

				endforeach;	//services foreach, descs bejárása

			} //if(isset($selectedCity->id)){  //Ha van ilyen település (hátha valaki próbálkozik az ID-vel)

		}	// $niceURI != 'csomagok.html'
		//----------------------------- /.KábelTV, Internet lekérdezése --------------------------------


		//███████████████████████████████████████████████████████████████████████████████████████████████████████████████████
		//----------------------------- TELEFON lekérdezése -----------------------------------------------------------------
		//███████████████████████████████████████████████████████████████████████████████████████████████████████████████████
		if($niceURI == 'telefon.html'){
			//----------------------- Szolgáltatások lekérdezése és kiiratása ---------------------
			if(isset($selectedCity->id)){  //Ha van ilyen település (hátha valaki próbálkozik az ID-vel)
				$services = $this->SzlaProductDescs->find()
							->contain(['SzlaProducts'])
							//->select(['id','headstation_id','servicegroup','pos','product_id','name','contents','description'])
							//->order(['headstation_id'=>'asc', 'servicegroup'=>'asc', 'pos'=>'asc'])
							->order(['headstation_id'=>'asc', 'pos'=>'asc'])
							->where(['headstation_id'=>$selectedCity->headstation_id, 'visible'=>1 ])
							->toArray()
							;

				$packages=[];
				foreach ($services as $service) {

					//Az adott termék, mely csomagokban érhető még el és mennyiért
					$result = $conn->execute(
						'SELECT DISTINCT akc.nev AS AkcName, descs.id AS DescId, products.csoport AS DescGroup, products.id AS ProdId, akc.id AS AkcId, descs.name AS DescName, descs.product_id AS DescProdId, products.nev AS ProdName, 
							products.ft AS ProdFt, 
							products.ft+akcios.akcios_kedv AS AkcFt1, products.ft+akcios.duo_kedv AS AkcFt2, products.ft+akcios.trio_kedv AS AkcFt3,
							descs.headstation_id AS HeadstationId
						FROM products
							LEFT JOIN akcios ON products.id = akcios.cikk
							LEFT JOIN products akc ON akc.id = akcios.focikk
							LEFT JOIN product_descs descs ON descs.product_id = products.id
							LEFT JOIN product_descs akcdescs ON akcdescs.product_id = akcios.focikk
							where products.id=:product_id AND descs.headstation_id=:headstation_id AND (akcdescs.headstation_id=:headstation_id or akcdescs.headstation_id is null)
						',
						['product_id'=>$service->product_id, 'headstation_id'=>$service->headstation_id]
					);	//execute

					foreach ($result as $row) {
						$r = $service->product_id;
						$packages[$r][] = [
							'HeadstationId' 	=> $row['HeadstationId'],
							'DescGroup' 	 	=> $row['DescGroup'],
							'ProdId' 	 		=> $row['ProdId'],
							'DescId' 	 		=> $row['DescId'],
							'DescProdId' 		=> $row['DescProdId'],
							'AkcId' 			=> $row['AkcId'],
							'DescName' 	 		=> $row['DescName'],
							'ProdName' 	 		=> $row['ProdName'],
							'AkcName' 	 		=> $row['AkcName'],
							'ProdFt' 	 		=> $row['ProdFt'],
							'AkcFt1' 	 		=> $row['AkcFt1'],
							'AkcFt2' 	 		=> $row['AkcFt2'],
							'AkcFt3' 	 		=> $row['AkcFt3'],
						];
					}	//kis foreach, tömb feltöltés

				}	//services foreach, descs bejárása

			} //if(isset($selectedCity->id)){  //Ha van ilyen település (hátha valaki próbálkozik az ID-vel)

		}	// $niceURI != 'csomagok.html'
		//----------------------------- /. Telefon lekérdezése --------------------------------

//die();

		//----------------------------- /.TELEFON lekérdezése ---------------------------------------------------------------
		//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■


		//███████████████████████████████████████████████████████████████████████████████████████████████████████████████████
		//----------------------------- CSOMAGOK lekérdezése ----------------------------------------------------------------
		//███████████████████████████████████████████████████████████████████████████████████████████████████████████████████
		if($niceURI == 'csomagok.html'){
			if(isset($selectedCity->id)){  //Ha van ilyen település (hátha valaki próbálkozik az ID-vel)
				$services = $this->SzlaProductDescs->find()
							->contain(['SzlaProducts'])
							//->select(['id','headstation_id','servicegroup','pos','product_id','name','contents','description'])
							//->order(['headstation_id'=>'asc', 'servicegroup'=>'asc', 'pos'=>'asc'])
							->order(['headstation_id'=>'asc', 'pos'=>'asc'])
							->where(['headstation_id'=>$selectedCity->headstation_id, 'visible'=>1 ])
							->toArray()
							;
				$packages = [];
				foreach ($services as $service) {
					if($service->szla_product->csoport == 8){
						//Az adott termék, mely csomagokban érhető még el és mennyiért
						$result = $conn->execute(
							'SELECT akcios.focikk AS AkcFoCikk, descs.id AS DescId, descs.contents AS DescContent, descs.description AS DescDescription, descs.headstation_id AS DescHeadstationId, descs.name AS DescName, products.id AS ProdId, products.nev AS ProdName, akc.nev AS AkcName, products.ft AS ProdFt,
								products.ft+akcios.akcios_kedv AS AkcFt1, products.ft+akcios.duo_kedv AS AkcFt2, products.ft+akcios.trio_kedv AS AkcFt3
							FROM products
								LEFT JOIN akcios ON products.id = akcios.cikk
								LEFT JOIN products akc ON akc.id = akcios.focikk
								LEFT JOIN product_descs descs ON descs.product_id = products.id
								-- LEFT JOIN product_descs descs ON descs.product_id = akc.cikk
							WHERE akcios.focikk=:product_id AND descs.headstation_id = :headstation_id
							',
							['product_id'=>$service->product_id, 'headstation_id'=>$headstation_id]
						);	//execute
						//foreach ($result as $res) {
							//debug($res);							
						//}
						//die();

						foreach ($result as $row) {
							$r = $service->product_id;
							$packages[$r][] = [
								'AkcFoCikk'  		=> $row['AkcFoCikk'],
								'DescHeadstationId'	=> $row['DescHeadstationId'],
								'DescId' 	 		=> $row['DescId'],
								'DescName' 	 		=> $row['DescName'],
								'DescContent' 	 	=> $row['DescContent'],
								'DescDescription'  	=> $row['DescDescription'],
								'ProdId' 	 		=> $row['ProdId'],
								'ProdName' 	 		=> $row['ProdName'],
								'AkcName' 	 		=> $row['AkcName'],
								'ProdFt' 	 		=> $row['ProdFt'],
								'AkcFt1' 	 		=> $row['AkcFt1'],
								'AkcFt2' 	 		=> $row['AkcFt2'],
								'AkcFt3' 	 		=> $row['AkcFt3'],
							];
						}	//kis foreach, tömb feltöltés
						//debug($service);
					} //if($service['servicegroup'] == 4 || $service['servicegroup'] == 7){
				} //foreach ($services as $service)
				//debug($packages);
				//die();
			} //if(isset($selectedCity->id)), ha van ilyen település. Hátha valaki próbálkozik
		} //if($niceURI == 'csomagok.html')
		//----------------------------- /.CSOMAGOK lekérdezése --------------------------------



		//----------------------------- CÍM beállítása ----------------------------------------
		switch( $niceURI ){
			case "csomagok.html";
				$this->set('title', 'Elérhető csomagjaink '.$currentCity.' településen');
				break;
			case "kabeltv.html";
				$this->set('title', 'Elérhető kábel TV szolgáltatásaink '.$currentCity.' településen');
				break;
			case "internet.html";
				$this->set('title', 'Elérhető Internet szolgáltatásaink '.$currentCity.' településen');
				break;
			case "telefon.html";
				$this->set('title', 'Elérhető telefon szolgáltatásaink '.$currentCity.' településen');
				break;
		}	//switch

		$this->set(compact('szlaProductDesc', 'currentCity', 'currentCityId', 'cities','services','price','digiprice','packages'));
		$this->set('_serialize', ['szlaProductDesc']);
		$this->set('niceURI',$niceURI);
	}
/*
#######################################################################################################################################
												 /CSOMAGOK/TERMÉKEK LEKÉRDEZÉSE KIIRATÁSA
#######################################################################################################################################
*/







	public function individualPackage2( $akcio_id=Null, $niceURI=Null ) {

	}






}
