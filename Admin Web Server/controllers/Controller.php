<?php include_once("models/Model.php"); ?>
<?php include_once("views/View.php"); ?>

<?php 
	class Controller{
		private $model = null;
		private $view = null;
		private $data = null;

		function __construct($foo = null){
			$this->model = new Model();
			$this->view = new View();
		}

		public function showError404(){
			$this->view->showError404();
		}

		public function frmLogin(){
			$this->view->frmLogin();
		}

		public function loginSystem(){
			if(isset($_POST['username'])){
				$user = $_POST['username'];
				$pass = $_POST['password'];
				if($user == "admin" && $pass == "1"){
					$_SESSION['logged'] = true;
					header('Location: '.DOMAIN);
				}else{
					echo "Wrong username or password. Click <a href='".DOMAIN."'>Back</a>";
				}
			}else{
				$this->view->showError404();
			}
		}

		public function logoutSystem(){
			session_destroy();
			header('Location: '.DOMAIN);
		}

		//Adapters
		public function showListAdapter(){
			$this->data = $this->model->getListAdapter();
			$this->view->showListAdapter($this->data);
		}

		public function frmUpdateAdapter(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$this->data = $this->model->getAdapterById($id);
					$this->view->frmUpdateAdapter($this->data);
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function updateAdapter(){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				$name = $_POST['a_name'];
				$description = $_POST['a_description'];
				if($id > 0){
					if($this->model->checkExistsAdapter() == 0){
						$this->data = $this->model->updateAdapter($id, $name, $description);
						if($this->data){
							echo "Update adapter successful.";
						}else{
							echo "Update adapter fail.";
						}
					}else{
						echo "The name already exists in the system !!!";
					}
					echo "<a href='?task=showListAdapter'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function frmInsertAdapter(){
			$this->view->frmInsertAdapter();
		}

		public function insertAdapter(){
			if(isset($_POST['a_name'])){
				$name = $_POST['a_name'];
				$desc = $_POST['a_description'];
				if($this->model->checkExistsAdapter($name) == 0){
					$check = $this->model->insertAdapter($name, $desc);
					if($check){
						echo "Insert successful.";
					}else{
						echo "Insert fail.";
					}
				}else{
					echo "The name Apdater already exists in the system !!!";
				}
				echo "<a href='?task=showListAdapter'>Back</a>";
			}
		}

		public function deleteAdapter(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){	
					$check = $this->model->updateModelWithAdapter($id);
					if($check){
						$check1 = $this->model->deleteAdapter($id);
						if($check1){
							echo "Delete adapter successful.";
						}else{
							echo "Delete adapter fail (delete adapter).";
						}
					}else{
						echo "Delete adapter fail (update model).";
					}
					echo "<a href='?task=showListAdapter'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}
		//End Adapters

		//Document
		public function showListDocument(){
			$this->data = $this->model->getListDocument();
			$this->view->showListDocument($this->data);
		}

		public function frmUpdateDocument(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$this->data = $this->model->getDocumentById($id);
					$this->view->frmUpdateDocument($this->data);
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function updateDocument(){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				if($id > 0){
					$name = $_POST['d_name'];
					$desc = $_POST['d_description'];
					if($this->model->checkExistsDocument($name, $id) == 0){
						$check = $this->model->updateDocument($id, $name, $desc);
						if($check){
							echo "Update document successful.";
						}else{
							echo "Update document fail.";
						}
					}else{
						echo "The name Document already exists in the system !!!";
					}
					echo "<a href='?task=showListDocument'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function frmInsertDocument(){
			$this->view->frmInsertDocument();
		}

		public function insertDocument(){
			if(isset($_POST['d_name'])){
				$name = $_POST['d_name'];
				$desc = $_POST['d_description'];
				if($this->model->checkExistsDocument($name) == 0){
					$check = $this->model->insertDocument($name, $desc);
					if($check){
						echo "Insert document successful.";
					}else{
						echo "Insert document fail.";
					}
				}else{
					echo "The name Document already exists in the system !!!";
				}
				echo "<a href='?task=showListDocument'>Back</a>";
			}else{
				$this->view->showError404();
			}
		}

		public function deleteDocument(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$check_umwd = $this->model->updateModelWithDocument($id);
					if($check_umwd){
						$check_dd = $this->model->deleteDocument($id);
						if($check_dd){
							echo "Delete document successful.";
						}else{
							echo "Delete document fail (delete document).";
						}
					}else{
						echo "Delete document fail (update model).";
					}
					echo "<a href='?task=showListDocument'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}
		//End document

		//Model
		public function showListModel(){
			$this->data = $this->model->getListModel();
			$this->view->showListModel($this->data);
		}

		public function frmUpdateModel(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$this->data = $this->model->getModelById($id);
					$listAdapter = $this->model->getListAdapter();
					$listDocument = $this->model->getListDocument();
					$this->view->frmUpdateModel($this->data, $listAdapter, $listDocument);
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function updateModel(){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				$name = $_POST['m_name'];
				$desc = $_POST['m_description'];
				$idAdapter = $_POST['id_adapter'];
				$idDocument = $_POST['id_document'];
				$keypart = $_POST['keypart'];
				if($id > 0){
					if($this->model->checkExistsKeypart($keypart, $id) == 0){
						$check = $this->model->updateModel($id, $name, $idAdapter, $idDocument, $keypart, $desc);
						if($check){
							echo "Update Model successful.";
						}else{
							echo "Update Model fail.";
						}
					}else{
						echo "The Keypart already exists in the system !!!";
					}
					echo "<a href='?task=showListModel'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function frmInsertModel(){
			$listAdapter = $this->model->getListAdapter();
			$listDocument = $this->model->getListDocument();
			$this->view->frmInsertModel($listAdapter, $listDocument);
		}

		public function insertModel(){
			if(isset($_POST['m_name'])){
				$name = $_POST['m_name'];
				$desc = $_POST['m_description'];
				$idAdapter = $_POST['id_adapter'];
				$idDocument = $_POST['id_document'];
				$keypart = $_POST['keypart'];

				if($this->model->checkExistsKeypart($keypart) == 0){
					$check = $this->model->insertModel($name, $idAdapter, $idDocument, $keypart, $desc);
					if($check){
						echo "Insert Model-keypart successful.";
					}else{
						echo "Insert Model-keypart fail.";
					}
				}else{
					echo "The Keypart already exists in the system !!!";
				}
				echo "<a href='?task=showListModel'>Back</a>";
			}else{
				$this->view->showError404();
			}
		}

		public function deleteModel(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$check_uswm = $this->model->updateSlotWithModel($id);
					if($check_uswm){
						$check_dm = $this->model->deleteModel($id);
						if($check_dm){
							echo "Delete model successful.";
						}else{
							echo "Delete model fail (delete model).";
						}
					}else{
						echo "Delete model fail (update slot).";
					}
					echo "<a href='?task=showListModel'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}
		//End Model

		//Line
		public function showListLine(){
			$this->data = $this->model->getListLine();
			$this->view->showListLine($this->data);
		}

		public function frmInsertLine(){
			$this->view->frmInsertLine();
		}

		public function insertLine(){
			if(isset($_POST['number'])){
				$lineNumber = $_POST['number'];
				$lineName = $_POST['name'];
				$desc = $_POST['description'];
				if($this->model->checkExistsLine($lineNumber) == 0){
					$check = $this->model->insertLine($lineNumber, $lineName, $desc);
					if($check){
						echo "Insert Line successful.";
					}else{
						echo "Insert Line fail.";
					}
				}else{
					echo "The line number already exists in the system !!!";
				}
				echo "<a href='?task=showListLine'>Back</a>";
			}else{
				$this->view->showError404();
			}
		}

		public function frmUpdateLine(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$this->data = $this->model->getLineById($id);
					$this->view->frmUpdateLine($this->data);
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function updateLine(){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				if($id > 0){
					$lineNumber = $_POST['number'];
					if($this->model->checkExistsLine($lineNumber, $id) == 0){

						$lineName = $_POST['name'];
						$desc = $_POST['description'];
						$check = $this->model->updateLine($id, $lineNumber, $lineName, $desc);
						if($check){
							echo "Update Line Successful.";
						}else{
							echo "Update Line Fail.";
						}
					}else{
						echo "The line number already exists in the system !!!";
					}
					echo "<a href='?task=showListLine'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function deleteLine(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$check_uswm = $this->model->updateRackWithLine($id);
					if($check_uswm){
						$check_dm = $this->model->deleteLine($id);
						if($check_dm){
							echo "Delete line successful.";
						}else{
							echo "Delete line fail (delete line).";
						}
					}else{
						echo "Delete line fail (update rack).";
					}
					echo "<a href='?task=showListLine'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}
		//End Line

		//Rack
		public function showListRack(){
			$rackAdap = $this->model->getListRackByType(ADAPTER);
			$rackDoc = $this->model->getListRackByType(DOCUMENT);
			$this->view->showListRack($rackAdap, $rackDoc);
		}

		public function frmUpdateRack(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$this->data = $this->model->getRackById($id);
					$slot = $this->model->getSlotByIdRack($id);
					$models = $this->model->getListModel();
					$line = $this->model->getListLine();
					$this->view->frmUpdateRack($this->data, $line, $models, $slot);
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function updateRack(){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				$idLine = $_POST['id_line'];
				if($id > 0){
					$name = $_POST['name'];
					if($this->model->checkExistsRacks($name, $idLine, $id) == 0){
						$type = $_POST['type_rack'];
						$slot1 = $_POST['s1']; //id_model in slot 1
						$slot2 = $_POST['s2']; //id_model in slot 2
						$idSlot1 = $_POST['id_slot_1'];
						$idSlot2 = $_POST['id_slot_2'];
						$idSlot3 = $_POST['id_slot_3'];
						$idSlot4 = $_POST['id_slot_4'];

						$isUsingS34 = $_POST['usingS34'];
						if($isUsingS34 != null){
							$slot3 = $_POST['s3'];//id_model in slot 3
							$slot4 = $_POST['s4'];//id_model in slot 4
						}

						$desc = $_POST['description'];
						$checkRack = $this->model->updateRack($id, $name, $type, $idLine, $desc);
						if($checkRack){
							$checkSlot1 = $this->model->updateSlotForId($idSlot1, $slot1);
							$checkSlot2 = $this->model->updateSlotForId($idSlot2, $slot2);
							$checkSlot3 = $this->model->updateSlotForId($idSlot3, $slot3);
							$checkSlot4 = $this->model->updateSlotForId($idSlot4, $slot4);

							if($checkSlot1 && $checkSlot2 && $checkSlot3 && $checkSlot4){
								echo "Update data successful.";
							}else{
								echo "Update Slot fail.";
							}
						}else{
							echo "Update Rack fail.";
						}
					}else{
						echo "The Racks already exists in the system !!!";
					}
					echo "<a href='?task=showListRack'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}

		public function frmInsertRack(){
			$models = $this->model->getListModel();
			$line = $this->model->getListLine();
			$this->view->frmInsertRack($line, $models);
		}

		public function insertRack(){
			if(isset($_POST['name'])){
				$name = $_POST['name'];
				$idLine = $_POST['id_line'];
				if($this->model->checkExistsRacks($name, $idLine) == 0){
					$type = $_POST['type_rack'];
					$slot1 = $_POST['s1']; //id_model in slot 1
					$slot2 = $_POST['s2']; //id_model in slot 2
					$slot3 = $slot4 = "null";
					$desc = $_POST['description'];

					$isUsingS34 = $_POST['usingS34'];
					if($isUsingS34 != null){
						$slot3 = $_POST['s3'];//id_model in slot 3
						$slot4 = $_POST['s4'];//id_model in slot 4
					}

					$check = $this->model->insertRack($name, $type, $idLine, $desc);
					if($check > 0){
						$check2 = $this->model->insertSlotForRack($check, $slot1, $slot2, $slot3, $slot4);
						if($check2){
							echo "Insert data successful.";	
						}else{
							echo "Insert data fail.";	
						}
					}else{
						echo "Insert Rack fail.";
					}
				}else{
					echo "The Racks already exists in the system !!!";
				}
				echo "<a href='?task=showListRack'>Back</a>";
			}else{
				$this->view->showError404();
			}
		}

		public function deleteRack(){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id > 0){
					$check_dswr = $this->model->deleteSlotWithRack($id);
					if($check_dswr){
						$check_dr = $this->model->deleteRack($id);
						if($check_dr){
							echo "Delete rack successful.";
						}else{
							echo "Delete rack fail (delete rack).";
						}
					}else{
						echo "Delete rack fail (delete slot).";
					}
					echo "<a href='?task=showListRack'>Back</a>";
				}else{
					$this->view->showError404();
				}
			}else{
				$this->view->showError404();
			}
		}
		//End Rack
	}
?>