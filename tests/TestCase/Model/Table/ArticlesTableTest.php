<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoituresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoituresTable Test Case
 */
class VoituresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VoituresTable
     */
    public $Voitures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Voitures',
        'app.Users',
        'app.Offres',
        'app.Tags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Voitures') ? [] : ['className' => VoituresTable::class];
        $this->Voitures = TableRegistry::getTableLocator()->get('Voitures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Voitures);

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
