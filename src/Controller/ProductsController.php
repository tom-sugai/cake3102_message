<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index','select']);       
    }

    public function isAuthorized($user)
    {
        // 管理者はすべての操作にアクセスできます
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // 管理者以外
        $action = $this->request->getParam('action');
        // intoCart および tags アクションは、常にログインしているユーザーに許可されます。
        if (in_array($action, ['check'])) {
            return true;
        }
    }

    public function select() 
    {
        $this->autoRender = true;
        //echo "Here is select action !! ";
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
    }

    public function check(){
        $this->autoRender = false;
        $userEmail = $this->Auth->user('email');
        $userRole = $this->Auth->user('role');
        echo "Here is /Products/check ---- Email :  " . $userEmail . "<br/>";
        echo "Here is /Products/check ---- Role : " . $userRole . "<br/>";
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $products = $this->paginate($this->Products);
        //debug($this->Products);
        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Carts', 'Details'],
        ]);
        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $file = $this->request->getData('image'); //受け取り
            $filePath = '/var/www/html/cake3102_message/img/' . date("YmdHis") . $file['name'];
            //echo $filePath;
            move_uploaded_file($file['tmp_name'], $filePath); //ファイル名の先頭に時間をくっつけて/webroot/imgに移動させる
            $data = array(
                'pname' => $this->request->getData('pname'),
                'price' => $this->request->getData('price'),
                'image' => date("YmdHis") . $file['name'] //同様の形でDBに入れる
            );
            //$product = $this->Products->patchEntity($product, $this->request->getData());
            $product = $this->Products->newEntity($data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->request->getData('image'); //受け取り
            $filePath = '/var/www/html/cake3102_message/img/' . date("YmdHis") . $file['name'];
            //echo $filePath;
            move_uploaded_file($file['tmp_name'], $filePath); //ファイル名の先頭に時間をくっつけて/webroot/imgに移動させる
            $data = array(
                'pname' => $this->request->getData('pname'),
                'price' => $this->request->getData('price'),
                'image' => date("YmdHis") . $file['name'] //同様の形でDBに入れる
            );

            //$product = $this->Products->patchEntity($product, $this->request->getData());
            $product = $this->Products->patchEntity($product, $data);
            //$product = $this->Products->newEntity($data);
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $this->set(compact('product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
