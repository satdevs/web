<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class LabelsController extends AppController{
	public $title = "Cimke felhő";

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
                //'Labels.group_id' => 'asc',
                //'Labels.name' => 'asc',                
            ],
            'conditions' => [
                //'Labels.xxx' => 1,
            ]
        ];
        $labels = $this->paginate($this->Labels);
        $this->set(compact('labels'));
        $this->set('_serialize', ['labels']);
    }

    public function view($id = null){
        $label = $this->Labels->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Labels_' . $id . '.pdf'
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



        $this->set(compact('label'));
        $this->set('_serialize', ['label']);
    }

    public function add() {
        $label = $this->Labels->newEntity();
        if ($this->request->is('post')) {
            $label = $this->Labels->patchEntity($label, $this->request->data);
            if ($this->Labels->save($label)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('label'));
        $this->set('_serialize', ['label']);
    }

    public function edit($id = null){
        $label = $this->Labels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $label = $this->Labels->patchEntity($label, $this->request->data);
            if ($this->Labels->save($label)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('label'));
        $this->set('_serialize', ['label']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $label = $this->Labels->get($id);
        if ($this->Labels->delete($label)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_labels.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Labels.id' => 'asc',
				//'Labels.xxx' => 'asc',
			],
			'conditions' => [
				//'Labels.id' => '1',
				//'Labels.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Labels->recursive = -1;
		$labels = $this->Labels->find('all',$options);
		foreach ($labels as $label) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$label->created = $label->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$label->modified = $label->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$label->created = $label->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$label->modified = $label->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'labels';
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
		$this->set(compact('labels', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_labels.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
