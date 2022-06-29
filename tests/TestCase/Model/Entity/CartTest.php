<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Cart;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Cart Test Case
 */
class CartTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Entity\Cart
     */
    public $Cart;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Cart = new Cart();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cart);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
