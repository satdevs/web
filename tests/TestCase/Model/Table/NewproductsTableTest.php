<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewproductsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewproductsTable Test Case
 */
class NewproductsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NewproductsTable
     */
    public $Newproducts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.newproducts',
        'app.cities',
        'app.headstations',
        'app.groups',
        'app.users',
        'app.photos',
        'app.posts',
        'app.postcategories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Newproducts') ? [] : ['className' => 'App\Model\Table\NewproductsTable'];
        $this->Newproducts = TableRegistry::get('Newproducts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Newproducts);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
