<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);       
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // intoCart および checkCart アクションは、常にログインしているユーザーに許可されます。
        if (in_array($action, ['fixOrder', 'confirm'])) {
            return true;
        }
    }

    public function confirm($id = null){
        $this->paginate = [
            'contain' => ['Users', 'Details.Products'],
        ];
        $order = $this->Orders->get($id, [
            'contain' => ['Users', 'Details.Products'],
        ]);
        $this->set(compact('order'));        
    }

    public function fixOrder(){
        $userId = $this->Auth->user('id');
        //$userName = $this->Auth->user('uname');
        $this->paginate = [
            'contain' => ['Users','Products'],
        ];
        $cartsTable = TableRegistry::getTableLocator()->get('Carts');
        $query = $cartsTable->find()
            ->where(['user_id' => $userId])
            ->where(['orderd' => 1]);
        $query->contain(['Users', 'Products']);
        $carts = $this->paginate($query);
        $this->set(compact('carts'));

        // step1 check orderItem and make detail entity list
        $details = [];
        foreach($query as $orderItem){
            $detail = $this->Orders->Details->newEntity();
            $detail->product_id = $orderItem->product_id;
            $detail->size = $orderItem->size;
            $details[] = $detail;
        }

        // step2 save order with details
        $order = $this->Orders->newEntity();
        $order->user_id = $userId;
        $order->details = $details;
        $this->set('order',$order);;
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            // save order record to ordersTable              
            if ($this->Orders->save($order)) {;
                // clean carts table( delete orderd cart record from carts table ) 
                foreach($query as $orderItem){
                    $cartsTable->delete($orderItem);
                }    
                return $this->redirect(['action' => 'confirm', $order->id]);
            } else {
                $this->Flash->error(__( 'The order could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Users', 'Details'],
        ]);

        $this->set('order', $order);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $this->set(compact('order', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $this->set(compact('order', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
