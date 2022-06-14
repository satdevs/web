<?php
namespace App\Model\Table;

use App\Model\Entity\Pdfinvoice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PdfinvoicesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('pdfinvoices');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

    }

    public function validationDefault(Validator $validator){
        $validator
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        //$validator->notEmpty('sub_id','Kérem adja meg az ügyfélszámát ID000000 formátumban');
/*
        $validator
            ->requirePresence('email', 'create')
            ->notEmpty('email','Kérem adja meg az Email címét');

        $validator
            ->notEmpty('name','Kérem adja meg a teljes nevét');

        $validator
            ->notEmpty('city','Kérem adja meg a település nevét');

        $validator
            ->notEmpty('address','Kérem adja meg a címét nevét');

        $validator
            ->notEmpty('phone','Kérem adja meg a telefonszámát');
*/
/*
        $validator
            ->boolean('accept')
            ->allowEmpty('accept');
*/


        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        //$rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['id']));
        return $rules;
    }
}
