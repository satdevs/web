<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SzlaCity extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
