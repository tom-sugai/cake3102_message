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
        $email = new Email();
        // set transport for debug
        $transport = new DebugTransport();
        $email->setTransport($transport);
        $result = $email->from(['me@example.com' => 'My Site'])
            ->to('you@example.com')
            ->subject('About')
            ->send('My message');
            
        debug($result);
    }
}
?>
