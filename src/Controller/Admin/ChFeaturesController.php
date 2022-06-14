<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class ChFeaturesController extends AppController{
	public $title = "Csatornák - Műsor jellegek (ChFeatures)";

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
                //'Features.group_id' => 'asc',
                //'Features.name' => 'asc',                
            ],
            'conditions' => [
                //'Features.xxx' => 1,
            ]
        ];
        $features = $this->paginate($this->ChFeatures);
        $this->set(compact('features'));
        $this->set('_serialize', ['features']);
    }

    public function view($id = null){
        $feature = $this->ChFeatures->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Features_' . $id . '.pdf'
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



        $this->set(compact('feature'));
        $this->set('_serialize', ['feature']);
    }

    public function add() {
        $feature = $this->ChFeatures->newEntity();
        if ($this->request->is('post')) {
            $feature = $this->ChFeatures->patchEntity($feature, $this->request->data);
            if ($this->ChFeatures->save($feature)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('feature'));
        $this->set('_serialize', ['feature']);
    }

    public function edit($id = null){
        $feature = $this->ChFeatures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feature = $this->ChFeatures->patchEntity($feature, $this->request->data);
            if ($this->ChFeatures->save($feature)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('feature'));
        $this->set('_serialize', ['feature']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $feature = $this->ChFeatures->get($id);
        if ($this->ChFeatures->delete($feature)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
