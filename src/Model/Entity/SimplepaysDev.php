<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SimplepaysDev extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
