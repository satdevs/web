<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;
class ChPackagesProgram extends Entity{

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
