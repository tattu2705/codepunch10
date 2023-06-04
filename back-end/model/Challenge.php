<?php
    class Challenge{
        public $id;
        public $title;
        public $hint;
        public $challenge_file;
        public $answer;
        public $mess;
       
        
        function __construct($id, $title, $hint, $challenge_file, $answer, $mess){
            $this->id = $id;
            $this->title = $title;
            $this->hint = $hint;
            $this->challenge_file = $challenge_file;
            $this->answer = $answer;
            $this->mess = $mess;
        }
    }
?>