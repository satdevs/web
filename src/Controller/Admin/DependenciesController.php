<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class DependenciesController extends AppController{
	public $title = "Telefon függőségek - Mikor jelenhet meg az adott telefonszolgáltatás";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->Auth->allow(['logout','add']);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

	
    public function index() {
        $this->paginate = [
            'contain' => ['Catvs', 'Nets', 'Tels'],
            'limit' => 100,
            'order' => [
                //'Dependencies.group_id' => 'asc',
                //'Dependencies.name' => 'asc',                
            ],
            'conditions' => [
                //'Dependencies.xxx' => 1,
            ]

        ];
        $dependencies = $this->paginate($this->Dependencies);
		
		//debug($dependencies->toArray()); die();
		
        $this->set(compact('dependencies'));
        $this->set('_serialize', ['dependencies']);
    }

    public function add() {
        $dependency = $this->Dependencies->newEntity();
        if ($this->request->is('post')) {
            $dependency = $this->Dependencies->patchEntity($dependency, $this->request->data);
			$dependency->name='';
            if ($this->Dependencies->save($dependency)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
		$this->loadModel('Newproducts');
		
/*
		if(isset($_COOKIE['currentCityId'])){
			$city_id = $_COOKIE['currentCityId'];			
		}else{
			$city_id = 72;	//Babarc
		}
		
		$this->loadModel('SzlaCities');
		$city = $this->SzlaCities->findById($city_id)->first();
		
		$headstation_id = $city->headstation_id;
		if(!isset($headstation_id)){
			$headstation_id = 1;	//Ha nem lenne
		}		
		
		
        //$lists = $this->Newproducts->find('all', ['conditions' => ['servicegroup'=>1, 'headstation_id' => $headstation_id], 'order'=>['pos'=>'asc']]);
        $lists = $this->Newproducts->find('all', ['conditions' => [ 'servicegroup'=>1, 'headstation_id <='=>2 ], 'order'=>[ 'headstation_id'=>'asc', 'pos'=>'asc'] ]);
			
		$catvs[0] = '---';
		foreach($lists as $list){
			if($list->headstation_id==1){
				$catvs[$list->id] = $list->name.' (Bóly)';
			}
			if($list->headstation_id==2){
				$catvs[$list->id] = $list->name.' (Felsőszentiván)';
			}
		}

        $lists = $this->Newproducts->find('all', ['conditions' => [ 'servicegroup'=>2, 'headstation_id <='=>2 ], 'order'=>[ 'headstation_id'=>'asc', 'pos'=>'asc'] ]);
		$nets[0] = '---';
		foreach($lists as $list){
			if($list->headstation_id==1){
				$nets[$list->id] = $list->name.' (Bóly)';
			}
			if($list->headstation_id==2){
				$nets[$list->id] = $list->name.' (Felsőszentiván)';
			}
		}
*/

        $lists = $this->Newproducts->find('all', ['conditions' => [ 'servicegroup'=>4, 'headstation_id <='=>2 ], 'order'=>[ 'headstation_id'=>'asc', 'pos'=>'asc'] ]);
		$tels[0] = '---';
		foreach($lists as $list){
			if($list->headstation_id==1){
				$tels[$list->id] = $list->name.' (Bóly)';
			}
			if($list->headstation_id==2){
				$tels[$list->id] = $list->name.' (Felsőszentiván)';
			}
		}
		
/*	
        //$catvs 	= $this->Newproducts->find('list', ['conditions' => ['servicegroup'=>1], 'order'=>['pos'=>'asc']]);
        //$nets 	= $this->Newproducts->find('list', ['conditions' => ['servicegroup'=>2], 'order'=>['pos'=>'asc']]);
        //$tels 	= $this->Newproducts->find('list', ['conditions' => ['servicegroup'=>4], 'order'=>['pos'=>'asc']]);
		
        $this->set(compact('dependency', 'catvs', 'nets', 'tels'));
*/

        $this->set(compact('dependency', 'tels'));
        $this->set('_serialize', ['dependency']);
    }

	
	
	
	

    public function edit($id = null){
        $dependency = $this->Dependencies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dependency = $this->Dependencies->patchEntity($dependency, $this->request->data);
            if ($this->Dependencies->save($dependency)) {
                $this->Flash->success(__('Adatok mentése: Ok!'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Adatok mentése nem sikerült. Kérem ellenőrizze az adatokat és próbálja újra!'));
            }
        }
        $catvs = $this->Dependencies->Catvs->find('list', ['limit' => 200]);
        $nets = $this->Dependencies->Nets->find('list', ['limit' => 200]);
        $tels = $this->Dependencies->Tels->find('list', ['limit' => 200]);
        $this->set(compact('dependency', 'catvs', 'nets', 'tels'));
        $this->set('_serialize', ['dependency']);
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $dependency = $this->Dependencies->get($id);
        if ($this->Dependencies->delete($dependency)) {
            $this->Flash->warning(__('Törlés: Ok'));
        } else {
            $this->Flash->error(__('Nem sikerült a törlés! Kérem próbálja újra!'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
