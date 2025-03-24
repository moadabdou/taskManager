<?php
require_once "./app/models/UserModel.php"; 
require_once "./common/session.php"; 

class RegisterController{
    use Session;

    protected UserModel $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }   

    public function view(array $req = []){
        $this->checkSession();

        $title = self::TITLE_REGISTER;
        ob_start();
        require "./app/views/auth/registerform.php";
        $form = ob_get_clean();
        extract(compact("title", "form"));
        require "./app/views/auth/login.php";
    }

    public function register(){
        $this->checkSession();

        $firstName = isset($_POST["firstName"])? $_POST["firstName"] : "";
        $lastName =isset($_POST["lastName"])? $_POST["lastName"] : "";
        $email = isset($_POST["email"])? $_POST["email"] : "";
        $password = isset($_POST["password"])? $_POST["password"] : "";

        $res =  $this->userModel->addUser($firstName, $lastName, $email, $password);

        if($res == REGESTRATION::SUCCESS){
            header("Location: ".BASE_URL);
            exit();
        }else {
            var_dump($res);
            $this->view();
        }
    }

    private const TITLE_REGISTER = "Register";
}

?>