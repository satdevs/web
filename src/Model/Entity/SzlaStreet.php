<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class SzlaStreet extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
