<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class ChProgram extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
