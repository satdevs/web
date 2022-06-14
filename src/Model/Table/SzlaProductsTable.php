<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaProduct;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaProductsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('products');
        $this->displayField('nev');
        $this->primaryKey('id');

        $this->hasMany('SzlaProductDescs', [
            'foreignKey' => 'product_id'
        ]);


/*
        $this->hasOne('SzlaProductdescs');
        $this->hasOne('Productdescriptions', [
            'className' => 'Productdescriptions',
            //'foreignKey' => 'product_id',
            //'joinType' => 'INNER'

            //'conditions' => ['SzlaProducts.primary' => '1'],
            //'dependent' => true
        ]);


/*
        $this->hasMany('DigitStates', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('InvoicesArchive', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('InvoicesGroupView', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('InvoicesRegi', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Meters', [
            'foreignKey' => 'product_id'
        ]);
        $this->hasMany('Rates', [
            'foreignKey' => 'product_id'
        ]);
*/
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('cikk', 'create')
            ->notEmpty('cikk');

        $validator
            ->integer('csoport')
            ->allowEmpty('csoport');

        $validator
            ->allowEmpty('nev');

        $validator
            ->allowEmpty('itj');

        $validator
            ->integer('afa')
            ->allowEmpty('afa');

        $validator
            ->allowEmpty('me');

        $validator
            ->integer('ft')
            ->allowEmpty('ft');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('ext_package');

        $validator
            ->integer('duo_kedv')
            ->allowEmpty('duo_kedv');

        $validator
            ->integer('trio_kedv')
            ->allowEmpty('trio_kedv');

        $validator
            ->allowEmpty('netfone_package');

        $validator
            ->integer('akcios_kedv')
            ->allowEmpty('akcios_kedv');

        return $validator;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
