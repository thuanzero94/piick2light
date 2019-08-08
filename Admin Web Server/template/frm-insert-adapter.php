<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">ADD Adapter</div>
  <div class="card-body">
    <form action="?task=insertAdapter" method="POST">
      <div class="form-group">
        <label>Name Adapter</label>
        <input class="form-control" type="text" placeholder="Name Adapter" name="a_name">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Description" name="a_description">
      </div>
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   