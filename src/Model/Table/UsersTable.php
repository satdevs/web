<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsersTable extends Table{

    public function initialize(array $config){
        parent::initialize($config);

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', ['Groups' => ['user_count']]);

        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Photos', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
        ]);
    }

    public function validationDefault(Validator $validator){
        /*
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');
        */

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email','Kérem adja meg az email címet');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password','Kérem adja meg a jelszót');

 //‘validate’ =>’someOtherMethod’

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name','Kérem adja meg a teljes nevét');

        return $validator;
    }

/*
    $validatedEntity = $articlesTable->patchEntity(
        $entity,
        $unsafeData,
        ['validate' => 'customName']
    );
*/

    public function buildRules(RulesChecker $rules){
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['group_id'], 'Groups'));
        return $rules;
    }

    public function validationPassword(Validator $validator ){
        //-------------------- Régi jelszó ellenőrzése -----------------
        $validator
            ->add('password_old','custom',[
                'rule'=>  function($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user) {
                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {  //Ha a régi jelszó stimmel
                            return true;
                        }
                    }
                    return false;
                },
                'message'=>'Hibás adtad meg a régi jelszót!',
            ])
            ->notEmpty('password_old');

        //-------------------- Új jelszó ellenőrzése -----------------
        $validator
            ->add('password_new', [
                'length' => [
                    'rule' => ['minLength', 8],
                    'message' => 'A jelszónak minimum 8 karakteresnek kell lennie!',
                ]
            ])
            ->add('password_new',[
                'match'=>[
                    'rule'=> ['compareWith','password_confirm'],
                    'message'=>'A két jelszó nem egyezik!',
                ]
            ])
            ->notEmpty('password_new');

        //-------------------- Új jelszó ellenőrzése -----------------
        $validator
            ->add('password_confirm', [
                'length' => [
                    'rule' => ['minLength', 8],
                    'message' => 'A jelszónak minimum 8 karakteresnek kell lennie!',
                ]
            ])
            ->add('password_confirm',[
                'match'=>[
                    'rule'=> ['compareWith','password_new'],
                    'message'=>'A két jelszó nem egyezik!',
                ]
            ])
            ->notEmpty('password_confirm');

        return $validator;
    }





}

