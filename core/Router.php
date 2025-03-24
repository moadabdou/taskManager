<?php 
require_once "./middlewares/middleware.php";

class Route{
    public string  $uri;

    /** @var array<string,callable> $handlers*/
    public array  $handlers;
    
    /** @var Middleware[] */
    public array $middlewares;
    
    /** @var  Route[]*/
    public array $children;

    /** @param Middleware[] $middlewares  */
    /** @param Route[] $children  */
    /** @param array<string,callable> $handlers*/
    public function __construct(string $uri, array $handlers, array $middlewares = [], array $children = []){
        $this->uri = $uri;
        $this->handlers = $handlers;
        $this->middlewares = $middlewares;
        $this->children = $children;
    }
}

class Router{

    protected static array  $routes;

    public static function addRoute(Route $route){
        
        //resolve the route
        foreach($route->handlers as $method => $handler){
            self::$routes[] = [
                "uri" => $route->uri,
                "method" => $method,
                "handler" => $handler,
                "middlewares" => $route->middlewares
            ];
        }
        foreach($route->children as $child){
            $child->uri = rtrim($route->uri, "/")."/".$child->uri;
            self::addRoute($child);

        }
    }

    public static function match(){
        $uri = isset($_GET["uri"]) ? $_GET["uri"] : "/";
        $method = $_SERVER["REQUEST_METHOD"];
        foreach( self::$routes as  $route){ 
            if ($route["uri"] == $uri && $route["method"] == $method){
                $req = [];
                foreach($route["middlewares"] as $mw){
                    /** @var Middleware $handler */
                    $handler = new $mw();
                    $req = $handler->handle($req);
                }
                if ($req){
                    call_user_func($route["handler"], $req);
                }else{
                    call_user_func($route["handler"]);
                }
                return;
            }
        }
        require "./app/views/404.php"; 
    }

}


?>