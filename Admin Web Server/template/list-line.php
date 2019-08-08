<?php include_once("template/header.php"); ?>
 <!-- Breadcrumbs-->
      <div class="row">
        <div class="col-12">

        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> List Line <a href="?task=frmInsertLine" class="float-right"><button class="btn btn-primary btn-sm">Add</button></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      					<tr>
                  <th>STT</th>
                  <th>Line number</th>
                  <th>Line name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                <?php $stt = 0; ?>
                <?php foreach ($data as $key => $value) : ?>
                  <tr>
                    <td><?php echo ++$stt; ?></td>
                    <td><?php echo $value['number']; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['description']; ?></td>
                    <td>
                      <a href="?task=frmUpdateLine&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-info font-size-12">Update</button></a>
                      <a href="?task=deleteLine&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger font-size-12">Delete</button></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
              <!-- Pie chart example -->
              <!-- End pie chart example -->
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include_once("template/footer.php"); ?>