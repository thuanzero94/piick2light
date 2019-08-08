<?php  require_once('template/header-frm.php'); ?>
  <div class="card-header my-form">ADD Model</div>
  <div class="card-body">
    <form action="?task=insertModel" method="POST">
      <div class="form-group">
        <label>Model Name</label>
        <input class="form-control" type="text" placeholder="Line number" name="m_name">
      </div>
      <div class="form-group">
        <label>Description</label>
        <input class="form-control" type="text" placeholder="Line name" name="m_description">
      </div>
      <div class="form-group">
        <label>Adapter P/N</label>
        <select name="id_adapter" class="form-control">
            <option value="0">-------</option>
            <?php foreach ($listAdap as $key => $value) :?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
            <?php endforeach; ?>
          </select> 
      </div>
      <div class="form-group">
        <label>Document P/N</label>
        <select name="id_document" class="form-control">
            <option value="0">---------</option>
            <?php foreach ($listDoc as $key => $value) :?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
            <?php endforeach; ?>
          </select> 
      </div>

      <div class="form-group">
        <label>Keypart QTY</label>
        <textarea name="keypart" class="form-control"></textarea>
      </div>
      <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   