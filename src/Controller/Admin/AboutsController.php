<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class AboutsController extends AppController{
	public $title = "Alapadatok";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->Auth->allow(['logout','add']);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $abouts = $this->paginate($this->Abouts);
        $this->set(compact('abouts'));
        $this->set('_serialize', ['abouts']);
    }

    public function view($id = null){
        $about = $this->Abouts->get($id, [
            'contain' => []
        ]);
        $this->set(compact('about'));
        $this->set('_serialize', ['about']);
    }

    public function add() {
        $about = $this->Abouts->newEntity();
        if ($this->request->is('post')) {
            $about = $this->Abouts->patchEntity($about, $this->request->data);
            if ($this->Abouts->save($about)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('about'));
        $this->set('_serialize', ['about']);
    }

    public function edit($id = null){
        $about = $this->Abouts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $about = $this->Abouts->patchEntity($about, $this->request->data);
            if ($this->Abouts->save($about)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'edit', $id]);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('about'));
        $this->set('_serialize', ['about']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $about = $this->Abouts->get($id);
        if ($this->Abouts->delete($about)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_abouts.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Abouts.id' => 'asc',
				//'Abouts.xxx' => 'asc',
			],
			'conditions' => [
				//'Abouts.id' => '1',
				//'Abouts.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Abouts->recursive = -1;
		$abouts = $this->Abouts->find('all',$options);
		foreach ($abouts as $about) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$about->created = $about->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$about->modified = $about->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$about->created = $about->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$about->modified = $about->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'abouts';
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
		$this->set(compact('abouts', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_abouts.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
