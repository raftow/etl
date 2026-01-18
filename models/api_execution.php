<?php


$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class ApiExecution extends AFWObject
{

    public static $MY_ATABLE_ID = 13978;

    public static $DATABASE        = "tvtc_etl";
    public static $MODULE                = "etl";
    public static $TABLE            = "api_execution";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("api_execution", "id", "etl");
        EtlApiExecutionAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new ApiExecution();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }

    public static function loadByMainIndex(
        $mapping_job_id,
        $data_api_id,
        $run_date,
        $input = '',
        $output = '',
        $title_output = '',
        $create_obj_if_not_found = false
    ) {
        if (!$mapping_job_id) throw new AfwRuntimeException("loadByMainIndex : mapping_job_id is mandatory field");
        if (!$data_api_id) throw new AfwRuntimeException("loadByMainIndex : data_api_id is mandatory field");
        if (!$run_date) throw new AfwRuntimeException("loadByMainIndex : run_date is mandatory field");
        if ($create_obj_if_not_found) {
            if ((!$input) or (strlen($input)<11)) throw new AfwRuntimeException("loadByMainIndex : bad value for input and create_obj_if_not_found is true");
            if ((!$output) or (strlen($output)<11)) throw new AfwRuntimeException("loadByMainIndex : bad value for output and create_obj_if_not_found is true");
        }

        $obj = new ApiExecution();
        $obj->select("mapping_job_id", $mapping_job_id);
        $obj->select("data_api_id", $data_api_id);
        $obj->select("run_date", $run_date);

        if ($obj->load()) {
            if ($create_obj_if_not_found) {
                $obj->set("input", $input);
                $obj->set("output", $output);
                $obj->set("output_title", $title_output);
                $obj->activate();
            }
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set("mapping_job_id", $mapping_job_id);
            $obj->set("data_api_id", $data_api_id);
            $obj->set("run_date", $run_date);
            $obj->set("input", $input);
            $obj->set("output", $output);
            $obj->set("output_title", $title_output);
            $obj->insertNew();
            if (!$obj->id) return null; // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        } else return null;
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

    public function calcShowHtml($what = "value")
    {
        $dataApiObj = $this->het("data_api_id");
        if (!$dataApiObj) {
            return "Strange data_api_id=" . $this->getVal("data_api_id") . " in ApiExecution id=" . $this->getId();
        }


        $mappingJobObj = $this->het("mapping_job_id");
        if (!$mappingJobObj) {
            return "Strange mapping_job_id=" . $this->getVal("mapping_job_id") . " in ApiExecution id=" . $this->getId();
        }

        /**
         * @var DataApi $dataApiObj
         * @var MappingJob $mappingJobObj
         */

        list($findword, $findword2, $findword3) = explode("|", $this->getVal("findword"));

        $MAX_SHOW = 50;

        $recordLogList = $this->get("recordLogList");
        $recordLogListCount = count($recordLogList);
        $data_rows = [];
        $count_data = 0;
        $header_row = null;
        $notes = "used to filter word1=$findword, word2=$findword2, word3=$findword3 on $recordLogListCount records<br>";
        $notes_count = 0;
        foreach ($recordLogList as $recordLogItem) {
            $record_json = $recordLogItem->getVal("record_json");
            $status = $recordLogItem->getVal("status");
            $page_num = $recordLogItem->getVal("page_num");
            $record_num = $recordLogItem->getVal("record_num");
            $record_definition = $recordLogItem->getVal("record_definition");
            $result_json_decoded = json_decode($record_json);
            if (is_object($result_json_decoded)) {
                $row = (array) $result_json_decoded;
            } else {
                $row = $result_json_decoded;
                if(!$row) $row = $record_json;
            }
            if ((
                !$findword
                or ($findword == $record_definition)
                or ($findword == $status)
                or ($findword == "record$record_num")
                or ($findword == "row$record_num")
                or ($findword == "page$page_num")
                or AfwStringHelper::stringContain($record_json, $findword)
            ) and (
                !$findword2
                or ($findword2 == $record_definition)
                or ($findword2 == $status)
                or ($findword2 == "record$record_num")
                or ($findword2 == "row$record_num")
                or ($findword2 == "page$page_num")
                or AfwStringHelper::stringContain($record_json, $findword2)
            ) and (
                !$findword3
                or ($findword3 == $record_definition)
                or ($findword3 == $status)
                or ($findword3 == "record$record_num")
                or ($findword3 == "row$record_num")
                or ($findword3 == "page$page_num")
                or AfwStringHelper::stringContain($record_json, $findword3)
            )) {

                if ($count_data < $MAX_SHOW) {
                    $data_rows[] = $row;
                    $count_data++;
                    $notes .= "<p class='info'>record_json:$record_json</p><br>";
                } else {
                    $notes .= "<p class='warning'>Too much records to show please use the filter</p><br>";
                    break;
                }
            } else {
                $notes_count++;
                if ($notes_count < 40) {
                    $alt = ($notes_count%2 == 0) ? "alt" : "";
                    $notes .= "<p class='log $alt'>filtered : rd=$record_definition, st=$status, record$record_num, page$page_num nothing in words</p>";
                }
            }
            if (!$header_row and $row and is_array($row)) $header_row = array_keys($row);

            
        }

        $data_rows_export = var_export($data_rows, true);
        $notes .= "<p class='warning'>Filtered : $count_data records</p><br>";

        if($count_data<10) $notes .= "<pre class='php'>$data_rows_export</pre><br>";

        $html = "";

        if(is_array($data_rows)) $html .= AfwHtmlHelper::tableToHtml($data_rows, null); 
        $html .= "<br>$notes";

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
