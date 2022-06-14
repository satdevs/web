<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class SzlaAkciosController extends AppController{
	public $title = "WinSzla_Web - Akciók (Akcios)";

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
                //'Akcios.group_id' => 'asc',
                //'Akcios.name' => 'asc',                
            ],
            'conditions' => [
                //'Akcios.xxx' => 1,
            ]
        ];
        $akcios = $this->paginate($this->SzlaAkcios);
        $this->set(compact('akcios'));
        $this->set('_serialize', ['akcios']);
    }

    public function view($id = null){
        $akcio = $this->Akcios->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Akcios_' . $id . '.pdf'
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



        $this->set(compact('akcio'));
        $this->set('_serialize', ['akcio']);
    }

    public function add() {
        $akcio = $this->Akcios->newEntity();
        if ($this->request->is('post')) {
            $akcio = $this->Akcios->patchEntity($akcio, $this->request->data);
            if ($this->Akcios->save($akcio)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('akcio'));
        $this->set('_serialize', ['akcio']);
    }

    public function edit($id = null){
        $akcio = $this->Akcios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $akcio = $this->Akcios->patchEntity($akcio, $this->request->data);
            if ($this->Akcios->save($akcio)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('akcio'));
        $this->set('_serialize', ['akcio']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $akcio = $this->Akcios->get($id);
        if ($this->Akcios->delete($akcio)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_akcios.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Akcios.id' => 'asc',
				//'Akcios.xxx' => 'asc',
			],
			'conditions' => [
				//'Akcios.id' => '1',
				//'Akcios.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Akcios->recursive = -1;
		$akcios = $this->Akcios->find('all',$options);
		foreach ($akcios as $akcio) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$akcio->created = $akcio->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$akcio->modified = $akcio->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$akcio->created = $akcio->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$akcio->modified = $akcio->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'akcios';
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
		$this->set(compact('akcios', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_akcios.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
