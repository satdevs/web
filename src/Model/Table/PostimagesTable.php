<?php
namespace App\Model\Table;

use App\Model\Entity\Postimage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostimagesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('postimages');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
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
        $validator
            ->requirePresence('filename', 'create')
            ->notEmpty('filename');

        $validator
            ->boolean('current')
            ->requirePresence('current', 'create')
            ->notEmpty('current');

        return $validator;
    }
}
