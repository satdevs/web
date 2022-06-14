<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class TickPhonebook extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
