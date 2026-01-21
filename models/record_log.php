<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class RecordLog extends AFWObject
{

    public static $MY_ATABLE_ID = 13978;

    public static $DATABASE        = "tvtc_etl";
    public static $MODULE                = "etl";
    public static $TABLE            = "record_log";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("record_log", "id", "etl");
        EtlRecordLogAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new RecordLog();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }


    public static function loadByMainIndex(
        $api_execution_id,
        $record_num,
        $page_num = 0,
        $status = '',
        $record_definition = '',
        $record_json = '',
        $log_title = '',
        $log_details = '',
        $create_obj_if_not_found = false
    ) {
        if (!$api_execution_id) throw new AfwRuntimeException("loadByMainIndex : api_execution_id is mandatory field");
        if (!$record_num) throw new AfwRuntimeException("loadByMainIndex : record_num is mandatory field");
        if ($create_obj_if_not_found) {
            if (!$page_num) throw new AfwRuntimeException("loadByMainIndex : page_num is mandatory field");
            if (!$status) throw new AfwRuntimeException("loadByMainIndex : status is mandatory field");
            if (!$record_definition) throw new AfwRuntimeException("loadByMainIndex : record_definition is mandatory field");
            if (!$record_json) throw new AfwRuntimeException("loadByMainIndex : record_json is mandatory field");
            if (!$log_title) throw new AfwRuntimeException("loadByMainIndex : log_title is mandatory field");
            if (!$log_details) throw new AfwRuntimeException("loadByMainIndex : log_details is mandatory field");
        }


        $obj = new RecordLog();
        $obj->select("api_execution_id", $api_execution_id);
        $obj->select("record_num", $record_num);

        if ($obj->load()) {
            if ($create_obj_if_not_found) {
                $obj->set("page_num", $page_num);
                $obj->set("status", $status);
                $obj->set("record_definition", $record_definition);
                $obj->set("record_json", $record_json);
                $obj->set("log_title", $log_title);
                $obj->set("log_details", $log_details);
                $obj->activate();
            }
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("api_execution_id", $api_execution_id);
            $obj->set("record_num", $record_num);
            $obj->set("page_num", $page_num);
            $obj->set("status", $status);
            $obj->set("record_definition", $record_definition);
            $obj->set("record_json", $record_json);
            $obj->set("log_title", $log_title);
            $obj->set("log_details", $log_details);

            $obj->insertNew();
            if (!$obj->id) return null; // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        } else return null;
    }


   





    public function calcShowHtml($what = "value")
    {
        $apiExecObj = $this->het("api_execution_id");
        if (!$apiExecObj) {
            return "Strange api_execution_id=" . $this->getVal("api_execution_id") . " in RecordLog id=" . $this->getId();
        }

        /*
        $dataApiObj = $apiExecObj->het("data_api_id");
        if (!$dataApiObj) {
            return "Strange data_api_id=" . $this->getVal("data_api_id") . " in RecordLog id=" . $this->getId();
        }


        $mappingJobObj = $apiExecObj->het("mapping_job_id");
        if (!$mappingJobObj) {
            return "Strange mapping_job_id=" . $this->getVal("mapping_job_id") . " in RecordLog id=" . $this->getId();
        }

        /**
         * @var DataApi $dataApiObj
         * @var MappingJob $mappingJobObj
         */
        /*
        $defaultPattern = $mappingJobObj->getDefaultPattern("output");
        $outputPattern = AfwSettingsHelper::readSettingValue($dataApiObj, "output", $defaultPattern);
        $outputPatternData = $outputPattern["data"];
        $dataPath = $outputPatternData["path"];
        $outputPatternExp = var_export($outputPatternData, true);
        */
        $record_json = $this->getVal("record_json");
        $result_json_decoded = json_decode($record_json);

        if (is_object($result_json_decoded)) {
            $row = (array) $result_json_decoded;
        } else {
            $row = $result_json_decoded;
        }

        $data_rows = [];
        $data_rows[] = $row;

        if ($data_rows) {
            $html = AfwHtmlHelper::tableToHtml($data_rows, null);
        } else $html = "<b>Bad Json code :</b>
                    <br>$record_json
                    ";

        return $html;
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


    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config("db_prefix", "tvtc_");

        if (!$id) {
            $id = $this->getId();
            $simul = true;
        } else {
            $simul = false;
        }

        if ($id) {
            if ($id_replace == 0) {
                // FK part of me - not deletable 


                // FK part of me - deletable 


                // FK not part of me - replaceable 



                // MFK

            } else {
                // FK on me 


                // MFK


            }
            return true;
        }
    }

    public function shouldBeCalculatedField($attribute){
        if($attribute=="mapping_job_id") return true;
        if($attribute=="showHtml") return true;
        if($attribute=="statusHtml") return true;
        return false;
    }


    public function calcStatusHtml($what="value") {
        $aeid =  $this->getVal("api_execution_id");
        //$apiExecutionObj = $this->het("api_execution_id");
        $nb = "&rarr;";
        $link = "main.php?Main_Page=afw_mode_edit.php&cl=ApiExecution&id=$aeid&currmod=etl&currstep=2&force_findword=".$this->getVal("record_definition");
        $status = "yellow";

        return "<div class='link run-status $status'><a href='$link'>$nb</a></div>";
    }
}



// errors 
