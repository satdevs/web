<?php
namespace App\Model\Table;

use App\Model\Entity\ChPackage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChPackagesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('packages');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', ['SzlaHeadstations' => ['package_count']]);

        $this->belongsToMany('ChPrograms', [
            'foreignKey' => 'package_id',
            'targetForeignKey' => 'program_id',
            'joinTable' => 'ch_packages_programs'
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

        //$validator
        //    ->requirePresence('encoded', 'create')
        //    ->notEmpty('encoded');

        $validator
            ->requirePresence('broadcast', 'create')
            ->notEmpty('broadcast');

        //$validator
        //    ->integer('packageGroup')
        //    ->requirePresence('packageGroup', 'create')
        //    ->notEmpty('packageGroup');

        $validator
            ->integer('packageorder')
            ->requirePresence('packageorder', 'create')
            ->notEmpty('packageorder');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        //$validator
        //    ->requirePresence('shortname', 'create')
        //    ->notEmpty('shortname');

        $validator
            ->requirePresence('popular_name', 'create')
            ->notEmpty('popular_name');

/*
        $validator
            ->requirePresence('external_name', 'create')
            ->notEmpty('external_name');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->allowEmpty('popular_comment_analog');

        $validator
            ->allowEmpty('popular_comment_digital');
*/
        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['headstation_id'], 'SzlaHeadstations'));
        //$rules->add($rules->existsIn(['ext_id'], 'Exts'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'channels';
    }
}
