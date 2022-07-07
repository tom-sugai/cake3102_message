<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UsersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users',
        'app.Carts',
        'app.Orders',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        //$this->markTestIncomplete('Not implemented yet.');
        $this->get('/users');
        $this->assertResponseOk();
        // add other assert
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        //$this->markTestIncomplete('Not implemented yet.');
        $this->get('/users?page=1');
        $this->assertResponseOk();
        // 他のアサート
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        //$this->markTestIncomplete('Not implemented yet.');

        /** add my-csrf-token
        //$token = 'my-csrf-token';
        //$this->cookie('csrfToken', $token);
        */ 
        $this->enableCsrfToken();
        
        $data = [
            'uname' => 'ai',
            //'_csrfToken' => $token
        ];
        $this->post('/users/add', $data);

        $this->assertResponseSuccess();
        $users = TableRegistry::getTableLocator()->get('Users');
        $query = $users->find()->where(['uname' => $data['uname']]);
        //debug($query);
        //debug($query->count());
        $this->assertEquals(1, $query->count()); // $query->count() -> do'nt exist : 1  already exist : 2 in fixture
    } 

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
