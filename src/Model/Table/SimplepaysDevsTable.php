<?php
namespace App\Model\Table;

use App\Model\Entity\SimplepaysDev;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SimplepaysDevsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('simplepays_dev');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->allowEmpty('name');

        $validator
            ->notEmpty('ids');
			//->message('Befizető azonosítót kötelező megadni!');

        $validator
            ->boolean('luhn_ok')
            ->allowEmpty('luhn_ok');

        $validator
            ->integer('amount')
            ->allowEmpty('amount');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['id']));
        return $rules;
    }
}
