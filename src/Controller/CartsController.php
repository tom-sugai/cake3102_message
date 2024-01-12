<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Carts Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 *
 * @method \App\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);       
    }

    public function isAuthorized($user)
    {
        // 管理者はすべての操作にアクセスできます
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // 管理者以外
        $action = $this->request->getParam('action');
        // intoCart および checkCart アクションは、常にログインしているユーザーに許可されます。
        if (in_array($action, ['intoCart', 'checkCart', 'order', 'delCart','checkOrder', 'backCart'])) {
            return true;
        }
    }

    public function backCart($cartId = null){
        $this->autoRender = false;
        $cart = $this->Carts->get($cartId);
        $cart->orderd = 0;
        // save cart record to cartsTable
        if ($this->Carts->save($cart)) {    
            $this->Flash->success(__('Here is /Carts/order --- cartId : ' . $cartId . 'was saved.'));
            return $this->redirect(['controller' => 'Carts', 'action' => 'check_cart']); 
        }
        $this->Flash->error(__('The cart could not be saved. Please, try again.'));
    }

    public function checkOrder(){
        $userId = $this->Auth->user('id');
        $query = $this->Carts->find()->contain(['Products'])
            ->where(['user_id' => $userId])
            ->where(['orderd' => 1]);
        $carts = $this->paginate($query);
        //debug($carts);
        $this->set(compact('carts'));
    }

    public function delCart($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'checkCart']);
    }

    public function order($cartId = null)
    {
        //$userId = $this->Auth->user('id');
        $userName = $this->Auth->user('uname');
        $cart = $this->Carts->get($cartId);
        $cart->orderd = 1;
        // save cart record to cartsTable
        if ($this->Carts->save($cart)) {    
            $this->Flash->success(__('Here is /Carts/order --- cartId : ' . $cartId . 'was saved.'));
            return $this->redirect(['controller' => 'Carts', 'action' => 'check_cart']); 
            //$this->setAction('checkCart');
        }
        $this->Flash->error(__('The cart could not be saved. Please, try again.'));   
    }

    public function checkCart(){
        //$this->autoRender = false;
        //echo "Here is /Carts/check ------- " . $userName . "<br/>";
        $userId = $this->Auth->user('id');
        //debug($userId);
        //$userId = $this->Session->read('userId');

        $this->paginate = [
            'contain' => ['Users', 'Products'],
        ];

        $query = $this->Carts->find()
            ->where(['user_id' => $userId])
            ->where(['orderd' => 0]);

        $carts = $this->paginate($query);
        $this->set(compact('carts'));
    }

    public function intoCart($productId = null)
    {
        // get user info from Auth->user()
        $this->autoRender =false;
        $productsTable = TableRegistry::getTableLocator()->get('Products');
        $product = $productsTable->get($productId);
        // create cart record 
        $cart = $this->Carts->newEntity();
        $cart->user_id = $this->Auth->user('id');
        $cart->product_id = $product->id;
        $cart->size = 1;
        // save cart record to cartsTable
        if ($this->Carts->save($cart)) {
            $this->Flash->success(__('Here is /Carts/save --- productName : ' . $product->pname . 'was saved.')); 
            return $this->redirect(['controller' => 'Products', 'action' => 'select']);
        }
        $this->Flash->error(__('The cart could not be saved. Please, try again.'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Products'],
        ];
        $carts = $this->paginate($this->Carts);
        $this->set(compact('carts'));
    }

    /**
     * View method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cart = $this->Carts->get($id, [
            'contain' => ['Users', 'Products'],
        ]);
        $this->set('cart', $cart);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cart = $this->Carts->newEntity();
        if ($this->request->is('post')) {
            $cart = $this->Carts->patchEntity($cart, $this->request->getData());
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        $users = $this->Carts->Users->find('list', ['limit' => 200]);
        $products = $this->Carts->Products->find('list', ['limit' => 200]);
        $this->set(compact('cart', 'users', 'products'));    
    }

    /**
     * Edit method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cart = $this->Carts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, $this->request->getData());
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));
                return $this->redirect(['action' => 'check_order']);
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        $users = $this->Carts->Users->find('list', ['limit' => 200]);
        $products = $this->Carts->Products->find('list', ['limit' => 200]);
        $this->set(compact('cart', 'users', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
