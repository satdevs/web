<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BasketsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BasketsTable Test Case
 */
class BasketsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BasketsTable
     */
    public $Baskets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.baskets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Baskets') ? [] : ['className' => 'App\Model\Table\BasketsTable'];
        $this->Baskets = TableRegistry::get('Baskets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Baskets);

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
