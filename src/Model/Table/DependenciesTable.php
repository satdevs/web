<?php
namespace App\Model\Table;

use App\Model\Entity\Dependency;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class DependenciesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('dependencies');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');


        $this->belongsTo('Catvs', [
            'foreignKey' => 'catv_id'
        ]);
        $this->belongsTo('Nets', [
            'foreignKey' => 'net_id'
        ]);
        $this->belongsTo('Tels', [
            'foreignKey' => 'tel_id'
        ]);

    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('name');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['id']));
        //$rules->add($rules->existsIn(['catv_id'], 'Catvs'));
        //$rules->add($rules->existsIn(['net_id'], 'Nets'));
        //$rules->add($rules->existsIn(['tel_id'], 'Tels'));
        return $rules;
    }
}
