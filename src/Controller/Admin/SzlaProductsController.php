<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;
//use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class SzlaProductsController extends AppController{
	public $title = "WinSzla_Web - Termékek (Products)";

    public function products_prices(){
        $this->loadModel('SzlaAkcios');
        //$total_posts = $this->Labels->find()->where(['readed'=>0])->count();
        $akcios = $this->SzlaAkcios->find()
                                    //->select(['id','focikk','cikk','akcios_kedv','duo_kedv','trio_kedv'])
                                    ->select(['focikk','cikk'])
                                    //->extract(['focikk'])
                                    //->order(['pos' => 'ASC', 'name'=>'ASC'])
                                    //->where(['focikk'=>321])
                                    //->distinct(['focikk'])
                                    //->limit(50)
                                    ->toArray();
                                    ;
        //$query = $SzlaAkcios->find()->where(['focikk'=>321]);

//        debug($akcios);
//        die();

        foreach ($akcios as $akcio) {
            $focikkek[] = $akcio->focikk;
            //echo $akcio->focikk;
            //echo "<br>";
        }

        $options = ['conditions'=>['id IN'=>$focikkek]];
        $products = $this->SzlaProducts->find('all',$options);

        foreach ($products as $product) {
            echo $product->id;
            echo "<br>";
        }


/*
        $products = $this->SzlaProducts->find()
                                    ->select(['id'])
                                    //->select(['focikk'])
                                    //->order(['pos' => 'ASC', 'name'=>'ASC'])
                                    //->limit(50)
                                    ->where(function ($exp, $q) {
                                        return $exp->in('id', $focikkek);
                                    })
                                    ->toArray();
/*
    $query = $cities->find()
    ->where(function ($exp, $q) {
        return $exp->in('country_id', ['AFG', 'USA', 'EST']);
    });
*/

//        debug($products);
        //debug($focikkek);
//        die();

    }




    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function index($itj=null) {
        $this->paginate = [
            'limit' => 100,
            'order' => [
                //'SzlaProducts.group_id' => 'asc',
                //'SzlaProducts.name' => 'asc',                
            ],
            'conditions' => [
                'SzlaProducts.status' => 1
            ]
        ];
        if($itj){
            $this->paginate = [
                'limit' => 100,
                'order' => [
                    //'SzlaProducts.group_id' => 'asc',
                    //'SzlaProducts.name' => 'asc',                
                ],
                'conditions' => [
                    'SzlaProducts.status' => 1,
                    'SzlaProducts.itj' => $itj,
                ]
            ];
        }
        $products = $this->paginate($this->SzlaProducts);
        $this->set(compact('products'));
        $this->set('_serialize', ['products']);
    }

    public function view($id = null){
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }

    public function add() {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }

    public function edit($id = null){
        $product = $this->Products->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $this->set(compact('product'));
        $this->set('_serialize', ['product']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }

	public function export_to_csv($filename="export_products.csv") {
		$options = [
			//'limit'	=> 100,
			'order' => [
				'Products.id' => 'asc',
				//'Products.xxx' => 'asc',
			],
			'conditions' => [
				//'Products.id' => '1',
				//'Products.xxx' => 'asc',
			],
			//'fields' => ['id','name','created','modified']
		];
		$this->Products->recursive = -1;
		$products = $this->Products->find('all',$options);
		foreach ($products as $product) {
			//----------------------------------------------------------------------- Ha ez a formátum kellene -----------
			//$product->created = $product->created->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//$product->modified = $product->modified->i18nFormat('yyyy.MM.dd. HH:mm:ss');
			//---------------------------------------------------------------- Excelhez ez a jó(jobb) formátum -----------
			$product->created = $product->created->i18nFormat('yyyy-MM-dd HH:mm:ss');
			$product->modified = $product->modified->i18nFormat('yyyy-MM-dd HH:mm:ss');
		}
		$_serialize 	= 'products';
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
		$this->set(compact('products', '_serialize', '_delimiter', '_enclosure', '_newline', '_eol', '_bom', '_header', '_extract'));
	}


	public function export_to_excel($filename="export_products.xlsx") {
		//Ide jön a megvalósítása. Egyelőre ez nem megy... Composer nem találja meg a dolgokat
	}

}
