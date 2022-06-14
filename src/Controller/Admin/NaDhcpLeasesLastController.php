<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class NaDhcpLeasesLastController extends AppController{
	public $title = "DhcpLeasesLast";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'DhcpLeasesLast.group_id' => 'asc',
                //'DhcpLeasesLast.name' => 'asc',                
            ],
            'conditions' => [
                //'DhcpLeasesLast.xxx' => 1,
            ]
        ];
        $dhcpLeasesLast = $this->paginate($this->NaDhcpLeasesLast);
        $this->set(compact('dhcpLeasesLast'));
        $this->set('_serialize', ['dhcpLeasesLast']);
    }

    public function view($id = null){
        $dhcpLeasesLast = $this->NaDhcpLeasesLast->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'DhcpLeasesLast_' . $id . '.pdf'
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



        $this->set(compact('dhcpLeasesLast'));
        $this->set('_serialize', ['dhcpLeasesLast']);
    }

    public function add() {
        $dhcpLeasesLast = $this->NaDhcpLeasesLast->newEntity();
        if ($this->request->is('post')) {
            $dhcpLeasesLast = $this->NaDhcpLeasesLast->patchEntity($dhcpLeasesLast, $this->request->data);
            if ($this->NaDhcpLeasesLast->save($dhcpLeasesLast)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('dhcpLeasesLast'));
        $this->set('_serialize', ['dhcpLeasesLast']);
    }

    public function edit($id = null){
        $dhcpLeasesLast = $this->NaDhcpLeasesLast->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dhcpLeasesLast = $this->NaDhcpLeasesLast->patchEntity($dhcpLeasesLast, $this->request->data);
            if ($this->NaDhcpLeasesLast->save($dhcpLeasesLast)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('dhcpLeasesLast'));
        $this->set('_serialize', ['dhcpLeasesLast']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $dhcpLeasesLast = $this->NaDhcpLeasesLast->get($id);
        if ($this->NaDhcpLeasesLast->delete($dhcpLeasesLast)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_dhcpLeasesLast.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'DhcpLeasesLast.id' => 'asc',
				//'DhcpLeasesLast.xxx' => 'asc',
			],
			'conditions' => [
				//'DhcpLeasesLast.id' => '1',
				//'DhcpLeasesLast.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->NaDhcpLeasesLast->recursive = -1;
		$dhcpLeasesLast = $this->NaDhcpLeasesLast->find('all',$options);
		foreach ($dhcpLeasesLast as $dhcpLeasesLast) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$dhcpLeasesLast->created = $dhcpLeasesLast->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$dhcpLeasesLast->modified = $dhcpLeasesLast->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$dhcpLeasesLast->created = $dhcpLeasesLast->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$dhcpLeasesLast->modified = $dhcpLeasesLast->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'dhcpLeasesLast';
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
		$this->set(compact('dhcpLeasesLast', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_dhcpLeasesLast.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
