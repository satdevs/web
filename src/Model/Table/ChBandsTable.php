<?php
namespace App\Model\Table;

use App\Model\Entity\Band;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ChBandsTable extends Table{

    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('bands');
        $this->displayField('id');
        $this->primaryKey('row');

        $this->addBehavior('Timestamp');

        $this->hasMany('ChPackagesPrograms', [
            'foreignKey' => 'band_id'
        ]);
    }

    public function validationDefault(Validator $validator){
        $validator
            ->integer('row')
            ->allowEmpty('row', 'create');

        $validator
            ->allowEmpty('id');

        $validator
            ->allowEmpty('name');

        $validator
            ->decimal('video_frequency')
            ->allowEmpty('video_frequency');

        $validator
            ->decimal('audio_frequency')
            ->allowEmpty('audio_frequency');

        return $validator;
    }

    public static function defaultConnectionName(){
        return 'channels';
    }
}
