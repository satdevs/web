<?php
namespace App\Model\Table;

use App\Model\Entity\Catv;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CatvsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('newproducts');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('content');

        $validator
            ->integer('price')
            ->allowEmpty('price');

        $validator
            ->integer('pos')
            ->allowEmpty('pos');

        $validator
            ->boolean('visible')
            ->allowEmpty('visible');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['headstation_id'], 'SzlaHeadstations'));
        return $rules;
    }
}
