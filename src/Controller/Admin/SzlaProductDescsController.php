<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class SzlaProductDescsController extends AppController{
	public $title = "WinSzla_Web - Termékeleírás web-re (ProductDescs)";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		$this->loadComponent('RequestHandler');
	   // $this->_validViewOptions[] = 'pdfConfig';
	}


	public function index() {
		$this->paginate = [
			'contain' => ['SzlaProducts', 'SzlaHeadstations'],
			'limit' => 100,
			'order' => [
				//'SzlaProductDescs.id'   => 'asc',
				'SzlaProductDescs.SzlaProducts.csoport' => 'desc'

				//'SzlaProductDescs.headstation_id'   => 'asc',
				//'SzlaProductDescs.servicegroup'     => 'asc',
				//'SzlaProductDescs.pos'              => 'asc',
			],
			'conditions' => [
				//'ProductDescs.xxx' => 1,
			]
		];
		$productDescs = $this->paginate($this->SzlaProductDescs);
		//foreach ($productDescs as $productDesc) {
		//	debug($productDesc);
		//}
		//debug($productDescs);
		//die();

		$this->set(compact('productDescs'));
		$this->set('_serialize', ['productDescs']);
	}

	public function view($id = null){
		$productDesc = $this->SzlaProductDescs->get($id, [
			'contain' => []
		]);
		$products = $this->SzlaProductDescs->SzlaProducts->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
		$headstations = $this->SzlaProductDescs->SzlaHeadstations->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
		$this->set(compact('productDesc', 'products', 'headstations'));
		$this->set('_serialize', ['productDesc']);
	}

	public function add() {
		$productDesc = $this->SzlaProductDescs->newEntity();
		if ($this->request->is('post')) {
			$productDesc = $this->SzlaProductDescs->patchEntity($productDesc, $this->request->data);
			if ($this->SzlaProductDescs->save($productDesc)) {
				$this->Flash->success(__('Adatok mentése: Ok!'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		
		$this->loadModel('SzlaOptions');
		$products = $this->SzlaProductDescs->SzlaProducts->find('list', ['limit' => 500]);
		$headstations = $this->SzlaProductDescs->SzlaHeadstations->find('list', ['limit' => 20]);
		$options = $this->SzlaOptions->find('all', [
			'limit' => 200,
			'conditions'=>['category'=>'CikkCsop'],
			'order'=>['oid'=>'asc'],
			'fields'=>['oid','name']
		]);
		$itemgroups = [];
		foreach ($options as $itemgroup) {
			$itemgroups[$itemgroup->oid] = $itemgroup->name;
		}

		//dump($itemgroups);
		//die();
		$this->set(compact('productDesc', 'products', 'headstations', 'itemgroups'));
		$this->set('_serialize', ['productDesc']);
	}

	public function edit($id = null){
		$productDesc = $this->SzlaProductDescs->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$productDesc = $this->SzlaProductDescs->patchEntity($productDesc, $this->request->data);
			if ($this->SzlaProductDescs->save($productDesc)) {
				$this->Flash->success(__('Adatok mentése: Ok!'));
				return $this->redirect(['action' => 'index']);
				//return $this->redirect(['action' => 'edit', $id+1]);	//Sorbamegy a következőre
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$this->loadModel('SzlaOptions');
		$products = $this->SzlaProductDescs->SzlaProducts->find('list', ['limit' => 500]);
		$headstations = $this->SzlaProductDescs->SzlaHeadstations->find('list', ['limit' => 20]);
		$options = $this->SzlaOptions->find('all', [
			'limit' => 200,
			'conditions'=>['category'=>'CikkCsop'],
			'order'=>['oid'=>'asc'],
			'fields'=>['oid','name']
		]);
		$itemgroups = [];
		foreach ($options as $itemgroup) {
			$itemgroups[$itemgroup->oid] = $itemgroup->name;
		}
		$this->set(compact('productDesc', 'products', 'headstations', 'itemgroups'));
		$this->set('_serialize', ['productDesc']);
/*
		//$products = $this->SzlaProductDescs->Products->find('list', ['limit' => 200]);
		//$headstations = $this->SzlaProductDescs->Headstations->find('list', ['limit' => 200]);
		$products = $this->SzlaProductDescs->SzlaProducts->find('list', ['limit' => 500]);
		$headstations = $this->SzlaProductDescs->SzlaHeadstations->find('list', ['limit' => 200]);
		$this->set(compact('productDesc', 'products', 'headstations'));
		$this->set('_serialize', ['productDesc']);
*/
	}

	public function delete($id = null) {
		$this->request->allowMethod(['post', 'delete']);
		$productDesc = $this->SzlaProductDescs->get($id);
		if ($this->SzlaProductDescs->delete($productDesc)) {
			$this->Flash->warning(__('Törlés: Ok'));
		} else {
			$this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function export_to_csv($filename="export_productDescs.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'ProductDescs.id' => 'asc',
				//'ProductDescs.xxx' => 'asc',
			],
			'conditions' => [
				//'ProductDescs.id' => '1',
				//'ProductDescs.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->SzlaProductDescs->recursive = -1;
		$productDescs = $this->SzlaProductDescs->find('all',$options);
		foreach ($productDescs as $productDesc) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$productDesc->created = $productDesc->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$productDesc->modified = $productDesc->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$productDesc->created = $productDesc->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$productDesc->modified = $productDesc->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'productDescs';
		$_header 		=  [ 'ID', 'headstation_id', 'product_id', 'Name', 'Created', 'Modified' ];
		//$_footer 		= [''];	//Ha kell, be kell illeszteni a compact()-ba
		$_extract 		= [ 'id', 'headstation_id', 'product_id', 'name', 'created', 'modified' ];
		//$_delimiter 	= chr(9); //Ha a TAB kellene ... (Kívánt rész törlendő ;-)
		$_delimiter 	= ';';
		$_enclosure 	= '"';
		$_newline 		= "\r\n";
		$_eol 			= "\r\n";
		$_bom 			= true;
		$this->response->download($filename);
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('productDescs', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_productDescs.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
