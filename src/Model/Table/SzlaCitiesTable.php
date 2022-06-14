<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaCity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaCitiesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('cities');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('CounterCache', ['SzlaHeadstations' => ['city_count']]);

        $this->belongsTo('SzlaHeadstations', [
            'foreignKey' => 'headstation_id',
            'joinType' => 'INNER'
        ]);


/*
        $this->hasMany('Provlocations', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Subs', [
            'foreignKey' => 'city_id'
        ]);
*/
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('irsz');

        $validator
            ->allowEmpty('unev');

        $validator
            ->date('udatum')
            ->allowEmpty('udatum');

        $validator
            ->allowEmpty('uido');

        $validator
            ->allowEmpty('phone_area');

        $validator
            ->allowEmpty('ksh_kod');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['headstation_id'], 'SzlaHeadstations'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
