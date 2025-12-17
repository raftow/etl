<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class DataApi extends EtlObject{

        public static $MY_ATABLE_ID=13964; 
  
        public static $DATABASE		= "";
        public static $MODULE		        = "etl";        
        public static $TABLE			= "data_api";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("data_api","id","etl");
            EtlDataApiAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new DataApi();
           $obj->select_visibilite_horizontale();
           if($obj->load($id))
           {
                return $obj;
           }
           else return null;
        }
        
        

        public function getScenarioItemId($currstep)
                {
                    
                    return 0;
                }
        
        
        public function getDisplay($lang="ar")
        {
               
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
            
            $pbms = $this->getPublicMethodsStandard();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
            //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));
            
            
            
            return $pbms;
        }
        
        
        /*
        public function isTechField($attribute) {
            return (($attribute=="created_by") or 
                    ($attribute=="created_at") or 
                    ($attribute=="updated_by") or 
                    ($attribute=="updated_at") or 
                    // ($attribute=="validated_by") or ($attribute=="validated_at") or 
                    ($attribute=="version"));  
        }*/
        
        
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
                       // etl.mapping_job-خدمة البيانات	data_api_id  حقل يفلتر به (required field)
                        // require_once "../etl/mapping_job.php";
                        $obj = new MappingJob();
                        $obj->where("data_api_id = '$id' and active='Y' ");
                        $nbRecords = $obj->count();
                        // check if there's no record that block the delete operation
                        if($nbRecords>0)
                        {
                            $this->deleteNotAllowedReason = "Used in some mapping jobs(s) as data api";
                            return false;
                        }
                        // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                        if(!$simul) $obj->deleteWhere("data_api_id = '$id' and active='N'");


                        
                   // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 
 

                        // etl.mapping_job-خدمة البيانات	data_api_id  حقل يفلتر به (required field)
                        if(!$simul)
                        {
                            // require_once "../etl/mapping_job.php";
                            MappingJob::updateWhere(array('data_api_id'=>$id_replace), "data_api_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}etl.mapping_job set data_api_id='$id_replace' where data_api_id='$id' ");
                            
                        } 
                        


                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 

