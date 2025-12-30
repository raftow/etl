<?php

$file_dir_name = dirname(__FILE__);

// require_once("$file_dir_name/../afw/afw.php");

class MappingCol extends EtlObject
{

    public static $MY_ATABLE_ID = 13968;
    // إحصائيات حقول التقابل 
    public static $BF_STATS_MAPPING_COL = 105081;
    // إدارة حقول التقابل 
    public static $BF_QEDIT_MAPPING_COL = 105076;
    // إنشاء mapping column 
    public static $BF_EDIT_MAPPING_COL = 105075;
    // البحث في حقول التقابل 
    public static $BF_SEARCH_MAPPING_COL = 105079;
    // حقول التقابل 
    public static $BF_QSEARCH_MAPPING_COL = 105080;
    // عرض تفاصيل mapping column 
    public static $BF_DISPLAY_MAPPING_COL = 105078;
    // مسح mapping column 
    public static $BF_DELETE_MAPPING_COL = 105077;

    public static $DATABASE = "ttc_etl";
    public static $MODULE   = "etl";
    public static $TABLE    = "mapping_col";

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct("mapping_col", "id", "etl");
        EtlMappingColAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new MappingCol();
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

    public function getDisplay($lang = "ar")
    {
        $display                      = $this->getVal("name_$lang");
        $mappingColTransformationList = $this->get("mappingColTransformationList");
        if (count($mappingColTransformationList) == 0) {
            $display .= " (No transformation)";
        }

        return $display;
    }

    protected function getOtherLinksArray($mode, $genereLog = false, $step = "all")
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        // $objme = AfwSession::getUserConnected();
        // $me = ($objme) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
        $my_id           = $this->getId();
        $displ           = $this->getDisplay($lang);

        if ($mode == "mode_mappingColTransformationList") {
            unset($link);
            $link              = [];
            $title             = "إدارة تحويلات الحقول ";
            $title_detailed    = $title . "لـ : " . $displ;
            $link["URL"]       = "main.php?Main_Page=afw_mode_qedit.php&cl=MappingColTransformation&currmod=etl&id_origin=$my_id&class_origin=MappingCol&module_origin=etl&newo=-1&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=mapping_col_id=$my_id&sel_mapping_col_id=$my_id&return_mode=1";
            $link["TITLE"]     = $title;
            $link["UGROUPS"]   = [];
            $otherLinksArray[] = $link;
        }

        if ($mode == "mode_mappingColTransformationList") {
            unset($link);
            $link              = [];
            $title             = "إضافة تحويل حقل جديد";
            $title_detailed    = $title . "لـ : " . $displ;
            $link["URL"]       = "main.php?Main_Page=afw_mode_edit.php&cl=MappingColTransformation&currmod=etl&sel_mapping_col_id=$my_id";
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

        $pbms = [];

        $color      = "green";
        $title_ar   = "xxxxxxxxxxxxxxxxxxxx";
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
        return "active";
    }

    public function beforeMaj($id, $fields_updated)
    {
        /*
         or
                  AfwStringHelper::stringContain($this->getVal("name_ar"),"rarr") or
                  AfwStringHelper::stringContain($this->getVal("name_en"),"rarr")
         */
        if(isset($fields_updated['source_field_name']) or isset($fields_updated['destination_field_name']))
        {
            $name = $this->getVal("source_field_name")."&rarr;".$this->getVal("destination_field_name");
            $this->set("name_ar", $name);
            $this->set("name_en", $name);
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
        $server_db_prefix = AfwSession::config("db_prefix", "ttc_");

        if (! $id) {
            $id    = $this->getId();
            $simul = true;
        } else {
            $simul = false;
        }

        if ($id) {
            if ($id_replace == 0) {
                // FK part of me - not deletable 
                // etl.mapping_col_transformation-حقل التقابل	mapping_col_id  أنا تفاصيل لها (required field)
                // require_once "../etl/mapping_col_transformation.php";
                $obj = new MappingColTransformation();
                $obj->where("mapping_col_id = '$id' and active='Y' ");
                $nbRecords = $obj->count();
                // check if there's no record that block the delete operation
                if ($nbRecords > 0) {
                    $this->deleteNotAllowedReason = "Used in some mapping column transformations(s) as mapping column";
                    return false;
                }
                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                if (! $simul) {
                    $obj->deleteWhere("mapping_col_id = '$id' and active='N'");
                }

                // FK part of me - deletable 

                // FK not part of me - replaceable 

                // MFK

            } else {
                // FK on me 

                // etl.mapping_col_transformation-حقل التقابل	mapping_col_id  أنا تفاصيل لها (required field)
                if (! $simul) {
                    // require_once "../etl/mapping_col_transformation.php";
                    MappingColTransformation::updateWhere(['mapping_col_id' => $id_replace], "mapping_col_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}etl.mapping_col_transformation set mapping_col_id='$id_replace' where mapping_col_id='$id' ");

                }

                // MFK

            }
            return true;
        }
    }

}

// errors 
