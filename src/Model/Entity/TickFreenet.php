<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class TickFreenets extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
