<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\Table;
use Cake\Mailer\Email;

class NewproductsController extends AppController{
	public $title = "Kérem válasszon települést";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		//$this->Auth->allow(['index','individual']);
		$this->loadComponent('RequestHandler');
		$this->loadComponent('Captcha');
		//$this->_validViewOptions[] = 'pdfConfig';
	}


###########################################################################################################################
###########################################################################################################################
###########################################################################################################################
###########################################################################################################################

    public function sendOffer(){
		//Configure::write('debug', 0); //it will avoid any extra output
		$i = 1;
		$ok = true;
		$message = '';
		$this->autoRender = false;
        $this->response->disableCache();
        if ($this->request->is(['post', 'ajax'])) {
			//-- AJAX adatok -------------------------------------------------
			$this->autoRender = false;
            $data 			= $this->request->input('json_decode');

			$data->name 	= $this->strip_tags_content($data->name);
			$data->zip 		= $this->strip_tags_content($data->zip);
			$data->city 	= $this->strip_tags_content($data->city);
			$data->address 	= $this->strip_tags_content($data->address);
			$data->phone	= $this->strip_tags_content($data->phone);
			$data->email 	= $this->strip_tags_content($data->email);
			$data->captcha 	= $this->strip_tags_content($data->captcha);
			$data->message	= $this->strip_tags_content($data->message);	// nl2br itt most nem megy

			$error = false;

			// https://stackoverflow.com/questions/1161708/php-detect-whitespace-between-strings
			if(preg_match('/\s/',$data->name)==0){
				$error = true;
				$message .= "• A teljes nevét legyen szíves megadni!\n";
			}

			if(!preg_match("/^[a-zA-ZíÍéÉáÁűŰőŐúÚöÖüÜóÓäÄ ]*$/", $data->name)){
				$error = true;
				$message .= "• A név csak betűkből és szóközökből állhat!\n";
			}

			if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
				$error = true;
				$message .= "• Hibás Email formátum!\n";
			}else{
				$domain_name = substr(strrchr($data->email, "@"), 1);	//$domain = explode('@', $email)[1];
				if (!checkdnsrr($domain_name, 'MX')) {
					$error = true;
					$message .= "• Hibás domain név az Email címben! A '".$domain_name."' nem létezik!\n";
				}
			}

			if (!preg_match("/^[0-9]*$/", $data->zip)) {
				$error = true;
				$message .= "• Az irányítószám csak számokból állhat!\n!";
			}

			if (!preg_match("/^[a-zA-ZíÍéÉáÁűŰőŐúÚöÖüÜóÓäÄ]*$/", $data->city)) {
				$error = true;
				$message .= "• A településnév csak betűkből állhat!\n";
			}

			if (!preg_match("/^[a-zA-Z0-9íÍéÉáÁűŰőŐúÚöÖüÜóÓäÄ\,\.\/ ]*$/", $data->address)) {
				$error = true;
				$message .= "• A cím csak betűket, számokat és szóközöket tartalmazhat!\n";
			}

			if (!preg_match("/^[\+0-9]*$/", $data->phone)) {
				$error = true;
				$message .= "• A telefonszám csak számokból és + jelből állhat!\n";
			}

			if ($this->Captcha->getCaptcha()!=strtoupper($data->captcha) ){
				$error = true;
				$message .= "• Hibás biztonsági kódot adott meg. Kérem adja meg az új kódot!\n";
				$this->Captcha->generateCaptcha(8,8);	// Megváltoztatja, biztos ami biztos. JS úgy is újat kér majd.
			}

			if (!preg_match("/^[0-9\,]*$/", $data->ids)) {
				$error = true;
				$message .= "• Hibás ID-ket küldött az AJAX által! ".$data->ids."\n";
				$this->Captcha->generateCaptcha(8,8);	// Megváltoztatja, biztos ami biztos. JS úgy is újat kér majd.
			}

			if($error){
				//$message .= "\n-------------------------------------------------\n";
			}


			//---------------- ids letisztázása --------------
			$data_ids = explode(',', $data->ids);
			$data->ids = '';
			foreach($data_ids as $data_id){
				$data_id = (integer) $data_id;
				if($data_id>0 && $data_id<1000){
					$data_id = (string) $data_id;
					$data->ids .= $data_id.',';
				}
			}
			$data->ids = substr($data->ids, 0, -1);
			//-------------- /.ids letisztázása --------------

			//-------------- az IDS alapján a lekérdezés -----
			$conditions = [
				'conditions' => [
					'id IN ('.$data->ids.')'
				],
				'order' => [
					'servicegroup' => 'asc',
					'pos' => 'asc',
				]
			];
			$interest_list = $this->Newproducts->find('all', $conditions);
			//-------------- az IDS alapján a lekérdezés -----


			//-------- TESZT - Éles esetén kikapcsolni ---------
			//$error = true;
			//$message .= "\n-------------------------------------------------\n";
			//$message .= "Csomag tartalma:";
			//$message .= "\n-------------------------------------------------\n";
			//foreach($interest_list as $list){
			//	//$message .= "• ".$this->strip_tags_content($list->name)." (".$this->strip_tags_content($list->content).")"."\n";
			//	$message .= "• #".$list->id." - ".$this->strip_tags_content($list->name)."\n";
			//}
			//----- /. TESZT - Éles esetén kikapcsolni ---------

			//---------- Ha nem azokat az ID-ket adja, amik szerepelnek az adatbázisban!!, akkor hibát ad vissza -------
			if(count($interest_list->toArray()) != count(explode(',', $data->ids))){
				$error = true;
				$message .= "\n-------------------------------------------------";
				$message .= "\n- Hibás ID-ket adott meg az AJAX paraméterének! -";
				$message .= "\n-------------------------------------------------";
			}
			//-------- /.Ha nem azokat az ID-ket adja, amik szerepelnek az adatbázisban!!, akkor hibát ad vissza -------


			//------------ HIBA esetén azonnal kilép, nemm egy tovább ------------------
			if($error){
				$response = [
					'ok'		=> false,
					'message'	=> $message
				];
				$this->response->body(json_encode($response));
				return $this->response;
				die();
			}
			//------------ /.HIBA esetén azonnal kilép, nemm egy tovább ----------------



			$footer = "<p>";
			$footer .= "Üdvözlettel: <b>Sághy-Sat Kft.</b><br>";
			$footer .= "7754 Bóly, Ady E. u. 9.<br>";
			$footer .= "Tel.: <b>+36 69/368-162</b><br>";
			$footer .= "Email: <b>info@saghysat.hu</b><br>";
			$footer .= "</p>\n";




			$email = new Email('default');
			$email->transport('saghysat');
			$email->template('default', 'default');
			$email->emailFormat('html');

			//$content  = "Tisztelt <b>".$data->name."</b>!<br>\n";
			//----------------------------- Visszaigazolás -----------------------
			$content = "";
			$content .= "Tisztelt Érdeklődő!<br>\n";
			$content .= "<p>Köszönettel vettük érdeklődését szolgáltatásaink iránt.<br>";
			$content .= "A megadott elérhetőségek egyikén hamarosan megkeressük Önt és megbeszéljük a további részleteket.<br>\n";
			$content .= "</p>";

			$email->subject('Visszaigazolás a saghysat.hu weboldalról!');
			$email->from(['info@saghysat.hu' => 'Sághy-Sat Kft.']);
			$email->to($data->email);
			$customer_email = $content.$footer;
			if(!$email->send($customer_email)){
				$ok = false;
			};

			//----------------------------- Saját részre -----------------------
			$content = "";
			$content .= "<p>";
			$content .= 	"<b><u>Érdeklődő adatai:</u></b><br>";
			$content .= 	"Neve: <b>".$data->name."</b><br>";
			$content .= 	"Cím: <b>".$data->zip.' '.$data->city.', '.$data->address."</b><br>";
			$content .= 	"Telefon: <b>".$data->phone."</b><br>";
			$content .= 	"Email: <b>".$data->email."</b><br>";
			//str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"<br/>",$description);
			$content .= 	"Üzenet: <b>".nl2br($data->message)."</b><br>";
			$content .= "</p>";

			$content .= "<p><b><u>Szolgáltatások:</u></b></p>";
			$content .= '<div style="width: 600px; border: 1px solid gray; background: #eee; padding: 10px 10px 20px; margin-bottom: 15px;">';

			$total = 0;
			$group = '';
			$first = true;
			foreach($interest_list as $list){
				if($first){
					$first = false;
				}else{
					if($group!=$list->servicegroup){
						$content .= "<br>";
						$group = $list->servicegroup;
					}
				}
				$content .= "• <b>".$list->name."</b> - ".$list->price."&nbsp;Ft.<br>";
				$total = $total + $list->price;
			}

			$content .= "<hr>";
			$content .= "Összesen: <b color='green'>".$total."</b>&nbsp;Ft.<br>";

			$content .= '</div>';

			$content .= "<hr>\n";
			// https://www.w3resource.com/php-exercises/php-basic-exercise-5.php
			if (!empty($_SERVER['HTTP_CLIENT_IP'])){				//whether ip is from share internet
				$ip_address = "HTTP_CLIENT_IP: ".$_SERVER['HTTP_CLIENT_IP'];
			}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){		//whether ip is from proxy
				$ip_address = "HTTP_X_FORWARDED_FOR: ".$_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{													//whether ip is from remote address
				$ip_address = "REMOTE_ADDR: ".$_SERVER['REMOTE_ADDR'];
			}
			$content .= "<br>".$ip_address."<br>";
			$content .= "<hr>\n";


			$email->subject('Szolgáltatás érdeklődés a saghysat.hu weboldalról!');
			$email->from([$data->email => $data->name]);
			$email->to('zsolt@saghysat.hu');
			if(!$email->send($content)){
				$ok = false;
			};

			$email->subject('Szolgáltatás érdeklődés a saghysat.hu weboldalról!');
			$email->from([$data->email => $data->name]);
			$email->to('support@saghysat.hu');
			if(!$email->send($content)){
				$ok = false;
			};

			$email->subject('Szolgáltatás érdeklődés a saghysat.hu weboldalról!');
			$email->from([$data->email => $data->name]);
			$email->to('saghyt@saghysat.hu');
			if(!$email->send($content)){
				$ok = false;
			};

			// Megváltoztatja, biztos ami biztos. JS úgy is újat kér majd.
			$this->Captcha->generateCaptcha(8,8);

			$response = [
				'ok'	=> $ok,
				'message'	=> $message
			];

			$this->response->body(json_encode($response));
			return $this->response;

		}
		die();	//!
	}


###########################################################################################################################
###########################################################################################################################

	public function getNewCaptcha() {
		$this->autoRender = false;
		$captcha = $this->Captcha->generateCaptcha(3,6);
		echo $captcha;
		die();
	}

	public function strip_tags_content($string) {
		// ----- remove HTML TAGs -----
		$string = preg_replace ('/<[^>]*>/', ' ', $string);
		// ----- remove control characters -----
		$string = str_replace("\r", '', $string);
		$string = str_replace("\n", ' ', $string);
		$string = str_replace("\t", ' ', $string);
		$string = str_replace(";", ' ', $string);
		$string = str_replace("*", ' ', $string);
		$string = str_replace("%", ' ', $string);
		$string = str_replace("_", ' ', $string);
		$string = str_replace("SELECT", ' ', $string);
		$string = str_replace("DROP", ' ', $string);
		$string = str_replace("TRUNCATE", ' ', $string);
		$string = str_replace("STOP", ' ', $string);
		$string = str_replace("START", ' ', $string);
		$string = str_replace("FROM", ' ', $string);
		$string = str_replace("DELIMITER", ' ', $string);
		$string = str_replace("name", ' ', $string);
		// ----- remove multiple spaces -----
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		return $string;

		//return strip_tags($string);
		/*
		return strip_tags(preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '.', $string));
		*/
	}

###########################################################################################################################
###########################################################################################################################
###########################################################################################################################
###########################################################################################################################
    public function getChannels() {
		$this->loadModel('ChPrograms');
		$this->loadModel('ChPackages');
		$this->loadModel('ChPackagesPrograms');

		$id = 0;
		//$this->autoRender = false;
		Configure::write('debug', 0);
        $this->response->disableCache();

        if ($this->request->is(['post', 'ajax'])) {
            $data = $this->request->input('json_decode');
			$id	  = $data->id;
			$this->set('id', $id);
			$channels = [];
			$product = $this->Newproducts->get($id);
			//dump($product->headstation_id); die();
			$channels = $this->ChPackagesPrograms->find('all',[
				'contain' => ['ChPrograms', 'ChPackages'],
				//'contain' => ['ChPackages'],
				'conditions' => [
					'ChPackagesPrograms.broadcast' => 'Analóg',
					'ChPackages.packageorder <=' => $product->package_rank,
					'visible' => 1,
					'to_delete' => 0,
					'headstation_id' => $product->headstation_id,
					'ChPackagesPrograms.visible' => 1,
				],
				'order' => [
					'ChPackagesPrograms.lcn' => 'asc',
				]
			]);
			$result = $channels->toArray();
			$this->set('result', $result);
			$this->set('package_name', $product->name);
		}
		//$response = [
		//	'table'	=> $table
		//];
		//$this->response->body(json_encode($response));
		//return $this->response;
	}


###########################################################################################################################
###########################################################################################################################
###########################################################################################################################

###########################################################################################################################
###########################################################################################################################
###########################################################################################################################
    public function getOffers() {
		//Configure::write('debug', 0); //it will avoid any extra output

		$i = 1;
		$this->autoRender = false;
		$conditions = [];
		$data = [];
		$catv = Null;
		$net = Null;
		$tel = Null;
		$table = '';
		$tr = '';

        $this->response->disableCache();
        if ($this->request->is(['post', 'ajax'])) {
			//-- AJAX adatok -------------------------------------------------
            $data = $this->request->input('json_decode');
			/*
			if ($this->Captcha->getCaptcha()==strtoupper($data->captcha)) {
				//$this->redirect('/');
				die('-- ERROR --');
			}
			*/

			$data_catv 			= $data->catv;
			$data_net 			= $data->net;
			$data_tel 			= $data->tel;
			$data_pkg 			= $data->pkg;
			$data_packprice 	= $data->packprice;
			$data_sumdigi 		= $data->sumdigi;
			$data_packprice 	= $data->packprice;
			$data_sum 			= $data->sum;
			$digi_ids 			= '';
			if(isset($data->digiids) && strlen($data->digiids)>0){
				$digi_ids = $data->digiids;
			}

			//------------ DIGI rendbetétele ----------
			$digis = explode(',', $digi_ids);
			$digi_ids = '';
			foreach($digis as $d){
				$digi_ids .= $d.',';
			}
			if($digi_ids!=''){
				$digi_ids = substr($digi_ids,0,-1);
			}
			//---------- /.DIGI rendbetétele ----------

			//----------- INIT TESZT -----------
			/*
			$data_catv 			= 1;
			$data_net 			= 0;
			$data_tel 			= 1;
			$data_pkg 			= 0;
			$data_packprice 	= 9131;
			$data_sumdigi 		= 0;
			$data_packprice 	= 0;
			$data_sum 			= 6800;
			*/
			//--------- /.INIT TESZT -----------

			//-- Aktuális település adatai a fejállomás lekérdezése miatt ----
			$city_id = $this->request->cookies['currentCityId'];
			$this->loadModel('SzlaCities');
			$city = $this->SzlaCities->find('all',['conditions'=>['id'=>$city_id]])->first();

			############# Választott szolgáltatások rekordjai ################
			$cur_catv	= $this->Newproducts->findById($data_catv)->first();
			$cur_net	= $this->Newproducts->findById($data_net)->first();
			$cur_tel	= $this->Newproducts->findById($data_tel)->first();
			$cur_pkg	= $this->Newproducts->findById($data_pkg)->first();
			########### /.Választott szolgáltatások rekordjai ################

			$sumdigi = $data_sumdigi;	//Digitális összesenek

			//-- Ha van csomag ár, akkor az, ha nicns, akkor az összesen --------
			if($data_packprice > 0){
				$sum = $data_packprice;
			}else{
				$sum = $data_sum;
			}

			//-- INIT ------------------------------------------------------------------------
			if($data_catv>0){ $have_catv = 1; }else{ $have_catv = 0; }
			if($data_net>0){  $have_net = 1;  }else{ $have_net  = 0; }
			if($data_tel>0){  $have_tel = 1;  }else{ $have_tel  = 0; }
			if($data_pkg>0){  $have_pkg = 1;  }else{ $have_pkg  = 0; }

			########## DRÁGÁBB szolgáltatás megkeresése ######################################
			if(isset($cur_catv)){
				$catv = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'			=> $cur_catv->price,	//Egy árral magasabbat keres, azaz a következőt
						'servicegroup'		=> 1,
						'headstation_id' 	=> $city->headstation_id
					]
				])->first();
			}

			if(isset($cur_net)){
				$net = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'		 	=> $cur_net->price,		//Egy árral magasabbat keres, azaz a következőt
						'pkg_catv'			=> $have_catv,			//NET KTV-vel együtt, ha nincs, akkor nincs
						'servicegroup'	 	=> 2,
						'headstation_id' 	=> $city->headstation_id
					]
				])->first();
			}

			if(isset($cur_tel)){
				$tel = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'			=> $cur_tel->price,		//Egy árral magasabbat keres, azaz a következőt
						'servicegroup'		=> 4,
						'headstation_id' 	=> $city->headstation_id
					]
				])->first();
			}
			######## /.DRÁGÁBB szolgáltatás megkeresése ######################################


			########## CSAK TV - OK ##################################################################################################
			########## CSAK TV - OK ##################################################################################################
			########## CSAK TV - OK ##################################################################################################
			if( $have_catv && !$have_net && !$have_tel){
				$catvs = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'			=> $cur_catv->price,	//Egy árral magasabbat keres, azaz a következőt
						'servicegroup'		=> 1,
						'headstation_id' 	=> $city->headstation_id
					]
				]);

				$content = '';
				foreach($catvs as $catv){
					$ids = '';
					$content .=
					'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
							'<b>'.$catv->name.' <span style="float: right; font-size: 20px;">'.$catv->price.'&nbsp;Ft</span></b><br>'.
							nl2br($catv->content);
					//------ It ta digi nem értelmezett, mert csak maxi csomaggal lehetséges és akkor nem ajánl ennél magasabbat...
					$ids .= $catv->id.",";
					$ids = substr($ids,0,-1);
					if(strlen($digi_ids)>0){
						$ids .= ",".$digi_ids;
					}
					$content .= '</div>
					<div style="text-align: center; width: 100%; border-bottom: 1px solid green; padding: 10px 10px 15px;">
						<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
					</div>';
					$i++;
				}
				if($content != ''){
					$table .= '<div style="background: #eff; border: 1px solid blue; margin-bottom: 10px;">';
					$table .= '<h3>További ajánlataink</h3>';
					$table .= $content;
					$table .= '</div>';
				}
			}
			######## /.CSAK TV - OK ##################################################################################################
			######## /.CSAK TV - OK ##################################################################################################
			######## /.CSAK TV - OK ##################################################################################################


			########### CSAK NET - OK ################################################################################################
			########### CSAK NET - OK ################################################################################################
			########### CSAK NET - OK ################################################################################################
			if( !$have_catv && $have_net && !$have_tel){
				$nets = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'		 	=> $cur_net->price,		//Egy árral magasabbat keres, azaz a következőt
						'pkg_catv'			=> $have_catv,			//NET KTV-vel együtt, ha nincs, akkor nincs
						'servicegroup'	 	=> 2,
						'headstation_id' 	=> $city->headstation_id
					]
				]);

				$content = '';
				foreach($nets as $net){
					$ids = '';
					$ids .= $net->id.",";
					$ids = substr($ids,0,-1);
					$content .=
					'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
							'<b>'.$net->name.' <span style="float: right; font-size: 20px;">'.$net->price.'&nbsp;Ft</span></b><br>'.
							nl2br($net->content).'
					</div>
					<div style="text-align: center; width: 100%; border-bottom: 1px solid green; padding: 10px 10px 15px;">
						<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
					</div>';
					$i++;
				}
				if($content != ''){
					$table .= '<div style="background: #eff; border: 1px solid blue; margin-bottom: 10px;">';
					$table .= '<h3>További ajánlataink</h3>';
					$table .= $content;
					$table .= '</div>';
				}
			}
			######### /.CSAK NET - OK ################################################################################################
			######### /.CSAK NET - OK ################################################################################################
			######### /.CSAK NET - OK ################################################################################################


			########## TV+NET - OK ###################################################################################################
			########## TV+NET - OK ###################################################################################################
			########## TV+NET - OK ###################################################################################################
			if( $have_catv==1 && $have_net==1 && $have_tel==0){
				$content = '';

				//--------- Először eggyel nagyobb NET ajánása a meglévő TV mellé, majd fordítva --------------------------------
				$nets = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'		 	=> $cur_net->price,		//Egy árral magasabbat keres, azaz a következőt
						'pkg_catv'			=> $have_catv,			//NET KTV-vel együtt, ha nincs, akkor nincs
						'servicegroup'	 	=> 2,
						'headstation_id' 	=> $city->headstation_id
					]
				]);

				foreach($nets as $net){
					$ids = '';
					//Csomagvizsgálat. A kérés része-e csomagnak
					$pkg = $this->Newproducts->find('all',[
						'conditions'=>[
							'headstation_id'=> $city->headstation_id,
							'servicegroup' 	=> 8,
							'pkg_catv_id' 	=> $cur_catv->id,
							'pkg_net_id' 	=> $net->id,
							'pkg_tel' 		=> 0,
						],
					])->first();

					if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel

						$content .=
							'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
								'<b>'.$cur_catv->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_catv->price.'&nbsp;Ft</span>'.
								nl2br($cur_catv->content).
								'<b>'.$net->name.'</b> <span style="float: right; font-size: 20px;">'.$net->price.'&nbsp;Ft</span>'.
								nl2br($net->content);

							if($sumdigi>0){
								$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
								//$content .= $data->digilist;
								$content .= "<br>".$data->digilist;
								$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$net->price + $sumdigi).'&nbsp;Ft</span>';
							}else{
								$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$net->price).'&nbsp;Ft</span></b>';
							}

						$ids .= $cur_catv->id.",".$net->id;
						if(strlen($digi_ids)>0){
							$ids .= ",".$digi_ids;
						}
						//$ids = substr($ids,0,-1);
						$content .= '</div>
							<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
								<button srv="110" ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
							</div>';
						$i++;
						break;
					}
				}
				//------- /.Először eggyel nagyobb NET ajánása a meglévő TV mellé, majd fordítva --------------------------------

				//--------- Majd eggyel nagyobb TV ajánása a meglévő TV mellé, majd fordítva --------------------------------
				$catvs = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'		 	=> $cur_catv->price,		//Egy árral magasabbat keres, azaz a következőt
						'pkg_catv'			=> $have_catv,			//NET KTV-vel együtt, ha nincs, akkor nincs
						'servicegroup'	 	=> 1,
						'headstation_id' 	=> $city->headstation_id
					]
				]);

				foreach($catvs as $catv){
					$ids = '';
					//Csomagvizsgálat. A kérés része-e csomagnak
					$pkg = $this->Newproducts->find('all',[
						'conditions'=>[
							'headstation_id'=> $city->headstation_id,
							'servicegroup' 	=> 8,
							'pkg_catv_id' 	=> $catv->id,
							'pkg_net_id' 	=> $cur_net->id,
							'pkg_tel' 		=> 0,
						],
					])->first();

					if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel
						$content .=
							'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
								'<b>'.$catv->name.'</b> <span style="float: right; font-size: 20px;">'.$catv->price.'&nbsp;Ft</span>'.
								nl2br($catv->content).
								'<b>'.$cur_net->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_net->price.'&nbsp;Ft</span>'.
								nl2br($cur_net->content);
/*	Nem értelmezett itt !!
							if($sumdigi>0){
								$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
								$content .= $data->digilist;
								$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_net->price + $sumdigi).'&nbsp;Ft</span>';
							}else{
								//----- Ez a sor lemásolva ide alább.... --------
								$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_net->price + $sumdigi).'&nbsp;Ft</span></b>';
								//----- Ez a sor lemásolva ide alább.... --------
							}
*/
							$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_net->price + $sumdigi).'&nbsp;Ft</span></b>';

						$ids .= $catv->id.",".$cur_net->id;
						if(strlen($digi_ids)>0){
							$ids .= ",".$digi_ids;
						}
						$content .= '</div>
							<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
								<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
							</div>';
						$i++;
						break;
					}
				}
				//------- /.Majd eggyel nagyobb TV ajánása a meglévő TV mellé, majd fordítva --------------------------------

				if($content != ''){
					$table .= '<div style="background: #eff; border: 1px solid blue; margin-bottom: 10px;">';
					$table .= '<h3>További ajánlataink</h3>';
					$table .= $content;
					$table .= '</div>';
				}

			}
			######## /.TV+NET - OK ###################################################################################################
			######## /.TV+NET - OK ###################################################################################################
			######## /.TV+NET - OK ###################################################################################################

			########## TV+TEL -OK ###################################################################################################
			########## TV+TEL -OK ###################################################################################################
			########## TV+TEL -OK ###################################################################################################
			if( $have_catv==1 && $have_net==0 && $have_tel==1){
				$content = '';
				$i = 1;

				//-------- Eggyel nagyobb telefon keresése --------
				$tels = $this->Newproducts->find('all',[
					'conditions'=>[
						'headstation_id'=> $city->headstation_id,
						'id !='			=> $cur_tel->id,
						'price >'		=> $cur_tel->price,
						'servicegroup' 	=> 4,
						'pkg_catv' 		=> $have_catv,
						'pkg_net' 		=> $have_net,
						'pkg_tel' 		=> $have_tel,
					],
				]);

				foreach($tels as $tel){
					$ids = '';
					$content .=
						'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
							'<b>'.$cur_catv->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_catv->price.'&nbsp;Ft</span>'.
							nl2br($cur_catv->content).
							'<b>'.$tel->name.'</b> <span style="float: right; font-size: 20px;">'.$tel->price.'&nbsp;Ft</span>'.
							nl2br($tel->content);

							if($sumdigi>0){
								$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
								$content .= $data->digilist;
								$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$tel->price + $sumdigi).'&nbsp;Ft</span>';
							}else{
								$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$tel->price + $sumdigi).'&nbsp;Ft</span></b>';
							}

/*
						if($sumdigi>0){
							$content .= '+ A választott digitális csomagok <br>';
							$content .= $data->digilist;
							$content .= ',<br>azaz '.($cur_catv->price+$tel->price).'&nbsp;Ft + '.$sumdigi.'&nbsp;Ft = <br><span style="float: right; font-size: 20px; border-top: 1px solid gray; font-weight: bold;"><span id="package-digi-2-price">'.($cur_catv->price+$tel->price + $sumdigi).'</span> Ft</span>';
						}else{
							$content .= '<span style="float: right;  clear: both; font-size: 20px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$tel->price).'&nbsp;Ft</span>';
						}
*/
					$ids .= $cur_catv->id.",".$tel->id;
					if(strlen($digi_ids)>0){
						$ids .= ",".$digi_ids;
					}
					$content .= '</div>
						<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
							<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
						</div>';
					$i++;
					//break;
				}
				//------ /.Eggyel nagyobb telefon keresése --------


				//-------- Eggyel nagyobb TV keresése --------
				$catvs = $this->Newproducts->find('all',[
					'conditions'=>[
						'headstation_id'=> $city->headstation_id,
						///'id !='			=> $cur_catv->id,
						'price >'		=> $cur_catv->price,
						'servicegroup' 	=> 1,
						'pkg_catv' 		=> $have_catv,
						//'pkg_net' 		=> $have_net,
						//'pkg_tel' 		=> $have_tel,
					],
				]);

				foreach($catvs as $catv){
					$ids = '';
					$content .=
						'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
							'<b>'.$catv->name.'</b> <span style="float: right; font-size: 20px;">'.$catv->price.'&nbsp;Ft</span>'.
							nl2br($catv->content).
							'<b>'.$cur_tel->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_tel->price.'&nbsp;Ft</span>'.
							nl2br($cur_tel->content);

							if($sumdigi>0){
								$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
								$content .= $data->digilist;
								$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_tel->price + $sumdigi).'&nbsp;Ft</span>';
							}else{
								$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_tel->price + $sumdigi).'&nbsp;Ft</span></b>';
							}
/*
						if($sumdigi>0){
							$content .= '+ A választott digitális csomagok <br>';
							$content .= $data->digilist;
							$content .= ',<br>azaz '.($catv->price+$cur_tel->price).'&nbsp;Ft + '.$sumdigi.'&nbsp;Ft = <br><span style="float: right; font-size: 20px; border-top: 1px solid gray; font-weight: bold;"><span id="package-digi-2-price">'.($catv->price+$cur_tel->price + $sumdigi).'</span> Ft</span>';
						}else{
							$content .= '<span style="float: right;  clear: both; font-size: 20px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_tel->price).'&nbsp;Ft</span>';
						}
*/
					$ids .= $catv->id.",".$cur_tel->id;
					if(strlen($digi_ids)>0){
						$ids .= ",".$digi_ids;
					}
					$content .= '</div>
						<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
							<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
						</div>';
					$i++;
					//break;
				}
				//------ /.Eggyel nagyobb TV keresése --------

				if($content != ''){
					$table .= '<div style="background: #eff; border: 1px solid blue; margin-bottom: 10px;">';
					$table .= '<h3>További ajánlataink</h3>';
					$table .= $content;
					$table .= '</div>';
				}

			}


			######## /.TV+TEL - OK ###################################################################################################
			######## /.TV+TEL - OK ###################################################################################################
			######## /.TV+TEL - OK ###################################################################################################


			########## NET+TEL - OK ###################################################################################################
			########## NET+TEL - OK ###################################################################################################
			########## NET+TEL - OK ###################################################################################################
			if( $have_catv==0 && $have_net==1 && $have_tel==1){
				$content = '';
				$i = 1;

				//--------- Először eggyel nagyobb NET ajánása a meglévő TV mellé, majd fordítva --------------------------------
				$nets = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'		 	=> $cur_net->price,		//Egy árral magasabbat keres, azaz a következőt
						'pkg_catv'			=> $have_catv,			//NET KTV-vel együtt, ha nincs, akkor nincs
						'servicegroup'	 	=> 2,
						'headstation_id' 	=> $city->headstation_id
					]
				]);

				foreach($nets as $net){
					$ids = '';
					$content .=
						'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
							'<b>'.$net->name.'</b> <span style="float: right; font-size: 20px;">'.$net->price.'&nbsp;Ft</span>'.
							nl2br($net->content).
							'<b>'.$cur_tel->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_tel->price.'&nbsp;Ft</span>'.
							nl2br($cur_tel->content).
							'<span style="float: right;  clear: both; font-size: 20px; border-top: 1px solid gray; font-weight: bold;">'.($net->price+$cur_tel->price).'&nbsp;Ft</span></b>';

					$ids .= $cur_tel->id.",".$net->id;
					//if(strlen($digi_ids)>0){
					//	$ids .= ",".$digi_ids;
					//}
					$content .= '</div>
						<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
							<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
						</div>';
					$i++;
					//break;
				}
				//------- /.Először eggyel nagyobb NET ajánása a meglévő TV mellé, majd fordítva --------------------------------

				if($content != ''){
					$table .= '<div style="background: #eff; border: 1px solid blue; margin-bottom: 10px;">';
					$table .= '<h3>További ajánlataink</h3>';
					$table .= $content;
					$table .= '</div>';
				}

			}
			######## /.NET+TEL - OK ###################################################################################################
			######## /.NET+TEL - OK ###################################################################################################
			######## /.NET+TEL - OK ###################################################################################################





			######### TV+NET+TEL - OK ##################################################################################################
			######### TV+NET+TEL ##################################################################################################
			######### TV+NET+TEL ##################################################################################################
			//--- Under construction ---
			if($have_catv==1 && $have_net==1 && $have_tel==1){
				$content = '';

				//--------- Eggyel nagyobb TV ajánása a meglévő TV mellé --------------------------------
				$catvs = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'		 	=> $cur_catv->price,		//Egy árral magasabbat keres, azaz a következőt
						'pkg_catv'			=> $have_catv,			//NET KTV-vel együtt, ha nincs, akkor nincs
						'servicegroup'	 	=> 1,
						'headstation_id' 	=> $city->headstation_id,
					]
				]);

				foreach($catvs as $catv){
					$ids = '';
					//Csomagvizsgálat. A kérés része-e csomagnak
					$conditions = ['conditions'=>[
						'headstation_id'=> $city->headstation_id,
						'servicegroup' 	=> 8,
						'pkg_catv_id' 	=> $catv->id,
						'pkg_net_id' 	=> $cur_net->id,
						'pkg_tel_id' 	=> $cur_tel->id,
					]];
					$pkg = $this->Newproducts->find('all', $conditions )->first();

					if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel
						$content .=
							'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
								'<b>'.$catv->name.'</b> <span style="float: right; font-size: 20px;">'.$catv->price.'&nbsp;Ft</span>'.
								nl2br($catv->content).
								'<b>'.$cur_net->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_net->price.'&nbsp;Ft</span>'.
								nl2br($cur_net->content).
								'<b>'.$cur_tel->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_tel->price.'&nbsp;Ft</span>'.
								nl2br($cur_tel->content);

								if($sumdigi>0){
									$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
									$content .= $data->digilist;
									$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_net->price+$cur_tel->price).'&nbsp;Ft</span>';
								}else{
									$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($catv->price+$cur_net->price+$cur_tel->price).'&nbsp;Ft</span></b>';
								}

						$ids .= $catv->id.",".$cur_net->id.",".$cur_tel->id;
						if(strlen($digi_ids)>0){
							$ids .= ",".$digi_ids;
						}
						$content .= '</div>
							<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
								<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
							</div>';
						$i++;
						break;
					}
				}
				//------- /.Eggyel nagyobb TV ajánása a meglévő TV mellé --------------------------------


				//--------- Eggyel nagyobb NET ajánása a meglévő TV mellé --------------------------------
				$nets = $this->Newproducts->find('all',[
					'conditions'=>[
						'price >'		 	=> $cur_net->price,		//Egy árral magasabbat keres, azaz a következőt
						'pkg_catv'			=> $have_catv,			//NET KTV-vel együtt, ha nincs, akkor nincs
						'servicegroup'	 	=> 2,
						'headstation_id' 	=> $city->headstation_id
					]
				]);
				$net = $nets->first();

				//Csomagvizsgálat. A kérés része-e csomagnak
				$pkg = $this->Newproducts->find('all',[
					'conditions'=>[
						'headstation_id'=> $city->headstation_id,
						'servicegroup' 	=> 8,
						'pkg_catv_id' 	=> $cur_catv->id,
						'pkg_net_id' 	=> $net->id,
						'pkg_tel_id' 		=> $cur_tel->id,
					],
				])->first();

				if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel
					$ids = '';
					$content .=
						'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
							'<b>'.$cur_catv->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_catv->price.'&nbsp;Ft</span>'.
							nl2br($cur_catv->content).
							'<b>'.$net->name.'</b> <span style="float: right; font-size: 20px;">'.$net->price.'&nbsp;Ft</span>'.
							nl2br($net->content).
							'<b>'.$cur_tel->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_tel->price.'&nbsp;Ft</span>'.
							nl2br($cur_tel->content);
							//'<span style="float: right;  clear: both; font-size: 20px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$net->price+$cur_tel->price).'&nbsp;Ft</span></b>';

							if($sumdigi>0){
								$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
								$content .= $data->digilist;
								$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$net->price+$cur_tel->price + $sumdigi).'&nbsp;Ft</span>';
							}else{
								$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$net->price+$cur_tel->price).'&nbsp;Ft</span></b>';
							}

					$ids .= $cur_catv->id.",".$net->id.",".$cur_tel->id;
					if(strlen($digi_ids)>0){
						$ids .= ",".$digi_ids;
					}
					$content .= '</div>
						<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
							<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
						</div>';
					$i++;
					//break;
				}
				//------- /.Eggyel nagyobb NET ajánása a meglévő TV mellé --------------------------------

				//-------- Nagyobb telefonok keresése --------
				$tels = $this->Newproducts->find('all',[
					'conditions'=>[
						'headstation_id'=> $city->headstation_id,
						'id !='			=> $cur_tel->id,
						//'price >'		=> $cur_tel->price,
						'pos >'			=> $cur_tel->pos,
						'onlyinpackage'	=> 0,
						'servicegroup' 	=> 4,
						'pkg_catv' 		=> $have_catv,
						//'pkg_net' 		=> $have_net,
						'pkg_tel' 		=> $have_tel,
					],
				]);

				foreach($tels as $tel){
					$ids = '';
					$content .=
						'<div id="content-'.$i.'" class="text-left" style="padding: 15px;">'.
							'<b>'.$cur_catv->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_catv->price.'&nbsp;Ft</span>'.
							nl2br($cur_catv->content).
							'<b>'.$cur_net->name.'</b> <span style="float: right; font-size: 20px;">'.$cur_net->price.'&nbsp;Ft</span>'.
							nl2br($cur_net->content).
							'<b>'.$tel->name.'</b> <span style="float: right; font-size: 20px;">'.$tel->price.'&nbsp;Ft</span>'.
							nl2br($tel->content);

							if($sumdigi>0){
								$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
								$content .= $data->digilist;
								$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$cur_net->price+$tel->price + $sumdigi).'&nbsp;Ft</span>';
							}else{
								$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($cur_catv->price+$cur_net->price+$tel->price).'&nbsp;Ft</span></b>';
							}

						$ids .= $cur_catv->id.",".$cur_net->id.",".$tel->id;
						if(strlen($digi_ids)>0){
							$ids .= ",".$digi_ids;
						}
						$content .=
						'</div>
						<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
							<button ids="'.$ids.'" class="btn btn-primary interest" content-id="content-'.$i.'" type="submit">Érdekel</button>
						</div>';
					$i++;
					//break;
				}
				//------ /.Nagyobb telefonok keresése --------

				if($content != ''){
					$table .= '<div style="background: #efe; border: 1px solid blue; margin-bottom: 10px;">';
					$table .= '<h3>További ajánlataink</h3>';
					$table .= $content;
					$table .= '</div>';
				}


			}
			####### /.TV+NET+TEL ##################################################################################################
			####### /.TV+NET+TEL ##################################################################################################
			####### /.TV+NET+TEL ##################################################################################################















			###########################################################################################################################
			###########################################################################################################################
			########## CSOMAG AJÁNLATOK #############################################################################################
			###########################################################################################################################
			###########################################################################################################################
			//$tr = '';
			$content = '';
			$ids = '';
			//----------- A totál árnál KISEBB CSOMAG ÁR ------------
			$pkg = $this->Newproducts->find('all',[
				'conditions'=>[
					'price <' 		=> $sum,
					'servicegroup'	=> 8,
					'pkg_catv' 		=> $have_catv,
					'pkg_net' 		=> $have_net,
					'pkg_tel' 		=> $have_tel,
					'headstation_id'=> $city->headstation_id
				],
				'order' => [
					'price' => 'asc'
				]
			])->first();
			if(isset($pkg)){

				$content .=
					'<div id="package-'.$i.'" class="text-left" style="padding: 15px;">'.
						'<b>'.$pkg->name.'</b> <span style="float: right; font-size: 20px;">'.$pkg->price.'&nbsp;Ft</span>'.
						nl2br($pkg->content);

						if($sumdigi>0){
							$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
							$content .= $data->digilist;
							$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($pkg->price + $sumdigi).'&nbsp;Ft</span>';
						}else{
							$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($pkg->price).'&nbsp;Ft</span></b>';
						}


/*
						if($sumdigi>0){
							$content .= '+ A választott digitális csomagok <br>';
							$content .= $data->digilist;
							$content .= ',<br>azaz '.$pkg->price.'&nbsp;Ft + '.$sumdigi.'&nbsp;Ft =';
						}
						$content .= '<span style="float: right;  clear: both; font-size: 20px; border-top: 1px solid gray; font-weight: bold;">'.($pkg->price + $sumdigi).'&nbsp;Ft</span></b>';
*/

				$content .= '</div>';

				$ids .= $pkg->id;
				if(strlen($digi_ids)>0){
					$ids .= ",".$digi_ids;
				}
				$content .=
					'<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid blue; padding: 10px 10px 15px;">
						<button ids="'.$ids.'" class="btn btn-primary interest" content-id="package-'.$i.'" type="submit">Érdekel</button>
					</div>';

				$i++;
				//break;
				//------- /.Először eggyel nagyobb NET ajánása a meglévő TV mellé, majd fordítva --------------------------------
			}
			//--------- /.A totál árnál KISEBB CSOMAG ÁR ------------



			//----------- A totál árnál KISEBB CSOMAG ÁR ------------
			$pkg = $this->Newproducts->find('all',[
				'conditions'=>[
					'price >' 		=> $sum,
					'servicegroup'	=> 8,
					'pkg_catv' 		=> $have_catv,
					'pkg_net' 		=> $have_net,
					'pkg_tel' 		=> $have_tel,
					'headstation_id'=> $city->headstation_id
				],
				'order' => [
					'pos' => 'asc'
				]
			])->first();
			if(isset($pkg)){
				$ids = '';
				$content .=
					'<div id="package-'.$i.'" class="text-left" style="padding: 15px;">'.
						'<b>'.$pkg->name.'</b> <span style="float: right; font-size: 20px;">'.$pkg->price.'&nbsp;Ft</span>'.
						nl2br($pkg->content);

						if($sumdigi>0){
							$content .= '<b>+ A választott digitális csomagok</b><span style="float: right; font-size: 20px; margin-bottom: 20px; margin-left: 5px;">'.$sumdigi.'&nbsp;Ft</span> <br>';
							$content .= $data->digilist;
							$content .= '<span style="float: right; clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($pkg->price + $sumdigi).'&nbsp;Ft</span>';
						}else{
							$content .= '<span style="float: right;  clear: both; font-size: 20px; margin-top: 10px; border-top: 1px solid gray; font-weight: bold;">'.($pkg->price).'&nbsp;Ft</span></b>';
						}
/*
						if($sumdigi>0){
							$content .= '+ A választott digitális csomagok <br>';
							$content .= $data->digilist;
							$content .= ',<br>azaz '.$pkg->price.'&nbsp;Ft + '.$sumdigi.'&nbsp;Ft =';
						}
						$content .= '<span style="float: right;  clear: both; font-size: 20px; border-top: 1px solid gray; font-weight: bold;">'.($pkg->price + $sumdigi).'&nbsp;Ft</span></b>';
*/
				$content .= '</div>';

				$ids .= $pkg->id;
				if(strlen($digi_ids)>0){
					$ids .= ",".$digi_ids;
				}
				$content .=
					'<div style="text-align: center; width: 100%; clear: both; border-bottom: 1px solid green; padding: 10px 10px 15px;">
						<button ids="'.$ids.'" class="btn btn-primary interest" content-id="package-'.$i.'" type="submit">Érdekel</button>
					</div>';

				$i++;
				//break;
				//------- /.Először eggyel nagyobb NET ajánása a meglévő TV mellé, majd fordítva --------------------------------
			}
			//--------- /.A totál árnál KISEBB CSOMAG ÁR ------------

			if($content != ''){
				$table .= '<div style="background: #eef; border: 1px solid blue; margin-bottom: 10px;">';
				$table .= '<h3>Kombinált csomag ajánlataink</h3>';
				$table .= $content;
				$table .= '</div>';
			}



			###########################################################################################################################
			###########################################################################################################################
			########## /.CSOMAG AJÁNLATOK #############################################################################################
			###########################################################################################################################
			###########################################################################################################################

        }

		//$table = '* * * HELLO * * *';
		//$table = $tr;

		//echo 'TABLE: '.$table;

		$captcha = $this->Captcha->generateCaptcha(2,3); //, 'white', 'red');

		$response = [
			'table'	=> $table,
			'captcha' => $captcha
		];

		$this->response->body(json_encode($response));
		return $this->response;

	}




###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
##############                           ######################################################################################
##############                           ######################################################################################
##############   INDIVIDUAL INDIVIDUAL   ######################################################################################
##############                           ######################################################################################
##############                           ######################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################
###############################################################################################################################

    public function individual($currentCityId=0, $hash=Null) {
		if(isset($hash) && $hash != "egyedi-csomag-osszeallitas.html"){
			$this->redirect('/');
		}

		$this->loadModel('SzlaCities');
		$cities = $this->SzlaCities->find('list',[
			'order'=>['SzlaCities.name'=>'asc'],
			'conditions' => ['SzlaCities.headstation_id >=' => 1]
		]);


		if($currentCityId==0){
			$this->set('promptCityId', true);
			$this->title = 'Kérem válasszon a fenti menüpontok közül!';

		}else{
			try {
				$city = $this->SzlaCities->get($currentCityId);
				if($currentCityId>0 && $city->headstation_id==0){
					return $this->redirect('/');
				}
			} catch (\Exception $e) {
				//echo 'Caught exception: ',  $e->getMessage(), "\n";
				//$this->log($currentCityId." ".$service." - ".$e->getMessage(), 'individual');
				return $this->redirect('/');
			}

			$this->title = 'Egyedi csomagösszeállítás <span style="color: #ff9;">'.$city->name.'</span> településre';

			$services = $this->Newproducts->find('all',[
				'contain' => ['SzlaHeadstations'],
				'limit' => 100,
				'order' => [
					'Newproducts.headstation_id' 	=> 'asc',
					'Newproducts.servicegroup' 		=> 'asc',
					'Newproducts.pos' 				=> 'asc',
				],
				'conditions' => [
					'Newproducts.headstation_id' 	=> $city->headstation_id,
					'Newproducts.servicegroup !=' 	=> 8
				]
			]);

			$this->set('services', $services);
			$this->set('city', $city);
			$this->set('currentCityId', $currentCityId);
			//$this->set('currentCityId', $city->id);
		}

		//echo $currentCityId;
		//debug($city->toArray());
		//die();

		$this->set('currentCityId', $currentCityId);

		$this->set('title', $this->title);
		$this->set('cities', $cities);

	}




#############################################################################################################################
#############################################################################################################################
#############################################################################################################################
#########                     ###############################################################################################
#########                     ###############################################################################################
#########  INDEX INDEX INDEX  ###############################################################################################
#########                     ###############################################################################################
#########                     ###############################################################################################
#############################################################################################################################
#############################################################################################################################
#############################################################################################################################

    public function index($currentCityId=0, $service=Null) {
		$city = [];

		if($service != "csomagok.html" && $service != "kabeltv.html" && $service != "internet.html" && $service != "telefon.html"){
			$this->redirect('/');
		}

		//debug($this->request); die();

		if($currentCityId==0){
			//$currentCityId=76;
			$this->set('promptCityId',true);
			$this->title = 'Kérem válasszon a fenti menüpontok közül!';

		}else{
			$this->loadmodel('SzlaCities');
			try {
				$city = $this->SzlaCities->get($currentCityId);
				if($currentCityId>0 && $city->headstation_id>=5){
					//return $this->redirect('/');
					//debug($city->toArray());
					//debug($this->request); die('111');
				}
			} catch (\Exception $e) {
				//echo 'Caught exception: ',  $e->getMessage(), "\n";
				//$this->log($currentCityId." ".$service." - ".$e->getMessage(), 'individual');
				return $this->redirect('/');
				//debug($this->request); die('2222');
			}

			//$this->loadmodel('SzlaCities');
			//$city = $this->SzlaCities->get($currentCityId);

			$cities = $this->SzlaCities->find('list',[
				'order'=>['SzlaCities.name'=>'asc'],
				'conditions' => ['SzlaCities.headstation_id >=' => 1]
			]);

			$digi = 0;
			switch($service){

				case 'kabeltv.html':
					$this->title = 'Elérhető kábel TV szolgáltatásaink <span style="color: #ff9;">'.$city->name.'</span> településen';
					$servicegroup = 1;
					$digi = 9;
					break;

				case 'internet.html':
					$this->title = 'Elérhető Internet szolgáltatásaink <span style="color: #ff9;">'.$city->name.'</span> településen';
					$servicegroup = 2;
					break;

				case 'telefon.html':
					$this->title = 'Elérhető telefon szolgáltatásaink <span style="color: #ff9;">'.$city->name.'</span> településen';
					$servicegroup = 4;
					break;

				case 'csomagok.html':
					$this->title = 'Elérhető csomagjaink <span style="color: #ff9;">'.$city->name.'</span> településen';
					$servicegroup = 8;
					break;

				default:
					$servicegroup = 0;

			}
			$this->set('title', $this->title);

			if(isset($currentCityId) && $currentCityId>0){
				$this->paginate = [
					'contain' => ['SzlaHeadstations'],
					'limit' => 100,
					'order' => [
						'Newproducts.headstation_id' => 'asc',
						'Newproducts.servicegroup' => 'asc',
						'Newproducts.pos' => 'asc',
					],
					'conditions' => [
						'Newproducts.headstation_id='.$city->headstation_id.' AND (Newproducts.servicegroup='.$servicegroup.' OR Newproducts.servicegroup='.$digi.')',
						'Newproducts.visible' => 1
					]
				];
				$newproducts = $this->paginate($this->Newproducts);
			}else{
				$newproducts = Null;
				$currentCityId = Null;
			}

			$this->set('title', $this->title);
			$this->set(compact('newproducts', 'city', 'cities', 'currentCityId', 'servicegroup'));
			$this->set('_serialize', ['newproducts']);

			//debug($servicegroup);
			//debug($city->toArray());
			//debug($newproducts->toArray()); die();
		}
    }






##################################################################################################################################
##################################################################################################################################
##################################################################################################################################
##################################################################################################################################
##################################################################################################################################
##################################################################################################################################
##################################################################################################################################


}
