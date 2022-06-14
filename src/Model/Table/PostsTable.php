<?php
namespace App\Model\Table;

use App\Model\Entity\Post;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('posts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('CounterCache', ['Postcategories' => ['post_count']]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Postcategories', [
            'foreignKey' => 'postcategory_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

			
/*
        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body');
*/


        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['postcategory_id'], 'Postcategories'));

        return $rules;
    }
}
