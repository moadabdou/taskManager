<?php 
require_once "./core/Database.php";
require_once "./common/enums/taskHandling.php";

class Task{
    public string $id;
    public string $title;
    public string $description;
    public string $user_id;
    public string $creation_date;
    public bool $is_done;

    public function __construct(
        string $id,
        string $title,
        string $description,
        string $user_id,
        string $creation_date,
        bool $is_done = false
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->user_id = $user_id;
        $this->creation_date = $creation_date;
        $this->is_done = $is_done;
    }
    
}

class TaskModel{
    protected Database $db;
    public function __construct(){
        $this->db = new Database();
    }

    /** @return  Task[] */
    public function getUserTasks(string $user_id): array{
        $tasks = $this->db->fetchAll("SELECT * FROM tasks WHERE user_id = ?", [$user_id]);

        return array_map(function ($task){
            return new Task(
                $task["task_id"],
                $task["title"],
                $task["description"],
                $task["user_id"],
                $task["creation_date"],
                $task["is_done"]
            );
        }, $tasks);
    }

    /** @return  Task[] */
    public function getUserCompleteTasks(string $user_id): array{
        $tasks = $this->db->fetchAll("SELECT * FROM tasks WHERE user_id = ? AND is_done=1", [$user_id]);

        return array_map(function ($task){
            return new Task(
                $task["task_id"],
                $task["title"],
                $task["description"],
                $task["user_id"],
                $task["creation_date"],
                $task["is_done"]
            );
        }, $tasks);
    }



    public function addNewTask(string $user_id, string $title, string $description): ADDTASK{

        if (!preg_match("/^[a-zA-Z()-_ ]{3,}$/", $title)){
            return ADDTASK::INVALIDE_TITLE;
        }

        if (preg_match("/^[^a-zA-Z()-_ ]*$/", $title)){
            return ADDTASK::INVALIDE_DESC;
        }
        
        $stmt = $this->db->execute("INSERT INTO tasks(user_id, title, description, creation_date) 
                                           VALUE (?, ?, ? , NOW())" , [$user_id, $title, $description]);

        return $stmt->rowCount() > 0 ? ADDTASK::SUCCESS : ADDTASK::DBFAILUR;

    }

    public function setTaskStatus(string $task_id, bool $is_done): EDITTASK{
        $stmt = $this->db->execute("UPDATE tasks SET is_done=? WHERE task_id=?" , [$is_done?1:0, $task_id]);

        return $stmt->rowCount() > 0 ? EDITTASK::SUCCESS : EDITTASK::FAILED;

    }

}

?> 