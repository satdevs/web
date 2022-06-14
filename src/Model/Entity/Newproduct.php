<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Newproduct extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
