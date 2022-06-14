<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class NewproductsController extends AppController{
	public $title = "Szolgáltatásaink, csomagjaink";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		//$this->Auth->allow(['logout']);
		$this->loadComponent('RequestHandler');
		$this->_validViewOptions[] = 'pdfConfig';
	}
	
    public function index() {
        $this->paginate = [
            'contain' => ['SzlaHeadstations'],
            'limit' => 100,
            'order' => [
				//-- Rögzítéskor hasznos---
				//'Newproducts.modified' => 'desc',
				//--/Rögzítéskor hasznos---
				
				//-- Listázás üzemeltetéskor --
                'Newproducts.headstation_id' => 'asc',
                'Newproducts.servicegroup' => 'asc',
                'Newproducts.pos' => 'asc',
				//-- /Listázás üzemeltetéskor ---
				
            ],
            'conditions' => [
                //'Newproducts.xxx' => 1,
            ]
        ];
        $newproducts = $this->paginate($this->Newproducts);
        $this->set(compact('newproducts'));
        $this->set('_serialize', ['newproducts']);
    }

    public function add() {
        $newproduct = $this->Newproducts->newEntity();
        if ($this->request->is('post')) {
            $newproduct = $this->Newproducts->patchEntity($newproduct, $this->request->data);
            if ($this->Newproducts->save($newproduct)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $headstations = $this->Newproducts->SzlaHeadstations->find('list', ['limit' => 200]);
        $this->set(compact('newproduct', 'headstations'));
        $this->set('_serialize', ['newproduct']);
    }

    public function edit($id = null){
        $newproduct = $this->Newproducts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newproduct = $this->Newproducts->patchEntity($newproduct, $this->request->data);
            if ($this->Newproducts->save($newproduct)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $headstations = $this->Newproducts->SzlaHeadstations->find('list', ['limit' => 200]);
        $this->set(compact('newproduct', 'headstations'));
        $this->set('_serialize', ['newproduct']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $newproduct = $this->Newproducts->get($id);
        if ($this->Newproducts->delete($newproduct)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
