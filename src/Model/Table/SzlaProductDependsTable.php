<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaProductDepend;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaProductDependsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('product_depends');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');
/*
        $validator
            ->integer('tv')
            ->allowEmpty('tv');

        $validator
            ->integer('net')
            ->allowEmpty('net');

        $validator
            ->integer('tel')
            ->allowEmpty('tel');
*/
            
        return $validator;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
