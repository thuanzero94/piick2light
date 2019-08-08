<?php include_once("define.php"); ?>
<?php include_once("models/Model.php"); ?>
<?php include_once("views/View.php"); ?>

<?php 
	$name = "N1";
	$type = "adapter";
	$idLine = 5;
	$desc = "Demo Test";
	$model = new Model();
	// $check = $model->insertRack($name, $type, $idLine, NULL, $desc);
	echo $name;

?>
