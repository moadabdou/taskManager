<?php 
require_once "./app/models/TaskModel.php";
require_once "./common/flash.php";
class TaskController{

    protected TaskModel $taskModel;
    protected Flash $flash;

    public function __construct(){
        $this->taskModel = new TaskModel();
        $this->flash = new Flash();
    }

    public function availableTasksView(){
        $tasks  =  $this->taskModel->getUserTasks($_SESSION["user_id"]);
        require  "./app/views/tasks/availableTasks.php";
    }

    public function completedTasks(){
        $tasks  =  $this->taskModel->getUserCompleteTasks($_SESSION["user_id"]);
        require  "./app/views/tasks/availableTasks.php";
    }


    public function taskForm(){
        $event = $this->flash->get("newtaskevent");
        require  "./app/views/tasks/taskForm.php";
    }

    public function newTaskRequest(){
        $title =  htmlspecialchars($_POST["title"]);
        $description =  htmlspecialchars($_POST["description"]); 
        $res = $this->taskModel->addNewTask($_SESSION["user_id"], $title, $description);
        $this->flash->set("newtaskevent", [
            "what" => self::$newtaskevents[$res->value]
        ]);
        header("Location: ".BASE_URL."/dashboard/newtask");
        exit;
    }

    public function editTaskRequest(){
        $task_id = $_GET["id"];
        $setdone = (int)$_GET["setdone"] ? true : false;
        $res = $this->taskModel->setTaskStatus($task_id, $setdone);

        $this->flash->set("edittaskevent", [
            "what" => self::$edittaskevent[$res->value]
        ]);
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            header("Location: ".BASE_URL."/dashboard/");
            exit;
        }
        exit;
    }

    private static array $newtaskevents = [
        ADDTASK::INVALIDE_TITLE->value => "invalid title",
        ADDTASK::INVALIDE_DESC->value => "invalid description",
        ADDTASK::SUCCESS->value => "task added successfully",
        ADDTASK::DBFAILUR->value => "failed to add task",
        ADDTASK::UNKNOWN_ERR->value => "unknwon error"
    ];

    private static array $edittaskevent = [
        EDITTASK::SUCCESS->value => "task edited successfully",
        EDITTASK::FAILED->value => "failed to edit task",
    ];

}

?>