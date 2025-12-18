<?php

$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class MappingJob extends EtlObject
{

    public static $MY_ATABLE_ID = 13967;
    // إحصائيات مهمات التقابل 
    public static $BF_STATS_MAPPING_JOB = 105095;
    // إدارة مهمات التقابل 
    public static $BF_QEDIT_MAPPING_JOB = 105090;
    // إنشاء  
    public static $BF_EDIT_MAPPING_JOB = 105089;
    // البحث في مهمات التقابل 
    public static $BF_SEARCH_MAPPING_JOB = 105093;
    // عرض تفاصيل  
    public static $BF_DISPLAY_MAPPING_JOB = 105092;
    // مسح  
    public static $BF_DELETE_MAPPING_JOB = 105091;
    // مهمات التقابل 
    public static $BF_QSEARCH_MAPPING_JOB = 105094;

    public static $DATABASE = "tvtc_etl";
    public static $MODULE   = "etl";
    public static $TABLE    = "mapping_job";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("mapping_job", "id", "etl");
        EtlMappingJobAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new MappingJob();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else {
            return null;
        }

    }

    public function getScenarioItemId($currstep)
    {
        return 0;
    }

    protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        // $objme = AfwSession::getUserConnected();
        // $me = ($objme) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
        $my_id           = $this->getId();
        $displ           = $this->getDisplay($lang);


        if ($mode == "mode_mappingColList") {
            unset($link);
            $link              = [];
            $title             = "إضافة حقل تقابل جديد";
            $title_detailed    = $title . "لـ : " . $displ;
            $link["URL"]       = "main.php?Main_Page=afw_mode_edit.php&cl=MappingCol&currmod=etl&sel_mapping_job_id=$my_id";
            $link["TITLE"]     = $title;
            $link["UGROUPS"]   = [];
            $otherLinksArray[] = $link;
        }

        // check errors on all steps (by default no for optimization)
        // rafik don't know why this : \//  = false;

        return $otherLinksArray;
    }

    protected function getPublicMethods()
    {

        $pbms = $this->getPublicMethodsStandard();

        $color      = "green";
        $title_ar   = "xxxxxxxxxxxxxxxxxxxx";
        $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
        //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));

        return $pbms;
    }

    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "tvtc_");

        if (! $id) {
            $id    = $this->getId();
            $simul = true;
        } else {
            $simul = false;
        }

        if ($id) {
            if ($id_replace == 0) {
                // FK part of me - not deletable 
                // etl.mapping_col-مهمة التقابل	mapping_job_id  أنا تفاصيل لها (required field)
                // require_once "../etl/mapping_col.php";
                $obj = new MappingCol();
                $obj->where("mapping_job_id = '$id' and active='Y' ");
                $nbRecords = $obj->count();
                // check if there's no record that block the delete operation
                if ($nbRecords > 0) {
                    $this->deleteNotAllowedReason = "Used in some mapping columns(s) as mapping job";
                    return false;
                }
                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                if (! $simul) {
                    $obj->deleteWhere("mapping_job_id = '$id' and active='N'");
                }

                // FK part of me - deletable 

                // FK not part of me - replaceable 

                // MFK

            } else {
                // FK on me 

                // etl.mapping_col-مهمة التقابل	mapping_job_id  أنا تفاصيل لها (required field)
                if (! $simul) {
                    // require_once "../etl/mapping_col.php";
                    MappingCol::updateWhere(['mapping_job_id' => $id_replace], "mapping_job_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}etl.mapping_col set mapping_job_id='$id_replace' where mapping_job_id='$id' ");

                }

                // MFK

            }
            return true;
        }
    }

}

// errors 
