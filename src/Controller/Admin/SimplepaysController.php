<?php
namespace App\Controller\Admin;
//namespace App\Controller\Admin;
use App\Controller\AppController;
//use App\Controller\Admin\AppController;

class SimplepaysController extends AppController{
	public $title = "Simplepays";

	

    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'Simplepays.group_id' => 'asc',
                //'Simplepays.name' => 'asc',                
            ],
            'conditions' => [
                //'Simplepays.xxx' => 1,
            ]
        ];
        $simplepays = $this->paginate($this->Simplepays);
        $this->set(compact('simplepays'));
        $this->set('_serialize', ['simplepays']);
    }

    public function view($id = null){
        $simplepay = $this->Simplepays->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Simplepays_' . $id . '.pdf'
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



        $this->set(compact('simplepay'));
        $this->set('_serialize', ['simplepay']);
    }

    public function add() {
        $simplepay = $this->Simplepays->newEntity();
        if ($this->request->is('post')) {
            $simplepay = $this->Simplepays->patchEntity($simplepay, $this->request->data);
            if ($this->Simplepays->save($simplepay)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('simplepay'));
        $this->set('_serialize', ['simplepay']);
    }

    public function edit($id = null){
        $simplepay = $this->Simplepays->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $simplepay = $this->Simplepays->patchEntity($simplepay, $this->request->data);
            if ($this->Simplepays->save($simplepay)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('simplepay'));
        $this->set('_serialize', ['simplepay']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $simplepay = $this->Simplepays->get($id);
        if ($this->Simplepays->delete($simplepay)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
