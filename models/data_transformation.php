<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class DataTransformation extends AFWObject{

        public static $MY_ATABLE_ID=13975; 
        // إدارة التحويلات 
        public static $BF_QEDIT_DATA_TRANSFORMATION = 105055; 
        // إنشاء  
        public static $BF_EDIT_DATA_TRANSFORMATION = 105054; 
        // البحث في التحويلات 
        public static $BF_SEARCH_DATA_TRANSFORMATION = 105058; 
        // التحويلات 
        public static $BF_QSEARCH_DATA_TRANSFORMATION = 105059; 
        // عرض تفاصيل  
        public static $BF_DISPLAY_DATA_TRANSFORMATION = 105057; 
        // مسح  
        public static $BF_DELETE_DATA_TRANSFORMATION = 105056; 
  
        public static $DATABASE		= "";
        public static $MODULE		        = "etl";        
        public static $TABLE			= "data_transformation";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("data_transformation","id","etl");
            EtlDataTransformationAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new DataTransformation();
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
            $title_en = "xxxxxxxxxxxxxxxxxxxx"; 
            $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
            //$pbms[AfwStringHelper::hzmEncode($methodName)] = 
                    array("METHOD"=>$methodName,
                          "COLOR"=>$color, 
                          "LABEL_AR"=>$title_ar, 
                          "LABEL_EN"=>$title_en,
                          "ADMIN-ONLY"=>true, 
                          "BF-ID"=>"", 
                          'STEP' =>$this->stepOfAttribute("xxyy"));
            
            
            
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
                       // etl.mapping_col_transformation-التحويلة	data_transformation_id  حقل يفلتر به (required field)
                        // require_once "../etl/mapping_col_transformation.php";
                        $obj = new MappingColTransformation();
                        $obj->where("data_transformation_id = '$id' and active='Y' ");
                        $nbRecords = $obj->count();
                        // check if there's no record that block the delete operation
                        if($nbRecords>0)
                        {
                            $this->deleteNotAllowedReason = "Used in some mapping column transformations(s) as transformation";
                            return false;
                        }
                        // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                        if(!$simul) $obj->deleteWhere("data_transformation_id = '$id' and active='N'");


                        
                   // FK part of me - deletable 

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        // FK on me 
 

                        // etl.mapping_col_transformation-التحويلة	data_transformation_id  حقل يفلتر به (required field)
                        if(!$simul)
                        {
                            // require_once "../etl/mapping_col_transformation.php";
                            MappingColTransformation::updateWhere(array('data_transformation_id'=>$id_replace), "data_transformation_id='$id'");
                            // $this->execQuery("update ${server_db_prefix}etl.mapping_col_transformation set data_transformation_id='$id_replace' where data_transformation_id='$id' ");
                            
                        } 
                        


                        
                        // MFK

                   
               } 
               return true;
            }    
	}
             
}



// errors 

