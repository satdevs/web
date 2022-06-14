<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
//use Cake\ORM\Table;
use Cake\Database\Expression\QueryExpression;


class PostimagesController extends AppController{
	public $title = "Cikk fotók";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        //$this->Auth->allow(['logout']);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function setAllCurrentOff() {
        $postimages = TableRegistry::get('Postimages');
        $postimages->query()->update()->set(['current'=>0])->where(['current'=>1])->execute();
        $this->Flash->success(__('Jelölők 0-ra állítva: OK!'));
        return $this->redirect(['action' => 'index']);
    }

    public function ajaxchangecurrent() {
        $this->autoRender = false;
        Configure::write('debug', 0); //it will avoid any extra output
        if ($this->request->is(['post', 'ajax'])) {
            $this->response->disableCache();
            $postimagesTable = TableRegistry::get('Postimages');
            $data = $this->request->input('json_decode');
            $postimage = $this->Postimages->get($data->id);
            $postimage->id = $data->id;
            if($postimage->current==0){
                $postimage->current = 1;
            }else{
                $postimage->current = 0;
            }
            $postimagesTable->save($postimage);            
            $this->response->body(json_encode($postimage->current));
            return $this->response;
        }
    }
    public function ajaxupdatetitle() {
        $this->autoRender = false;
        Configure::write('debug', 0); //it will avoid any extra output
        if ($this->request->is(['post', 'ajax'])) {
            $this->response->disableCache();
            $postimagesTable = TableRegistry::get('Postimages');
            $data = $this->request->input('json_decode');
            $postimage = $postimagesTable->get( $data->id );
            $postimage->id = $data->id;
            $postimage->title = $data->title;
            $postimagesTable->save($postimage);
            //$this->set(compact('postimage'));
            $this->response->body(json_encode($data));
            return $this->response;
        }
    }

    public function add() {
        $postimage = $this->Postimages->newEntity();
        if ($this->request->is('post')) {
            $postimage = $this->Postimages->patchEntity($postimage, $this->request->data);
            //echo "<pre>";
            //print_r($this->request->data);
            //print_r($postimage);
            //die();
            $postimagesTable = TableRegistry::get('Postimages');
            //Images upload
            $saveError = 0;
            if(isset($postimage['files'])){
                foreach ($postimage['files'] as $u):
                    $tmp_name = $u['tmp_name'];
                    $src_path = WWW_ROOT.'images'.DS.'uploads'.DS.'postimages'.DS;
                    $dest_path = $src_path;
                    $name = $u['name'];
                    $original_name = 'original_'.$name;
                    $original_name_with_path = $dest_path.$original_name;
                    move_uploaded_file($tmp_name, $original_name_with_path);
                    if( file_exists($original_name_with_path) ){
                        $postimage = $postimagesTable->newEntity();
                        $postimage->title    = $name;
                        $postimage->filename    = $name;
                        $postimage->current     = 1;
                        if (!$postimagesTable->save($postimage)) {
                            $saveError++;
                        }else{
                            $id = $postimage->id;
                            $big_name   = $id.'_big.jpg';
                            $thumb_name = $id.'_thumb.jpg';
                            parent::resizePhoto(150, $original_name, $thumb_name, $src_path, $dest_path, 30);
                            parent::resizePhoto(800, $original_name, $big_name,   $src_path, $dest_path, 30);
                        }
                        unlink($original_name_with_path);
                    }
                endforeach;
            }

            if (!$saveError) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Nem mindegyik képet sikerült menteni! Kérlek ellenőrizd! (Sikertelen feltöltés: '.$saveError.')'));
            }
        }
        $this->set(compact('postimage'));
        $this->set('_serialize', ['postimage']);
    }

    public function index($current=1) {
        //$this->paginate['contain']      = ['Groups'];
        $this->paginate['limit']        = 20;
        $this->paginate['orders']       = ['Postimages.id'=>'asc'];
        if($current<=1){
            $this->paginate['conditions']   = ['Postimages.current'=>$current];
        }

        $postimages = $this->paginate($this->Postimages);
        $this->set(compact('postimages'));
        $this->set('_serialize', ['postimages']);
        $this->set('current', $current);
    }

    public function view($id = null){
        $postimage = $this->Postimages->get($id, [
            'contain' => []
        ]);
        $this->pdfConfig = [
            'orientation' => 'portrait',
            'filename' => 'Postimages_' . $id . '.pdf'
        ];
        $this->set(compact('postimage'));
        $this->set('_serialize', ['postimage']);
    }

    public function edit($id = null){
        $postimage = $this->Postimages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postimage = $this->Postimages->patchEntity($postimage, $this->request->data);
            if ($this->Postimages->save($postimage)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('postimage'));
        $this->set('_serialize', ['postimage']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $postimage = $this->Postimages->get($id);
        if ($this->Postimages->delete($postimage)) {
            //--- Delete images ---
            $file_with_path = WWW_ROOT.'images'.DS.'uploads'.DS.'postimages'.DS.$id.'_thumb.jpg';
            if( file_exists($file_with_path) ){
                unlink($file_with_path);
            }
            $file_with_path = WWW_ROOT.'images'.DS.'uploads'.DS.'postimages'.DS.$id.'_big.jpg';
            if( file_exists($file_with_path) ){
                unlink($file_with_path);
            }
            //--- /Delete images ---
            $this->Flash->warning(__('Törlés: Ok '));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_postimages.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Postimages.id' => 'asc',
				//'Postimages.xxx' => 'asc',
			],
			'conditions' => [
				//'Postimages.id' => '1',
				//'Postimages.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Postimages->recursive = -1;
		$postimages = $this->Postimages->find('all',$options);
		foreach ($postimages as $postimage) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$postimage->created = $postimage->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$postimage->modified = $postimage->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$postimage->created = $postimage->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$postimage->modified = $postimage->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'postimages';
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
		$this->set(compact('postimages', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_postimages.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
