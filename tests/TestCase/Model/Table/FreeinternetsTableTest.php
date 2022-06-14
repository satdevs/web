<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FreeinternetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FreeinternetsTable Test Case
 */
class FreeinternetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FreeinternetsTable
     */
    public $Freeinternets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.freeinternets',
        'app.subs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Freeinternets') ? [] : ['className' => 'App\Model\Table\FreeinternetsTable'];
        $this->Freeinternets = TableRegistry::get('Freeinternets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Freeinternets);

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
