<?php
namespace App\View\Cell;

use Cake\View\Cell;

class BottomCell extends Cell{

    protected $_validCellOptions = [];

    public function display(){
        $this->loadModel('Abouts');
        $about = $this->Abouts->find()
                                    ->select(['icon1','title1','text1','icon2','title2','text2','icon3','title3','text3','icon4','title4','text4'])
                                    ->where(['id'=>1])
                                    ->toArray();
        $this->set(['about' => $about]);
    }

}
