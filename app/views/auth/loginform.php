<div class="form-container">
  <form action="<?=BASE_URL?>/"  method="POST">
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <div class="navigation">
    <p>
      are you new ?  then <a href="<?=BASE_URL?>/register">sign up</a>
    </p>
  </div>
</div>