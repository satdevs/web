<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PdfinvoicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PdfinvoicesTable Test Case
 */
class PdfinvoicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PdfinvoicesTable
     */
    public $Pdfinvoices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pdfinvoices',
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
        $config = TableRegistry::exists('Pdfinvoices') ? [] : ['className' => 'App\Model\Table\PdfinvoicesTable'];
        $this->Pdfinvoices = TableRegistry::get('Pdfinvoices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pdfinvoices);

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
