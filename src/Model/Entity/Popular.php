<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Popular extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
