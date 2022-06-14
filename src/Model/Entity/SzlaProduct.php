<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SzlaProduct extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
