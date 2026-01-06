<?php

$file_dir_name = dirname(__FILE__);

// require_once( "$file_dir_name/../afw/afw.php" );

class Collection extends AFWObject
{

    public static $MY_ATABLE_ID = 13979;

    public static $DATABASE         = 'tvtc_etl';
    public static $MODULE                = 'etl';

    public static $TABLE             = 'collection';

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct('collection', 'id', 'etl');
        EtlCollectionAfwStructure::initInstance($this);
    }

    public static function loadById($id)
    {
        $obj = new Collection();
        $obj->select_visibilite_horizontale();
        if ($obj->load($id)) {
            return $obj;
        } else return null;
    }

    public static function loadByMainIndex($lookup_code, $create_obj_if_not_found = false)
    {
        if (!$lookup_code) throw new AfwRuntimeException('loadByMainIndex : lookup_code is mandatory field');

        $obj = new Collection();
        $obj->select('lookup_code', $lookup_code);

        if ($obj->load()) {
            if ($create_obj_if_not_found) $obj->activate();
            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set('lookup_code', $lookup_code);

            $obj->insertNew();
            if (!$obj->id) return null;
            // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        } else return null;
    }

    protected function getOtherLinksArray($mode, $genereLog = false, $step = 'all')
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        // $objme = AfwSession::getUserConnected();
        // $me = ( $objme ) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
        $my_id = $this->getId();
        $displ = $this->getDisplay($lang);

        // check errors on all steps ( by default no for optimization )
        // rafik don't know why this : \//  = false;


        if($mode=="mode_mappingJobList")
        {
            unset($link);
            $link = array();
            $title = "إضافة مهمة تقابل جديد";
            $title_detailed = $title ."لـ : ". $displ;
            $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=MappingJob&currmod=etl&sel_collection_id=$my_id";
            $link["TITLE"] = $title;
            $link["UGROUPS"] = array();
            $otherLinksArray[] = $link;
        }

        return $otherLinksArray;
    }

    protected function getPublicMethods()
    {

        $pbms = array();

        $color = "green";
        $title_ar = "xxxxxxxxxxxxxxxxxxxx";
        $methodName = "mmmmmmmmmmmmmmmmmmmmmmm";
        //$pbms[AfwStringHelper::hzmEncode($methodName)] = array("METHOD"=>$methodName,"COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"", 'STEP' =>$this->stepOfAttribute( 'xxyy' ) );

        return $pbms;
    }

    public function fld_CREATION_USER_ID()
    {
        return 'created_by';
    }

    public function fld_CREATION_DATE()
    {
        return 'created_at';
    }

    public function fld_UPDATE_USER_ID()
    {
        return 'updated_by';
    }

    public function fld_UPDATE_DATE()
    {
        return 'updated_at';
    }

    public function fld_VALIDATION_USER_ID()
    {
        return 'validated_by';
    }

    public function fld_VALIDATION_DATE()
    {
        return 'validated_at';
    }

    public function fld_VERSION()
    {
        return 'version';
    }

    public function fld_ACTIVE()
    {
        return  'active';
    }

    public function beforeMaj($id, $fields_updated)
    {
        return true;
    }

    public function beforeDelete($id, $id_replace)
    {
        $server_db_prefix = AfwSession::config('db_prefix', 'tvtc_');

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
