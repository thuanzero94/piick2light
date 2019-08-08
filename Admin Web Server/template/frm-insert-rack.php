<?php  require_once('template/header-frm.php'); ?>
  <div class="card-body my-form">
    <form action="?task=insertRack" method="POST">
      <div class="form-group">
        <label>Rack Name</label>
        <input class="form-control" type="text" placeholder="Rack number" name="name">
      </div>
      <div class="form-group">
        <label>Type Rack</label>
        <select name="type_rack" class="form-control">
            <option value="adapter">Adapter</option>
            <option value="document">Document</option>
          </select> 
      </div>
      <div class="form-group">
        <label>Line Number</label>
        <select name="id_line" class="form-control">
            <option value="0">---------</option>
            <?php foreach ($line as $key => $value) : ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['number']; ?></option>
            <?php endforeach; ?>
          </select> 
      </div>
      <div class="form-group">
        <label>Slot 1</label>
        <select name="s1" class="form-control">
            <option value="NULL" selected>---------</option>
            <?php foreach ($models as $key => $value) : ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php endforeach; ?>
          </select> 
      </div>

      <div class="form-group">
        <label>Slot 2</label>
        <select name="s2" class="form-control">
            <option value="NULL" selected>---------</option>
            <?php foreach ($models as $key => $value) : ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php endforeach; ?>
          </select> 
      </div>
      
      <div class="form-group">
        <input type="checkbox" name="usingS34" class="cbUsingSlot" value="true"> Using Slot 3, 4<br>
      </div>

      <div class="form-group slot-3-4">
        <label>Slot 3</label>
        <select name="s3" class="form-control">
            <option value="NULL" selected>---------</option>
            <?php foreach ($models as $key => $value) : ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php endforeach; ?>
          </select> 
      </div>

      <div class="form-group slot-3-4">
        <label>Slot 4</label>
        <select name="s4" class="form-control">
            <option value="NULL" selected>---------</option>
            <?php foreach ($models as $key => $value) : ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php endforeach; ?>
          </select> 
      </div>

      <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" placeholder="Description" name="description"></textarea>
      </div>
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">
    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   