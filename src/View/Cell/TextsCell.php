<?php
namespace App\View\Cell;
use Cake\View\Cell;

class TextsCell extends Cell{

    protected $_validCellOptions = [];

    public function display( $parameters ){
        $this->loadModel('Texts');
        if(isset($parameters[2])){  //Ha a 3. paraméter meg van adva, akkor az az ID. Mivel általában a másik kettővel van keresés, ezért ez most így lett kialakítva
            $text = $this->Texts->find()->select(['title','text'])->where(['id'=>$parameters[2]])->first(); //->toArray();
        }else{
            $text = $this->Texts->find()->select(['title','text'])->where(['headstation_id'=>$parameters[0], 'servicegroup'=>$parameters[1]])->first(); //->toArray();
        }
        //if(!empty($text->toArray())){
        if($text){
            $this->set(['text' => $text]);
        }else{
            $this->set(['text' => Null]);
        }
    }
}
