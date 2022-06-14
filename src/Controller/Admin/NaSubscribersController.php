<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class NaSubscribersController extends AppController{
	public $title = "Netadmin - előfizetők (Subscribers)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function index() {
        $this->paginate = [
            //'contain' => ['Radii'],
            //'contain' => [],
            'limit' => 100,
            'order' => [
                //'NaSubscribers.group_id' => 'asc',
                //'NaSubscribers.name' => 'asc',                
            ],
            'conditions' => [
                //'Subscribers.xxx' => 1,
            ]
        ];
        $subscribers = $this->paginate($this->NaSubscribers);
        $this->set(compact('subscribers'));
        $this->set('_serialize', ['subscribers']);
    }

    public function view($id = null){
        $subscriber = $this->Subscribers->get($id, [
            'contain' => []
        ]);

/*
        $radii = $this->Subscribers->Radii->find('list', ['limit' => 20]);    //10, azaz csak 1, mert az input-ok disabled-ben vannak
        $this->set(compact('subscriber', 'radii'));
*/
        $this->set(compact('subscriber'));
        $this->set('_serialize', ['subscriber']);
    }

    public function add() {
        $subscriber = $this->Subscribers->newEntity();
        if ($this->request->is('post')) {
            $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->data);
            if ($this->Subscribers->save($subscriber)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }

        //$radii = $this->Subscribers->Radii->find('list', ['limit' => 200]);
        //$this->set(compact('subscriber', 'radii'));
        $this->set(compact('subscriber'));
        $this->set('_serialize', ['subscriber']);
    }

    public function edit($id = null){
        $subscriber = $this->Subscribers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscriber = $this->Subscribers->patchEntity($subscriber, $this->request->data);
            if ($this->Subscribers->save($subscriber)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        //$radii = $this->Subscribers->Radii->find('list', ['limit' => 200]);
        //$this->set(compact('subscriber', 'radii'));
        $this->set(compact('subscriber'));
        $this->set('_serialize', ['subscriber']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $subscriber = $this->Subscribers->get($id);
        if ($this->Subscribers->delete($subscriber)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_subscribers.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Subscribers.id' => 'asc',
				//'Subscribers.xxx' => 'asc',
			],
			'conditions' => [
				//'Subscribers.id' => '1',
				//'Subscribers.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Subscribers->recursive = -1;
		$subscribers = $this->Subscribers->find('all',$options);
		foreach ($subscribers as $subscriber) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$subscriber->created = $subscriber->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$subscriber->modified = $subscriber->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$subscriber->created = $subscriber->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$subscriber->modified = $subscriber->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'subscribers';
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
		$this->set(compact('subscribers', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_subscribers.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
