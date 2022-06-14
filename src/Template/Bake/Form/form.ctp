<?php
namespace <%= $namespace %>\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class <%= $name %>Form extends Form{

    protected function _buildSchema(Schema $schema){
        return $schema;
    }

    protected function _buildValidator(Validator $validator){
        return $validator;
    }

    protected function _execute(array $data){
        return true;
    }

}
