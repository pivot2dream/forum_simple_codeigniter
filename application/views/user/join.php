<div class="row-fluid">
    <div class="span1">
        
    </div>
    <div class="span4">
        <div class="page-header">
            <h3 style="text-align:center;">Register Account</h3>
        </div>
        <?php if (isset($tmp_success)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading">User created!</h4>
        </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading">Error!</h4>
            <?php if (isset($error['username'])): ?>
                <div>- <?php echo $error['username']; ?></div>
            <?php endif; ?>
            <?php if (isset($error['password'])): ?>
                <div>- <?php echo $error['password']; ?></div>
            <?php endif; ?>  
        </div>
        <?php endif; ?>
        <form class="well" action="" method="post" style="margin: 5px 10px;">
        <label>Username</label>
        <input type="text" name="row[username]" class="span12" placeholder="">
        <label>Password</label>
        <input type="password" name="row[password]" class="span12" placeholder="">
        <label>Confirm Password</label>
        <input type="password" name="password2" class="span12" placeholder="">
        <input type="submit" style="margin-top:15px;font-weight: bold;" name="btn-reg" class="btn btn-primary btn-large" value="Register Account"/>
        </form>
    </div>
    
    <div class="span2" style="text-align: center;padding-top: 160px;"><h1>OR</h1></div>
    
    <div class="span4">
        <div class="page-header">
            <h3 style="text-align:center;">Login Account</h3>
        </div>
        
        <?php if (isset($error_login)): ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <h4 class="alert-heading"><?php echo $error_login['login']; ?></h4>
        </div>
        <?php endif; ?>
        <form class="well" action="" method="post" style="margin: 5px 10px;">
        <label>Username</label>
        <input type="text" name="row[username]" class="span12" placeholder="">
        <label>Password</label>
        <input type="password" name="row[password]" class="span12" placeholder="">
        <input type="submit" style="margin-top:15px;font-weight: bold;" name="btn-login" class="btn btn-primary btn-large" value="Login"/>
        </form>
    </div>
    
    <div class="span1">
        
    </div>
</div>