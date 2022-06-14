<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class InternetextrasController extends AppController{
	public $title 	= "Internet Extra 1000 Mbps igénylések";


    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        //$this->Auth->allow(['getPdfInvoices','setStatus']);
    }



    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'Internetextras.group_id' => 'asc',
                //'Internetextras.name' => 'asc',
                'Internetextras.created' => 'desc',
            ],
            'conditions' => [
                //'Internetextras.xxx' => 1,
            ]
        ];
        $internetextras = $this->paginate($this->Internetextras);
        $this->set(compact('internetextras'));
        $this->set('_serialize', ['internetextras']);
    }

    public function view($id = null){
        $internetextra = $this->Internetextras->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Internetextras_' . $id . '.pdf'
        ];
        $this->set(compact('internetextra'));
        $this->set('_serialize', ['internetextra']);
    }

    public function add() {
        $internetextra = $this->Internetextras->newEntity();
        if ($this->request->is('post')) {
            $internetextra = $this->Internetextras->patchEntity($internetextra, $this->request->data);
            if ($this->Internetextras->save($internetextra)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('internetextra'));
        $this->set('_serialize', ['internetextra']);
    }

    public function edit($id = null){
        $internetextra = $this->Internetextras->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $internetextra = $this->Internetextras->patchEntity($internetextra, $this->request->data);
            if ($this->Internetextras->save($internetextra)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('internetextra'));
        $this->set('_serialize', ['internetextra']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $internetextra = $this->Internetextras->get($id);
        if ($this->Internetextras->delete($internetextra)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
