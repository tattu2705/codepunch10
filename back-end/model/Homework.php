<?php
    class Homework{
        public $id;
        public $title;
        public $description;
        public $fileUpload;
       
        
        function __construct($id, $title, $description, $fileUpload){
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->fileUpload = $fileUpload;
        }
    }
?>