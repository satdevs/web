<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Dependency extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
