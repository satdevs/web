<?php
namespace App\Model\Table;

use App\Model\Entity\Interestdetail;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class InterestdetailsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('interestdetails');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Interests', [
            'foreignKey' => 'interest_id',
            'joinType' => 'INNER'
        ]);
        
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
/*
        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');
*/
        $validator
            ->requirePresence('product_name', 'create')
            ->notEmpty('product_name');

        $validator
            ->integer('product_group')
            ->requirePresence('product_group', 'create')
            ->notEmpty('product_group');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['interest_id'], 'Interests'));
        //$rules->add($rules->existsIn(['productdesc_id'], 'Productdescs'));
        //$rules->add($rules->existsIn(['product_id'], 'Products'));
        return $rules;
    }
}
