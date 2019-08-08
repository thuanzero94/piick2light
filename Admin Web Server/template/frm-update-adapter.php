<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">Update Adapter "<?php echo $data['name']; ?>"</div>
  <div class="card-body">
    <form action="?task=updateAdapter" method="POST">
      <div class="form-group">
        <label>Name Adapter</label>
        <input class="form-control" type="text" aria-describedby="name" placeholder="Name Adapter" name="a_name" value="<?php echo $data['name']; ?>">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Description" name="a_description" value="<?php echo $data['description']; ?>">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
      </div>
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   