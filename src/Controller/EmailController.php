use Cake\Mailer\Email;

class EmailController extends AppController 
{
    Email::configTransport('gmail_ssl', [
        ]);

    

}