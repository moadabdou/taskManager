<?php
require_once "./app/models/UserModel.php";
require_once "./common/session.php"; 

class AuthController{
    use Session;

    protected UserModel $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }   

    public function view(){
        $this->checkSession();

        $title = self::TITLE_LOGIN;
        ob_start();
        require "./app/views/auth/loginform.php";
        $form = ob_get_clean();
        extract(compact("title", "form"));
        require "./app/views/auth/login.php";
    }

    public function auth(){
        $this->checkSession();
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password =  isset($_POST["password"]) ? $_POST["password"] : "";
        $validation = $this->userModel->validateCredentials($email, $password);
        if($validation["event"] == AUTH::SUCCESS){
            $_SESSION["user_id"] = $validation["data"]["id"];
            $_SESSION["firstName"] = $validation["data"]["firstName"];
            $_SESSION["lastName"] = $validation["data"]["lastName"];
            $_SESSION["email"] = $validation["data"]["email"];

            header("Location: ".BASE_URL."/dashboard/");
            exit();
        }else {
            var_dump($validation["event"]);
            $this->view();
        }
    }

    public function logout(){
        $this->endSession();
        header("Location: ".BASE_URL);
        exit();
    }

    private const TITLE_LOGIN = "Login";

}

?>