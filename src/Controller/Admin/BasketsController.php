<?php
//namespace App\Controller;
namespace App\Controller\Admin;
//use App\Controller\AppController;
use App\Controller\Admin\AppController;

class BasketsController extends AppController{
	public $title = "Érdeklődések (kosár)";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		//$this->Auth->allow(['index','individual']);
		$this->loadComponent('RequestHandler');
		//$this->_validViewOptions[] = 'pdfConfig';
	}
	
	
    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'Baskets.group_id' => 'asc',
                //'Baskets.name' => 'asc',                
                'Baskets.status' => 'asc',
                'Baskets.id' => 'desc',
            ],
            'conditions' => [
                //'Baskets.xxx' => 1,
            ]
        ];
        $baskets = $this->paginate($this->Baskets);
        $this->set(compact('baskets'));
        $this->set('_serialize', ['baskets']);
    }

    public function view($id = null){
        $basket = $this->Baskets->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Baskets_' . $id . '.pdf'
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



        $this->set(compact('basket'));
        $this->set('_serialize', ['basket']);
    }

    public function add() {
        $basket = $this->Baskets->newEntity();
        if ($this->request->is('post')) {
            $basket = $this->Baskets->patchEntity($basket, $this->request->data);
            if ($this->Baskets->save($basket)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('basket'));
        $this->set('_serialize', ['basket']);
    }

    public function edit($id = null){
        $basket = $this->Baskets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $basket = $this->Baskets->patchEntity($basket, $this->request->data);
            if ($this->Baskets->save($basket)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('basket'));
        $this->set('_serialize', ['basket']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $basket = $this->Baskets->get($id);
        if ($this->Baskets->delete($basket)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
