<?php
namespace App\Model\Table;

use App\Model\Entity\Message;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MessagesTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('messages');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Messagethemes', [
            'foreignKey' => 'messagetheme_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name','Kérem írja be a nevét!');
			
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email','Kérem érvényes Email címet adjon meg!');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone','Kérem adja meg a telefonszámát!');

        $validator
            ->requirePresence('subject', 'create')
            ->notEmpty('subject','Kérem adja meg üzenete tárgyát!');

        $validator
            ->requirePresence('captcha', 'create')
            ->notEmpty('captcha','Kérem írja be a biztonsági kódot!');

        $validator
            ->requirePresence('body', 'create')
            ->notEmpty('body','Kérem írja meg üzenetét!');
			
        $validator
            ->boolean('readed')
            ->requirePresence('readed', 'create')
            ->notEmpty('readed');

/*
        $validator
            ->dateTime('readedtime')
            ->requirePresence('readedtime', 'create')
            ->notEmpty('readedtime');
*/
/*
        $validator
            ->integer('whoisreaded')
            ->requirePresence('whoisreaded', 'create')
            ->notEmpty('whoisreaded');
*/
            
        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        //$rules->add($rules->isUnique(['email'],'Ezzel az email címmel már küldtek üzenetet ;-) - TESZT!'));
        $rules->add($rules->existsIn(['messagetheme_id'], 'Messagethemes'));
        return $rules;
    }
}
