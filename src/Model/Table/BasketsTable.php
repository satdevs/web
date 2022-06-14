<?php
namespace App\Model\Table;

use App\Model\Entity\Basket;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BasketsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('baskets');
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
            ->allowEmpty('cookie');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('zip');

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
            ->allowEmpty('comment');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['id']));
        return $rules;
    }
}
