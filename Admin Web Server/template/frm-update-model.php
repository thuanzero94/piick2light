<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header">Update Model "<?php echo $data['name']; ?>"</div>
  <div class="card-body">
    <form action="?task=updateModel" method="POST">
      <div class="form-group">
        <label>Model Name</label>
        <input class="form-control" type="text" placeholder="Line number" name="m_name" value="<?php echo $data['name']; ?>">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Line name" name="m_description" value="<?php echo $data['description']; ?>">
      </div>
      <div class="form-group">
        <label>Adapter P/N</label>
        <select name="id_adapter" class="form-control">
            <option value="0">-------</option>
            <?php foreach ($listAdap as $key => $value) :?>
              <?php if($data['id_adapter'] == $value['id']) : ?>
                  <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
              <?php else : ?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select> 
      </div>
      <div class="form-group">
        <label>Document P/N</label>
        <select name="id_document" class="form-control">
            <option value="0">---------</option>
            <?php foreach ($listDoc as $key => $value) :?>
              <?php if($data['id_document'] == $value['id']) : ?>
                  <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']; ?></option>
              <?php else : ?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select> 
      </div>

      <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
      
      <div class="form-group">
        <label>Keypart QTY</label>
        <textarea name="keypart" class="form-control"><?php echo $data['keypart']; ?></textarea>
      </div>
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   