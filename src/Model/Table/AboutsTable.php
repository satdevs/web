<?php
namespace App\Model\Table;

use App\Model\Entity\About;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AboutsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('abouts');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->requirePresence('fax', 'create')
            ->notEmpty('fax');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
