<?php
namespace App\Model\Table;

use App\Model\Entity\Messagetheme;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MessagethemesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('messagethemes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Messages', [
            'foreignKey' => 'messagetheme_id'
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
            ->integer('pos')
            ->requirePresence('pos', 'create')
            ->notEmpty('pos');

        return $validator;
    }
}
