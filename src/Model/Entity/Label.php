<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Label extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
