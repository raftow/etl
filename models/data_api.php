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

        $color      = "yellow";
        $title_ar   = "تنفيذ فعلي للخدمة";
        $title_en   = "Execute API on Production";
        $help_ar   = "تنفيذ الخدمة الإلكترونية على البيئة الفعلية";
        $help_en   = "Execute Electronic Service on Production environment";
        
        $methodName = "runAPIProd";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName, 
                "COLOR"=>$color, 
                "LABEL_AR"=>$title_ar, 
                "HELP_EN"=>$help_en,
                "HELP_AR"=>$help_ar, 
                "LABEL_EN"=>$title_en, 
                "ADMIN-ONLY"=>true, 
                "ICON"=>"execute", 
                'STEP' =>$this->stepOfAttribute("output"));

        $color      = "black";
        $title_ar   = "تنفيذ تجريبي للخدمة";
        $title_en   = "Execute API as Test";
        $help_ar   = "تنفيذ الخدمة الإلكترونية على البيئة التجريبية";
        $help_en   = "Execute Electronic Service on Test environment";
        $methodName = "runAPI";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName, 
                "COLOR"=>$color, 
                "LABEL_AR"=>$title_ar, 
                "LABEL_EN"=>$title_en, 
                "HELP_EN"=>$help_en,
                "HELP_AR"=>$help_ar, 
                "ADMIN-ONLY"=>true, 
                "ICON"=>"link", 
                'STEP' =>$this->stepOfAttribute("output"));           

        /*        
        $color      = "orange";
        $title_ar   = "تنفيذ الخدمة الإلكترونية";
        $methodName = "runAPI2";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName, 
                "COLOR"=>$color, 
                "LABEL_AR"=>$title_ar, 
                "LABEL_EN"=>$title_en, 
                "ADMIN-ONLY"=>true, 
                "ICON"=>"generate", 
                'STEP' =>$this->stepOfAttribute("xxyy"));       
                
        $color      = "blue";
        $title_ar   = "تنفيذ الخدمة الإلكترونية";
        $methodName = "runAPI3";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName, 
                "COLOR"=>$color, 
                "LABEL_AR"=>$title_ar,
                "LABEL_EN"=>$title_en,  
                "ADMIN-ONLY"=>true, 
                "ICON"=>"merge", 
                'STEP' =>$this->stepOfAttribute("xxyy"));   

        $color      = "red";
        $title_ar   = "تنفيذ الخدمة الإلكترونية تنفيذ الخدمة الإلكترونية تنفيذ الخدمة الإلكترونية";
        $methodName = "runAPI1";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName, 
                "COLOR"=>$color, 
                "LABEL_AR"=>$title_ar, 
                "LABEL_EN"=>$title_en, 
                "ADMIN-ONLY"=>true, 
                "ICON"=>"clone", 
                'STEP' =>$this->stepOfAttribute("xxyy"));   
        */
        return $pbms;
    }

    public function runAPIProd($lang = "ar")
    {
        return $this->runAPI($lang, $test=false);
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
        $url = rtrim($epObj->getVal("url"), "/") . "/" . ltrim($this->getVal('relative_url'), "/");
        $bearer_token = AfwSettingsHelper::readSettingValue($this,"bearer_token",null);
        $proxy = AfwSettingsHelper::readSettingValue($this,"proxy",null);
        $data = AfwSettingsHelper::readParamsArray($this,"input");
        $verify_host = AfwSettingsHelper::readSettingValue($this,"verify_host",null);
        $verify_pear = AfwSettingsHelper::readSettingValue($this,"verify_pear",null);
        $return_transfer = AfwSettingsHelper::readSettingValue($this,"return_transfer",true);
        $method = AfwSettingsHelper::readSettingValue($this,"method",'GET');
        $maxredirs = AfwSettingsHelper::readSettingValue($this,"maxredirs",10);
        $timeout = AfwSettingsHelper::readSettingValue($this,"timeout",0);
        $followlocation = AfwSettingsHelper::readSettingValue($this,"followlocation",true);
        $http_version = AfwSettingsHelper::readSettingValue($this,"http_version",null);
        $encoding = AfwSettingsHelper::readSettingValue($this,"encoding",'');
        
        // $xxxxx = AfwSettingsHelper::readSettingValue($this,"xxxxx",def-xxxxx);
        $http_header_array = AfwSettingsHelper::readSettingValue($this, "http_header", ['accept: application/json', 'Content-Type: application/json'],"settings",true);
        if($bearer_token)
        {
            $res = AfwApiConsumeHelper::consume_bearer_api(
                $url,
                $bearer_token,
                $proxy,
                $data,
                $verify_host,
                $verify_pear,
                $return_transfer,
                $encoding,
                $method,
                $maxredirs,
                $timeout,
                $followlocation,
                $http_version,
                $http_header_array);
        }
        else
        {
            $res = AfwApiConsumeHelper::consume_normal_api($url,
                $proxy,
                $data,
                $verify_host,
                $verify_pear,
                $return_transfer,
                $encoding,
                $method,
                $maxredirs,
                $timeout,
                $followlocation,
                $http_version,
                $http_header_array);
        }

        if($res['success'])
        {
            $success_message = $res['url'] . " executed successfully with result: " . $res['result']."\n";
            $output = $success_message . "CURL Commands : \n". implode("\n", $res['commands']);
            $this->set("output", $output);
            $this->commit();
            return [null, $success_message];
        }
        else
        {
            $error_message = "Error while consuming the API : " . $res['message']."\n";
            $output = $error_message . "CURL Commands : \n". implode("\n", $res['commands']);
            $this->set("output", $output);
            $this->commit();
            return[$error_message, null];
        }
        
    }

    public function beforeMaj($id, $fields_updated)
    {
        if(isset($fields_updated['source_field_name']) and ((!$this->getVal("name_ar")) or (!$this->getVal("name_en"))))
        {
            $name = $this->getVal("source_field_name")."&rarr;".$this->getVal("destination_field_name");
            if(!$this->getVal("name_ar")) $this->set("name_ar", $name);
            if(!$this->getVal("name_en")) $this->set("name_en", $name);
        }

        if($fields_updated['settings'])
        {
            $input_arr = AfwSettingsHelper::readParamsArray($this, "input");
            $input_settings_arr = AfwSettingsHelper::readSettingValue($this,"input");
            foreach($input_settings_arr as $input_param => $input_param_props_arr)
            {
                $input_arr = AfwSettingsHelper::repareParamsArray($input_arr, $input_param, $input_param_props_arr);
            }

            $this->set("input", AfwSettingsHelper::paramsArrayToString($input_arr));
        }

        return true;
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
