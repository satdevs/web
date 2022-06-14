<?php
namespace App\Model\Table;

use App\Model\Entity\NaDhcpLeasesLast;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class NaDhcpLeasesLastTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('dhcp_leases_last');

        $this->displayField('cpe_name');
        $this->primaryKey('cpe_id');

        $this->belongsTo('Subscribers', [
            'foreignKey' => 'cpe_id'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->dateTime('date')
            ->allowEmpty('date');

        $validator
            ->allowEmpty('lease_time');

        $validator
            ->allowEmpty('modem');

        $validator
            ->allowEmpty('cpemac');

        $validator
            ->allowEmpty('cpeip');

        $validator
            ->allowEmpty('cpe_name');

        $validator
            ->allowEmpty('cpe_addr');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['cpe_id'], 'Cpes'));
        return $rules;
    }

    public static function defaultConnectionName(){
        return 'netadmin';
    }
}
