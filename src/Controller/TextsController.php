<?php
//namespace App\Controller;
namespace App\Controller;
//use App\Controller\AppController;
use App\Controller\AppController;

class TextsController extends AppController{
	public $title = "Szöveg";

    public function initialize(){
        parent::initialize();
        $this->set('title', $this->title);
        $this->loadComponent('RequestHandler');
        $this->_validViewOptions[] = 'pdfConfig';
    }

    public function view($id = null){
        $text = $this->Texts->get($id);
        //debug($text);
        //die();
        if($text){
            $this->title = $text['title'];
        }
        $this->set('title', $this->title);
        $this->set(compact('text'));
        $this->set('_serialize', ['text']);
    }


}
