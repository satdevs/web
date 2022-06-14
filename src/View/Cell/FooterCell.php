<?php
namespace App\View\Cell;

use Cake\View\Cell;

class FooterCell extends Cell{

    protected $_validCellOptions = [];

    public function display(){
        $this->loadModel('Abouts');
        $about = $this->Abouts->find()
                                    ->select(['footer_title1','footer_text1','footer_title2','footer_text2','footer_title3','footer_text3','footer_title4','footer_text4'])
                                    ->where(['id'=>1])
                                    ->toArray();
        $this->set(['about' => $about]);
    }

}
