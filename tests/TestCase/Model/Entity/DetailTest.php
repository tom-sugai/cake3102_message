<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Detail;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\Detail Test Case
 */
class DetailTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Entity\Detail
     */
    public $Detail;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Detail = new Detail();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Detail);

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
