<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Mailer\Transport\DebugTransport;


class SmailController extends AppController 

{
    public function index(){
        $this->autoRender = false;
        echo "Here is EmailController";

        /** load from config/app_loca.php
        Email::configTransport('gmail_ssl', [
        'className' => 'Smtp'  
        ]);
        */
        /** 
        Email::configTransport('gmail', [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'username' => 'my@gmail.com',
            'password' => 'secret',
            'className' => 'Smtp',
            'tls' => true
        ]);
        */

        // create email instans
        //$email = new Email();
        $email = new Email('default');
        // create DebugTransport
        //$transport = new DebugTransport();
        // set Transport
        //$email->setTransport($transport);
        /** 
        $result = $email->setFrom(['me@example.com' => 'My Site'])
            ->setTo('you@example.com')
            ->addTo('fumiko@example.com', 'Junji Example')
            ->setCc('seiichi@example.com')
            ->addCc('keito@example.com')
            ->setBcc('yumi@example.com')
            ->addBcc('keiko@example.com')
            ->setSubject('About')
            ->send('Hello Everybody !!');
        debug($result);
        */
        $result = $email
            ->setTemplate('default', 'default') // 'view template' 'layout template'
            ->emailFormat('html')
            ->to('fumiko@svr.home.com')
            ->from('fumiko@svr.home.com')
            ->subject('Hello 4 !!')
            ->send('<h3>Hello Fumiko How are you ?</h3>');
        debug($result);

    }
}
?>
