<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

class SmailController extends AppController 

{
    public function index(){
        $this->autoRender = false;
        Email::configTransport('gmail_ssl', [
        'className' => 'Smtp'  
        ]);

        echo "Here is EmailController";
    
    }
}
?>
