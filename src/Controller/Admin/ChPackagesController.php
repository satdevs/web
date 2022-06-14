<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class ChPackagesController extends AppController{
	public $title = "Packages";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    public function edit($id = null){

        //debug($this->request->data);
        //die();

        $package = $this->ChPackages->get($id, [
            'contain' => ['ChPrograms']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $package = $this->ChPackages->patchEntity($package, $this->request->data);

            //debug($package);
            //die();            

            if ($this->ChPackages->save($package)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $headstations = $this->ChPackages->SzlaHeadstations->find('list', ['limit' => 20]);
        $ch_programs = $this->ChPackages->ChPrograms->find('list', ['limit' => 400]);

        //$selected = $this->ChPackages->ChPackagesPrograms->find('all', ['limit' => 400, 'conditions'=>['package_id'=>$id]]);

        //$selected = $this->ChPackages->ChPackagesPrograms->find('all', ['limit' => 400, 'conditions'=>['package_id'=>$id]]);
        //foreach ($selected as $s) {
        //    debug($s);
        //}
        //debug($ch_programs);
        //die();


        $this->set(compact('package', 'headstations', 'ch_programs', 'selected'));
        $this->set('_serialize', ['package']);
    }


    public function index() {
        $this->paginate = [
            'contain' => ['SzlaHeadstations'],
            'limit' => 100,
            'order' => [
                'ChPackages.headstation_id' => 'asc',
                'ChPackages.packagegroup' => 'asc',
                //'Packages.name' => 'asc',                
            ],
            'conditions' => [
                //'Packages.xxx' => 1,
            ]
        ];
        $packages = $this->paginate($this->ChPackages);
        $this->set(compact('packages'));
        $this->set('_serialize', ['packages']);
    }


    public function add() {
        $package = $this->ChPackages->newEntity();
        if ($this->request->is('post')) {
            $package = $this->ChPackages->patchEntity($package, $this->request->data);
            if ($this->ChPackages->save($package)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $headstations = $this->ChPackages->SzlaHeadstations->find('list', ['limit' => 20]);
        $ch_programs = $this->ChPackages->ChPrograms->find('list', ['limit' => 400]);
        //$selected = $this->ChPackages->ChPackagesPrograms->find('all', ['limit' => 400, 'conditions'=>['package_id'=>$id]]);
        $this->set(compact('package', 'headstations', 'ch_programs','selected'));
        $this->set('_serialize', ['package']);

/*       
        $headstations = $this->ChPackages->SzlaHeadstations->find('list', ['limit' => 20]);
        //$exts = $this->ChPackages->Exts->find('list', ['limit' => 200]);
        $programs = $this->ChPackages->ChPrograms->find('list', ['limit' => 400]);
        $this->set(compact('package', 'headstations', 'programs'));
        $this->set('_serialize', ['package']);
*/
    }



    public function view($id = null){
        $package = $this->ChPackages->get($id, [
            'contain' => ['ChPrograms']
        ]);
        $headstations = $this->ChPackages->SzlaHeadstations->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        //$exts = $this->ChPackages->Exts->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $programs = $this->ChPackages->ChPrograms->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak

        $this->set(compact('package', 'headstations', 'programs'));
        $this->set('_serialize', ['package']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $package = $this->ChPackages->get($id);
        if ($this->ChPackages->delete($package)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
