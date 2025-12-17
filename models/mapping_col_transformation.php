<?php 

                
$file_dir_name = dirname(__FILE__); 
                
// require_once("$file_dir_name/../afw/afw.php");

class MappingColTransformation extends EtlObject{

        public static $MY_ATABLE_ID=13976; 
        // إحصائيات تحويلات الحقول 
        public static $BF_STATS_MAPPING_COL_TRANSFORMATION = 105088; 
        // إدارة تحويلات الحقول 
        public static $BF_QEDIT_MAPPING_COL_TRANSFORMATION = 105083; 
        // إنشاء  
        public static $BF_EDIT_MAPPING_COL_TRANSFORMATION = 105082; 
        // البحث في تحويلات الحقول 
        public static $BF_SEARCH_MAPPING_COL_TRANSFORMATION = 105086; 
        // تحويلات الحقول 
        public static $BF_QSEARCH_MAPPING_COL_TRANSFORMATION = 105087; 
        // عرض تفاصيل  
        public static $BF_DISPLAY_MAPPING_COL_TRANSFORMATION = 105085; 
        // مسح  
        public static $BF_DELETE_MAPPING_COL_TRANSFORMATION = 105084; 
  
        public static $DATABASE		= "tvtc_etl";
        public static $MODULE		        = "etl";        
        public static $TABLE			= "mapping_col_transformation";

	    public static $DB_STRUCTURE = null;
	
	    public function __construct(){
		parent::__construct("mapping_col_transformation","id","etl");
            EtlMappingColTransformationAfwStructure::initInstance($this);    
	    }
        
        public static function loadById($id)
        {
           $obj = new MappingColTransformation();
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
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "xxxxxxxxxxxxxxxxxxxx"; 
            $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
            //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));
            
            
            
            return $pbms;
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

