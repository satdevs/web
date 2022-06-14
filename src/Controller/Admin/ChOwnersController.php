<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class ChOwnersController extends AppController{
	public $title = "Csatornák - Tulajdonosok (ChOwners)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->Auth->allow(['logout','add']);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'Owners.group_id' => 'asc',
                //'Owners.name' => 'asc',                
            ],
            'conditions' => [
                //'Owners.xxx' => 1,
            ]
        ];
        $owners = $this->paginate($this->ChOwners);
        $this->set(compact('owners'));
        $this->set('_serialize', ['owners']);
    }

    public function view($id = null){
        $owner = $this->ChOwners->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Owners_' . $id . '.pdf'
        ];

/*
        Configure::write('CakePdf', array(
            'engine' => 'CakePdf.WkHtmlToPdf',
            'binary' => '/usr/local/bin/wkhtmltopdf',
            //'binary' => 'C:\\Progra~1\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            'margin' => [
                'bottom' => 5,
                'left' => 10,
                'right' => 10,
                'top' => 10
            ],
            'orientation' => 'portrait',
            'encoding'  => 'UTF-8',
            'download'  => true,
            'routes' =>true
        ));

        Configure::write('CakePdf', [
            'engine' => 'CakePdf.WkHtmlToPdf',
            //'engine' => 'CakePdf.tcpdf',
            //'binary' => '/usr/local/bin/wkhtmltopdf',
            'binary' => 'C:\\Progra~1\\wkhtmltopdf\\bin\\wkhtmltopdf.exe',
            'options' => [
                'print-media-type' => false,
                'outline' => true,
                'dpi' => 96
            ],             
            'margin' => [
                'bottom' => 5,
                'left' => 10,
                'right' => 10,
                'top' => 10
            ],
            'orientation' => 'landscape',
            'download' => true
        ]);

        $this->viewBuilder()->options([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'saghysat_'.date("Ymd_His")
            ]
        ]);
*/



        $this->set(compact('owner'));
        $this->set('_serialize', ['owner']);
    }

    public function add() {
        $owner = $this->ChOwners->newEntity();
        if ($this->request->is('post')) {
            $owner = $this->ChOwners->patchEntity($owner, $this->request->data);
            if ($this->ChOwners->save($owner)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('owner'));
        $this->set('_serialize', ['owner']);
    }

    public function edit($id = null){
        $owner = $this->ChOwners->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $owner = $this->ChOwners->patchEntity($owner, $this->request->data);
            if ($this->ChOwners->save($owner)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('owner'));
        $this->set('_serialize', ['owner']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $owner = $this->ChOwners->get($id);
        if ($this->ChOwners->delete($owner)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
