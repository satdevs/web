<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class ChBandsController extends AppController{
	public $title = "Csatornák - Frekvenciák (ChBands)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->Auth->allow(['logout','add']);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }


    public function index() {
        $this->paginate = [
            'limit' => 200,
            'order' => [
                'ChBands.video_frequency' => 'asc',
                //'ChBands.name' => 'asc',
                //'ChBands.row' => 'asc',                
            ],
            'conditions' => [
                //'Bands.xxx' => 1,
            ]
        ];
        $bands = $this->paginate($this->ChBands);
        $this->set(compact('bands'));
        $this->set('_serialize', ['bands']);
    }

    public function view($id = null){
        $band = $this->ChBands->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Bands_' . $id . '.pdf'
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



        $this->set(compact('band'));
        $this->set('_serialize', ['band']);
    }

    public function add() {
        $band = $this->ChBands->newEntity();
        if ($this->request->is('post')) {
            $band = $this->ChBands->patchEntity($band, $this->request->data);
            if ($this->ChBands->save($band)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('band'));
        $this->set('_serialize', ['band']);
    }

    public function edit($id = null){
        $band = $this->ChBands->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $band = $this->ChBands->patchEntity($band, $this->request->data);
            if ($this->ChBands->save($band)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('band'));
        $this->set('_serialize', ['band']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $band = $this->ChBands->get($id);
        if ($this->ChBands->delete($band)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
