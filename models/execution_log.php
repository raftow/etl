<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class ExecutionLog extends AFWObject{

        public static $MY_ATABLE_ID=13978; 
  
        public static $DATABASE		= "tvtc_etl";
        public static $MODULE		        = "etl";        
        public static $TABLE			= "execution_log";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("execution_log","id","etl");
            EtlExecutionLogAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new ExecutionLog();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        public static function loadByMainIndex($mapping_job_id, $data_api_id, $run_date,
        $input, $output, $title_output,
        $create_obj_if_not_found=false)
        {
           if(!$mapping_job_id) throw new AfwRuntimeException("loadByMainIndex : mapping_job_id is mandatory field");
           if(!$data_api_id) throw new AfwRuntimeException("loadByMainIndex : data_api_id is mandatory field");
           if(!$run_date) throw new AfwRuntimeException("loadByMainIndex : run_date is mandatory field");
           if($create_obj_if_not_found) 
           {
                if(!$input) throw new AfwRuntimeException("loadByMainIndex : input is mandatory field when create_obj_if_not_found is true");
                if(!$output) throw new AfwRuntimeException("loadByMainIndex : output is mandatory field when create_obj_if_not_found is true");
           }

           $obj = new ExecutionLog();
           $obj->select("mapping_job_id",$mapping_job_id);
           $obj->select("data_api_id",$data_api_id);
           $obj->select("run_date",$run_date);

           if($obj->load())
           {
                if($create_obj_if_not_found) 
                {
                    $obj->set("input",$input);
                    $obj->set("output",$output);
                    $obj->set("output_title",$title_output);
                    $obj->activate();
                }
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("mapping_job_id",$mapping_job_id);
                $obj->set("data_api_id",$data_api_id);
                $obj->set("run_date",$run_date);
                $obj->set("input",$input);
                $obj->set("output",$output);
                $obj->set("output_title",$title_output);
                $obj->insertNew();
                if(!$obj->id) return null; // means beforeInsert rejected insert operation
                $obj->is_new = true;
                return $obj;
           }
           else return null;
           
        }

        

        public function getScenarioItemId($currstep)
        {
            return 0;
        }
        

        
        

        
        protected function getOtherLinksArray($mode,$genereLog=false,$step="all")      
        {
             $lang = AfwLanguageHelper::getGlobalLanguage();
             // $objme = AfwSession::getUserConnected();
             // $me = ($objme) ? $objme->id : 0;

             $otherLinksArray = $this->getOtherLinksArrayStandard($mode,$genereLog,$step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             
             
             // check errors on all steps (by default no for optimization)
             // rafik don't know why this : \//  = false;
             
             return $otherLinksArray;
        }
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
            //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));
            
            
            
            return $pbms;
        }
        
        public function fld_CREATION_USER_ID()
        {
                return "created_by";
        }

        public function fld_CREATION_DATE()
        {
                return "created_at";
        }

        public function fld_UPDATE_USER_ID()
        {
        	return "updated_by";
        }

        public function fld_UPDATE_DATE()
        {
        	return "updated_at";
        }
        
        public function fld_VALIDATION_USER_ID()
        {
        	return "validated_by";
        }

        public function fld_VALIDATION_DATE()
        {
                return "validated_at";
        }
        
        public function fld_VERSION()
        {
        	return "version";
        }

        public function fld_ACTIVE()
        {
        	return  "active";
        }
        
        

        public function beforeMaj($id, $fields_updated)
        {
            return true;
        }            
        
        
        public function beforeDelete($id,$id_replace) 
        {
            $server_db_prefix = AfwSession::config("db_prefix","tvtc_");
            
            if(!$id)
            {
                $id = $this->getId();
                $simul = true;
            }
            else
            {
                $simul = false;
            }
            
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 

                        
                   // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 

