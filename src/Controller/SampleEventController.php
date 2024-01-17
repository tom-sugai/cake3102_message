<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Event\Event;
use Cake\Event\EventManager;
use App\Event\NotificationListener;

/**
 * SampleEvent Controller
 *
 *
 * @method \App\Model\Entity\SampleEvent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SampleEventController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->autoRender = false;

        $this->Notification = new NotificationListener();
        EventManager::instance()->attach($this->Notification);
    }

    public function mail()
    {
        // prepare contents which will send by email
        $ordersTable = TableRegistry::getTableLocator()->get('Orders');
        $order = $ordersTable->get(33, ['contain' => ['Users', 'Details' => 'Products']]);
        debug($order);

        $message = "Happy birthday Fumichan !!";

        $event = new Event('Notification.E-Mail', $this, ['message' => $message, 'order' => $order]);
        $this->getEventManager()->dispatch($event);
    }
}