<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class InterestdetailsController extends AppController{
	public $title = "Érdeklődés tételek - (Interestdetails)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        //$this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Interests'],
            'limit' => 100,
            'order' => [
                //'Interestdetails.group_id' => 'asc',
                //'Interestdetails.name' => 'asc',                
            ],
            'conditions' => [
                //'Interestdetails.xxx' => 1,
            ]
        ];
        $interestdetails = $this->paginate($this->Interestdetails);
        $this->set(compact('interestdetails'));
        $this->set('_serialize', ['interestdetails']);
    }

    public function add() {
        $interestdetail = $this->Interestdetails->newEntity();
        if ($this->request->is('post')) {
            $interestdetail = $this->Interestdetails->patchEntity($interestdetail, $newinterestdetail);
            if ($this->Interestdetails->save($interestdetail)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $interests = $this->Interestdetails->Interests->find('list', ['limit' => 200]);
        $this->set(compact('interestdetail', 'interests', 'productdescs', 'products'));
        $this->set('_serialize', ['interestdetail']);
    }

    public function edit($id = null){
        $interestdetail = $this->Interestdetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $interestdetail = $this->Interestdetails->patchEntity($interestdetail, $this->request->data);
            if ($this->Interestdetails->save($interestdetail)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $interests = $this->Interestdetails->Interests->find('list', ['limit' => 200]);
        $productdescs = $this->Interestdetails->Productdescs->find('list', ['limit' => 200]);
        $products = $this->Interestdetails->Products->find('list', ['limit' => 200]);
        $this->set(compact('interestdetail', 'interests', 'productdescs', 'products'));
        $this->set('_serialize', ['interestdetail']);
    }

    public function view($id = null){
        $interestdetail = $this->Interestdetails->get($id, [
            'contain' => []
        ]);
        $interests = $this->Interestdetails->Interests->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $productdescs = $this->Interestdetails->Productdescs->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $products = $this->Interestdetails->Products->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Interestdetails_' . $id . '.pdf'
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



        $this->set(compact('interestdetail', 'interests', 'productdescs', 'products'));
        $this->set('_serialize', ['interestdetail']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $interestdetail = $this->Interestdetails->get($id);
        if ($this->Interestdetails->delete($interestdetail)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
