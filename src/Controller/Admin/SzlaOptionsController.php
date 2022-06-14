<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class SzlaOptionsController extends AppController{
	public $title = "WinSzla_WEB - Combo-Opciók (SzlaOptions) - Legördülő lista sorai";

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
                //'Options.group_id' => 'asc',
                //'Options.name' => 'asc',                
            ],
            'conditions' => [
                //'Options.xxx' => 1,
            ]
        ];
        $options = $this->paginate($this->SzlaOptions);
        $this->set(compact('options'));
        $this->set('_serialize', ['options']);
    }

    public function add() {
        $option = $this->SzlaOptions->newEntity();
        if ($this->request->is('post')) {
            $option = $this->SzlaOptions->patchEntity($option, $this->request->data);
            if ($this->SzlaOptions->save($option)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('option'));
        $this->set('_serialize', ['option']);
    }

    public function edit($id = null){
        $option = $this->SzlaOptions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $option = $this->SzlaOptions->patchEntity($option, $this->request->data);
            if ($this->SzlaOptions->save($option)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('option'));
        $this->set('_serialize', ['option']);
    }

    public function view($id = null){
        $option = $this->SzlaOptions->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Options_' . $id . '.pdf'
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



        $this->set(compact('option'));
        $this->set('_serialize', ['option']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $option = $this->SzlaOptions->get($id);
        if ($this->SzlaOptions->delete($option)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
