<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Order;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Order Test Case
 */
class OrderTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Entity\Order
     */
    public $Order;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Order = new Order();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Order);

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
