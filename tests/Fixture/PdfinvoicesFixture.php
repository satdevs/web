<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PdfinvoicesFixture
 *
 */
class PdfinvoicesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'length' => 64, 'null' => false, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sub_id' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 40, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'phone' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'accept' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'hash' => ['type' => 'string', 'length' => 64, 'null' => true, 'default' => null, 'collate' => 'utf8_hungarian_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'key_sub_id' => ['type' => 'index', 'columns' => ['sub_id'], 'length' => []],
            'key_email' => ['type' => 'index', 'columns' => ['email'], 'length' => []],
            'key_city' => ['type' => 'index', 'columns' => ['city'], 'length' => []],
            'key_phone' => ['type' => 'index', 'columns' => ['phone'], 'length' => []],
            'key_accept' => ['type' => 'index', 'columns' => ['accept'], 'length' => []],
            'key_hash' => ['type' => 'index', 'columns' => ['hash'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'id_UNIQUE' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_hungarian_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 'c7721322-9c96-4789-ada5-ca73c11ec93e',
            'sub_id' => 'Lorem ipsum dolor ',
            'email' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum dolor ',
            'accept' => 1,
            'hash' => 'Lorem ipsum dolor sit amet',
            'created' => '2020-03-31 11:07:21',
            'modified' => '2020-03-31 11:07:21'
        ],
    ];
}
