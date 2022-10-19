<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            // コントローラーで isAuthorized を使用します
            'authorize' => ['Controller'],
            'authenticate' => [           
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            // ログアウト後のリダイレクト先(コントローラーとアクション)
            'logoutRedirect' => [
                'controller' => 'Products',
                'action' => 'select'
            ],
            // 未認証の場合、直前のページに戻します
            'unauthorizedRedirect' => $this->referer()
        ]);
        $this->Session = $this->request->getSession();

        // display アクションを許可して、PagesController が引き続き
        // 動作するようにします。また、読み取り専用のアクションを有効にします。
        $this->Auth->allow(['display', 'select']);
        
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

        $this->Session = $this->request->session();
        $this->set('loginname', $this->Auth->user('email'));
        $this->set('userId', $this->Auth->user('id'));
    }

    public function isAuthorized($user)
    {    
        // 管理者はすべての操作にアクセスできます
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // デフォルトは拒否
        return false;
    }  

}
