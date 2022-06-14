<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaAkcio;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaAkciosTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('akcios');
        $this->displayField('id');
        $this->primaryKey('id');
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('focikk')
            ->requirePresence('focikk', 'create')
            ->notEmpty('focikk');

        $validator
            ->integer('cikk')
            ->requirePresence('cikk', 'create')
            ->notEmpty('cikk');

        $validator
            ->integer('akcios_kedv')
            ->allowEmpty('akcios_kedv');

        $validator
            ->integer('duo_kedv')
            ->allowEmpty('duo_kedv');

        $validator
            ->integer('trio_kedv')
            ->allowEmpty('trio_kedv');

        return $validator;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
