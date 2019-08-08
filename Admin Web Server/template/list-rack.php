<?php include_once("template/header.php"); ?>
 <!-- Breadcrumbs-->
  <div class="row">
    <div class="col-12">
      <div class="w3-row">
        <a href="javascript:void(0)" onclick="openTab(event, 'adpater');">
          <div class="w3-col tablink w3-bottombar w3-hover-light-grey w3-padding w3-border-red" style="width: 30%;"><i class="fa fa-plug color-icon" ></i> Rack For Adapter</div>
        </a>
        <a href="javascript:void(0)" onclick="openTab(event, 'document');">
          <div class="w3-col tablink w3-bottombar w3-hover-light-grey w3-padding" style="width: 30%;"><i class="fa fa-file-text color-icon"></i> Rack For Document</div>
        </a>
      </div>
      <a href="?task=frmInsertRack" class="float-right"><button class="btn btn-primary btn-sm">Add</button></a>

      <div class="tab-content">
        <div id="adpater" class="w3-container rack w3-animate-opacity" style="display:block">
          <div class="table-responsive">
              <table class="table table-condensed table-bordered">
                <tr>
                  <th>STT</th>
                  <th>Name</th>
                  <th>Line</th>
                  <th>S1, S2, S3, S4</th>
                  <th>Action</th>
                </tr>
                <?php $stt = 0; ?>
                <?php foreach ($rackAdap as $key => $value) : ?>
                  <tr>
                    <td><?php echo ++$stt; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['line_number']; ?></td>
                    <td><?php echo $value['s1s2']; ?></td>
                    <td>
                      <a href="?task=frmUpdateRack&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-info font-size-12">Update</button></a>
                      <a href="?task=deleteRack&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger font-size-12">Delete</button></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
      <div id="document" class="w3-container rack w3-animate-opacity" style="display:none">
        <table class="table table-condensed table-bordered">
            <tr>
              <th>STT</th>
              <th>Name</th>
              <th>Line</th>
              <th>S1, S2, S3, S4</th>
              <th>Action</th>
            </tr>
            <?php $stt = 0; ?>
            <?php foreach ($rackDoc as $key => $value) : ?>

              <tr>
                <td><?php echo ++$stt; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['line_number']; ?></td>
                <td><?php echo $value['s1s2']; ?></td>
                <td>
                  <a href="?task=frmUpdateRack&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-info font-size-12">Update</button></a>
                  <a href="?task=deleteRack&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger font-size-12">Delete</button></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>  
    </div>
  </div>
<script>
  function openTab(event, nameTab) {
    var i, x, tablinks;
    x = document.getElementsByClassName("rack");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
    }
    document.getElementById(nameTab).style.display = "block";
    event.currentTarget.firstElementChild.className += " w3-border-red";
  }
</script>
<?php include_once("template/footer.php"); ?>