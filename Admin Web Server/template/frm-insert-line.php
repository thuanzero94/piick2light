<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">ADD Line</div>
  <div class="card-body">
    <form action="?task=insertLine" method="POST">
      <div class="form-group">
        <label>Line number</label>
        <input class="form-control" type="text" placeholder="Line number" name="number">
      </div>
      <div class="form-group">
        <label>Line name</label>
        <input class="form-control" type="text" placeholder="Line name" name="name">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Description" name="description">
      </div>
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   