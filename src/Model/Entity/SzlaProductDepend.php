<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SzlaProductDepend extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
