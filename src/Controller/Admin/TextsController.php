<?php
//namespace App\Controller;
namespace App\Controller\Admin;
//use App\Controller\AppController;
use App\Controller\Admin\AppController;

class TextsController extends AppController{
	public $title = "Szövegek";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        //$this->Auth->allow(['...']);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $this->paginate = [
            //'contain' => ['Users'],
            'limit' => 100,
            'order' => [
                'Texts.headstation_id' => 'asc',
                'Texts.servicegroup' => 'asc',                
                'Texts.id' => 'asc',                
            ],
            'conditions' => [
                //'Texts.xxx' => 1,
            ]
        ];
        $texts = $this->paginate($this->Texts);
        $this->set(compact('texts'));
        $this->set('_serialize', ['texts']);
    }

    public function view($id = null){
        $text = $this->Texts->get($id, [
            'contain' => []
        ]);
        $users = $this->Texts->Users->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Texts_' . $id . '.pdf'
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



        $this->set(compact('text', 'users'));
        $this->set('_serialize', ['text']);
    }

    public function add() {
        $this->loadModel('Postimages');
        $options = [
            'conditions' => [
                'current' => 1
            ]
        ];
        $this->Postimages->recursive = -1;
        $postimages = $this->Postimages->find('all',$options);
        $this->set('postimages',$postimages);
                
        $text = $this->Texts->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $text = $this->Texts->patchEntity($text, $this->request->data);
            if ($this->Texts->save($text)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->loadModel('SzlaOptions');
        $options = $this->SzlaOptions->find('all', [
            'limit' => 200,
            'conditions'=>['category'=>'CikkCsop'],     //1 Kábel TV, 2 Internet, 4 Telefon, 8 Akció (Csomagok), 9 Digitális
            'order'=>['oid'=>'asc'],
            'fields'=>['oid','name']
        ]);
        $itemgroups = [];
        foreach ($options as $itemgroup) {
            $itemgroups[$itemgroup->oid] = $itemgroup->name;
        }

        $users = $this->Texts->Users->find('list', ['limit' => 200]);
        $this->set(compact('text', 'users', 'itemgroups'));
        $this->set('_serialize', ['text']);
    }

    public function edit($id = null){
        $this->loadModel('Postimages');
        $options = [
            'conditions' => [
                'current' => 1
            ]
        ];
        $this->Postimages->recursive = -1;
        $postimages = $this->Postimages->find('all',$options);
        $this->set('postimages',$postimages);

        $text = $this->Texts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['user_id'] = $this->Auth->user('id');
            $text = $this->Texts->patchEntity($text, $this->request->data);
            if ($this->Texts->save($text)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }

        $this->loadModel('SzlaOptions');
        $options = $this->SzlaOptions->find('all', [
            'limit' => 200,
            'conditions'=>['category'=>'CikkCsop'],
            'order'=>['oid'=>'asc'],
            'fields'=>['oid','name']
        ]);
        $itemgroups = [];
        foreach ($options as $itemgroup) {
            $itemgroups[$itemgroup->oid] = $itemgroup->name;
        }

        $users = $this->Texts->Users->find('list', ['limit' => 200]);
        $this->set(compact('text', 'users', 'itemgroups'));
        $this->set('_serialize', ['text']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $text = $this->Texts->get($id);
        if ($this->Texts->delete($text)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_texts.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Texts.id' => 'asc',
				//'Texts.xxx' => 'asc',
			],
			'conditions' => [
				//'Texts.id' => '1',
				//'Texts.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Texts->recursive = -1;
		$texts = $this->Texts->find('all',$options);
		foreach ($texts as $text) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$text->created = $text->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$text->modified = $text->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$text->created = $text->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$text->modified = $text->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'texts';
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
		$this->set(compact('texts', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_texts.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
