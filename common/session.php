<?php 
trait Session{
    private function checkSession(){
        if(isset($_SESSION["user_id"])){
            header("Location: ".BASE_URL."/dashboard/");
            exit();
        }
    }
    private function endSession(){

        global $_SESSION;
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }
}

?>