<div class="row">
    <div class="col-md-5 col-md-offset-4">
        <form method="post" class="form-horizontal" action="/account/login">
            <legend>
                Login with existing account
                <hr/>
            </legend>
            <div class="form-group">
                <label for="username" class="col-md-2 control-label">Username</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-2 control-label">Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="/account/register">Signup</a>
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
            </div>
        </form>
    </div>
</div>
</div>
