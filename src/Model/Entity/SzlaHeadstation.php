<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SzlaHeadstation extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
