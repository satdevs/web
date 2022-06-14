<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class ChFeature extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
