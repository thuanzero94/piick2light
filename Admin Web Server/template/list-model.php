<?php include_once("template/header.php"); ?>
 <!-- Breadcrumbs-->
      <div class="row">
        <div class="col-12">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> List Model <a href="?task=frmInsertModel" class="float-right"><button class="btn btn-primary btn-sm">Add</button></a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      					<tr>
                  <th>STT</th>
                  <th>Model Name</th>
                  <th>Keypart QTY</th>
                  <th>Description</th>
                  <th>Adapter P/N</th>
                  <th>Document P/N</th>
                  <th>Action</th>
                </tr>
                <?php $stt = 0; ?>
                <?php foreach ($data as $key => $value) : ?>
                  <tr>
                    <td><?php echo ++$stt; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['keypart']; ?></td>
                    <td><?php echo $value['description']; ?></td>
                    <td><?php echo $value['adapter_name']; ?></td>
                    <td><?php echo $value['document_name']; ?></td>
                    <td>
                      <a href="?task=frmUpdateModel&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-info font-size-12">Update</button></a>
                      <a href="?task=deleteModel&id=<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger font-size-12">Delete</button></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include_once("template/footer.php"); ?>