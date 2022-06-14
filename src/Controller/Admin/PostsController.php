<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
//use Cake\View\Helper\SessionHelper;

// Update GIT //

class PostsController extends AppController{
	public $title = "Cikkek";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		//$this->Auth->allow(['logout']);
		$this->loadComponent('RequestHandler');
		$this->_validViewOptions[] = 'pdfConfig';
	}

	public function index() {
		$this->paginate = [
			'contain' => ['Postcategories'],
			'limit' => 20,
			'order' => [
				'Posts.date_from' => 'desc',
				//'Posts.name' => 'asc',                
			],
			'conditions' => [
				//'Posts.xxx' => 1,
			]
		];
		$posts = $this->paginate($this->Posts);
		$this->set(compact('posts'));
		$this->set('_serialize', ['posts']);
	}

	public function view($id = null){
		$post = $this->Posts->get($id, [
			'contain' => []
		]);
		$users = $this->Posts->Users->find('list', ['limit' => 1]);
		$postcategories = $this->Posts->Postcategories->find('list', ['limit' => 1]);
		$this->set(compact('post', 'users','postcategories'));
		$this->set('_serialize', ['post']);
	}

	public function deleteimage($id = null){
		if(file_exists(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$id.'_big.jpg')){
			unlink(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$id.'_big.jpg');
		}
		if(file_exists(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$id.'_post.jpg')){
			unlink(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$id.'_post.jpg');
		}
		if(file_exists(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$id.'_thumb.jpg')){
			unlink(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$id.'_thumb.jpg');
		}
		$this->Flash->warning(__('Kép(ek) törölve! (Amennyiben még látszik a kép, nyomj F5-öt az oldal frissítéséhez. ;-) '));
		$this->redirect( ['controller'=>'Posts', 'action'=>'edit',$id]);
	}

	public function add(){
		$this->loadModel('Postimages');
		$options = [
			'conditions' => [
				'current' => 1
			]
		];
		$this->Postimages->recursive = -1;
		$postimages = $this->Postimages->find('all',$options);
		$this->set('postimages',$postimages);

		$post = $this->Posts->newEntity();
		if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$post = $this->Posts->patchEntity($post, $this->request->data);
			
			//debug($post);
			//die();
			
			if ($this->Posts->save($post)) {
				$id = $post->id;
				foreach ($post['files'] as $u) {   //Multi upload-hoz is jó a kódrészlet
					$tmp_name = $u['tmp_name'];
					if($tmp_name != ''){
						$src_path = WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS;
						$dest_path = $src_path;
						$name = $u['name'];
						$original_name = 'original_'.$name;
						$original_name_with_path = $dest_path.$original_name;

						if( file_exists($original_name_with_path) ){ unlink($original_name_with_path); }
						move_uploaded_file($tmp_name, $original_name_with_path);
							
						$thumb_name = $id.'_thumb.jpg';
						$post_name  = $id.'_post.jpg';
						$big_name   = $id.'_big.jpg';

						if( file_exists($dest_path.$thumb_name)){ unlink($dest_path.$thumb_name); }
						parent::resizePhoto(150, $original_name, $thumb_name, $src_path, $dest_path, 30);

						if( file_exists($dest_path.$post_name) ){ unlink($dest_path.$post_name); }
						parent::resizePhoto(375, $original_name, $post_name,  $src_path, $dest_path, 40);

						if( file_exists($dest_path.$big_name) ) { unlink($dest_path.$big_name); }
						parent::resizePhoto(800, $original_name, $big_name,   $src_path, $dest_path, 50);

						unlink($original_name_with_path);
					}
				}

				$this->Flash->success(__('Adatok mentése: Ok!'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		//$users = $this->Posts->Users->find('list', ['limit' => 200]);
		//$this->set(compact('post'));
		//$this->set('_serialize', ['post']);

		$postcategories = $this->Posts->Postcategories->find('list', ['limit' => 20]);
		//$users = $this->Posts->Users->find('list', ['limit' => 20]);
		$this->set(compact('post','postcategories'));
		$this->set('_serialize', ['post']);
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

		$post = $this->Posts->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$post = $this->Posts->patchEntity($post, $this->request->data);
			if ($this->Posts->save($post)) {

				$id = $post->id;
				foreach ($post['files'] as $u) {    //Multi upload-hoz is jó a kódrészlet
					$tmp_name = $u['tmp_name'];
					if($tmp_name != ''){
						$src_path = WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS;
						$dest_path = $src_path;
						$name = $u['name'];
						$original_name = 'original_'.$name;
						$original_name_with_path = $dest_path.$original_name;

						if( file_exists($original_name_with_path) ){ unlink($original_name_with_path); }
						move_uploaded_file($tmp_name, $original_name_with_path);
							
						$thumb_name = $id.'_thumb.jpg';
						$post_name  = $id.'_post.jpg';
						$big_name   = $id.'_big.jpg';

						if( file_exists($dest_path.$thumb_name)){ unlink($dest_path.$thumb_name); }
						parent::resizePhoto(150, $original_name, $thumb_name, $src_path, $dest_path, 30);

						if( file_exists($dest_path.$post_name) ){ unlink($dest_path.$post_name); }
						parent::resizePhoto(375, $original_name, $post_name,  $src_path, $dest_path, 40);

						if( file_exists($dest_path.$big_name) ) { unlink($dest_path.$big_name); }
						parent::resizePhoto(800, $original_name, $big_name,   $src_path, $dest_path, 50);

						unlink($original_name_with_path);
					}
				}

				$this->Flash->success(__('Adatok mentése: Ok!'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$postcategories = $this->Posts->Postcategories->find('list', ['limit' => 20]);
		//$users = $this->Posts->Users->find('list', ['limit' => 20]);
		$this->set(compact('post','postcategories'));
		$this->set('_serialize', ['post']);
	}

	public function delete($id = null) {
		$this->request->allowMethod(['post', 'delete']);
		$post = $this->Posts->get($id);
		if ($this->Posts->delete($post)) {
			$dest_path = WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS;
			$thumb_name = $id.'_thumb.jpg';
			$post_name  = $id.'_post.jpg';
			$big_name   = $id.'_big.jpg';
			if( file_exists($dest_path.$thumb_name)){ unlink($dest_path.$thumb_name); }
			if( file_exists($dest_path.$post_name) ){ unlink($dest_path.$post_name); }
			if( file_exists($dest_path.$big_name) ) { unlink($dest_path.$big_name); }
			$this->Flash->warning(__('Törlés: Ok'));
		} else {
			$this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function export_to_csv($filename="export_posts.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Posts.id' => 'asc',
				//'Posts.xxx' => 'asc',
			],
			'conditions' => [
				//'Posts.id' => '1',
				//'Posts.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Posts->recursive = -1;
		$posts = $this->Posts->find('all',$options);
		foreach ($posts as $post) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$post->created = $post->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$post->modified = $post->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$post->created = $post->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$post->modified = $post->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'posts';
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
		$this->set(compact('posts', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_posts.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
