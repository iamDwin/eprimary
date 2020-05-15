<?php

Class Ops{
         public function input_function($username , $pass){
        $result = query("SELECT * FROM user_login WHERE username='".$username."' AND password='".$pass."'");
        return $result;


        }
}
?>
