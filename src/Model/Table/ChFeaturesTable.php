<?php
namespace App\Model\Table;

use App\Model\Entity\Feature;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChFeaturesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('features');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ChPrograms', [
            'foreignKey' => 'feature_id'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }

    public static function defaultConnectionName(){
        return 'channels';
    }
}
