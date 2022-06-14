<?php
namespace App\Model\Table;

use App\Model\Entity\Owner;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChOwnersTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('owners');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ChPrograms', [
            'foreignKey' => 'owner_id'
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
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        return $validator;
    }

    public static function defaultConnectionName(){
        return 'channels';
    }
}
