<?php
namespace App\Controller;

use App\Controller\AppController;
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
        $message = "Happy birthday Fumichan !!";

        $event = new Event('Notification.E-Mail', $this, [
            'message' => $message
        ]);
        $this->getEventManager()->dispatch($event);
    }
}