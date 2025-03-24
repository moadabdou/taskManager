<?php 
require_once "./config/database.php";
require_once "./core/Database.php";
require_once "./common/enums/userRegisterionEnum.php";
require_once "./common/enums/userAuthEnum.php";

class UserModel{

    protected Database $db;

    public function __construct(){
        $this->db = new Database(); 
    }

    public function validateCredentials(string $email, string $password): array{
        $user_data = $this->db->fetchOne("SELECT * FROM users WHERE email = ? LIMIT 1", [$email]);

        if (!$user_data){
            return [
                "data" => [],
                "event" => AUTH::EMAIL_NOT_FOUND
            ];
        }

        if (password_verify($password, $user_data["password"]) ){
            return [
                "data" => $user_data,
                "event"=> AUTH::SUCCESS
            ]; 
        }

        return [
            "data" => [],
            "event"=> AUTH::INVALID_CREDENTIALS
        ];
    }

    public function addUser( 
        string $firstName , 
        string $lastName, 
        string $email, 
        string $password): REGESTRATION{

        //data  checking 
        if (!( preg_match("/^[a-zA-Z-' ]{2,30}$/", $firstName) 
            && preg_match("/^[a-zA-Z-' ]{2,30}$/", $lastName) )){ //invalid used  name
            return REGESTRATION::INVALID_NAME;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return REGESTRATION::INVALID_EMAIL;
        }

        if ($this->checkUserEmailExistence($email)){
            return REGESTRATION::EMAIL_TOKEN;
        }

        if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%?*&_-])[A-Za-z\d@$!%?\*&_-]{8,}$/", $password)){
            return REGESTRATION::INVALID_PASSWORD;
        }


        $firstName = trim(htmlspecialchars($firstName, encoding:"UTF-8")); //extra caution
        $lastName = trim(htmlspecialchars($lastName, encoding:"UTF-8"));

        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->execute("INSERT INTO users(firstName, lastName, email, password)
                                            VALUES (?, ?, ?, ?)", 
                                            [$firstName, $lastName, $email, $password]);
                        
        return $stmt->rowCount() > 0 ? REGESTRATION::SUCCESS :  REGESTRATION::DBFAILURE;
    }

    public function checkUserEmailExistence(string $email): bool{
        return $this->db->execute("SELECT * FROM users WHERE email = ?", [$email])->rowCount() > 0;
    }

}

?>