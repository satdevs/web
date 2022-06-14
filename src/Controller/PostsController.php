<?php
//namespace App\Controller;
namespace App\Controller;
//use App\Controller\AppController;
use App\Controller\AppController;
use Cake\View\Helper\UrlHelper;

//use Cake\View\Helper\SessionHelper;
//use Cake\Network\Session;



class PostsController extends AppController{
	public $title = "Hírek";

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		$this->loadComponent('RequestHandler');
		$this->_validViewOptions[] = 'pdfConfig';
	}

	public function index($what = Null, $parameter_id = Null) {
		
		if ($this->RequestHandler->isRss() ) {
			$this->set('title','RSS Hírcsatorna');
			$posts = $this->Posts->find()->limit(20)->order(['created' => 'desc']);
			$this->set(compact('posts'));

			$this->set('channelData', [
				'title' => __("Legújabb cikkek"),
				'link' => '/posts',
//                'link' => $this->Url->build('/posts', true),
				'description' => __("Legújabb cikkek."),
				'language' => 'hu-hu'
			]);
		} else {
			$this->loadModel('Labels');	//Mert ez nincs összekötve a posts táblával

			//-------------------- Normál listázás KEZDŐLAPRA ---------------
			if( $what=='home' ){
				$method = "Hírek";
				$this->set('title', $method);
				$this->paginate = [
					'contain' => ['Postcategories'],
					'limit' => 5,
					'order' => [
						//'Posts.created' 	=> 'desc',
						'Posts.pos' 		=> 'asc',
						'Posts.date_from' 	=> 'desc',
					],
					'conditions' => [
					   //'Posts.postcategory_id' => $parameter_id,
					   'Posts.visible' => 1,
					   'Posts.visible_start <= CURDATE()',
					   'Posts.visible_end >= CURDATE()',
					]
				];
			}

			//-------------------- Összes hírek listázása -------------------
			if( $what=='all' ){
				$method = "Összes hír";
				$this->set('title', $method);
				$this->paginate = [
					'contain' => ['Postcategories'],
					'limit' => 10,
					'order' => [
						'Posts.pos' 		=> 'asc',
						'Posts.date_from' 	=> 'desc',
					],
					'conditions' => [
					   //'Posts.postcategory_id' => $parameter_id,
					   'Posts.visible' => 1,
					   'Posts.visible_start <= CURDATE()',
					   //'Posts.visible_end >= CURDATE()',
					]
				];
			}

			//-------------------- Cimkére való keresés ---------------------
			if( $what=='label' && $parameter_id ){
				$label = $this->Labels->get( $parameter_id );
				$method = '"'.$label->name.'" cimkére keresés'; 
				$this->set('title', $method);
				$this->set('searchtext', $label->name);
				$this->paginate = [
					'contain' => ['Postcategories'],
					'limit' => 10,
					'order' => [
						'Posts.date_from' => 'desc',
						//'Posts.created' => 'desc',
					],
					'conditions' => [
						'OR' => [
							'Posts.title LIKE' => "%".$label->name."%",
							'Posts.body LIKE' => "%".$label->name."%",
						],
					   'Posts.visible' => 1,
					   'Posts.visible_start <= CURDATE()',
					   'Posts.visible_end >= CURDATE()',
					]
				];
			}

			//-------------------- Kategóriákra való szűrés ---------------
			if( $what=='category' && $parameter_id ){
				$postcategory = $this->Posts->Postcategories->get( $parameter_id );
				$method = '"'.$postcategory->title.'" kategóriára való szűrés'; 
				$this->set('title', $method);
				$this->set('searchtext', $postcategory->title); 
				$this->paginate = [
					'contain' => ['Postcategories'],
					'limit' => 10,
					'order' => [
						'Posts.date_from' => 'desc',
						//'Posts.created' => 'desc',
					],
					'conditions' => [
					   'Posts.postcategory_id' => $parameter_id,
					   'Posts.visible' => 1,
					   'Posts.visible_start <= CURDATE()',
					   'Posts.visible_end >= CURDATE()',
					]
				];
			}
			//-------------------- Kereső mezőbe írt szöveg keresése ------
			if ($this->request->is(['post', 'put'])) {
			 	$method = "Keresés: ".$this->request->data['search'];
			 	$this->set('title', $method);
			 	//$this->set('searchtext', $this->request->data['search']);
				if($this->request->data['search'] != ''){
		 			$this->set('search', $this->request->data['search']);
					$this->paginate = [
						'contain' => ['Postcategories'],
						'limit' => 10,
						'order' => [
							'Posts.date_from' => 'desc',
							//'Posts.created' => 'desc',
						],
						'conditions' => [
							'OR' => [
								'Posts.title LIKE' => "%".str_replace(" ","%",$this->request->data['search'])."%",
								'Posts.body LIKE'  => "%".str_replace(" ","%",$this->request->data['search'])."%",
							],
						   'Posts.postcategory_id' => $parameter_id,
					   'Posts.visible' => 1,
					   'Posts.visible_start <= CURDATE()',
					   'Posts.visible_end >= CURDATE()',
						]
					];
				}
			}
			if(!isset($method)){	//Fentebb beálíltódik a változó értéke, de ha mégsem... ;-)
				$method = "";
			}
			$this->set('method',$method);	//Ezt felülírja... az alábbi...
			$this->set('title', $this->title);

			$posts = $this->paginate($this->Posts);
			$postcategories = $this->Posts->Postcategories->find('all', ['limit'=>20, 'order'=>['title'=>'asc']]);
			$labels = $this->Labels->find('all', ['limit'=>50, 'order'=>['pos'=>'asc','name'=>'asc']]);
			$this->set(compact('posts','postcategories','labels'));
			$this->set('_serialize', ['posts']);
		}
	}

	public function view($id = null){
		$post = $this->Posts->get($id, [
			'contain' => ['Postcategories']
		]);
		$users = $this->Posts->Users->find('list', ['limit' => 200]);
		$this->pdfConfig = [
			'orientation' => 'portrait',
			'filename' => 'Posts_' . $id . '.pdf'
		];
		$this->set(compact('post', 'users'));
		$this->set('_serialize', ['post']);
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

		$post = $this->Posts->newEntity();
		if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$post = $this->Posts->patchEntity($post, $this->request->data);
			if ($this->Posts->save($post)) {
				$this->Flash->success(__('Adatok mentése: Ok!'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$users = $this->Posts->Users->find('list', ['limit' => 200]);
		$this->set(compact('post'));
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
				$this->Flash->success(__('Adatok mentése: Ok!'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
			}
		}
		$users = $this->Posts->Users->find('list', ['limit' => 200]);
		$this->set(compact('post'));
		$this->set('_serialize', ['post']);
	}

	public function delete($id = null) {
		$this->request->allowMethod(['post', 'delete']);
		$post = $this->Posts->get($id);
		if ($this->Posts->delete($post)) {
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
