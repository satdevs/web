<?php
namespace App\Model\Table;

use App\Model\Entity\Street;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaStreetsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('streets');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Subs', [
            'foreignKey' => 'street_id'
        ]);
        //$this->hasMany('Provlocations', [
        //    'foreignKey' => 'street_id'
        //]);
		
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('kozterulet_neve');

        $validator
            ->allowEmpty('kozterulet_tipusa');

        return $validator;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
