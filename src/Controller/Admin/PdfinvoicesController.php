<?php
namespace App\Controller\Admin;
//use App\Controller\AppController;
use App\Controller\Admin\AppController;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Utility\Xml;
use Cake\Core\Configure;

class PdfinvoicesController extends AppController{
	public $title 		= "PDF Számla igénylése";
	public $finish 		= false;
	public $debug 		= false;
	public $onlyForMe 	= false;


    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        //$this->Auth->allow(['getPdfInvoices','setStatus']);
    }


	// https://trinitytuts.com/tips/create-xml-sitemap-cakephp-3/ innem talán valamit
	//https://saghysat.hu/admin/pdfinvoices/getPdfInvoices/Activated
	//https://saghysat.hu/admin/pdfinvoices/getPdfInvoices/DeActivated
	//https://saghysat.hu/admin/pdfinvoices/getPdfInvoices/setStatus/68b38ff189ubzh6fa72189ubzh6f4ebe89ubzh6f927d89ubzh6f229015d719fb/1
/*
	PdfSzlaIgenyUserName / PdfSzlaIgenyPassword
	winktv@saghysat.hu / FdfMqhhxad3D
*/
    public function setStatus($id=Null, $status=Null){
		if($id==Null || strlen($id)!=64){
			die();
		}
		if($status==Null){
			die();
		}

		//http://saghysat.loc/admin/pdfinvoices/setStatus/68b38ff189ubzh6fa72189ubzh6f4ebe89ubzh6f927d89ubzh6f229015d719fb/1

		//$pdfinvoicesTable = TableRegistry::getTableLocator()->get('Pdfinvoices');
		$pdfinvoicesTable = TableRegistry::get('Pdfinvoices');
		$pdfinvoice = $pdfinvoicesTable->get($id);
		if($status==1){
			$pdfinvoice->processed_activate 	= new Time( date("Y-m-d H:i:s") );	// Bootstrapban beáűllítva a timezone Budapestre
		}
		if($status==2){
			$pdfinvoice->processed_deactivate 	= new Time( date("Y-m-d H:i:s") );	// Bootstrapban beáűllítva a timezone Budapestre
		}
		if($status==3){
			$pdfinvoice->processed_errorStatus 	= new Time( date("Y-m-d H:i:s") );	// Bootstrapban beáűllítva a timezone Budapestre
		}
		$pdfinvoicesTable->save($pdfinvoice);
		die('OK');
	}

    public function getPdfInvoices($param=Null){
		Configure::write('debug', true); //it will avoid any extra output
		$ret = [];
		$xml = '';
		$i=1;
		$news = Null;

		if($param=='Activated'){
			$news = $this->Pdfinvoices->find('all', [
				'conditions'=>['activated Is Not Null', 'deactivated Is Null', 'processed_activate Is Null', 'processed_errorStatus Is Null'],
				'fields'=>['sub_id','name','city','address','email','phone','cb1','cb2','cb3','cb4','cb5','id','hash','taxnumber','type','activated','deactivated']]
			);
		}
		if($param=='DeActivated'){
			$news = $this->Pdfinvoices->find('all', [
				'conditions'=>['activated Is Not Null', 'deactivated Is Not Null', 'processed_activate Is Null', 'processed_errorStatus Is Null'],
				'fields'=>['sub_id','name','city','address','email','phone','cb1','cb2','cb3','cb4','cb5','id','hash','taxnumber','type','activated','deactivated']]
			);
		}

		$news = $news->toArray();
		$this->set('news', $news);
	}

    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                'Pdfinvoices.processed_activate' => 'asc',
                'Pdfinvoices.processed' 		 => 'asc',
                'Pdfinvoices.activates' 		 => 'desc',
            ],
            'conditions' => [
                //'Pdfinvoices.xxx' => 1,
            ]
        ];
        $pdfinvoices = $this->paginate($this->Pdfinvoices);
        $this->set(compact('pdfinvoices'));
        $this->set('_serialize', ['pdfinvoices']);
    }

    public function view($id = null){
        $pdfinvoice = $this->Pdfinvoices->get($id, [
            'contain' => []
        ]);
        $subs = $this->Pdfinvoices->Subs->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Pdfinvoices_' . $id . '.pdf'
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



        $this->set(compact('pdfinvoice', 'subs'));
        $this->set('_serialize', ['pdfinvoice']);
    }

    public function add() {
        $pdfinvoice = $this->Pdfinvoices->newEntity();
        if ($this->request->is('post')) {
            $pdfinvoice = $this->Pdfinvoices->patchEntity($pdfinvoice, $this->request->data);
            if ($this->Pdfinvoices->save($pdfinvoice)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $subs = $this->Pdfinvoices->Subs->find('list', ['limit' => 200]);
        $this->set(compact('pdfinvoice', 'subs'));
        $this->set('_serialize', ['pdfinvoice']);
    }

    public function edit($id = null){
        $pdfinvoice = $this->Pdfinvoices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pdfinvoice = $this->Pdfinvoices->patchEntity($pdfinvoice, $this->request->data);
            if ($this->Pdfinvoices->save($pdfinvoice)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $subs = $this->Pdfinvoices->Subs->find('list', ['limit' => 200]);
        $this->set(compact('pdfinvoice', 'subs'));
        $this->set('_serialize', ['pdfinvoice']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $pdfinvoice = $this->Pdfinvoices->get($id);
        if ($this->Pdfinvoices->delete($pdfinvoice)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
