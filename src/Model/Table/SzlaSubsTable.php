<?php
namespace App\Model\Table;

use App\Model\Entity\SzlaSub;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SzlaSubsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('subs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('SzlaCities', [
            'foreignKey' => 'city_id'
        ]);
        $this->belongsTo('SzlaStreets', [
            'foreignKey' => 'street_id'
        ]);
        
/*
        $this->belongsTo('Banks', [
            'foreignKey' => 'bank_id'
        ]);
        $this->hasMany('DigitNodes', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Digits', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('InvoicesArchive', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('InvoicesGroupView', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('InvoicesRegi', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Logs', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Meters', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('NfInvoices', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Phones', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Provlocations', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Rates', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Recuperations', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('SystemEvents', [
            'foreignKey' => 'sub_id'
        ]);
        $this->hasMany('Tickets', [
            'foreignKey' => 'sub_id'
        ]);
*/
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->allowEmpty('name2');

        $validator
            ->allowEmpty('kerulet');

        $validator
            ->allowEmpty('HSZ');

        $validator
            ->integer('hazszam')
            ->allowEmpty('hazszam');

        $validator
            ->allowEmpty('epulet');

        $validator
            ->allowEmpty('lepcsohaz');

        $validator
            ->allowEmpty('szint');

        $validator
            ->allowEmpty('ajto');

        $validator
            ->allowEmpty('hrsz');

        $validator
            ->allowEmpty('TIPUS');

        $validator
            ->allowEmpty('FIZMOD');

        $validator
            ->allowEmpty('anyanev');

        $validator
            ->allowEmpty('szulhely');

        $validator
            ->date('szulido')
            ->allowEmpty('szulido');

        $validator
            ->allowEmpty('szigszam');

        $validator
            ->allowEmpty('adoszam');

        $validator
            ->allowEmpty('cegszam');

        $validator
            ->allowEmpty('TEL');

        $validator
            ->allowEmpty('EMAIL');

        $validator
            ->allowEmpty('BANKSZLA');

        $validator
            ->integer('NYITOFT')
            ->allowEmpty('NYITOFT');

        $validator
            ->date('SZERZDAT')
            ->allowEmpty('SZERZDAT');

        $validator
            ->allowEmpty('DUMA');

        $validator
            ->allowEmpty('AKTIV');

        $validator
            ->allowEmpty('IKULCS');

        $validator
            ->allowEmpty('ft_status');

        $validator
            ->allowEmpty('tipus2');

        $validator
            ->allowEmpty('szla_kezbesites');

        $validator
            ->allowEmpty('HSZ_TMP');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['city_id'], 'Cities'));
        $rules->add($rules->existsIn(['street_id'], 'Streets'));
        $rules->add($rules->existsIn(['bank_id'], 'Banks'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'winszla_web';
    }
}
