<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">Update Line "<?php echo $data['number']; ?>"</div>
  <div class="card-body">
    <form action="?task=updateLine" method="POST">
      <div class="form-group">
        <label>Line number</label>
        <input class="form-control" type="text" placeholder="Line number" name="number" value="<?php echo $data['number']; ?>">
      </div>
      <div class="form-group">
        <label>Line name</label>
        <input class="form-control" type="text" placeholder="Line name" name="name" value="<?php echo $data['name']; ?>">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Description" name="description" value="<?php echo $data['description']; ?>">
      </div>
      <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   