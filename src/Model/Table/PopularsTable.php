<?php
namespace App\Model\Table;

use App\Model\Entity\Popular;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PopularsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('populars');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('catv')
            ->requirePresence('catv', 'create')
            ->notEmpty('catv');

        $validator
            ->integer('net')
            ->requirePresence('net', 'create')
            ->notEmpty('net');

        $validator
            ->integer('tel')
            ->requirePresence('tel', 'create')
            ->notEmpty('tel');

        return $validator;
    }

}
