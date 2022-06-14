<?php
//namespace App\Controller;
namespace App\Controller\Admin;
//use App\Controller\AppController;
use App\Controller\Admin\AppController;

class MessagethemesController extends AppController{
	public $title = "Üzenet témák";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->Auth->allow(['logout','add']);
    }

    public function index() {
        $messagethemes = $this->paginate($this->Messagethemes);
        $this->set(compact('messagethemes'));
        $this->set('_serialize', ['messagethemes']);
    }

    public function view($id = null){
        $messagetheme = $this->Messagethemes->get($id, [
            'contain' => []
        ]);
        $this->set(compact('messagetheme'));
        $this->set('_serialize', ['messagetheme']);
    }

    public function add() {
        $messagetheme = $this->Messagethemes->newEntity();
        if ($this->request->is('post')) {
            $messagetheme = $this->Messagethemes->patchEntity($messagetheme, $this->request->data);
            if ($this->Messagethemes->save($messagetheme)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('messagetheme'));
        $this->set('_serialize', ['messagetheme']);
    }

    public function edit($id = null){
        $messagetheme = $this->Messagethemes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messagetheme = $this->Messagethemes->patchEntity($messagetheme, $this->request->data);
            if ($this->Messagethemes->save($messagetheme)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('messagetheme'));
        $this->set('_serialize', ['messagetheme']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $messagetheme = $this->Messagethemes->get($id);
        if ($this->Messagethemes->delete($messagetheme)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
