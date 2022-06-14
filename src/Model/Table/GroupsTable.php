<?php
namespace App\Model\Table;

use App\Model\Entity\Group;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GroupsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('groups');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users', [
            'foreignKey' => 'group_id'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');
        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

/*
        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');
*/
        return $validator;
    }
}
