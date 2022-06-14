<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SimplepaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SimplepaysTable Test Case
 */
class SimplepaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SimplepaysTable
     */
    public $Simplepays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.simplepays'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Simplepays') ? [] : ['className' => 'App\Model\Table\SimplepaysTable'];
        $this->Simplepays = TableRegistry::get('Simplepays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Simplepays);

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
