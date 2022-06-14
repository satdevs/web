<?php
namespace App\Model\Table;

use App\Model\Entity\Interest;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class InterestsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('interests');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Interestdetails', [
            'foreignKey' => 'interest_id'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('cookie', 'create')
            ->notEmpty('cookie');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

/*
        $validator
            ->requirePresence([
                'name' => [
                    'mode' => 'update',
                    'message' => 'Kérem a név mezőt ne hagyja üresen!',
                ]
            ])
            ->notEmpty('name');

        $validator
            ->requirePresence([
                'address' => [
                    'mode' => 'update',
                    'message' => 'Kérem a utca, házszám mezőt ne hagyja üresen!',
                ]
            ])
            ->notEmpty('address');

        $validator
            ->requirePresence([
                'phone' => [
                    'mode' => 'update',
                    'message' => 'Kérem a telefon mezőt ne hagyja üresen!',
                ]
            ])
            ->notEmpty('phone');

        $validator
            ->requirePresence([
                'email' => [
                    'mode' => 'update',
                    'message' => 'Kérem az email mezőt ne hagyja üresen!',
                ]
            ])
            ->notEmpty('email');
*/
/*
        $validator
            ->requirePresence('message', 'create')
            ->notEmpty('message');
*/
        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        //$rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
