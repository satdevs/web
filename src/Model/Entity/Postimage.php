<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Postimage extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
