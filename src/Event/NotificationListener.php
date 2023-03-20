<?php
namespace App\Event;

use Cake\Event\EventListenerInterface;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\SendMailComponent;
//use Cake\Mailer\Email;

/**
 * Class NotificationListener
 * @package App\Event
 */
class NotificationListener implements EventListenerInterface
{
    protected $Email;
        
    public function __construct()
    {
        $this->Email = new SendMailComponent(new ComponentRegistry());
    }
    
    public function implementedEvents()
    {
        return [
            'Notification.E-Mail' => 'mailNotification'
        ];
    }

    /**
     * E-Mail通知処理
     * @param $event
     * @param $message
     */
    public function mailNotification($event, $message, $order)
    {
        $this->Email->send($message, $order);
    }
}