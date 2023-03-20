<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;

/**
 * SendMail component
 */
class SendMailComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function initialize(array $config)
    {
        $this->email = new Email('default');
    }

    public function send($message, $order)
    {
        //debug($order);
        //debug($order->details[0]->product->pname);
        $this->email
            ->setTemplate('welcome', 'default')
            ->emailFormat('html')
            ->to('fumiko@svr.home.com')
            ->from(['tom@lavie.home.com' => 'CakePHP'])
            ->subject('Thank you mail !!')
            ->viewVars(['order' => $order])
            ->send($message);
    }
}
