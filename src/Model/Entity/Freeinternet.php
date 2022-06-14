<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Freeinternet extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
