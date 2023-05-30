<?php
    class Teacher{
        public $id;
        public $username;
        public $password;
        public $fullName;
        public $email;
        public $phoneNumber;
        public $imgProfile;
        public $type;
        
        function __construct($id, $username, $password, $fullName, $email, $phoneNumber, $imgProfile, $type){
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->fullName = $fullName;
            $this->email = $email;
            $this->phoneNumber = $phoneNumber;
            $this->imgProfile = $imgProfile;
            $this->type = $type;
        }
    }
?>