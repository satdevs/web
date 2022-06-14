<?php
namespace App\Controller\Admin;
use App\Controller\Admin\AppController;

class SzlaCitiesController extends AppController{
	public $title = "WinSzla_Web - Települések (Cities)";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->loadModel('SzlaCities');

    }

    public function index() {
        $this->viewBuilder()->layout('admin');
        $this->loadComponent('Paginator');
        $this->paginate = [
            'contain' => ['SzlaHeadstations'],
            'limit' => 100,
            'order' => [
                'SzlaCities.headstation_id' => 'asc',
                'SzlaCities.name' => 'asc',                
            ],
            'conditions' => [
                'SzlaCities.headstation_id >' => 0,
            ]
        ];
        $cities = $this->paginate($this->SzlaCities);
        $this->set(compact('cities'));
        $this->set('_serialize', ['cities']);
    }

    public function view($id = null){
        $city = $this->SzlaCities->get($id);
        $this->set(compact('city'));
        $this->set('_serialize', ['city']);
    }


}
