<?php
namespace App\View\Cell;
use Cake\View\Cell;

class LabelsCell extends Cell{
    protected $_validCellOptions = [];

    public function display(){
        $this->loadModel('Labels');
        //$total_posts = $this->Labels->find()->where(['readed'=>0])->count();
        $labels = $this->Labels->find()
                                    ->select(['id','name'])
                                    ->order(['pos' => 'ASC', 'name'=>'ASC'])
                                    //->where(['readed'=>0])
                                    ->limit(50)
                                    ->toArray();
        $this->set(['labels' => $labels]);
    }
}
