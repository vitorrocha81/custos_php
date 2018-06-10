<?php

//function to trim values
function cleandata($value){

    return trim($value);
}


//function to sanitize value for string
function sanitazestr($raw_value){

    return filter_var($raw_value, FILTER_SANITIZE_STRING);
}

//function to validate value for email
function validateEmail($raw_email){

    return filter_var($raw_email, FILTER_VALIDATE_EMAIL);
}

//function to validate value for integer
function validateiNT($raw_int){

    return filter_var($raw_int, FILTER_VALIDATE_INT);
}



//function to redirect
function redirect($page){

    header("Location: {$page}");
}


//function to keep error messages in a session
function keepMsg($message){

    if(empty($message)) {
        $message = "Mensagem Padrão de erro.";
    }else {
             $_SESSION['msg']        =      $message;
    }
}

//function to display the stored message in the session super global
function showmsg(){
    if(isset($_SESSION['msg'])){

        echo $_SESSION['msg'];

            unset($_SESSION['msg']);
    }
}

//Create function to hash password using md5
function hash_password($clean_password){

    return md5($clean_password);

}

?>



