<?php
//namespace App\Controller;
namespace App\Controller\Admin;
//use App\Controller\AppController;
use App\Controller\Admin\AppController;

class GroupsController extends AppController{
	public $title = "Felhasználói csoportok";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->Auth->allow(['logout','add']);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $groups = $this->paginate($this->Groups);
        $this->set(compact('groups'));
        $this->set('_serialize', ['groups']);
    }

    public function view($id = null){
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Groups_' . $id . '.pdf'
        ];
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    public function add() {
        $group = $this->Groups->newEntity();
        if ($this->request->is('post')) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    public function edit($id = null){
        $group = $this->Groups->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->Groups->patchEntity($group, $this->request->data);
            if ($this->Groups->save($group)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('group'));
        $this->set('_serialize', ['group']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $group = $this->Groups->get($id);
        if ($this->Groups->delete($group)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_groups.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Groups.id' => 'asc',
				//'Groups.xxx' => 'asc',
			],
			'conditions' => [
				//'Groups.id' => '1',
				//'Groups.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Groups->recursive = -1;
		$groups = $this->Groups->find('all',$options);
		foreach ($groups as $group) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$group->created = $group->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$group->modified = $group->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$group->created = $group->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$group->modified = $group->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'groups';
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
		$this->set(compact('groups', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_groups.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
