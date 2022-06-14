<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Upload extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
