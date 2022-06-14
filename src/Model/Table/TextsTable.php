<?php
namespace App\Model\Table;

use App\Model\Entity\Text;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TextsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('texts');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator){
/*        
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('text', 'create')
            ->notEmpty('text');
*/
        return $validator;
    }

    //public function buildRules(RulesChecker $rules) {
    //    $rules->add($rules->existsIn(['user_id'], 'Users'));
    //    return $rules;
    //}
}
