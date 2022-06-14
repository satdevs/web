<?php
namespace App\Controller;
//namespace App\Controller\Admin;
use App\Controller\AppController;
//use App\Controller\Admin\AppController;

class SimplepayErrorcodesController extends AppController{
	public $title = "SimplepayErrorcodes";

/*
    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'SimplepayErrorcodes.group_id' => 'asc',
                //'SimplepayErrorcodes.name' => 'asc',                
            ],
            'conditions' => [
                //'SimplepayErrorcodes.xxx' => 1,
            ]
        ];
        $simplepayErrorcodes = $this->paginate($this->SimplepayErrorcodes);
        $this->set(compact('simplepayErrorcodes'));
        $this->set('_serialize', ['simplepayErrorcodes']);
    }

    public function view($id = null){
        $simplepayErrorcode = $this->SimplepayErrorcodes->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'SimplepayErrorcodes_' . $id . '.pdf'
        ];
		$this->set(compact('simplepayErrorcode'));
        $this->set('_serialize', ['simplepayErrorcode']);
    }
	
    public function add() {
        $simplepayErrorcode = $this->SimplepayErrorcodes->newEntity();
        if ($this->request->is('post')) {
            $simplepayErrorcode = $this->SimplepayErrorcodes->patchEntity($simplepayErrorcode, $this->request->data);
            if ($this->SimplepayErrorcodes->save($simplepayErrorcode)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('simplepayErrorcode'));
        $this->set('_serialize', ['simplepayErrorcode']);
    }

    public function edit($id = null){
        $simplepayErrorcode = $this->SimplepayErrorcodes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $simplepayErrorcode = $this->SimplepayErrorcodes->patchEntity($simplepayErrorcode, $this->request->data);
            if ($this->SimplepayErrorcodes->save($simplepayErrorcode)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('simplepayErrorcode'));
        $this->set('_serialize', ['simplepayErrorcode']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $simplepayErrorcode = $this->SimplepayErrorcodes->get($id);
        if ($this->SimplepayErrorcodes->delete($simplepayErrorcode)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
*/	
}
