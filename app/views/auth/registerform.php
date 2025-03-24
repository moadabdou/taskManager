<div class="form-container">
    <form action="<?=BASE_URL?>/register" method="POST">
        <div class="form-group">
            <label for="f_name">First Name</label>
            <input id="f_name" name="firstName" type="text" class="form-control" placeholder="FirstName">
        </div>
        <div class="form-group">
            <label for="l_name">Last Name</label>
            <input id="l_name" name="lastName" type="text" class="form-control" placeholder="LastName">
        </div>
        <div class="form-group ">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group ">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
    <div class="navigation">
        <p>
            you have an account ? then <a href="<?=BASE_URL?>">log in</a>
        </p>
    </div>
</div>