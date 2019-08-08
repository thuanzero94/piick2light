<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">ADD Document</div>
  <div class="card-body">
    <form action="?task=insertDocument" method="POST">
      <div class="form-group">
        <label>Name Document</label>
        <input class="form-control" type="text" placeholder="Name Document" name="d_name">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Description" name="d_description">
      </div>
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   