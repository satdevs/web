<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Text extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
