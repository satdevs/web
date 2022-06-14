<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Interest extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
