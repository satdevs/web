<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class UploadsController extends AppController{
	public $title = "Letöltések";
	public $components = array('My');

	public function initialize(){
		parent::initialize();
		$this->set('title', $this->title);
		$this->loadComponent('RequestHandler');
	}


	public function download($hash=Null) {
		Configure::write('debug', 0); //it will avoid any extra output		
		$this->autoRender = false;
		if(!$hash){
			$this->redirect('/');
		}
		$this->loadModel('Uploads');
		$file = $this->Uploads->find()->select(['id','ext','filename'])->where(['hash'=>$hash])->toArray();
		
		if(!$file[0]['id']){
			$this->redirect('/');
		}else{
			$id         = $file[0]['id'];
			$ext        = $file[0]['ext'];
			$filename   = str_replace(" ","_",$file[0]['filename']);
			
			$path       = WWW_ROOT.'files'.DS;
			$src_filename_with_path = $path.$id.'_'.$this->My->normalizeString($filename);
			
			header('Content-Type: multipart/mixed;');
			header('Content-Disposition: attachment; filename='.$filename);
			if(file_exists($src_filename_with_path)){
				$fh = fopen( $src_filename_with_path, "r" );
				if ($fh) {
					while (($buffer = fgets($fh, 4096)) !== false) {
						echo $buffer;
					}
					fclose($fh);
				}
			}
			die();	//Ez kell, mert az autoRender nem működik sajna...
		}
	}
	
	
    public function index() {

        $optionsCurrent = [
            'limit' => 1000,
            'maxLimit' => 1000,
            'order' => [
                //'Uploads.current'  		=> 'desc',
                'Uploads.servicegroup'  => 'asc',
                'Uploads.date_from'     => 'desc',
                'Uploads.pos'           => 'asc',
                'Uploads.name'          => 'asc',
            ],
            'conditions' => [
                'Uploads.current' => 1,
                'Uploads.visible' => 1,
            ]
        ];
		
        $optionsNonCcurrent = [
            'limit' => 1000,
            'maxLimit' => 1000,
            'order' => [
                //'Uploads.current'  		=> 'desc',
                'Uploads.servicegroup'  => 'asc',
                'Uploads.date_from'     => 'desc',
                'Uploads.pos'           => 'asc',
                'Uploads.name'          => 'asc',
            ],
            'conditions' => [
                'Uploads.current' => 0,
                'Uploads.visible' => 1,
            ]
        ];
        $currents = $this->Uploads->find('all', $optionsCurrent);
        $nonCurrents = $this->Uploads->find('all', $optionsNonCcurrent);
		
		//debug($currents->toArray());
		//debug($nonCurrents->toArray());
		//die('111');
		
        $this->set(compact('currents', 'nonCurrents'));
        $this->set('_serialize', ['currents']);



/*
		$this->paginate = [
            'limit' => 1000,
            'maxLimit' => 1000,
            'order' => [
                //'Uploads.current'  		=> 'desc',
                'Uploads.servicegroup'  => 'asc',
                'Uploads.date_from'     => 'desc',
                'Uploads.pos'           => 'asc',
                'Uploads.name'          => 'asc',
            ],
            'conditions' => [
                'Uploads.current' => 1,
                'Uploads.visible' => 1,
            ]
        ];
        $uploads = $this->paginate($this->Uploads);
        $this->set(compact('uploads'));
        $this->set('_serialize', ['uploads']);
    }
*/
	
	}


}
