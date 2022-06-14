<?php
//namespace App\Controller;
namespace App\Controller\Admin;
//use App\Controller\AppController;
use App\Controller\Admin\AppController;

class PostcategoriesController extends AppController{
	public $title = "Cikk kategóriák";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		//$this->Auth->allow(['logout','add']);
		$this->loadComponent('RequestHandler');
		$this->_validViewOptions[] = 'pdfConfig';
	}

	public function index() {
		$postcategories = $this->paginate($this->Postcategories);
		$this->set(compact('postcategories'));
		$this->set('_serialize', ['postcategories']);
	}

	public function view($id = null){
		$postcategory = $this->Postcategories->get($id, [
			'contain' => []
		]);
		$this->pdfConfig = [
			'orientation' => 'portrait',
			'filename' => 'Postcategories_' . $id . '.pdf'
		];
		$this->set(compact('postcategory'));
		$this->set('_serialize', ['postcategory']);
	}

	public function add() {
		$postcategory = $this->Postcategories->newEntity();
		if ($this->request->is('post')) {
			$postcategory = $this->Postcategories->patchEntity($postcategory, $this->request->data);
			if ($this->Postcategories->save($postcategory)) {
				if(isset($postcategory['files'])):
					foreach ($postcategory['files'] as $u):    //Egyszer fut csak le, mert ...
						$tmp_name = $u['tmp_name'];
						if($u['tmp_name'] != ''){
							$src_path = WWW_ROOT.'images'.DS.'uploads'.DS.'postcategories'.DS;
							$dest_path = $src_path;
							$name = $u['name'];
							$ext = pathinfo($name, PATHINFO_EXTENSION);
							$postcategory->avatar_ext = $ext;
							$ext = strtolower($ext);
							if($ext == 'jpg' || $ext == 'jpeg' ){
								$ext = 'jpg';
								$thumb_name = $postcategory->id."_thumb.jpg";
								$big_name   = $postcategory->id."_big.jpg";
								$original_name = $postcategory->id.'.'.$ext;
								$original_name_with_path = $dest_path.$original_name;
								if(move_uploaded_file($tmp_name, $original_name_with_path )){
									parent::resizePhoto(150, $original_name, $thumb_name, $src_path, $dest_path, 30);
									parent::resizePhoto(400, $original_name, $big_name,   $src_path, $dest_path, 30);   //400 magas, remélhetőleg 750 széles ;-)
									if(file_exists($original_name_with_path)){
										unlink($original_name_with_path);                                    
									}
									$this->Flash->success(__('Adatok mentése: Ok!'));
								}else{
									$this->Flash->warning(__('Hibás a feltöltött kép! Adatok mentve: Ok!'));
								}
							}else{
								$this->Flash->error(__('Adatok mentése: NEM Ok! Kérem nézze át az adatokat s próbálja újra!'));
							}
						}
					endforeach;
				endif;
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$this->set(compact('postcategory'));
		$this->set('_serialize', ['postcategory']);
	}

	public function edit($id = null){
		$postcategory = $this->Postcategories->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$postcategory = $this->Postcategories->patchEntity($postcategory, $this->request->data);
			if ($this->Postcategories->save($postcategory)) {
				foreach ($postcategory['files'] as $u):    //Egyszer fut csak le, mert ...
					$tmp_name = $u['tmp_name'];
					if($u['tmp_name'] != ''){
						$src_path = WWW_ROOT.'images'.DS.'uploads'.DS.'postcategories'.DS;
						$dest_path = $src_path;
						$name = $u['name'];
						$ext = pathinfo($name, PATHINFO_EXTENSION);
						$postcategory->avatar_ext = $ext;
						$ext = strtolower($ext);
						if($ext == 'jpg' || $ext == 'jpeg' ){
							$ext = 'jpg';
							$thumb_name = $postcategory->id."_thumb.jpg";
							$big_name   = $postcategory->id."_big.jpg";
							if(file_exists($dest_path.$thumb_name)){    //Ha ott lenne, akkor törli és helyére teszi az újat
								unlink($dest_path.$thumb_name);
							}
							if(file_exists($dest_path.$big_name)){      //Ha ott lenne, akkor törli és helyére teszi az újat
								unlink($dest_path.$big_name);
							}
							$original_name = $postcategory->id.'.'.$ext;
							$original_name_with_path = $dest_path.$original_name;
							if(move_uploaded_file($tmp_name, $original_name_with_path )){
								parent::resizePhoto(150, $original_name, $thumb_name, $src_path, $dest_path, 30);
								parent::resizePhoto(400, $original_name, $big_name,   $src_path, $dest_path, 30);   //400 magas, remélhetőleg 750 széles ;-)
								if(file_exists($original_name_with_path)){
									unlink($original_name_with_path);                                    
								}
								$this->Flash->success(__('Adatok mentése: Ok!'));
							}else{
								$this->Flash->warning(__('Hibás a feltöltött kép! Adatok mentve: Ok!'));
							}
						}else{	// $ext
							$this->Flash->error(__('Adatok mentése: NEM Ok! Kérem nézze át az adatokat s próbálja újra!'));
						}
					}
				endforeach;
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$this->set(compact('postcategory'));
		$this->set('_serialize', ['postcategory']);
	}

	public function delete($id = null) {
		$this->request->allowMethod(['post', 'delete']);
		$postcategory = $this->Postcategories->get($id);
		if ($this->Postcategories->delete($postcategory)) {
			$path = WWW_ROOT.'images'.DS.'uploads'.DS.'postcategories'.DS;
			$thumb_name = $id."_thumb.jpg";
			$big_name   = $id."_big.jpg";
			if(file_exists($path.$thumb_name)){    //Ha ott lenne, akkor törli és helyére teszi az újat
				unlink($path.$thumb_name);
			}
			if(file_exists($path.$big_name)){      //Ha ott lenne, akkor törli és helyére teszi az újat
				unlink($path.$big_name);
			}
			$this->Flash->warning(__('Törlés: Ok'));
		} else {
			$this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function export_to_csv($filename="export_postcategories.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Postcategories.id' => 'asc',
				//'Postcategories.xxx' => 'asc',
			],
			'conditions' => [
				//'Postcategories.id' => '1',
				//'Postcategories.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Postcategories->recursive = -1;
		$postcategories = $this->Postcategories->find('all',$options);
		foreach ($postcategories as $postcategory) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$postcategory->created = $postcategory->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$postcategory->modified = $postcategory->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$postcategory->created = $postcategory->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$postcategory->modified = $postcategory->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'postcategories';
		$_header 		=  [ 'ID', 'Name', 'Created', 'Modified' ];
		//$_footer 		= [''];	//Ha kell, be kell illeszteni a compact()-ba
		$_extract 		= [ 'id', 'name', 'created', 'modified' ];
		//$_delimiter 	= chr(9); //Ha a TAB kellene ... (Kívánt rész törlendő ;-)
		$_delimiter 	= ';';
		$_enclosure 	= '"';
		$_newline 		= "\r\n";
		$_eol 			= "\r\n";
		$_bom 			= true;
		$this->response->download($filename);
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('postcategories', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_postcategories.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
