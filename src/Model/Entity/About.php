<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class About extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
