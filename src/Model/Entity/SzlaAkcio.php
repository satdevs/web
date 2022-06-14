<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SzlaAkcio extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
