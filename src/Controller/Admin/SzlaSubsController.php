<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class SzlaSubsController extends AppController{
	public $title = "WinSzla_Web - Előfizetők (Subs)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $this->paginate = [
            //'contain' => ['SzlaCities', 'Streets', 'Banks'],
            'contain' => ['SzlaCities'],
            'limit' => 100,
            'order' => [
                //'Subs.group_id' => 'asc',
                //'Subs.name' => 'asc',                
            ],
            'conditions' => [
                //'Subs.xxx' => 1,
            ]
        ];
        $subs = $this->paginate($this->SzlaSubs);
        $this->set(compact('subs'));
        $this->set('_serialize', ['subs']);
    }

    public function view($id = null){
        $sub = $this->Subs->get($id, [
            'contain' => []
        ]);
        $cities = $this->Subs->Cities->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $streets = $this->Subs->Streets->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $banks = $this->Subs->Banks->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak

        $this->set(compact('sub', 'cities', 'streets', 'banks'));
        $this->set('_serialize', ['sub']);
    }

    public function add() {
        $sub = $this->Subs->newEntity();
        if ($this->request->is('post')) {
            $sub = $this->Subs->patchEntity($sub, $this->request->data);
            if ($this->Subs->save($sub)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $cities = $this->Subs->Cities->find('list', ['limit' => 200]);
        $streets = $this->Subs->Streets->find('list', ['limit' => 200]);
        $banks = $this->Subs->Banks->find('list', ['limit' => 200]);
        $this->set(compact('sub', 'cities', 'streets', 'banks'));
        $this->set('_serialize', ['sub']);
    }

    public function edit($id = null){
        $sub = $this->Subs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sub = $this->Subs->patchEntity($sub, $this->request->data);
            if ($this->Subs->save($sub)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $cities = $this->Subs->Cities->find('list', ['limit' => 200]);
        $streets = $this->Subs->Streets->find('list', ['limit' => 200]);
        $banks = $this->Subs->Banks->find('list', ['limit' => 200]);
        $this->set(compact('sub', 'cities', 'streets', 'banks'));
        $this->set('_serialize', ['sub']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $sub = $this->Subs->get($id);
        if ($this->Subs->delete($sub)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_subs.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Subs.id' => 'asc',
				//'Subs.xxx' => 'asc',
			],
			'conditions' => [
				//'Subs.id' => '1',
				//'Subs.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Subs->recursive = -1;
		$subs = $this->Subs->find('all',$options);
		foreach ($subs as $sub) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$sub->created = $sub->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$sub->modified = $sub->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$sub->created = $sub->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$sub->modified = $sub->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'subs';
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
		$this->set(compact('subs', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_subs.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
