<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class ChOwner extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
