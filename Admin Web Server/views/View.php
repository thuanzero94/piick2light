<?php 
	class View{
		public function showError404(){
			require_once('template/404.php');
		}

		public function frmLogin(){
			require_once('template/frm-login.php');
		}

		//Adapters
		public function showListAdapter($data){
			$title = "List Adapter";
			require_once('template/list-adapter.php');
		}

		public function frmInsertAdapter(){
			$title = "Insert Adapter";
			require_once('template/frm-insert-adapter.php');
		}

		public function frmUpdateAdapter($data){
			$title = "Update Adapter ".$data['name'];
			require_once('template/frm-update-adapter.php');
		}
		//End Adapters

		//Documents
		public function showListDocument($data){
			$title = "List Document";
			require_once('template/list-document.php');
		}
		
		public function frmInsertDocument(){
			$title = "Insert Document";
			require_once('template/frm-insert-document.php');
		}

		public function frmUpdateDocument($data){
			$title = "Update Document ".$data['name'];
			require_once('template/frm-update-document.php');
		}
		//End document

		//Model
		public function showListModel($data){
			$title = "List Model";
			require_once('template/list-model.php');
		}

		public function frmInsertModel($listAdap, $listDoc){
			$title = "Insert Model";
			require_once('template/frm-insert-model.php');
		}

		public function frmUpdateModel($data, $listAdap, $listDoc){
			$title = "Update Line ".$data['name'];
			require_once('template/frm-update-model.php');
		}
		//End Model

		//Line
		public function showListLine($data){
			$title = "List Line";
			require_once('template/list-line.php');
		}

		public function frmInsertLine(){
			$title = "Insert Line";
			require_once('template/frm-insert-line.php');
		}

		public function frmUpdateLine($data){
			$title = "Update Line ".$data['number'];
			require_once('template/frm-update-line.php');
		}
		//End Line

		//Rack
		public function showListRack($rackAdap, $rackDoc){
			$title = "List Rack";
			require_once('template/list-rack.php');
		}

		public function frmInsertRack($line, $models){
			$title = "Insert Rack";
			require_once('template/frm-insert-rack.php');
		}

		public function frmUpdateRack($data, $line, $models, $slot){
			$title = "Update Rack ".$data['name'];
			require_once('template/frm-update-rack.php');
		}
		//End Rack
	}
?>