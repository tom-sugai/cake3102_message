<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Carts Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 *
 * @method \App\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
{
    public function backCart($cartId = null){
        $this->autoRender = false;
        $userName = $this->Session->read('userName');
        $userId = $this->Session->read('userId');
        echo "Here is /Carts/backCart ------- " . $userName . "<br/>";    
        $cart = $this->Carts->get($cartId);
        $cart->orderd = 0;
        // save cart record to cartsTable
        if ($this->Carts->save($cart)) {    
            //$this->Flash->success(__('Here is /Carts/order --- cartId : ' . $cartId . 'was saved.'));
            return $this->redirect(['controller' => 'Carts', 'action' => 'check_cart']); 
            //$this->setAction('check');
        }
        $this->Flash->error(__('The cart could not be saved. Please, try again.'));
    
    }
    public function checkOrder(){
        //$this->autoRender = false;
        //echo "Here is /Carts/checkOrder ------- " . $userName . "<br/>";    
        $userId = $this->Session->read('userId');

        $query = $this->Carts->find()
            ->where(['user_id' => $userId])
            ->where(['orderd' => true]);
        $query->contain(['Users', 'Products']);    
        //debug($query->toList());

        if($query->isEmpty()){
            $this->Flash->error(__('注文する商品を選んでください'));
            return $this->redirect(['controller' => 'Carts', 'action' => 'check_cart']);
        }

        $carts = $this->paginate($query);
        //debug($carts);
        $this->set(compact('carts'));

    }

    public function checkCart(){
        //$this->autoRender = false;
        //echo "Here is /Carts/check ------- " . $userName . "<br/>";
        $userId = $this->Session->read('userId');

        $this->paginate = [
            'contain' => ['Users', 'Products'],
        ];
        $query = $this->Carts->find()
            ->where(['user_id' => $userId])
            ->where(['orderd' => false]);
       
        $carts = $this->paginate($query);
<<<<<<< HEAD
        
=======
        //debug($carts);
>>>>>>> 4ea4f8246fdc7d3532992d4268d9278374a1749e
        $this->set(compact('carts'));
    }

    public function order($cartId = null){
         
        $this->autoRender = false;
        $userId = $this->Session->read('userId');
        $userName = $this->Session->read('userName');
        echo "Here is /Carts/order ------- " . $userName . "<br/>";
       $cart = $this->Carts->get($cartId);
         $cart->orderd = 1;
        // save cart record to cartsTable
        if ($this->Carts->save($cart)) {    
            //$this->Flash->success(__('Here is /Carts/order --- cartId : ' . $cartId . 'was saved.'));
            return $this->redirect(['controller' => 'Carts', 'action' => 'check_cart']); 
            //$this->setAction('check');

        }
        $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        
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

    public function intoCart($productId = null)
    {
        // get user info from session
        $this->autoRender =false;
        $userId = $this->Session->read('userId');
        $userName = $this->Session->read('userName');
        // create cart record 
        $cart = $this->Carts->newEntity();
        $cart->user_id = $userId;
        $cart->product_id = $productId;
        $cart->size = 1;
        // save cart record to cartsTable
        if ($this->Carts->save($cart)) {    
            //$this->Flash->success(__('Here is /Carts/save --- productName : ' . $this->Session->read('productName') . 'was saved.')); 
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

                return $this->redirect(['action' => 'index']);
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
