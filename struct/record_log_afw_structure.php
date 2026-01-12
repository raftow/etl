<?php

class EtlRecordLogAfwStructure
{
    // token separator = §
    public static function initInstance(&$obj)
    {
        if ($obj instanceof RecordLog) {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;

            // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
            $obj->ORDER_BY_FIELDS = '';

            $obj->UNIQUE_KEY = ['mapping_job_id', 'data_api_id', 'run_date', 'record_definition'];

            $obj->showQeditErrors      = true;
            $obj->showRetrieveErrors   = true;
            $obj->general_check_errors = true;
            $obj->editByStep           = true;
            $obj->editNbSteps          = 3;
            // $obj->after_save_edit = array( 'class'=>'RecordLog', 'attribute'=>'xxxx_id', 'currmod'=>'etl', 'currstep'=>2 );
            $obj->after_save_edit = ['mode' => 'qsearch', 'currmod' => 'etl', 'class' => 'RecordLog', 'submit' => true];
        } else {
            RecordLogArTranslator::initData();
            RecordLogEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE =
    [
        'id'                 => ['SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'],

        'mapping_job_id'     => ['SHORTNAME' => 'job', 'SEARCH'    => true, 'QSEARCH'            => true, 'SHOW'      => true, 'AUDIT'                   => false, 'RETRIEVE' => true,
            'EDIT'                                    => true, 'QEDIT'      => true,
            'SIZE'                                    => 32, 'MAXLENGTH'    => 32, 'MIN-SIZE'             => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8'      => false,
            'TYPE'                                    => 'FK', 'ANSWER'     => 'mapping_job', 'ANSMODULE' => 'etl',
            'RELATION'                                => 'OneToMany', 'READONLY' => true, 'DNA'               => true,
            'CSS'                                     => 'width_pct_50'],

        'data_api_id'        => ['SHORTNAME' => 'api', 'SEARCH'    => true, 'QSEARCH'         => true, 'SHOW'      => true, 'AUDIT'                   => false, 'RETRIEVE' => true,
            'EDIT'                                    => true, 'QEDIT'      => true,
            'SIZE'                                    => 32, 'MAXLENGTH'    => 32, 'MIN-SIZE'          => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8'      => false,
            'TYPE'                                    => 'FK', 'ANSWER'     => 'data_api', 'ANSMODULE' => 'etl',
            'RELATION'                                => 'OneToMany', 'READONLY' => true, 'DNA'            => true,
            'CSS'                                     => 'width_pct_50'],

        'run_date'           => ['SEARCH' => true, 'QSEARCH'        => false, 'SHOW'  => true, 'AUDIT'      => false, 'RETRIEVE'               => true,
            'EDIT'                                 => true, 'QEDIT'          => true,
            'SIZE'                                 => 10, 'MAXLENGTH'        => 10, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8' => false,
            'TYPE'                                 => 'DATETIME', 'READONLY' => true,
            'CSS'                                  => 'width_pct_50'],


        'record_definition'           => ['SEARCH' => true, 'QSEARCH'    => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'                 => false,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 255, 'MAXLENGTH'    => 255, 'MIN-SIZE' => 4, // ex 'id:1'
            'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE', 'MANDATORY' => false, 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY' => false,
            'CSS'                                  => 'width_pct_50'],            

        'record_json'              => ['SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MAXLENGTH' => 32, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY'  => true,
            'CSS'                                  => 'width_pct_100'],


        'log_title'           => ['SEARCH' => true, 'QSEARCH'    => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'                 => true,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 96, 'MAXLENGTH'    => 128, 'MIN-SIZE' => 5, 'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE', 'MANDATORY' => true, 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY' => true,
            'CSS'                                  => 'width_pct_100'],

        'log_details'             => ['STEP' => 2, 'SEARCH'         => true, 'QSEARCH' => true, 'SHOW'       => true, 'AUDIT'              => false, 'RETRIEVE' => false,
            'EDIT'                               => true, 'QEDIT'       => false,
            'SIZE'                               => 'AREA', 'MAXLENGTH' => 9999999999999, 'MIN-SIZE'  => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => true,
            'TYPE'                               => 'TEXT', 'READONLY'  => true,
            'ROWS'                               => 20,      
            'CSS'                                => 'width_pct_100'],


        'showHtml'            => ['STEP' => 3, 'CATEGORY' => 'FORMULA',
            'SHOW'   => true,  'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY'  => true,  'FORMAT' => 'HTML',
            'CSS'                                  => 'width_pct_100'],                 

        'created_by'         => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'],
        'created_at'         => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'],
        'updated_by'         => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'],
        'updated_at'         => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'TECH_FIELDS-RETRIEVE' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'],
        'validated_by'       => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'auser', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'],
        'validated_at'       => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'DATETIME', 'FGROUP' => 'tech_fields'],
        'active'             => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, 'DEFAULT' => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'],
        'version'            => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'INT', 'FGROUP' => 'tech_fields'],
        'draft'              => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 'QEDIT' => false, 'DEFAULT' => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'],
        'update_groups_mfk'  => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'],
        'delete_groups_mfk'  => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'],
        'display_groups_mfk' => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'ANSWER' => 'ugroup', 'ANSMODULE' => 'ums', 'TYPE' => 'MFK', 'FGROUP' => 'tech_fields'],
        'sci_id'             => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'QEDIT' => false, 'TYPE' => 'FK', 'ANSWER' => 'scenario_item', 'ANSMODULE' => 'ums', 'FGROUP' => 'tech_fields'],
        'tech_notes'         => ['STEP' => 99, 'HIDE_IF_NEW' => true, 'TYPE' => 'TEXT', 'CATEGORY' => 'FORMULA', 'SHOW-ADMIN' => true, 'TOKEN_SEP' => '§', 'READONLY' => true, 'NO-ERROR-CHECK' => true, 'FGROUP' => 'tech_fields'],
    ];

}

// errors
