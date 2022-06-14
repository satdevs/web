<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class ChBand extends Entity{

    protected $_accessible = [
        '*' => true,
        'row' => false,
    ];
}
