use Cake\Mailer\Email;

class EmailController extends AppController 
{
    Email::configTransport('gmail_ssl', [
        ]);

    public function index(){
    $this->autoRender = false;
    echo "Here is EmailController";
    
    }

}