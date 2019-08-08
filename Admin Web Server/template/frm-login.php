<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">Login</div>
  <div class="card-body">
    <form action="?task=loginSystem" method="post">
      <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input class="form-control" type="text" aria-describedby="emailHelp" placeholder="Username" name="username">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="password">
      </div>
      <input type="submit" name="btnEnter" value="Login" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   