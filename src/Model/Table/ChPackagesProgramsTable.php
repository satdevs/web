<?php
namespace App\Model\Table;

use App\Model\Entity\ChPackagesProgram;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChPackagesProgramsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('packages_programs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', ['ChPackages' => ['packages_program_count'], 'ChPrograms' => ['packages_program_count'], 'ChBands' => ['packages_program_count']]);

        $this->belongsTo('ChPackages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ChPrograms', [
            'foreignKey' => 'program_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ChBands', [
            'foreignKey' => 'band_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('packageorder')
            ->requirePresence('packageorder', 'create')
            ->notEmpty('packageorder');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('broadcast', 'create')
            ->notEmpty('broadcast');

        $validator
            ->integer('lcn')
            ->requirePresence('lcn', 'create')
            ->notEmpty('lcn');
/*
        $validator
            ->requirePresence('channel', 'create')
            ->notEmpty('channel');

        $validator
            ->decimal('frequency')
            ->requirePresence('frequency', 'create')
            ->notEmpty('frequency');

        $validator
            ->requirePresence('qam', 'create')
            ->notEmpty('qam');

        $validator
            ->integer('sid')
            ->requirePresence('sid', 'create')
            ->notEmpty('sid');
        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->requirePresence('public_comment', 'create')
            ->notEmpty('public_comment');
*/

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['package_id'], 'ChPackages'));
        $rules->add($rules->existsIn(['program_id'], 'ChPrograms'));
        $rules->add($rules->existsIn(['band_id'], 'ChBands'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'channels';
    }
}
