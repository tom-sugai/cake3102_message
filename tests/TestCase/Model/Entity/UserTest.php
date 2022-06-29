<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\User;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\User Test Case
 */
class UserTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Entity\User
     */
    public $User;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->User = new User();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->User);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        //$this->markTestIncomplete('Not implemented yet.');
    }

    /** $this->User test */
    public function testUserInstance(){
        $this->asserTrue(is_a($this->User,'App/Model/Entity/User'));
    }
}
