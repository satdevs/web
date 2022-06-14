<?php
namespace App\Model\Table;

use App\Model\Entity\SimplepayErrorcode;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SimplepayErrorcodesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('simplepay_errorcodes');
        $this->displayField('name');
        $this->primaryKey('id');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('name');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['id']));
        return $rules;
    }
}
