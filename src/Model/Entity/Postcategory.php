<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class Postcategory extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
