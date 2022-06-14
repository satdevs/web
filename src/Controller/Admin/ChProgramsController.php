<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class ChProgramsController extends AppController{
	public $title = "Channels - Műsorok (ChPrograms)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    public function edit($id = null){

        //debug($this->request->data);
        //die();

        $program = $this->ChPrograms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $program = $this->ChPrograms->patchEntity($program, $this->request->data);
			
                //debug($program);
                //debug($this->request->data);
                //die();

			$program->logo_file = $this->request->data['files']['name'];
				
            if ($this->ChPrograms->save($program)) {

				if(!file_exists(WWW_ROOT."images".DS."logo")){
					mkdir(WWW_ROOT."images".DS."logo");
				}
				if(file_exists(WWW_ROOT."images".DS."logo".DS.$this->request->data['files']['name'])){
					unlink(WWW_ROOT."images".DS."logo".DS.$this->request->data['files']['name']);
				}
				
				move_uploaded_file($this->request->data['files']['tmp_name'], WWW_ROOT."images".DS."logo".DS.$this->request->data['files']['name']);
				
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $owners = $this->ChPrograms->ChOwners->find('list', ['limit' => 400]);        
        $features = $this->ChPrograms->ChFeatures->find('list', ['limit' => 400]);        
        //$ch_packages = $this->ChPrograms->ChPackages->find('list', ['limit' => 400]);        

//        $selected = $this->ChPrograms->ChPackagesPrograms->find('all', ['limit' => 400, 'conditions'=>['program_id'=>$id]])->select(['package_id']);
//        $sel = [];
//        foreach ($selected as $s) {
//            $sel[$s->package_id] = $s->package_id;
//        }
//        debug($sel);
        //die();

        $ch_packages = $this->ChPrograms->ChPackages->find('list', ['limit' => 200]);
        $this->set(compact('program', 'owners', 'features', 'ch_packages'));
        $this->set('_serialize', ['program']);
    }


    public function index() {
        $this->paginate = [
            'contain' => ['ChOwners','ChFeatures'],
            'limit' => 200,
            'order' => [
                //'Programs.group_id' => 'asc',
                //'Programs.name' => 'asc',                
            ],
            'conditions' => [
                //'Programs.xxx' => 1,
            ]
        ];
        $programs = $this->paginate($this->ChPrograms);
        $this->set(compact('programs'));
        $this->set('_serialize', ['programs']);
    }

    public function view($id = null){
        $program = $this->ChPrograms->get($id, [
            'contain' => []
        ]);
        $ch_packages = $this->ChPrograms->ChPackages->find('list', ['limit' => 400]);        
        $this->set(compact('program', 'ch_packages'));
        $this->set('_serialize', ['program']);
    }

    public function add() {
        $program = $this->ChPrograms->newEntity();
        if ($this->request->is('post')) {
            $program = $this->ChPrograms->patchEntity($program, $this->request->data);
            if ($this->ChPrograms->save($program)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $owners = $this->ChPrograms->ChOwners->find('list', ['limit' => 400]);        
        $features = $this->ChPrograms->ChFeatures->find('list', ['limit' => 400]);        
        $ch_packages = $this->ChPrograms->ChPackages->find('list', ['limit' => 400]);        
        $this->set(compact('program', 'ch_packages', 'features', 'owners','selected'));
        $this->set('_serialize', ['program']);
    }


/*
    public function view($id = null){
        $program = $this->ChPrograms->get($id, [
            'contain' => []
        ]);
        $ch_packages = $this->ChPrograms->ChPackages->find('list', ['limit' => 400]);        
        $this->set(compact('program', 'ch_packages'));
        $this->set('_serialize', ['program']);
    }
*/
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $program = $this->ChPrograms->get($id);
        //if ($this->ChPrograms->delete($program)) {
        //    $this->Flash->warning(__('Törlés: Ok'));
        //} else {
        //    $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        //}
		$this->Flash->error(__('Itt nem értelmezett a törlés funkció. Azt a CHANNELS-be tedd meg!'));
        return $this->redirect(['action' => 'index']);
    }
}
