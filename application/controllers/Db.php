<?php
include_once('Protected_Controller.php');
class Db extends Protected_Controller {
	// protected $activeTemplate = "";
	private $dbtemplate = "db";
	private $dbAjaxtemplate = "db_ajax";
	private $tables= array();
	public function __construct() {
		parent::__construct ();
		
		if ($_SESSION ['sessionUser'] ['user_type'] ['internal_key'] != "application_admin") {
			redirect ( '/user/login' );
		}
		$this->load->model ( 'Dbtool_Model', 'dbtool' );
		$requestType = $this->input->get ( 'rt' );
		if ($requestType == 'm') {
			$this->activeTemplate = $this->dbAjaxtemplate;
		} else {
			$this->activeTemplate = $this->dbtemplate;
			$this->tables = $this->dbtool->getTables ();
		}
	}
	public function index($data = array()) {
		
		$data ["tables"] = $this->tables;
		if (! isset ( $data ["table"] )) {
			$data ["table"] = "";
		}
		if (! isset ( $data ["pageNo"] )) {
			$data ["pageNo"] = 1;
		}
		if (! isset ( $data ["pageSize"] )) {
			$data ["pageSize"] = 10;
		}
		$this->loadView ( "dbtool/index", $data );
	}
	public function load($table = "", $pageNo = 1, $pageSize = 10) {
		$data = array ();
		$data ["tables"] = $this->tables;
		$data ["table"] = $table;
		// $data ["id"] = $id;
		$data ["pageNo"] = $pageNo;
		$data ["prevPage"] = $pageNo - 1;
		$data ["nextPage"] = $pageNo + 1;
		$data ["pageSize"] = $pageSize;
		$this->dbtool->setTable ( $table );
		if (empty ( $table )) {
			$this->index ();
		} else {
			$condition = "fetchAll";
			$startFrom = $pageSize * ($pageNo - 1);
			$rs = $this->dbtool->getByCondition ( $condition, null, 'desc', $pageSize, $startFrom );
			
			$totalCount = $this->dbtool->getTotalCount ( $table );
			
			$totalPages = $totalCount / $pageSize;
			$remander = $totalCount % $pageSize;
			if ($remander > 0) {
				$totalPages += 1;
			}
			if ($pageNo > $totalPages) {
				$pageNo = $totalPages;
			}
			$data ["meta"] = $this->dbtool->getTableMetaInfo ( $table );
			$data ["totalPages"] = ( int ) $totalPages;
			$data ["rs"] = $rs;
			$this->loadView ( "dbtool/index", $data );
		}
	}
	public function runSQLForm($data = array()) {
		$this->loadView ( "dbtool/query_form", $data );
	}
	public function runSQL() {
		$data = array ();
		$data ["tables"] = $this->tables;
		$sql = $this->input->post ( "sql" );
		$data ["sql"] = $sql;
		if (empty ( $sql )) {
			$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
			$this->index ();
		} else {
			
			$response = $this->dbtool->runSQL ( $sql );
			// $data ["response"] = $response;
			if ($response ["status"] == get_app_message ( "response.failed" )) {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
				$_SESSION ["appErrors"] [] = "Error No.: " . $response ["errorNo"];
				$_SESSION ["appErrors"] [] = "Error Message: " . $response ["errorMessage"];
			} else {
				$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
				if(isset ($response["rs"])){
					$data ["rs"] = $response ["rs"];
				}
				if(isset ($response["successMessage"])){
					$data ["successMessage"] = $response ["successMessage"];
				}
				
			}
			$this->runSQLForm ( $data );
		}
	}
	public function create($table = "", $pageNo = "", $pageSize = "") {
		$this->edit ( $table, "", $pageNo, $pageSize );
	}
	public function edit($table = "", $id = "", $pageNo = "", $pageSize = "") {
		if (empty ( $table )) {
			$this->index ();
		} else {
			$this->dbtool->setTable ( $table );
			$data = array ();
			$data ["tables"] = $this->tables;
			$data ["table"] = $table;
			$data ["pageNo"] = $pageNo;
			
			$data ["pageSize"] = $pageSize;
			$rs = array ();
			if (! empty ( $id )) {
				
				$rs = $this->dbtool->getByColumn ( "id", decodeID ( $id ) );
				if (! empty ( $rs )) {
					$rs = $rs [0];
					$data ['row'] = $rs;
				}
			}
			$data ["meta"] = $this->dbtool->getTableMetaInfo ( $table );
			// pre_d($data);
			$this->loadView ( "dbtool/form_wrapper", $data );
		}
	}
	public function save() {
		$data = array ();
		$data ["tables"] = $this->tables;
		$table = $this->input->post ( "table" );
		if (empty ( $table )) {
			$this->index ();
		} else {
			$this->dbtool->setTable ( $table );
			$data = array ();
			$data ["table"] = $table;
			$data ["pageNo"] = $this->input->post ( "pageNo" );
			$data ["pageSize"] = $this->input->post ( "pageSize" );
			$fieldsStr = $this->input->post ( "fields" );
			$fields = explode ( ",", $fieldsStr );
			if (! empty ( $fields )) {
				$entity = array ();
				foreach ( $fields as $field ) {
					$entity [$field] = $this->input->post ( $field );
				}
				// pre_d($entity);
				$response = $this->dbtool->merge ( $entity );
				if (is_numeric ( $response ) || $response == get_app_message ( "response.success" )) {
					$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
				} else {
					$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
				}
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "No data found to process" );
			}
			
			$this->load ( $table, $data ['pageNo'], $data ['pageSize'] );
		}
	}
	public function view($table = "", $id = "", $pageNo = "", $pageSize="") {
		if (empty ( $table )) {
			$this->index ();
		} else {
			$this->dbtool->setTable ( $table );
			$data = array ();
			$data ["tables"] = $this->tables;
			$data ["table"] = $table;
			$data ["pageNo"] = $pageNo;
			$data ["pageSize"] = $pageSize;
			$rs = array ();
			if (! empty ( $id )) {
				$rs = $this->dbtool->getByColumn ( "id", decodeID ( $id ) );
				if (! empty ( $rs )) {
					$rs = $rs [0];
					$data ['row'] = $rs;
				}
			}
			$data ["meta"] = $this->dbtool->getTableMetaInfo ( $table );
			$this->loadView ( "dbtool/view_wrapper", $data );
		}
	}
	public function deleteConfirm($table = "", $id = "", $pageNo = "", $pageSize = "") {
		if (empty ( $table )) {
			$this->index ();
		} else {
			$this->dbtool->setTable ( $table );
			$data = array ();
			$data ["tables"] = $this->tables;
			$data ["table"] = $table;
			$data ["pageNo"] = $pageNo;
			$data ["pageSize"] = $pageSize;
			$rs = array ();
			if (! empty ( $id )) {
				$rs = $this->dbtool->getByColumn ( "id", decodeID ( $id ) );
				if (! empty ( $rs )) {
					$rs = $rs [0];
					$data ['row'] = $rs;
				}
			}
			$data ["meta"] = $this->dbtool->getTableMetaInfo ( $table );
			$this->loadView ( "dbtool/delete_wrapper", $data );
		}
	}
	public function delete() {
		$table = $this->input->post ( "table" );
		
		if (empty ( $table )) {
			$this->index ();
		} else {
			$this->dbtool->setTable ( $table );
			$data = array ();
			$data ["tables"] = $this->tables;
			$data ["table"] = $table;
			$data ["pageNo"] = $this->input->post ( "pageNo" );
			$data ["pageSize"] = $this->input->post ( "pageSize" );
			$rs = array ();
			$confirmed = $this->input->post ( "confirmed" );
			
			$pk = $this->input->post ( "pkCol" );
			$pkValue = $this->input->post ( $pk );
			
			if (empty ( $pkValue ) || $confirmed != "confirmed") {
				$_SESSION ["appErrors"] [] = get_app_message ( "invalid_url" );
				redirect ( "/db/table" . $table );
			}
			$response = $this->dbtool->remove ( decodeID ( $pkValue ) );
			
			if ($response == get_app_message ( "response.success" )) {
				$_SESSION ["appMessages"] [] = get_app_message ( "request_processed_successfully" );
			} else {
				$_SESSION ["appErrors"] [] = get_app_message ( "cannot_process_request" );
			}
			
			$this->load ( $table, $data ['pageNo'], $data ['pageSize'] );
		}
	}
	protected function loadView($view, $data) {
		$this->template->load ( $this->activeTemplate, $view, $data );
	}
}