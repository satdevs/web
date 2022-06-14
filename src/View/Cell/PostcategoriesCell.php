<?php
namespace App\View\Cell;
use Cake\View\Cell;

class PostcategoriesCell extends Cell{
    protected $_validCellOptions = [];

    public function display(){
        $this->loadModel('Postcategories');
        $postcategories = $this->Postcategories->find()
                                    ->select(['id','title','post_count'])
                                    ->order(['pos' => 'ASC', 'title'=>'ASC'])
                                    ->where(['post_count >'=>0])
                                    ->limit(50)
                                    ->toArray();
        $this->set(['postcategories' => $postcategories]);
    }

}
