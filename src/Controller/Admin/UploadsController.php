<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

class UploadsController extends AppController{
	public $title = "Feltöltések";
    public $components = array('My');

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
                'Uploads.current'  		=> 'desc',
                'Uploads.servicegroup'  => 'asc',
                'Uploads.date_from'     => 'desc',
                'Uploads.pos'           => 'asc',
            ],
            'conditions' => [
                //'Uploads.xxx' => 1,
            ]
        ];
        $uploads = $this->paginate($this->Uploads);
        $this->set(compact('uploads'));
        $this->set('_serialize', ['uploads']);
    }

    public function view($id = null){
        $upload = $this->Uploads->get($id, [
            'contain' => []
        ]);
        $this->set(compact('upload'));
        $this->set('_serialize', ['upload']);
    }


    public function add() {
        $upload = $this->Uploads->newEntity();
		
        if ($this->request->is('post')) {
			
			$upload = $this->Uploads->patchEntity($upload, $this->request->data);
			
            if ($this->Uploads->save($upload)) {
                $saveError = 0; //Files upload
                if(isset($upload['files'])){
                    foreach ($upload['files'] as $u):
					
                        $tmp_name = $u['tmp_name'];
                        $dest_path = WWW_ROOT.'uploads'.DS;
                        if(!file_exists($dest_path)){ 
                            mkdir($dest_path);
                        }
                        $upload->filename   = str_replace(" ","_",$u['name']);
                        $upload->ext = pathinfo($u['name'], PATHINFO_EXTENSION);
                        $upload->hash = str_replace( "-", strtolower($this->My->generateRandomString(16)), Text::uuid() );
                        //$file_with_path = $dest_path.$upload->id.'.'.$upload->ext;
                        $file_with_path = WWW_ROOT.'files'.DS.$upload->id.'_'.$this->My->normalizeString($upload->filename);
                        move_uploaded_file($tmp_name, $file_with_path);
						
						//debug( file_exists($file_with_path) );
						//debug($upload); 
						//die();
						
                        if( file_exists($file_with_path) ){
                            if (!$this->Uploads->save($upload)) {
                                $saveError++;
                            }
                        }
                    endforeach;
                }
                if(!$saveError){
                    $this->Flash->success(__('Adatok mentése: Ok!'));
                }else{
                    $this->Flash->success(__('nem sikerült a file feltöltése!'));
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('upload'));
        $this->set('_serialize', ['upload']);
    }

    public function edit($id = null){
        $upload = $this->Uploads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $upload = $this->Uploads->patchEntity($upload, $this->request->data);
            if ($this->Uploads->save($upload)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('upload'));
        $this->set('_serialize', ['upload']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $upload = $this->Uploads->get($id);
        $file_with_path = WWW_ROOT.'files'.DS.$upload['id'].'_'.$this->My->normalizeString($upload['filename']);
        if(file_exists($file_with_path)){
            unlink($file_with_path);
        }
        if ($this->Uploads->delete($upload)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

}
