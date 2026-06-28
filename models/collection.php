<?php

$file_dir_name = dirname(__FILE__);

// require_once( "$file_dir_name/../afw/afw.php" );

class Collection extends EtlObject
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
            $title_en = "Add a new migration task";
            $title_ar = $this->tm($title_en,"ar");
            
            $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=MappingJob&currmod=etl&sel_collection_id=$my_id";
            $link["TITLE_AR"] = $title_ar;
            $link["TITLE_EN"] = $title_en;
            $link["UGROUPS"] = array();
            $otherLinksArray[] = $link;
        }

        return $otherLinksArray;
    }

    protected function getPublicMethods()
    {

        $pbms = array();

        $color = "green";
        $title_en = "Import from file";
        $title_ar = "استيراد من ملف";
        $methodName = "importFromFile";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = 
                    array("METHOD"=>$methodName,"COLOR"=>$color, 
                        "LABEL_AR"=>$title_ar, 
                        "LABEL_EN"=>$title_en,
                        "ADMIN-ONLY"=>true, 
                        "BF-ID"=>"", 
                        'STEP' =>$this->stepOfAttribute('mappingJobList') );

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

    public function importFromFile($lang='ar')
    {
        $collection_id = $this->id;
        $collection_code = $this->getVal('collection_code');
        $batch_root_path = "/var/www/hub_batch";        
        require_once("$batch_root_path/$collection_code/job_api_list_config.php");

        if(!$base_url) throw new AfwRuntimeException("importFromFile: base_url not defined in $batch_root_path/$collection_code/job_api_list_config.php");

        $endPointObj = EndPoint::loadByMainIndex($base_url);

        foreach($job_api_list as $job_api_code => $apiItem)
        {
            $relative_url = str_replace($base_url, "", $apiItem['url']);
            $relative_url = ltrim($relative_url, "/");
            $dataApiObj = DataApi::loadByMainIndex($endPointObj->id, $relative_url, true);
            if(!$dataApiObj->getVal('name_ar')) $dataApiObj->set('name_ar', $job_api_code);
            if(!$dataApiObj->getVal('name_en')) $dataApiObj->set('name_en', $job_api_code);
            if(!$dataApiObj->getVal("settings")) $dataApiObj->resetSettings();
            $dataApiObj->commit();
            $mappingJob = MappingJob::loadByMainIndex($collection_id, $job_api_code, true);
            if(!$mappingJob)
            {
                throw new AfwRuntimeException("importFromFile: cannot create/load mapping job with collection_id=$collection_id code=$job_api_code");
            }
            
            if(!$mappingJob->getVal('name_ar')) $mappingJob->set('name_ar', $job_api_code);
            if(!$mappingJob->getVal('name_en')) $mappingJob->set('name_en', $job_api_code);
            
            $mappingJob->set('end_point_id', $endPointObj->getId());
            $mappingJob->set('data_api_id', $dataApiObj->getId());
            $mappingJob->set('atable_name', $apiItem['table_config']['table_name']);
            $mappingJob->set('pk_cols', implode(",", $apiItem['table_config']['pkey']));
            $mappingJob->set('collection_id', $this->getId());            
            if(!$mappingJob->getVal("settings")) $mappingJob->resetSettings($lang, false);
            $mappingJob->commit();
        }


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
