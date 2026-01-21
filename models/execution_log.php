<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class ExecutionLog extends AFWObject{

        public static $MY_ATABLE_ID=13978; 
  
        public static $DATABASE		= "";
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
        
        public static function loadByMainIndex($api_execution_id, $page,
                                                $input, $output, $title_output,
                                                $create_obj_if_not_found=false)
        {
           if(!$api_execution_id) throw new AfwRuntimeException("loadByMainIndex : api_execution_id is mandatory field");
           if(!$page) throw new AfwRuntimeException("loadByMainIndex : page is mandatory field");
            if($create_obj_if_not_found) 
           {
                if(!$input) throw new AfwRuntimeException("loadByMainIndex : input is mandatory field when create_obj_if_not_found is true");
                if(!$output) throw new AfwRuntimeException("loadByMainIndex : output is mandatory field when create_obj_if_not_found is true");
           }

           $obj = new ExecutionLog();
           $obj->select("api_execution_id",$api_execution_id);
           $obj->select("page",$page);

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
                $obj->set("api_execution_id",$api_execution_id);
                $obj->set("page",$page);
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


        public function calcInputOutputHtml($what = "value")
        {
            $input = AfwSettingsHelper::paramsArrayToString(json_decode($this->getVal("input")));
            $output = $this->getVal("output");
            $output_title = $this->getVal("output_title");
            return "<div class='ioae'>
                <div class='aeinput'><pre class='json'>$input</pre></div>
                <div class='aeoutput'>
                            <div class='aeoutputtitle'>
                                $output_title
                            </div>
                            <div class='aeoutputbody'>
                                <pre class='json'>$output</pre>
                            </div>
                </div>
            </div>";   
        }



        public function calcShowHtml($what="value")
        {
            $apiExecObj = $this->het("api_execution_id");
            if (!$apiExecObj) {
                return "Strange api_execution_id=" . $this->getVal("api_execution_id") . " in RecordLog id=" . $this->getId();
            }
            
            $dataApiObj = $apiExecObj->het("data_api_id");
            if(!$dataApiObj)
            {
                return "Strange data_api_id=".$apiExecObj->getVal("data_api_id")." in APIExecution id=".$apiExecObj->getId();
            }


            $mappingJobObj = $apiExecObj->het("mapping_job_id");
            if(!$mappingJobObj)
            {
                return "Strange mapping_job_id=".$apiExecObj->getVal("mapping_job_id")." in APIExecution id=".$apiExecObj->getId();
            }

            /**
             * @var DataApi $dataApiObj
             * @var MappingJob $mappingJobObj
             */

            $defaultPattern = $mappingJobObj->getDefaultPattern("output");
            $outputPattern = AfwSettingsHelper::readSettingValue($dataApiObj,"output", $defaultPattern);
            $outputPatternData = $outputPattern["data"];
            $dataPath = $outputPatternData["path"];
            $outputPatternExp = var_export($outputPatternData, true);
            
            $output = $this->getVal("output");
            $result_json_decoded = json_decode($output);

            if(is_object($result_json_decoded))
            {
                $result_arr = (array) $result_json_decoded;
            }
            else
            {
                $result_arr = $result_json_decoded;
            }
            

            if(is_array($result_arr))
            {
                //die("rafik will do AfwFormatHelper::extractDataFromArray(result_arr, $dataPath, ...) with result_arr = ".var_export($result_arr,true)." ... ");
                list($header_row,$data_rows, $log) = AfwFormatHelper::extractDataFromArray($result_arr, $dataPath, $outputPatternData["record"]);
            }
            else throw new AfwRuntimeException("Strange output response can't be decoded as array");
            

            if($header_row and $data_rows)
            {
                $html = AfwHtmlHelper::tableToHtml($data_rows, null);
            }
            else $html = "<b>Json parsed not muching pattern :</b>
                    <br>$log
                    <br>dataPath=$dataPath
                    <br>outputPattern=$outputPatternExp";

            return $html;
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

