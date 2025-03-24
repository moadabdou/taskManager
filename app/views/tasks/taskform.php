<h1> add you  new Task </h1>
<?php 
if($event){
    echo $event["what"];
}
?>
<form action="<?=BASE_URL?>/tasks/new" method="POST">
  <div class="form-group">
    <label for="tasktitle">title</label>
    <input type="text" name="title" class="form-control" id="tasktitle">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">description</label>
    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">log in</button>
</form>