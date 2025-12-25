<?php

$file_dir_name = dirname(__FILE__);

// require_once( "$file_dir_name/../afw/afw.php" );

class EndPoint extends EtlObject
{

    public static $MY_ATABLE_ID = 13965;

    // إحصائيات نقاط نهاية
    public static $BF_STATS_END_POINT = 105074;

    // إدارة نقاط نهاية
    public static $BF_QEDIT_END_POINT = 105069;

    // إنشاء
    public static $BF_EDIT_END_POINT = 105068;

    // البحث في نقاط نهاية
    public static $BF_SEARCH_END_POINT = 105072;

    // عرض تفاصيل
    public static $BF_DISPLAY_END_POINT = 105071;

    // مسح
    public static $BF_DELETE_END_POINT = 105070;

    // نقاط نهاية
    public static $BF_QSEARCH_END_POINT = 105073;

    public static $DATABASE = 'ttc_etl';
    public static $MODULE   = 'etl';

    public static $TABLE = 'end_point';

    public static $DB_STRUCTURE = null;

    public function __construct()
    {
        parent::__construct('end_point', 'id', 'etl');
        EtlEndPointAfwStructure::initInstance($this);

    }

    public static function loadById($id)
    {
        $obj = new EndPoint();
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


    protected function getOtherLinksArray($mode, $genereLog = false, $step = 'all')
    {
        $lang = AfwLanguageHelper::getGlobalLanguage();
        // $objme = AfwSession::getUserConnected();
        // $me = ( $objme ) ? $objme->id : 0;

        $otherLinksArray = $this->getOtherLinksArrayStandard($mode, $genereLog, $step);
        $my_id           = $this->getId();
        $displ           = $this->getDisplay($lang);

        if ($mode == 'mode_dataApiList') {
            unset($link);
            $link              = [];
            $title             = 'إضافة خدمة بيانات جديد';
            $title_detailed    = $title . 'لـ : ' . $displ;
            $link['URL']       = "main.php?Main_Page=afw_mode_edit.php&cl=DataApi&currmod=etl&sel_end_point_id=$my_id";
            $link['TITLE']     = $title;
            $link['UGROUPS']   = [];
            $otherLinksArray[] = $link;
        }

        // check errors on all steps ( by default no for optimization )
        // rafik don't know why this : \//  = false;

        return $otherLinksArray;
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
                // etl.data_api-نقطة النهاية	end_point_id  أنا تفاصيل لها (required field)
                // require_once "../etl/data_api.php";
                $obj = new DataApi();
                $obj->where("end_point_id = '$id' and active='Y' ");
                $nbRecords = $obj->count();
                // check if there's no record that block the delete operation
                if ($nbRecords > 0) {
                    $this->deleteNotAllowedReason = 'Used in some data apis(s) as end point';
                    return false;
                }
                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                if (! $simul) {
                    $obj->deleteWhere("end_point_id = '$id' and active='N'");
                }

                // etl.mapping_job-نقطة النهاية	end_point_id  حقل يفلتر به (required field)
                // require_once "../etl/mapping_job.php";
                $obj = new MappingJob();
                $obj->where("end_point_id = '$id' and active='Y' ");
                $nbRecords = $obj->count();
                // check if there's no record that block the delete operation
                if ($nbRecords > 0) {
                    $this->deleteNotAllowedReason = 'Used in some mapping jobs(s) as end point';
                    return false;
                }
                // if there's no record that block the delete operation perform the delete of the other records linked with me and deletable
                if (! $simul) {
                    $obj->deleteWhere("end_point_id = '$id' and active='N'");
                }

                // FK part of me - deletable 

                // FK not part of me - replaceable 

                // MFK

            } else {
                // FK on me 

                // etl.data_api-نقطة النهاية	end_point_id  أنا تفاصيل لها (required field)
                if (! $simul) {
                    // require_once "../etl/data_api.php";
                    DataApi::updateWhere(['end_point_id' => $id_replace], "end_point_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}etl.data_api set end_point_id='$id_replace' where end_point_id='$id' ");

                }

                // etl.mapping_job-نقطة النهاية	end_point_id  حقل يفلتر به (required field)
                if (! $simul) {
                    // require_once "../etl/mapping_job.php";
                    MappingJob::updateWhere(['end_point_id' => $id_replace], "end_point_id='$id'");
                    // $this->execQuery("update ${server_db_prefix}etl.mapping_job set end_point_id='$id_replace' where end_point_id='$id' ");

                }

                // MFK

            }
            return true;
        }
    }

    protected function getPublicMethods()
    {
        $pbms = $this->getPublicMethodsStandard();

        $color                                         = "green";
        $title_ar                                      = "انشاء نسخة مطابقة";
        $methodName                                    = "cloneMe";
        $pbms[AfwStringHelper::hzmEncode($methodName)] = ["METHOD" => $methodName, "COLOR" => $color, "LABEL_AR" => $title_ar, "PUBLIC" => true, "BF-ID" => "", 'STEPS' => [2, 3]];

        
        if(!$this->revertSimulate())
        {
            $typeEp = $this->sureIs('production') ? 'تجريبية' : 'فعلية';
            $color                                         = "blue";
            $title_ar                                      = "انشاء نسخة $typeEp مطابقة";
            $methodName                                    = "revertMe";
            $pbms[AfwStringHelper::hzmEncode($methodName)] = ["METHOD" => $methodName, "COLOR" => $color, "LABEL_AR" => $title_ar, "PUBLIC" => true, "BF-ID" => "", 'STEPS' => [2, 3]];
        }
        


        return $pbms;
    }

    public static function loadByMainIndex($name_ar, $production, $name_en=null, $create_obj_if_not_found = false)
    {
        if (! $name_ar) {
            throw new AfwRuntimeException('loadByMainIndex : name_ar is mandatory field');
        }

        if (! $production) {
            throw new AfwRuntimeException('loadByMainIndex : production is mandatory field');
        }

        $obj = new EndPoint();
        $obj->select('name_ar', $name_ar);
        $obj->select('production', $production);

        if ($obj->load()) {
            if ($create_obj_if_not_found) {
                if($name_en) $obj->set('name_en', $name_en);
                $obj->activate();
            }

            return $obj;
        } elseif ($create_obj_if_not_found) {
            $obj->set('name_ar', $name_ar);
            $obj->set('production', $production);
            $obj->set('name_en', $name_en);
            $obj->insertNew();
            if (! $obj->id) {
                return null;
            }

            // means beforeInsert rejected insert operation
            $obj->is_new = true;
            return $obj;
        } else {
            return null;
        }

    }


    public function revertMe($lang = 'ar')
    {
        return $this->cloneMe($lang, true);
    }

    public function revertSimulate($lang = 'ar')
    {
        return $this->cloneMe($lang, true, true);
    }

    public function cloneMe($lang = 'ar', $revertProd = false, $simulate = false)
    {
        if($revertProd) $new_prod     = $this->sureIs('production') ? 'N' : 'Y';        
        else $new_prod = $this->getVal('production');

        $name_ar     = $this->getVal('name_ar');
        $name_en     = $this->getVal('name_en');

        $new_name_ar     = $this->getVal('name_ar');
        $new_name_en     = $this->getVal('name_en');

        if($revertProd)
        {
            if($new_prod=="Y") $new_name_ar = str_replace('تجريبي', 'فعلي', $new_name_ar);
            else $new_name_ar = str_replace('فعلي', 'تجريبي', $new_name_ar);
            if($new_prod=="Y") $new_name_en = str_replace('Test', 'Production', $new_name_en);
            else $new_name_en = str_replace('Production', 'Test', $new_name_en);
        }
        else {
            $new_name_ar = $new_name_ar . ' - نسخة';
            $new_name_en = $new_name_en . ' - clone';            
        }
        

        if($new_prod=="Y") $typeEP = 'Production';
        else $typeEP = 'Test';

        if($simulate) {
            if($new_name_ar and $new_prod) return EndPoint::loadByMainIndex($new_name_ar, $new_prod, $new_name_en, false);
            return null;
        }
        $epCloned = EndPoint::loadByMainIndex($new_name_ar, $new_prod, $new_name_en, true);
        if(!$epCloned->is_new) {
            return ['', "No need to clone EP `$name_en` to `$new_name_en`. It already exists with ID : ".$epCloned->id.''];
        }

        if($revertProd)
        {
            $dataApiList = $this->get('dataApiList');
            $nb = 0;
            foreach ($dataApiList as $dataApiItem) {
                /** @var DataApi $dataApiItem */
                if($new_prod=="Y") $dataApiItem->set("end_point_id", $epCloned->id);
                else $dataApiItem->set("test_end_point_id", $epCloned->id);
                $dataApiItem->commit();
                $nb++;
            }

            return ['', "$typeEP EP `$new_name_en` Cloned from `$name_en` with ID : ".$epCloned->id.", $nb data apis updated with this $typeEP EP."];
        } else {
            return ['', "$typeEP EP `$new_name_en` Cloned from `$name_en` with ID : ".$epCloned->id];
        }

    }

}
