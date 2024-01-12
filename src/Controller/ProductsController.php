<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Error\Debugger;
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
    public function check(){
        $this->autoRender = false;
        $userName = $this->Session->read('userName');
        echo "Here is /Products/check ------- " . $userName . "<br/>";
    }

    public function select() 
    {
        $this->autoRender = true;
        //echo "Here is select action !! ";
        $products = $this->paginate($this->Products);
        $this->set(compact('products'));
    }

    public function intoCart ($id = null) 
    {
        $product = $this->Products->get($id);
        $this->Session->write('productId', $product->id);
        $this->Session->write('productName', $product->pname);
        $this->Flash->success(__('Your sellected product is   ' . $product->pname));
        $userName = $this->Session->read('userName');
        $this->Flash->success(__('Your namet is ---  ' . $userName));
        return $this->redirect(['controller' => 'Carts', 'action' => 'intoCart', $product->id]);
        $this->setAction('select');
    
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->autoLayout = true;
        $this->autoRender = true;
        //$this->viewBuilder()->setLayout('default');

        // テーブルオブジェクトを取得
        //$productsTable = TableRegistry::getTableLocator()->get('Products');

        $products = $this->paginate($this->Products);
        /** 
        $this->paginate = [
            'contain' => ['Carts', 'Detailes'],
            'limit' => 10
        ];
        */

        //$products = $this->Products->find()->all();
        //$products = $productsTable->find();
        //debug($products);

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
