<?php
namespace App\Model\Table;

use App\Model\Entity\Freeinternet;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class FreeinternetsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('freeinternets');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);


/*
        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('mother_name');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('phone');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('student_card_number');

        $validator
            ->integer('status')
            ->allowEmpty('status');

        $validator
            ->allowEmpty('ip');

        $validator
            ->boolean('cb1')
            ->allowEmpty('cb1');

        $validator
            ->boolean('cb2')
            ->allowEmpty('cb2');

        $validator
            ->boolean('cb3')
            ->allowEmpty('cb3');

        $validator
            ->boolean('cb4')
            ->allowEmpty('cb4');

        $validator
            ->boolean('cb5')
            ->allowEmpty('cb5');
*/

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['id']));
        //$rules->add($rules->existsIn(['sub_id'], 'Subs'));
        return $rules;
    }
}
