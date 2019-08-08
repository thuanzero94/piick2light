<?php  require_once('template/header-frm.php'); ?>

<?php 
  $isUsingS34 = false;
  $modelS1 = $slot[0]['model_name'];
  $idS1 = $slot[0]['id'];
  $modelS2 = $slot[1]['model_name'];
  $idS2 = $slot[1]['id'];
  $modelS3 = $slot[2]['model_name'];
  $idS3 = $slot[2]['id'];
  $modelS4 = $slot[3]['model_name'];
  $idS4 = $slot[3]['id'];
  
  if($modelS3 != null || $modelS4 != null){
    $isUsingS34 = true;
  }
?>
  <div class="card-body my-form">
    <form action="?task=updateRack" method="POST">
      <div class="form-group">
        <label>Rack Name</label>
        <input class="form-control" type="text" placeholder="Line number" name="name" value="<?php echo $data['name']; ?>">
      </div>
      <div class="form-group">
        <label>Type Rack</label>
        <select name="type_rack" class="form-control">
          <?php if($data['type'] == 'adapter') : ?>
              <option value="adapter" selected>Adapter</option>
              <option value="document">Document</option>
            <?php else : ?>
              <option value="adapter">Adapter</option>
              <option value="document" selected>Document</option>
            <?php endif; ?>
        </select> 
      </div>
      <div class="form-group">
        <label>Line Number</label>
        <select name="id_line" class="form-control">
            <?php foreach ($line as $key => $value) : ?>
              <?php if($value['id'] == $data['id_line']) : ?>
                <option value="<?php echo $value['id']; ?>" selected><?php echo $value['number']; ?></option>
              <?php else : ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['number']; ?></option>
              <?php endif ; ?>
            <?php endforeach; ?>
          </select> 
      </div>
      <div class="form-group">
        <label>Slot 1</label>
        <select name="s1" class="form-control">
          <option value="null" selected>---------</option>
          <?php foreach ($models as $key => $value) : ?>
            <?php if($modelS1 == $value['name']): ?>
              <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php else : ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select> 
      </div>

      <div class="form-group">
        <label>Slot 2</label>
        <select name="s2" class="form-control">
          <option value="null" selected>---------</option>
          <?php foreach ($models as $key => $value) : ?>
            <?php if($modelS2 == $value['name']): ?>
              <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php else : ?>
              <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select> 
      </div>

      <div class="form-group">
        <?php if($isUsingS34) : ?>
         <input type="checkbox" name="usingS34" class="cbUsingSlot" checked="true"> Using Slot 3, 4<br>
        <?php else : ?>
         <input type="checkbox" name="usingS34" class="cbUsingSlot"> Using Slot 3, 4<br>
        <?php endif; ?>
      </div>

      <div class="form-group slot-3-4">
        <label>Slot 3</label>
        <select name="s3" class="form-control">
            <option value="null" selected>---------</option>
            <?php foreach ($models as $key => $value) : ?>
              <?php if($modelS3 == $value['name']): ?>
                <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
              <?php else : ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select> 
      </div>

      <div class="form-group slot-3-4">
        <label>Slot 4</label>
        <select name="s4" class="form-control">
            <option value="null" selected>---------</option>
            <?php foreach ($models as $key => $value) : ?>
              <?php if($modelS4 == $value['name']): ?>
                <option value="<?php echo $value['id']; ?>" selected><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
              <?php else : ?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['name']." (".$value['keypart'].")"; ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </select> 
      </div>

      <input type="hidden" name="id_slot_1" value="<?php echo $idS1; ?>">
      <input type="hidden" name="id_slot_2" value="<?php echo $idS2; ?>">
      <input type="hidden" name="id_slot_3" value="<?php echo $idS3; ?>">
      <input type="hidden" name="id_slot_4" value="<?php echo $idS4; ?>">

      <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
      <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" placeholder="Description" name="description"><?php echo $data['description']; ?></textarea>
      </div>
      <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
      <input type="submit" name="btnEnter" value="Save" class="btn btn-primary btn-block">

    </form>
  </div>
<?php  require_once('template/footer-frm.php'); ?>   