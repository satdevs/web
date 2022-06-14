<?php
namespace App\Model\Table;

use App\Model\Entity\Postcategory;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostcategoriesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('postcategories');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Posts', [
            'foreignKey' => 'postcategory_id'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

/*
        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');
*/
            
        return $validator;
    }
}
