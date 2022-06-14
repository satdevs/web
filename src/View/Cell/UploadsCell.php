<?php
namespace App\View\Cell;
use Cake\View\Cell;

class UploadsCell extends Cell{

    protected $_validCellOptions = [];

    public function display( $parameters ){
        //$headstation_id=1;
        //$sericegroup = 1;
        $this->loadModel('Uploads');

        $uploads = $this->Uploads->find()
                                    ->select(['name','hash'])
                                    ->where(['servicegroup'=>$parameters[0], 'show_in_mainpage'=>1, 'visible'=>1])									
                                    ->order(['date_from'=>'desc', 'pos'=>'asc'])
                                    ->toArray();

        if($uploads){
            $this->set(['uploads' => $uploads]);
        }else{
            $this->set(['uploads' => Null]);
        }

    }
}
