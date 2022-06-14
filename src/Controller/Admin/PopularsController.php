<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class PopularsController extends AppController{
	public $title = "Populars";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'Populars.group_id' => 'asc',
                //'Populars.name' => 'asc',                
            ],
            'conditions' => [
                //'Populars.xxx' => 1,
            ]
        ];
        $populars = $this->paginate($this->Populars);
        $this->set(compact('populars'));
        $this->set('_serialize', ['populars']);
    }

    public function add() {
        $popular = $this->Populars->newEntity();
        if ($this->request->is('post')) {
            $popular = $this->Populars->patchEntity($popular, $this->request->data);
            if ($this->Populars->save($popular)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set('_serialize', ['popular']);
    }

    public function edit($id = null){
        $popular = $this->Populars->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $popular = $this->Populars->patchEntity($popular, $this->request->data);
            if ($this->Populars->save($popular)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set('_serialize', ['popular']);
    }

    public function view($id = null){
        $popular = $this->Populars->get($id, [
            'contain' => []
        ]);
        $this->set('_serialize', ['popular']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $popular = $this->Populars->get($id);
        if ($this->Populars->delete($popular)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
