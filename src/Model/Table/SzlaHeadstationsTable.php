<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaHeadstation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaHeadstationsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('headstations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ChPackages', [
            'foreignKey' => 'headstation_id'
        ]);

        $this->hasMany('SzlaCities', [
            'foreignKey' => 'headstation_id'
        ]);
        $this->hasMany('SzlaProductDescs', [
            'foreignKey' => 'headstation_id'
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
            ->requirePresence('place', 'create')
            ->notEmpty('place');

        $validator
            ->requirePresence('last_sentence', 'create')
            ->notEmpty('last_sentence');

        $validator
            ->requirePresence('last_digital_sentence', 'create')
            ->notEmpty('last_digital_sentence');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        return $validator;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
        //return 'channels';
    }
}
