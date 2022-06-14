<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SzlaSub extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
