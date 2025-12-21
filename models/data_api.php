<?php

$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class DataApi extends EtlObject
{

    public static $MY_ATABLE_ID = 13964;

    public static $DATABASE = "";
    public static $MODULE   = "etl";
    public static $TABLE    = "data_api";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("data_api", "id", "etl");
        EtlDataApiAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new DataApi();
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

        // check errors on all steps (by default no for optimization)
        // rafik don't know why this : \//  = false;

        return $otherLinksArray;
    }

    protected function getPublicMethods()
    {

        $pbms = $this->getPublicMethodsStandard();

        $color      = "green";
        $title_ar   = "تنفيذ الخدمة الإلكترونية";
        $methodName = "runAPI";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute("xxyy"));

        return $pbms;
    }

    public function runAPI($lang = "ar", $test=true)
    {
        if($test) $epObj = $this->get('test_end_point_id');
        else $epObj = $this->get('end_point_id');
        if(!$epObj)
        {
            $error_message = $this->tm("No end point defined for this API", $lang);
            return[$error_message, ""];
        }
        $url = trim($epObj->getVal("url"), "/") . "/" . trim($this->getVal('relative_url'), "/");
        $bearer_token = $this->readSettingValue("bearer_token",null);
        $proxy = $this->readSettingValue("proxy",null);
        $data = $this->readSettingValue("data",[]);
        $verify_host = $this->readSettingValue("verify_host",false);
        $verify_pear = $this->readSettingValue("verify_pear",false);
        $return_transfer = $this->readSettingValue("return_transfer",true);
        if($bearer_token)
        {
            $res = AfwApiConsumeHelper::consume_bearer_api(
                $url,
                $bearer_token,
                $proxy,
                $data,
                $verify_host,
                $verify_pear,
                $return_transfer);

            if($res['success'])
            {
                return [null, $res['url'] . " executed successfully with result: " . $res['result']];
            }
            else
            {
                $error_message = "Error while consuming the API : " . $res['message'];
                return[$error_message, null];
            }
        }
        else
        {
            $error_message = $this->tm("No bearer token defined for this API", $lang);
            return[$error_message, ""];
        }
        
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
                // etl.mapping_job-خدمة البيانات	data_api_id  حقل يفلتر به (required field)
                // require_once "../etl/mapping_job.php";
                $obj = new MappingJob();
                $obj->where("data_api_id = '$id' and active='Y' ");
                $nbRecords = $obj->count();
                // check if there's no record that block the delete operation
                if ($nbRecords > 0) {
                    $this->deleteNotAllowedReason = "Used in some mapping jobs(s) as data api";
                    return false;
                }
                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                if (! $simul) {
                    $obj->deleteWhere("data_api_id = '$id' and active='N'");
                }

                // FK part of me - deletable 

                // FK not part of me - replaceable 

                // MFK

            } else {
                // FK on me 

                // etl.mapping_job-خدمة البيانات	data_api_id  حقل يفلتر به (required field)
                if (! $simul) {
                    // require_once "../etl/mapping_job.php";
                    MappingJob::updateWhere(['data_api_id' => $id_replace], "data_api_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}etl.mapping_job set data_api_id='$id_replace' where data_api_id='$id' ");

                }

                // MFK

            }
            return true;
        }
    }

}

// errors 
