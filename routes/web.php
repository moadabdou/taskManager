<?php 
require_once "./app/controllers/AuthController.php";
require_once "./app/controllers/RegisterController.php";
require_once "./app/controllers/DashboardController.php";
require_once "./app/controllers/TaskController.php";
require_once "./middlewares/Auth.php";
require_once "./core/Router.php";

define('BASE_URL', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));


Router::addRoute(
    new Route(
        "/", 
        [
            "GET" => [new AuthController(), "view"],
            "POST"=> [new AuthController(), "auth"]
        ],
        children:[
            new Route("logout",["GET"=> [new  AuthController(), "logout"]]),
            new Route(
                "register", 
                [
                    "GET" => [new RegisterController(), "view"],
                    "POST"=> [new RegisterController(), "register"]
                ]
            ),
            new Route(
                "dashboard/", //root of  dashboard 
                ["GET"=> [new  DashboardController(), "indexView"]], 
                ["AuthMiddleware"],
                children:[
                    new Route("newtask", ["GET"=> [new  DashboardController(), "newTaskView"],], ["AuthMiddleware"]),
                    new Route("complitedtasks", ["GET"=> [new  DashboardController(), "completedTasksView"]], ["AuthMiddleware"])
                ]
            ),
            new Route(
                "tasks/",
                [], //not an actual  route
                children:[
                    new Route("new",["POST"=> [new  TaskController(), "newTaskRequest"]], ["AuthMiddleware"]),
                    new Route("edit",["GET" => [new  TaskController(), "editTaskRequest"]], ["AuthMiddleware"])
                ]
            )
        ]
    )
);

?>