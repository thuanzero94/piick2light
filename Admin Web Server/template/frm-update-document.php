<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">Update Document "<?php echo $data['name']; ?>"</div>
  <div class="card-body">
    <form action="?task=updateDocument" method="POST">
      <div class="form-group">
        <label>Name Document</label>
        <input class="form-control" type="text" placeholder="Name Document" name="d_name" value="<?php echo $data['name']; ?>">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Description" name="d_description" value="<?php echo $data['description']; ?>">
      </div>
      <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   