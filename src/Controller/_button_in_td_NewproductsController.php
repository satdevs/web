<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\Table;

class NewproductsController extends AppController{
	public $title = "Kérem válasszon települést";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		//$this->Auth->allow(['index','individual']);
		$this->loadComponent('RequestHandler');
		//$this->_validViewOptions[] = 'pdfConfig';
	}
	
    public function getOffers() {
		//Configure::write('debug', 0); //it will avoid any extra output
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
			$data_catv 			= $data->catv;
			$data_net 			= $data->net;
			$data_tel 			= $data->tel;
			$data_pkg 			= $data->pkg;
			$data_packprice 	= $data->packprice;
			$data_sumdigi 		= $data->sumdigi;
			$data_packprice 	= $data->packprice;
			$data_sum 			= $data->sum;
			
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


			########## CSAK TV ##################################################################################################
			if( $have_catv && !$have_net && !$have_tel){
				//if(!isset($pkg)){	//Ha nincs csomagban
					if(isset($catv)){
						$table .= '<div style="background: #eff; border: 1px solid green; margin-bottom: 10px;"><h3>További ajánlataink</h3><table style="width: 100%;" class=""><tr><th style="text-align: left;">Neve</th><th>&nbsp;</th><th style="width: 150px;">Ár (Ft)</th></tr>';
							$table .= '<tr><td id="content-1" class="text-left"><b>'.$catv->name.'</b><br>'.nl2br($catv->content).'</td> <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-1" type="submit">Érdekel</button></td> <td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.$catv->price.'&nbsp;Ft</b></td></tr>';						
						$table .= '</table></div>';
					}					
				//}
			}
			######## /.CSAK TV ##################################################################################################

			########### CSAK NET ################################################################################################
			if( !$have_catv && $have_net && !$have_tel){
				if(isset($net)){
					$table .= '<div style="background: #eff; border: 1px solid green; margin-bottom: 15px;"><h3>További ajánlataink</h3><table style="width: 100%;"><tr><th style="text-align: left;">Neve</th><th>&nbsp;</th><th style="width: 150px;">Ár (Ft)</th></tr>';
						$table .= '<tr><td id="content-1" class="text-left">Csak TV - <b>'.$net->name.'</b><br>'.nl2br($net->content).'</td> <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-1" type="submit">Érdekel</button></td> <td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.$net->price.'&nbsp;Ft</b></td></tr>';						
					$table .= '</table>';
				}					
			}
			######### /.CSAK NET ################################################################################################
			
			########## TV+NET ###################################################################################################
			if( $have_catv && $have_net && !$have_tel){
		
				//if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel
					if(isset($catv)){
						$tr = '';
						//---------------- Ha nem része csomagnak, akkor felkínálja 1. ------------
						$pkg = $this->Newproducts->find('all',[
							'conditions'=>[
								'headstation_id'=> $city->headstation_id,
								'servicegroup' 	=> 8,
								'pkg_catv_id' 	=> $catv->id,
								'pkg_net_id' 	=> $cur_net->id,
								'pkg_tel' 		=> $have_tel,
							],
						])->first();
						if(!isset($pkg) && isset($catv) && isset($cur_net)){
							$tr .= '<tr><td id="content-1" class="text-left"><b>'.$catv->name.'</b> - '.$catv->price.'&nbsp;Ft'.$catv->content.'<b><br>'.$cur_net->name.'</b> - '.$cur_net->price.'Ft'.$cur_net->content.'</td> <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-1" type="submit">Érdekel</button></td> <td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($catv->price+$cur_net->price).'&nbsp;Ft</b></td></tr>';
						}
						//-------------- /.Ha nem része csomagnak, akkor felkínálja 1. ------------
					}
					
					if(isset($net)){
						//---------------- Ha nem része csomagnak, akkor felkínálja 2. ------------
						$pkg = $this->Newproducts->find('all',[
							'conditions'=>[
								'headstation_id'=> $city->headstation_id,
								'servicegroup'	=> 8,
								'pkg_catv_id' 	=> $cur_catv->id,
								'pkg_net_id' 	=> $net->id,
								'pkg_tel' 		=> $have_tel,
							],
						])->first();
						if(!isset($pkg) && isset($cur_catv) && isset($net)){
							//$tr .= '<tr><td id="content-2" class="text-left"><b>'.$cur_catv->name.'</b> - '.$cur_catv->price.'&nbsp;Ft'.$cur_catv->content.'<b><br>'.$net->name.'</b> - '.$net->price.'Ft'.$net->content.'</td> <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-2" type="submit">Érdekel</button></td> <td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($cur_catv->price+$net->price).'&nbsp;Ft</b></td></tr>';
						}
						//-------------- /.Ha nem része csomagnak, akkor felkínálja 2. ------------

						//---------------- KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
						if($tr != ''){
							$table = '<div style="background: #eff; border: 1px solid green; margin-bottom: 15px;"><h3>További KTV+Internet ajánlataink</h3><table cellpadding="3" cellspacing="3" style="width: 100%; border: 1px solid gray;"><tr><th style="text-align: left;">Neve</th><th>&nbsp;</th><th style="width: 150px;">Ár (Ft)</th></tr>';
							$table .= $tr;
							$table .= '</table></div>';
						}
						//-------------- /.KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
					}
				//}
			}
			######## /.TV+NET ###################################################################################################

			########## TV+TEL ###################################################################################################
			if( $have_catv && !$have_net && $have_tel){
				
				//if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel
					if(isset($catv) || isset($net)){
						$tr = '';
						//---------------- Eggyel nagyobb telefon ------------
						$catv_tel = $this->Newproducts->find('all',[
							'conditions'=>[
								'headstation_id'=> $city->headstation_id,
								'id !='			=> $cur_tel->id,
								'price >'		=> $cur_tel->price,
								'servicegroup' 	=> 4,								
								'pkg_catv' 		=> $have_catv,
								'pkg_net' 		=> $have_net,
								'pkg_tel' 		=> $have_tel,
							],
						])->first();
						if(isset($catv_tel) && isset($cur_catv)){
							$tr .= '<tr><td id="content-1" class="text-left"><b>'.$cur_catv->name.'</b> - '.$cur_catv->price.'&nbsp;Ft'.$cur_catv->content.'<b><br>'.$catv_tel->name.'</b> - '.$catv_tel->price.'Ft'.$catv_tel->content.'</td> <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-1" type="submit">Érdekel</button></td> <td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($cur_catv->price+$catv_tel->price).'&nbsp;Ft</b></td></tr>';
						}
						//-------------- /.Eggyel nagyobb telefon ------------

						//---------------- Eggyel nagyobb TV -----------------
						$catv_tel = $this->Newproducts->find('all',[
							'conditions'=>[
								'headstation_id'=> $city->headstation_id,
								'id !='			=> $cur_catv->id,
								'price >'		=> $cur_catv->price,
								'servicegroup' 	=> 1,
								'pkg_catv' 		=> $have_catv,
								//'pkg_net' 		=> $have_net,
								//'pkg_tel' 		=> $have_tel,
							],
						])->first();
						if(isset($catv_tel) && isset($cur_tel)){
							$tr .= '<tr><td id="content-2" class="text-left"><b>'.$catv_tel->name.'</b> - '.$catv_tel->price.'&nbsp;Ft'.$catv_tel->content.'<b><br>'.$cur_tel->name.'</b> - '.$cur_tel->price.'Ft'.$cur_tel->content.'</td> <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-2" type="submit">Érdekel</button></td> <td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($catv_tel->price+$cur_tel->price).'&nbsp;Ft</b></td></tr>';
						}
						//-------------- /.Eggyel nagyobb TV -----------------
						
						//---------------- KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
						if($tr != ''){
							$table = '<div style="background: #eff; border: 1px solid green; margin-bottom: 15px;"><h3>További KTV+Telefonszolgáltatás ajánlataink</h3><table cellpadding="3" cellspacing="3" style="width: 100%; border: 1px solid gray;"><tr><th style="text-align: left;">Neve</th><th>&nbsp;</th><th style="width: 150px;">Ár (Ft)</th></tr>';
							$table .= $tr;
							$table .= '</table></div>';
						}
						//-------------- /.KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
					}
				//}
			}
			######## /.TV+TEL ###################################################################################################
			

			########## NET+TEL ###################################################################################################
			if( !$have_catv && $have_net && $have_tel){
				
				//if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel
					if(isset($catv) || isset($net)){
						$tr = '';
						//---------------- Eggyel nagyobb NET -----------------
						$net_tel = $this->Newproducts->find('all',[
							'conditions'=>[
								'headstation_id'=> $city->headstation_id,
								//'id !='			=> $cur_net->id,
								'price >'		=> $cur_net->price,
								'servicegroup' 	=> 2,
								'pkg_catv' 		=> $have_catv,
								'pkg_net' 		=> $have_net,
							],
							'order' => [
								'price' => 'asc',
							]
						])->first();
						
						$tel_tel = $this->Newproducts->find('all',[
							'conditions'=>[
								'headstation_id'=> $city->headstation_id,
								//'id !='			=> $cur_net->id,
								//'price >'		=> $cur_net->price,
								'servicegroup' 	=> 4,
								'pkg_catv' 		=> $have_catv,
								'pkg_net' 		=> $have_net,
								'pkg_tel' 		=> $have_tel,
							],
							'order' => [
								'price' => 'asc',
							]
						])->first();
						if(isset($net_tel) && isset($tel_tel)){
							$tr .= '<tr><td id="content-1" class="text-left"><b>'.$net_tel->name.'</b> - '.$net_tel->price.'&nbsp;Ft'.$net_tel->content.'<b><br>'.$tel_tel->name.'</b> - '.$tel_tel->price.'Ft'.$tel_tel->content.'</td> <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-1" type="submit">Érdekel</button></td> <td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($net_tel->price+$tel_tel->price).'&nbsp;Ft</b></td></tr>';
						}
						//-------------- /.Eggyel nagyobb TV -----------------
						
						//---------------- KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
						if($tr != ''){
							$table = '<div style="background: #eff; border: 1px solid green; margin-bottom: 15px;"><h3>További Internet és/vagy Telefonszolgáltatás ajánlataink</h3><table cellpadding="3" cellspacing="3" style="width: 100%; border: 1px solid gray;"><tr><th style="text-align: left;">Neve</th><th>&nbsp;</th><th style="width: 150px;">Ár (Ft)</th></tr>';
							$table .= $tr;
							$table .= '</table></div>';
						}
						//-------------- /.KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
					}
				//}
			}
			######## /.NET+TEL ###################################################################################################
			
			

			
			
			######### TV+NET+TEL ##################################################################################################
			//--- Under construction ---
			if($have_catv && $have_net && $have_tel){
				//if(!isset($pkg)){	//ha nem része csomagnak, akkor kínálja fel
					//if(isset($catv) || isset($net)){
						$tr = '';

						//-------- Az eggyel nagyobb catv és net már a $catv és a $net változókban kell, hogy legynek...
						//---------------- Eggyel nagyobb telefon ------------
						$tel = $this->Newproducts->find('all',[
							'conditions'=>[
								'headstation_id'=> $city->headstation_id,
								'id !='			=> $cur_tel->id,
								'pos >'			=> $cur_tel->pos,
								//'price >'		=> $cur_tel->price,
								'servicegroup' 	=> 4,
								'onlyInPackage'	=> 0,
								//'pkg_catv' 		=> $have_catv,
								//'pkg_net' 		=> $have_net,
								//'pkg_tel' 		=> $have_tel,
							],
							'order' => [
								'pos' 			=> 'asc'
							]
						])->first();
						//-------------- /.Eggyel nagyobb telefon ------------

						//------------- 3 variáció összeállítása -----------
						//if(isset($catv) && isset($net) && isset($tel)){
							if(isset($tel)){
								$tr .= '<tr><td id="content-1" class="text-left"><b>';
									$tr .= $cur_catv->name.'</b> - '.$cur_catv->price.'&nbsp;Ft'.$cur_catv->content.'<br>';
									$tr .= '<b>'.$cur_net->name.'</b> - '.$cur_net->price.'Ft'.$cur_net->content.'<br>';
									$tr .= '<b>'.$tel->name.'</b> - '.$tel->price.'Ft'.$tel->content.'</td>';
									$tr .= ' <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-1" type="submit">Érdekel</button></td> ';
									$tr .= '<td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($cur_catv->price+$cur_net->price+$tel->price).'&nbsp;Ft</b></td></tr>';
							}
							if(isset($net) && isset($tel)){
								$tr .= '<tr><td id="content-2" class="text-left"><b>';
									$tr .= $cur_catv->name.'</b> - '.$cur_catv->price.'&nbsp;Ft'.$cur_catv->content.'<br>';
									$tr .= '<b>'.$net->name.'</b> - '.$net->price.'Ft'.$net->content.'<br>';
									$tr .= '<b>'.$tel->name.'</b> - '.$tel->price.'Ft'.$tel->content.'</td>';
									$tr .= ' <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-2" type="submit">Érdekel</button></td> ';
									$tr .= '<td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($cur_catv->price+$net->price+$tel->price).'&nbsp;Ft</b></td></tr>';
							}
							if(isset($catv) && isset($tel)){
								$tr .= '<tr><td id="content-2" class="text-left"><b>';
									$tr .= $catv->name.'</b> - '.$catv->price.'&nbsp;Ft'.$catv->content.'<br>';
									$tr .= '<b>'.$cur_net->name.'</b> - '.$cur_net->price.'Ft'.$cur_net->content.'<br>';
									$tr .= '<b>'.$tel->name.'</b> - '.$tel->price.'Ft'.$tel->content.'</td>';
									$tr .= ' <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-3" type="submit">Érdekel</button></td> ';
									$tr .= '<td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($cur_catv->price+$net->price+$tel->price).'&nbsp;Ft</b></td></tr>';
							}
							if(isset($catv) && isset($net) && isset($tel)){
								$tr .= '<tr><td id="content-4" class="text-left"><b>';
									$tr .= $catv->name.'</b> - '.$catv->price.'&nbsp;Ft'.$catv->content.'<br>';
									$tr .= '<b>'.$net->name.'</b> - '.$net->price.'Ft'.$net->content.'<br>';
									$tr .= '<b>'.$tel->name.'</b> - '.$tel->price.'Ft'.$tel->content.'</td>';
									$tr .= ' <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-4" type="submit">Érdekel</button></td> ';
									$tr .= '<td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.($catv->price+$net->price+$tel->price).'&nbsp;Ft</b></td></tr>';
							}

						//}

						/*
							$tr .= '<tr><td class="text-left"><b>';
							//$tr .= $catv->id.' '.$net->id.' '.$tel->id.'<br>';						
							$tr .= $catv->id.' '.$net->id.' '.$tel->id.'<br>';						
							$tr .= $cur_catv->id.' '.$cur_net->id.' '.$cur_tel->id;						
							$tr .= '</td><td class="text-left"><b>Valami<b></td></tr>';
						*/

						
						
						//---------------- KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
						if($tr != ''){
							$table = '<div style="background: #eff; border: 1px solid green; margin-bottom: 15px;"><h3>További KTV+Internet+Telefonszolgáltatás ajánlataink</h3><table cellpadding="3" cellspacing="3" style="width: 100%; border: 1px solid gray;"><tr><th style="text-align: left;">Neve</th><th>&nbsp;</th><th style="width: 150px;">Ár (Ft)</th></tr>';
							$table .= $tr;
							$table .= '</table></div>';
						}
						//-------------- /.KIIRATÁS Ha van ajánlat, ami nem része csomagnak ------------
					//}
				//}

			}
			####### /.TV+NET+TEL ##################################################################################################
			


			
			
			
			
			
			
			
			
			
			

			
			###########################################################################################################################
			###########################################################################################################################
			########## CSOMAG AJÁNLATOK #############################################################################################
			###########################################################################################################################
			###########################################################################################################################
			$tr = '';

			//----------- A totál átnál KISEBB CSOMAG ÁR ------------
			$pkg = $this->Newproducts->find('all',[
				'conditions'=>[
					'price <' 		=> $sum,
					'servicegroup'	=> 8,
					'pkg_catv' 		=> $have_catv,	//
					'pkg_net' 		=> $have_net,	//
					'pkg_tel' 		=> $have_tel,
					'headstation_id'=> $city->headstation_id
				],
				//'order' => 
			])->first();
			if(isset($pkg)){
				$tr .= '<tr><td id="package-1" class="text-left"><b>'.$pkg->name.'</b> <u>csomag</u><br>'.nl2br($pkg->content).'<br>';
				if($sumdigi>0){
					$tr .= '(+a választott digitális csatornák, azaz '.$pkg->price.'&nbsp;Ft + '.$sumdigi.'&nbsp;Ft = <b>'.($pkg->price+$sumdigi).'</b>&nbsp;Ft)';
				}
				$tr .= ' <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-1" type="submit">Érdekel</button></td> ';
				$tr .= '</td><td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.$pkg->price.'&nbsp;Ft</b>';
				$tr .= '</td></tr>';
			}
			//--------- /.A totál átnál KISEBB CSOMAG ÁR ------------

			//----------- A totál átnál NAGYOBB CSOMAG ÁR ------------
			$pkg = $this->Newproducts->find('all',[
				'conditions'=>[
					'price >' 		=> $sum,
					'servicegroup'	=> 8,
					'pkg_catv' 		=> $have_catv,	//
					'pkg_net' 		=> $have_net,	//
					'pkg_tel' 		=> $have_tel,
					'headstation_id'=> $city->headstation_id
				],
			])->first();
			if(isset($pkg)){
				$tr .= '<tr><td id="package-2" class="text-left"><b>'.$pkg->name.'</b> <u>csomag</u><br>'.nl2br($pkg->content).'<br>';
				if($sumdigi>0){
					$tr .= '(+a választott digitális csatornák, azaz '.$pkg->price.'&nbsp;Ft + '.$sumdigi.'&nbsp;Ft = <b>'.($pkg->price+$sumdigi).'</b>&nbsp;Ft)';
				}
				$tr .= ' <td style="width: 120px;"><button class="btn btn-primary interest" content-id="content-2" type="submit">Érdekel</button></td> ';
				$tr .= '</td><td class="text-right" style="padding-right: 15px; font-size: 20px;"><b>'.$pkg->price.'&nbsp;Ft</b>';
				$tr .= '</td></tr>';
			}
			//--------- /.A totál átnál NAGYOBB CSOMAG ÁR ------------

			//---------- Csomag Kiiratás, ha van tétel --------------
			if($tr != ''){
				$table .= '<div style="background: #eef; border: 1px solid blue;"><h3>Csomag ajánlataink</h3><table style="width: 100%;"><tr><th style="text-align: left;">Neve</th><th>&nbsp;</th><th style="width: 150px;">Ár (Ft)</th></tr>';
				$table .= $tr;
				$table .= '</table><div>';
			}
			//-------- /.Csomag Kiiratás, ha van tétel --------------
			###########################################################################################################################
			###########################################################################################################################
			########## /.CSOMAG AJÁNLATOK #############################################################################################
			###########################################################################################################################
			###########################################################################################################################

        }

		//$table = '* * * HELLO * * *';
		//$table = $tr;
		
		$response = [
			'table'	=> $table

		];

		$this->response->body(json_encode($response));
		return $this->response;
		
	}
	
	
	
    public function individual($currentCityId=Null, $hash=Null) {
		if(isset($hash) && $hash != "egyedi-csomag-osszeallitas.html"){
			$this->redirect('/');
		}

		if($currentCityId==0){
			return $this->redirect(['action'=>'individual',72,'egyedi-csomag-osszeallitas.html']);
		}
		
		
		$this->loadModel('SzlaCities');
		try {
			$city = $this->SzlaCities->get($currentCityId);
		} catch (\Exception $e) {
			//echo 'Caught exception: ',  $e->getMessage(), "\n";
			$this->log($currentCityId." ".$hash." - ".$e->getMessage(), 'individual');
			$this->redirect('/');
		}

		$this->title = 'Egyedi csomagösszeállítás <span style="color: #ff9;">'.$city->name.'</span> településre';

		$cities = $this->SzlaCities->find('list',[
			'order'=>['SzlaCities.name'=>'asc'],
			'conditions' => ['SzlaCities.headstation_id >=' => 1]
		]);
		
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
		
		$this->set('title', $this->title);
		$this->set('services', $services);
		$this->set('city', $city);
		$this->set('cities', $cities);
		$this->set('currentCityId', $city->id);
		
	}










	
    public function index($currentCityId=Null, $service = Null) {
		
		if($currentCityId==0){
			return $this->redirect(['action'=>'index',72,'kabeltv.html']);
		}

		if($service != "csomagok.html" && $service != "kabeltv.html" && $service != "internet.html" && $service != "telefon.html"){
			$this->redirect('/');
		}

	/*
		if($currentCityId==0){
			$currentCityId=76;
		}
		*/
	
	
	$city = [];
	
	$this->loadmodel('SzlaCities');
	try {
		$city = $this->SzlaCities->get($currentCityId);
	} catch (\Exception $e) {
		//echo 'Caught exception: ',  $e->getMessage(), "\n";
		$this->log($currentCityId." ".$service." - ".$e->getMessage(), 'individual');
		$this->redirect('/');
	}

	
	
	
	/*
	try {
		if(isset($currentCityId) && $currentCityId>0){
		}
		
	} catch (\Exception $e) {
		//echo 'Caught exception: ',  $e->getMessage(), "\n"; die();
		$currentCityIds = Null;
		
	} finally {
		//echo "First finally.\n";
		
	}
	
	debug($city);
	*/
	
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
        $this->set(compact('newproducts', 'city', 'cities', 'currentCityId', 'servicegroup'));
        $this->set('_serialize', ['newproducts']);
		
		//debug($servicegroup);
		//debug($city->toArray());
		//debug($newproducts->toArray()); die();
		
    }

}
