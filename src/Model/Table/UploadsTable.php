<?php
namespace App\Model\Table;

use App\Model\Entity\Upload;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UploadsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('uploads');
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

/*
        $validator
            ->requirePresence('text', 'create')
            ->notEmpty('text');

        $validator
            ->requirePresence('filename', 'create')
            ->notEmpty('filename');

        $validator
            ->integer('filesize')
            ->requirePresence('filesize', 'create')
            ->notEmpty('filesize');
*/
            
        return $validator;
    }
}
