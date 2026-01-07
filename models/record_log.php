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


    public static function loadByMainIndex($mapping_job_id, $data_api_id, $run_date, $record_definition, 
                $record_json, $log_title, $log_details,
                $create_obj_if_not_found = false)
    {
        if (!$mapping_job_id) throw new AfwRuntimeException("loadByMainIndex : mapping_job_id is mandatory field");
        if (!$data_api_id) throw new AfwRuntimeException("loadByMainIndex : data_api_id is mandatory field");
        if (!$run_date) throw new AfwRuntimeException("loadByMainIndex : run_date is mandatory field");


        $obj = new RecordLog();
        $obj->select("mapping_job_id", $mapping_job_id);
        $obj->select("data_api_id", $data_api_id);
        $obj->select("run_date", $run_date);
        $obj->select("record_definition", $record_definition);

        if ($obj->load()) {
            if ($create_obj_if_not_found) { 
                $obj->set("record_json", $record_json);  
                $obj->set("log_title", $log_title);
                $obj->set("log_details", $log_details);
                $obj->activate();
            }
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("mapping_job_id", $mapping_job_id);
            $obj->set("data_api_id", $data_api_id);
            $obj->set("run_date", $run_date);
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
        $dataApiObj = $this->het("data_api_id");
        if (!$dataApiObj) {
            return "Strange data_api_id=" . $this->getVal("data_api_id") . " in RecordLog id=" . $this->getId();
        }


        $mappingJobObj = $this->het("mapping_job_id");
        if (!$mappingJobObj) {
            return "Strange mapping_job_id=" . $this->getVal("mapping_job_id") . " in RecordLog id=" . $this->getId();
        }

        /**
         * @var DataApi $dataApiObj
         * @var MappingJob $mappingJobObj
         */

        $defaultPattern = $mappingJobObj->getDefaultPattern("output");
        $outputPattern = AfwSettingsHelper::readSettingValue($dataApiObj, "output", $defaultPattern);
        $outputPatternData = $outputPattern["data"];
        $dataPath = $outputPatternData["path"];
        $outputPatternExp = var_export($outputPatternData, true);

        $record_json = $this->getVal("record_json");
        $result_json_decoded = json_decode($record_json);

        if (is_object($result_json_decoded)) {
            $result_arr = (array) $result_json_decoded;
        } else {
            $result_arr = $result_json_decoded;
        }


        if (is_array($result_arr)) {
            //die("rafik will do AfwFormatHelper::extractDataFromArray(result_arr, $dataPath, ...) with result_arr = ".var_export($result_arr,true)." ... ");
            list($header_row, $data_rows, $log) = AfwFormatHelper::extractDataFromArray($result_arr, $dataPath, $outputPatternData["record"]);
        } else throw new AfwRuntimeException("Strange output response can't be decoded as array");


        if ($header_row and $data_rows) {
            $html = AfwHtmlHelper::tableToHtml($data_rows, null);
        } else $html = "<b>Json record parsed not muching pattern :</b>
                    <br>$log
                    <br>dataPath=$dataPath
                    <br>outputPattern=$outputPatternExp";

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
}



// errors 
