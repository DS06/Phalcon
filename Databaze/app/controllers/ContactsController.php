<?php

use Phalcon\Mvc\Controller;

class ContactsController extends Controller
{
    public $ID = NUll;

    //--------------------------------
    public function idAction()
    {
        $contacts = $this->db->fetchAll(
            "SELECT * FROM contacts"
        );
        foreach ($contacts as $contact) {
            if ($this->request->getPost("ID") === $contact['Id_contact']) {
                $this->ID = $this->request->getPost("ID");
                return $this->request->getPost("ID");
            }
        }
    }


    public function deleteAction()
    {
        $this->ID = $this->idAction();

        if($this->ID)
        {
            $success = $this->db->delete(
                "contacts",
                "Id_contact = $this->ID"
            );

            if($success)
                echo "<center><h2>Contact was deleted</h2></center>";
            header("refresh: 2; url=/Phalcon/Databaze");

        }else{
            echo "There is <b>not</b> contact with ID: ".$this->request->getPost("ID");
            header("refresh: 2; url=/Phalcon/Databaze/contacts/del");
        }

    }

    public function updateAction()
    {
        $this->ID = $this->idAction();

        if ($this->ID) {
            $first_name=$this->request->getPost("first_name");
            $last_name=$this->request->getPost("last_name");
            $phone=$this->request->getPost("phone");
            $bio=$this->request->getPost("bio");
            $success = $this->db->update(

                "contacts",
                ["first_name", "last_name", "phone", "bio"],
                ["$first_name"," $last_name", "$phone", "$bio"],
                "Id_contact = $this->ID;"
            );

            if ($success)
                echo "<center><h2>Contact was updated</h2></center>";
            header("refresh: 2; url=/Phalcon/Databaze/");

        } else {
            echo "There is <b>not</b> contact with ID: " . $this->request->getPost("ID");
            header("refresh: 2; url=/Phalcon/Databaze/contacts/del");
        }
    }




    public function signupAction()
    {

    }

    public function delAction()
    {

    }

    public function upAction()
    {

    }





}