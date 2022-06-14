<?php
namespace App\Model\Table;

use App\Model\Entity\Internetextra;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class InternetextrasTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('internetextras');
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
            ->allowEmpty('custno');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('address');

//        $validator
//            ->boolean('accept')
//            ->allowEmpty('accept');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['id']));
        return $rules;
    }
}
