<?php 
require_once __DIR__."/middleware.php";
class AuthMiddleware implements Middleware{
    public function handle(array $req): array{    
        if (isset($_SESSION["user_id"])){
            $req["is_auth"] = true;
        }else {
            header("Location: ".BASE_URL);
            exit();
        }
        return $req;
    }
}
?>
