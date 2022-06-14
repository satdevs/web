<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaOption;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaOptionsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('options');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('oid')
            ->notEmpty('oid');
            //->allowEmpty('oid');

        $validator
            ->notEmpty('name');
            //->allowEmpty('name');

        $validator
            ->requirePresence('category', 'create')
            ->notEmpty('category');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['id']));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
