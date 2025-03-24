<h1>
    available tasks
</h1>
<?php 
/** @var Task[] $tasks */
if ($tasks){
    foreach($tasks as $task){
    ?>
    <div class="card text-center" data-taskid = "<?= $task->id ?>">
        <div class="card-header">
            <?= $task->is_done ? "DONE" : "in progress" ?>
        </div>
        <div class="card-body">
            <h5 class="card-title"> <?=  htmlspecialchars($task->title) ?></h5>
            <p class="card-text">   <?= htmlspecialchars($task->description)?></p>
            <a href="<?=BASE_URL?>/tasks/edit?id=<?= $task->id ?>&setdone=<?= $task->is_done ? 0:1?>" class="btn btn-primary"><?= $task->is_done ? "set in progress" : "set done" ?></a>
        </div>
        <div class="card-footer text-muted">
            <?= $task->creation_date ?>
        </div>
    </div>    
    <?php
    }
}else {?>  
    <h2> no tasks  </h2>
<?php }?>