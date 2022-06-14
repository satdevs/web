<?php
namespace App\Model\Table;

use App\Model\Entity\ChProgram;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChProgramsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('programs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', ['ChOwners' => ['program_count'], 'ChFeatures' => ['program_count']]);

        $this->belongsToMany('ChPackages', [
            'foreignKey' => 'program_id',
            'targetForeignKey' => 'package_id',
            'joinTable' => 'ch_packages_programs'
        ]);
        $this->belongsTo('ChOwners', [
            'foreignKey' => 'owner_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ChFeatures', [
            'foreignKey' => 'feature_id',
            'joinType' => 'INNER'
        ]);

    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('language', 'create')
            ->notEmpty('language');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

/*
        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->requirePresence('programs_url', 'create')
            ->notEmpty('programs_url');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('address');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('logo_url');
			
        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');
*/
        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['owner_id'], 'ChOwners'));
        $rules->add($rules->existsIn(['feature_id'], 'ChFeatures'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'channels';
    }
}
