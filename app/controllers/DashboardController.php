<?php 

require_once __DIR__."/TaskController.php";

enum DASHBOARD_NAVIGATION{
    case INDEX;
    case NEWTASK;
    case COMPLETEDTASKS;
    case LOGOUT;
}

class DashboardController{

    protected TaskController $taskController;

    public function __construct(){
        $this->taskController = new TaskController();
    }  
    
    public function indexView(array $req = []){

        $links = $this->navigation;
        $userName = $this->getUserName();

        $active = DASHBOARD_NAVIGATION::INDEX;
        ob_start();
        $this->taskController->availableTasksView();
        $content = ob_get_clean();
        require "./app/views/dashboard/dashboardLayout.php";
    }

    public function newTaskView(array $req = []){

        $links = $this->navigation;
        $userName = $this->getUserName();
        $active = DASHBOARD_NAVIGATION::NEWTASK;
        ob_start();
        $this->taskController->taskForm();
        $content = ob_get_clean();
        require "./app/views/dashboard/dashboardLayout.php";

    }

    public function completedTasksView(array $req = []){

        $links = $this->navigation;
        $userName = $this->getUserName();

        $active = DASHBOARD_NAVIGATION::COMPLETEDTASKS;
        ob_start();
        $this->taskController->completedTasks();
        $content = ob_get_clean();
        require "./app/views/dashboard/dashboardLayout.php";
    }

    private function getUserName ():string{
        return  isset($_SESSION["firstName"]) && isset($_SESSION["lastName"]) ? $_SESSION["firstName"]." ". $_SESSION["lastName"] : "<UserName>";
    }

    private array $navigation  = [[
        "nav" => DASHBOARD_NAVIGATION::INDEX,
        "text"=> "All Tasks",
        "href"=> "./"
    ], [
        "nav" => DASHBOARD_NAVIGATION::NEWTASK,
        "text"=> "new Task",
        "href"=> "./newtask"
    ], [ 
        "nav" => DASHBOARD_NAVIGATION::COMPLETEDTASKS,
        "text"=> "completed Tasks",
        "href"=> "./complitedtasks"
    ],[
        "nav" => DASHBOARD_NAVIGATION::LOGOUT,
        "text"=> "log out",
        "href"=> BASE_URL."/logout"  
    ]];
}
?>