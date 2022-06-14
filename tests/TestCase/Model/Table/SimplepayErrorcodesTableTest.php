<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SimplepayErrorcodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SimplepayErrorcodesTable Test Case
 */
class SimplepayErrorcodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SimplepayErrorcodesTable
     */
    public $SimplepayErrorcodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.simplepay_errorcodes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SimplepayErrorcodes') ? [] : ['className' => 'App\Model\Table\SimplepayErrorcodesTable'];
        $this->SimplepayErrorcodes = TableRegistry::get('SimplepayErrorcodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SimplepayErrorcodes);

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
