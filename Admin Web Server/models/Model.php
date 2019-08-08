<?php 
	class Model{
		private $con = null;

		function __construct(){
			$this->con = mysqli_connect(HOST, USER, PASS, NAME_DB);
			mysqli_set_charset($this->con, "utf8");
			if (!$this->con){
			  die("Connection error: " . mysqli_connect_error());
			}
		}

		public function testConnect(){
			return $this->con;
		}

		//Adapters
		public function checkExistsAdapter($name, $id = null){
			$query = "SELECT `adapters`.`id` FROM `adapters` WHERE `adapters`.`name` LIKE '$name' ";
			if($id != null){
				$query .= "AND `adapters`.`id` <> $id";
			}
			$data = $this->con->query($query);
			$numRows = $data->num_rows;

			return $numRows;
		}

		public function getAdapterById($id){
			$query = "SELECT `id`, `name`, `description` FROM `adapters` WHERE `id` = $id ";
			$data = $this->con->query($query);
			$this->con->close();
			$numRows = $data->num_rows;
			$result = null;
			if($numRows > 0){
				if($row = $data->fetch_assoc()){
					$result = $row;
				}
			}
			return $result;
		}

		public function insertAdapter($name, $description=null){
			$query = "INSERT INTO `adapters`(`name`, `description`) VALUES ('$name', '$description')";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}
		
		public function updateAdapter($id, $name, $description=null){
			$query = "UPDATE `adapters` SET `name`='$name', `description`='$description' WHERE `id` = $id";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function getListAdapter(){
			$query = "SELECT `id`, `name`, `description` FROM `adapters` ORDER BY `id` DESC";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = array();
			if($numRows > 0){
				while($row = $data->fetch_assoc()){
					$result[] = $row;
				}
			}
			return $result;
		}

		public function deleteAdapter($id){
			$query = "DELETE FROM `adapters` WHERE `id` = $id";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function updateModelWithAdapter($idAdapter){
			$query = "
				UPDATE `models` 
				SET `models`.`id_adapter` = NULL 
				WHERE `models`.`id_adapter` = $idAdapter";
			$check = $this->con->query($query);
			return $check;

		}
		//End Adapters

		//Documents
		public function checkExistsDocument($name, $id = null){
			$query = "SELECT `documents`.`id` FROM `documents` WHERE `documents`.`name` LIKE '$name' ";
			if($id != null){
				$query .= "AND `documents`.`id` <> $id ";
			}
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			return $numRows;
		}

		public function insertDocument($name, $description = null){
			$query = "INSERT INTO `documents`(`name`, `description`) VALUES ('$name', '$description')";
			$check = $this->con->query($query);
			
			$this->con->close();
			return $check;
		}

		public function updateDocument($id, $name, $description = null){
			$query = "UPDATE `documents` SET `name`='$name', `description`= '$description' WHERE `id` = $id";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function getListDocument(){
			$query = "SELECT * FROM `documents` ORDER BY `id` DESC";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = array();
			if($numRows > 0){
				while($row = $data->fetch_assoc()){
					$result[] = $row;
				}
			}
			return $result;
		}

		public function getDocumentById($id){
			$query = "SELECT * FROM `documents` WHERE `id` = $id ";
			$data = $this->con->query($query);
			$this->con->close();
			$numRows = $data->num_rows;
			$result = null;
			if($numRows > 0){
				if($row = $data->fetch_assoc()){
					$result = $row;
				}
			}
			return $result;
		}

		public function deleteDocument($idDocument){
			$query = "DELETE FROM `documents` WHERE `id` = $idDocument";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function updateModelWithDocument($idDocument){
			$query = "UPDATE `models` SET `id_document`= $idDocument WHERE `id_document` = $idDocument";
			$check = $this->con->query($query);
			return $check;
		}
		//End Documents

		//Models
		public function checkExistsModel($name, $id = null){
			$query = "SELECT `models`.`id` FROM `models` WHERE `models`.`name` LIKE '$name' ";
			if($id != null){
				$query .= " AND `models`.`id` <> $id ";
			}
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			return $numRows;
		}

		public function checkExistsKeypart($name, $id = null){
			$query = "SELECT `id` FROM `models` WHERE `models`.`keypart` LIKE '$name' ";
			if($id != null){
				$query .= " AND `models`.`id` <> $id ";
			}
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			return $numRows;
		}

		public function insertModel($name, $idAdapter, $idDocument, $keyPart, $description = null){
			$check = false;
			$query = "
				INSERT INTO `models`(`name`, `id_adapter`, `id_document`, `keypart`,  `description`)
				VALUES ('$name', $idAdapter, $idDocument, '$keyPart', '$description')";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function updateModel($id, $name, $idAdapter, $idDocument, $keyPart, $description = null){
			$check = false;
			$query = "UPDATE `models` SET `name` = '$name',`id_adapter` = $idAdapter, `id_document` = $idDocument, `description`= '$description', `keypart`='$keyPart' WHERE `id` = $id";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function getListModel(){
			$query = "
				SELECT `models`.`id`, `models`.`name`, `models`.`description`, `models`.`id_adapter`, `adapters`.`name` as 'adapter_name', `models`.`id_document`,`documents`.`name` as 'document_name', `models`.`keypart` 
				FROM `models` 
				LEFT JOIN `adapters` ON `models`.`id_adapter` = `adapters`.`id` 
				LEFT JOIN `documents` ON `models`.`id_document` = `documents`.`id`
				ORDER BY `models`.`id` DESC";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = array();
			if($numRows > 0){
				while($row = $data->fetch_assoc()){
					$result[] = $row;
				}
			}
			return $result;
		}

		public function getModelById($id){
			$query = "
				SELECT `models`.`id`, `models`.`name`, `models`.`description`, `models`.`id_adapter`, `adapters`.`name` as 'adapter_name', `models`.`id_document`,`documents`.`name` as 'document_name', `models`.`keypart` 
				FROM `models` 
				LEFT JOIN `adapters` ON `models`.`id_adapter` = `adapters`.`id` 
				LEFT JOIN `documents` ON `models`.`id_document` = `documents`.`id`
				WHERE `models`.`id` = $id";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = null;
			if($numRows > 0){
				if($row = $data->fetch_assoc()){
					$result = $row;
				}
			}
			return $result;
		}

		public function deleteModel($id){
			$query = "DELETE FROM `models` WHERE `id` = $id";
			$check = $this->con->query($query);
			return $check;
		}

		public function updateSlotWithModel($idModel){
			$query = "UPDATE `slots` SET `id_model` = NULL WHERE `slots`.`id_model` = $idModel";
			$check = $this->con->query($query);
			return $check;
		}
		//End Models

		//Racks
		public function checkExistsRacks($name, $idLine, $id = null){
			$query = "SELECT `racks`.`id` 
				FROM `racks` 
				INNER JOIN `line` ON `line`.`id` = `racks`.`id_line`
				WHERE `racks`.`id_line` = $idLine AND `racks`.`name` LIKE '$name' ";
			if($id != null){
				$query .= " AND `racks`.`id` <> $id ";
			}

			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			return $numRows;
		}
		
		public function getInfoRack($name){
			$query = "
				SELECT `mo`.`name` as 'ModelName', `line`.`number` as 'LineNumber', `line`.`name` as 'LineName', `racks`.`name` as 'RackNumber', `slots`.`running` as 'Running' , (CASE WHEN `racks`.`type` LIKE 'adapter' THEN `mo`.`adapter_name` ELSE `mo`.`document_name` END) as 'KeyPartNo'
				FROM `racks` 
				INNER JOIN `line` ON `racks`.`id_line` = `line`.`id`
				INNER JOIN `slots` ON `racks`.`id` = `slots`.`id_rack`
				INNER JOIN (
					SELECT `models`.`id`, `models`.`name`, `documents`.`name` as 'document_name', `adapters`.`name` as 'adapter_name'
				    FROM `models`
				    INNER JOIN `adapters` ON `models`.`id_adapter` = `adapters`.`id`
				    INNER JOIN `documents` ON `models`.`id_document` = `documents`.`id`
				) mo ON `slots`.`id_model` = `mo`.`id`
				WHERE `racks`.`name` LIKE '$name'
				LIMIT 0,2";
			$data = $this->con->query($query);
			$this->con->close();
			$numRows = $data->num_rows;
			$result = null;
			if($numRows > 0){
				if($row = $data->fetch_assoc()){
					$result = $row;
				}
			}
			return $result;
		}

		/**
		* @param $type: adapter
		* @param $type: document
		*/
		public function getListRackByType($type){
			$query = "
				SELECT `racks`.`id`, `racks`.`name`, `racks`.`type`, `racks`.`description`, `line`.`number` as 'line_number', GROUP_CONCAT(`models`.`name`) as 's1s2', GROUP_CONCAT(`slots`.`running`) as 'running'
				FROM `racks`
				LEFT JOIN `line` ON `racks`.`id_line` = `line`.`id`
				INNER JOIN `slots` ON `racks`.`id` = `slots`.`id_rack`
				LEFT JOIN `models` ON `slots`.`id_model` = `models`.`id`
				WHERE `racks`.`type` LIKE '$type'
				GROUP BY `racks`.`id`
				ORDER BY CAST(SUBSTR(`racks`.`name`, 2) AS UNSIGNED) DESC";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = array();
			if($numRows > 0){
				while($row = $data->fetch_assoc()){
					$result[] = $row;
				}
			}
			return $result;
		}

		public function getRackById($id){
			$query = "
				SELECT `racks`.`id`, `racks`.`name`, `racks`.`type`, `racks`.`description`, `line`.`number` as 'line_number', GROUP_CONCAT(`models`.`name`) as 's1s2', `line`.`id` as 'id_line'
				FROM `racks`
				LEFT JOIN `line` ON `racks`.`id_line` = `line`.`id`
				LEFT JOIN `slots` ON `racks`.`id` = `slots`.`id_rack`
				LEFT JOIN `models` ON `slots`.`id_model` = `models`.`id`
				WHERE `racks`.`id` = $id
				GROUP BY `racks`.`id`
				ORDER BY CAST(SUBSTR(`racks`.`name`, 2) AS UNSIGNED) ASC";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = null;
			if($numRows > 0){
				if($row = $data->fetch_assoc()){
					$result = $row;
				}
			}
			return $result;
		}

		public function updateRack($id, $name, $type, $idLine, $desc = null){
			$check = false;
			$query = "UPDATE `racks` SET `name`='$name',`type`='$type',`id_line`='$idLine',`description`='$desc' WHERE `id` = $id";
			$check = $this->con->query($query);
			return $check;
		}

		public function insertRack($name, $type, $idLine, $desc = null){
			$check = false;
			$query = "INSERT INTO `racks`(`name`, `type`, `id_line`, `description`) VALUES ('$name', '$type', $idLine, '$desc')";
			$check = $this->con->query($query);
			return $this->con->insert_id;
		}

		public function deleteRack($id){
			$query = "DELETE FROM `racks` WHERE `id` = $id";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function deleteSlotWithRack($idRack){
			$query = "DELETE FROM `slots` WHERE `id_rack` = $idRack";
			$check = $this->con->query($query);
			return $check;
		}
		//End Racks

		//Line
		public function checkExistsLine($number, $id = null){
			$query = "SELECT `id` FROM `line` WHERE `number` LIKE '$number' ";
			if($id != null){
				$query .= " AND `id` <> $id ";
			}
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			return $numRows;
		}

		public function insertLine($lineNumber, $lineName, $description){
			$check = false;
			$query = "INSERT INTO `line`(`number`, `name`, `description`) VALUES ('$lineNumber', '$lineName', '$description')";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function updateLine($id, $lineNumber, $lineName, $description){
			$check = false;
			$query = "UPDATE `line` SET `number` = '$lineNumber' , `name` = '$lineName', `description` = '$description' WHERE `id`= $id";
			$check = $this->con->query($query);
			$this->con->close();
			return $check;
		}

		public function getListLine(){
			$query = "SELECT * FROM `line` WHERE 1";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = array();
			if($numRows > 0){
				while($row = $data->fetch_assoc()){
					$result[] = $row;
				}
			}
			return $result;
		}

		public function getLineById($id){
			$query = "SELECT * FROM `line` WHERE `id` = $id";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = null;
			if($numRows > 0){
				if($row = $data->fetch_assoc()){
					$result = $row;
				}
			}
			return $result;
		}

		public function deleteLine($id){
			$query = "DELETE FROM `line` WHERE `id` = $id";
			$check = $this->con->query($query);
			return $check;
		}

		public function updateRackWithLine($idLine){
			$query = "UPDATE `racks` SET `id_line` = NULL WHERE `racks`.`id_line` = $idLine";
			$check = $this->con->query($query);
			return $check;
		}
		//End Line

		//Slot
		public function updateSlotForId($id, $idModel){
			$query = "UPDATE `slots` SET `id_model` = $idModel WHERE `id` = $id";
			$check = $this->con->query($query);
			return $check;
		}

		public function insertSlotForRack($idRack, $idModel1 = 'NULL', $idModel2 = 'NULL', $idModel3 = 'NULL', $idModel4 = 'NULL'){
			$check = false;
			$query = "INSERT INTO `slots`(`id_rack`, `id_model`, `name`) 
					VALUES ($idRack, $idModel1, 'S1'), ($idRack, $idModel2, 'S2')
						, ($idRack, $idModel3, 'S3'), ($idRack, $idModel4, 'S4')";
			$check = $this->con->query($query);
			return $check;
		}

		public function getSlotByIdRack($idRack){
			$query = "
				SELECT `slots`.`id`, `slots`.`name`, `models`.`name` as 'model_name'
				FROM `slots`
				LEFT JOIN `models` ON `slots`.`id_model` = `models`.`id`
				WHERE `slots`.`id_rack` = $idRack
				ORDER BY `slots`.`name` ASC ";
			$data = $this->con->query($query);
			$numRows = $data->num_rows;
			$result = array();
			if($numRows > 0){
				while($row = $data->fetch_assoc()){
					$result[] = $row;
				}
			}
			return $result;
		}
		//End Slot
	}
?>