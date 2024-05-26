<?php
if (! defined ( 'BASEPATH' )) {
    exit ( 'No direct script access allowed' );

}
include_once('Base_Model.php');
class Subject_Model extends Base_Model {
    private $table = "subjects";
    //private $campusId;                    //Enable this line for the models that contains campus_id in its table
    public function __construct() {
        parent::__construct ();
        $this->parentTable = $this->table;
        $this->load->model('Class_Model', 'class');
    }
    public function get($id = null) {
        
        $rs = array ();
        $rs=  parent::get($id);
        if(!empty($rs)  ){
            if ($id != null) {
                if(!empty($rs["class_id"])){
                    $class = $this->class->get($rs["class_id"]);
                    $rs["class"] = $class;
                }
            }else{
                if(!empty($rs)){
                    foreach ($rs as $key=>$row){
                        if(!empty($rs[$key]["class_id"])){
                            $class = $this->class->get($rs[$key]["class_id"]);
                            $rs[$key]["class"] = $class;
                        }
                    }
                }
            }
        }
        
        
        return $rs;
    }
    
    public function getByClass($classId = null) {
        
        $rs = array ();
        if(empty($classId)){
        	return $rs;
        }
        
        $rs=  parent::getByColumn("class_id", $classId);
        
        if(!empty($rs)){
        	foreach ($rs as $key=>$row){
        		if(!empty($rs[$key]["class_id"])){
        			$class = $this->class->get($rs[$key]["class_id"]);
        			$rs[$key]["class"] = $class;
        		}
        	}
        }
        
        /* if(!empty($rs)  ){
            if ($id != null) {
                if(!empty($rs["class_id"])){
                    $class = $this->class->get($rs["class_id"]);
                    $rs["class"] = $class;
                }
            }else{
                if(!empty($rs)){
                    foreach ($rs as $key=>$row){
                        if(!empty($rs[$key]["class_id"])){
                            $class = $this->class->get($rs[$key]["class_id"]);
                            $rs[$key]["class"] = $class;
                        }
                    }
                }
            }
        } */
        
        
        return $rs;
    }
    
   
    
     
    
}

