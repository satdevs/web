<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaSub;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TickPhonebooksTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('phonebooks');
        $this->displayField('name');
        $this->primaryKey('id');

    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

/*
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['street_id'], 'Streets'));
        $rules->add($rules->existsIn(['bank_id'], 'Banks'));
        return $rules;
    }
*/

    public static function defaultConnectionName(){
        return 'ticketing';
    }
}
