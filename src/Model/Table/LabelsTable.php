<?php
namespace App\Model\Table;

use App\Model\Entity\Label;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LabelsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('labels');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('pos')
            ->requirePresence('pos', 'create')
            ->notEmpty('pos');

        return $validator;
    }
}
