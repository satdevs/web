<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaProductDesc;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaProductDescsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('product_descs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SzlaProducts', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SzlaHeadstations', [
            'foreignKey' => 'headstation_id',
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

        $validator
            ->requirePresence('description', 'create')
            ->allowEmpty('description');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['product_id'], 'SzlaProducts'));
        $rules->add($rules->existsIn(['headstation_id'], 'SzlaHeadstations'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
