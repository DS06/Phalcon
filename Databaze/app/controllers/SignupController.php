<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{

    public function indexAction()
    {

    }

    public function registerAction()
    {
        $contact = new Contacts();

        // Store and check for errors
        $success = $contact->save(
            $this->request->getPost(),
            [
                "first_name",
                "last_name",
                "phone",
                "bio",
            ]
        );

        if ($success) {
            echo "<center><h2>Thanks for registering!</h2></center>";
            header("refresh: 2; url=/Phalcon/Databaze");
        } else {
            echo "<center><h3>Sorry, the following problems were generated:<center></h3>";

            $messages = $contact->getMessages();

            foreach ($messages as $message) {
                echo $message->getMessage(), "<br/>";
            }
            header("refresh: 3; url=/Phalcon/Databaze/contacts/signup");
        }

        $this->view->disable();
    }

}
