<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CardsTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CardsTagsTable Test Case
 */
class CardsTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CardsTagsTable
     */
    public $CardsTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cards_tags',
        'app.cards',
        'app.tags',
        'app.users',
        'app.users_cards'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CardsTags') ? [] : ['className' => 'App\Model\Table\CardsTagsTable'];
        $this->CardsTags = TableRegistry::get('CardsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CardsTags);

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
