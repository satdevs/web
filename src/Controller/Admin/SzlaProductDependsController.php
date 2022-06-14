<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class SzlaProductDependsController extends AppController{
	public $title = "Melyik telefon kapcsoló legyen BE-kapcsolva, melyik kapcsoló kiválasztása esetén.";

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
                //'ProductDepends.group_id' => 'asc',
                //'ProductDepends.name' => 'asc',                
            ],
            'conditions' => [
                //'ProductDepends.xxx' => 1,
            ]
        ];
        $productDepends = $this->paginate($this->SzlaProductDepends);
        $this->set(compact('productDepends'));
        $this->set('_serialize', ['productDepends']);
    }

    public function add() {
        $this->loadModel('SzlaProductDescs');
        $this->loadModel('SzlaHeadstations');
        $productDepend = $this->SzlaProductDepends->newEntity();
        if ($this->request->is('post')) {
            $productDepend = $this->SzlaProductDepends->patchEntity($productDepend, $this->request->data);
            if ($this->SzlaProductDepends->save($productDepend)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $tvs = $this->SzlaProductDescs->find( 'list', [
            'contain' => ['SzlaProducts', 'SzlaHeadstations'],
            'limit' => 500,
            'fields'=>['id','name'],
            'conditions'=>[
                'SzlaProducts.csoport' => 1,
                'SzlaHeadstations.id' => 1
            ]
        ]);
        $nets = $this->SzlaProductDescs->find( 'list', [
            'contain' => ['SzlaProducts', 'SzlaHeadstations'],
            'limit' => 500,
            'fields'=>['id','name'],
            'conditions'=>[
                'SzlaProducts.csoport' => 2,
                //'SzlaHeadstations.id' => 1
            ]
        ]);
        $tels = $this->SzlaProductDescs->find( 'list', [
            'contain' => ['SzlaProducts', 'SzlaHeadstations'],
            'limit' => 500,
            'fields'=>['id','name'],
            'conditions'=>[
                'SzlaProducts.csoport' => 4,
                //'SzlaHeadstations.id' => 1
            ]
        ]);
        $headstations = $this->SzlaHeadstations->find( 'list', [
            'limit' => 20,
            'fields'=>['id','name'],
        ]);

        //$this->set(compact('productDepend','tvs','nets','tels','headstations'));
        $this->set(compact('productDepend','headstations','tels'));
        $this->set('_serialize', ['productDepend']);
    }

    public function edit($id = null){
        $productDepend = $this->SzlaProductDepends->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productDepend = $this->SzlaProductDepends->patchEntity($productDepend, $this->request->data);
            if ($this->SzlaProductDepends->save($productDepend)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('productDepend'));
        $this->set('_serialize', ['productDepend']);
    }

    public function view($id = null){
        $productDepend = $this->SzlaProductDepends->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'ProductDepends_' . $id . '.pdf'
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



        $this->set(compact('productDepend'));
        $this->set('_serialize', ['productDepend']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $productDepend = $this->SzlaProductDepends->get($id);
        if ($this->SzlaProductDepends->delete($productDepend)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
