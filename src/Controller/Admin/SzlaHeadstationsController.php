<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class SzlaHeadstationsController extends AppController{
	public $title = "WinSzla_Web - Fejállomások (Headstations)";

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
                //'Headstations.group_id' => 'asc',
                //'Headstations.name' => 'asc',                
            ],
            'conditions' => [
                //'Headstations.xxx' => 1,
            ]
        ];
        $headstations = $this->paginate($this->SzlaHeadstations);
        $this->set(compact('headstations'));
        $this->set('_serialize', ['headstations']);
    }

    public function view($id = null){
        $headstation = $this->Headstations->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Headstations_' . $id . '.pdf'
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



        $this->set(compact('headstation'));
        $this->set('_serialize', ['headstation']);
    }

    public function add() {
        $headstation = $this->Headstations->newEntity();
        if ($this->request->is('post')) {
            $headstation = $this->Headstations->patchEntity($headstation, $this->request->data);
            if ($this->Headstations->save($headstation)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('headstation'));
        $this->set('_serialize', ['headstation']);
    }

    public function edit($id = null){
        $headstation = $this->Headstations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $headstation = $this->Headstations->patchEntity($headstation, $this->request->data);
            if ($this->Headstations->save($headstation)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('headstation'));
        $this->set('_serialize', ['headstation']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $headstation = $this->Headstations->get($id);
        if ($this->Headstations->delete($headstation)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_headstations.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Headstations.id' => 'asc',
				//'Headstations.xxx' => 'asc',
			],
			'conditions' => [
				//'Headstations.id' => '1',
				//'Headstations.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Headstations->recursive = -1;
		$headstations = $this->Headstations->find('all',$options);
		foreach ($headstations as $headstation) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$headstation->created = $headstation->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$headstation->modified = $headstation->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$headstation->created = $headstation->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$headstation->modified = $headstation->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'headstations';
        $_header 		=  [ 'ID', 'Name', 'Created', 'Modified' ];
        //$_footer 		= [''];	//Ha kell, be kell illeszteni a compact()-ba
        $_extract 		= [ 'id', 'name', 'created', 'modified' ];
        //$_delimiter 	= chr(9); //Ha a TAB kellene ... (Kívánt rész törlendő ;-)
        $_delimiter 	= ';';
		$_enclosure 	= '"';
		$_newline 		= "\r\n";
		$_eol 			= "\r\n";
		$_bom 			= true;
		$this->response->download($filename);
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('headstations', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_headstations.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
