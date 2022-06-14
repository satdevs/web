<?php
namespace App\Model\Table;

use App\Model\Entity\NaSubscriber;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class NaSubscribersTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('subscribers');

        $this->displayField('fullname');
        $this->primaryKey('id');

/*
        $this->belongsTo('Radii', [
            'foreignKey' => 'radius_id',
            'joinType' => 'INNER'
        ]);
*/

    }

    public function validationDefault(Validator $validator){
        $validator
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->allowEmpty('ext_key');

        $validator
            ->requirePresence('fullname', 'create')
            ->notEmpty('fullname');

        $validator
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->requirePresence('zip', 'create')
            ->notEmpty('zip');

        $validator
            ->requirePresence('street', 'create')
            ->notEmpty('street');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->allowEmpty('tel1');

        $validator
            ->allowEmpty('tel2');

        $validator
            ->allowEmpty('paymode');

        $validator
            ->allowEmpty('category');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->allowEmpty('over_limit_down');

        $validator
            ->allowEmpty('over_limit_up');

        $validator
            ->date('contract_time')
            ->allowEmpty('contract_time');

        $validator
            ->boolean('contract_year')
            ->allowEmpty('contract_year');

        $validator
            ->integer('download_override')
            ->allowEmpty('download_override');

        $validator
            ->integer('upload_override')
            ->allowEmpty('upload_override');

        $validator
            ->dateTime('last_change')
            ->allowEmpty('last_change');

        $validator
            ->allowEmpty('size_override');

        $validator
            ->dateTime('debug')
            ->allowEmpty('debug');

        $validator
            ->allowEmpty('category_test');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['radius_id'], 'Radii'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'netadmin';
    }
}
