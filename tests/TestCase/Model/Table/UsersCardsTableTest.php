<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersCardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersCardsTable Test Case
 */
class UsersCardsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersCardsTable
     */
    public $UsersCards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_cards',
        'app.users',
        'app.cards',
        'app.tags',
        'app.cards_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersCards') ? [] : ['className' => 'App\Model\Table\UsersCardsTable'];
        $this->UsersCards = TableRegistry::get('UsersCards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersCards);

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
