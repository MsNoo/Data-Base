<?php
class User
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $phoneNumber;

    public function __construct($id, $name, $surname, $email, $phoneNumber)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function toString()
    {
        echo "<h5>"
            . $this->id . " "
            . $this->name . " "
            . $this->surname . " "
            . $this->email . " "
            . $this->phoneNumber . "</h5>";
    }
}

?>