<?php

class EtlMappingJobAfwStructure
{
    // token separator = §
    public static function initInstance(&$obj)
    {
        if ($obj instanceof MappingJob) {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
            $obj->DISPLAY_FIELD_BY_LANG                 = ['ar' => 'name_ar', 'en' => 'name_en'];

            // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
            $obj->ORDER_BY_FIELDS = '';
            $obj->editByStep      = true;
            $obj->editNbSteps     = 4;
            $obj->UNIQUE_KEY      = ['lookup_code'];

            $obj->showQeditErrors      = true;
            $obj->showRetrieveErrors   = true;
            $obj->general_check_errors = true;
            // $obj->after_save_edit = array( 'class'=>'MappingJob', 'attribute'=>'xxxx_id', 'currmod'=>'etl', 'currstep'=>2 );
            $obj->after_save_edit = ['mode' => 'qsearch', 'currmod' => 'etl', 'class' => 'MappingJob', 'submit' => true];
        } else {
            MappingJobArTranslator::initData();
            MappingJobEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE =
    [
        'id'                 => ['SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'],

        'lookup_code'        => ['SEARCH' => true, 'QSEARCH'    => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'               => true,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 16, 'MAXLENGTH'    => 16, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY' => false, 'DNA'   => true,
            'CSS'                                  => 'width_pct_50'],


        'name_ar'            => ['STEP' => 2, 'SEARCH' => true, 'QSEARCH'    => true, 'SHOW'    => true, 'AUDIT'      => false, 'RETRIEVE'                 => false,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 128, 'MAXLENGTH'   => 128, 'MIN-SIZE' => 5, 'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE', 'MANDATORY' => true, 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY' => false,
            'CSS'                                  => 'width_pct_50'],

        'name_en'            => ['STEP' => 2, 'SEARCH' => true, 'QSEARCH'    => true, 'SHOW'    => true, 'AUDIT'      => false, 'RETRIEVE'               => false,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 128, 'MAXLENGTH'   => 128, 'MIN-SIZE' => 5, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY' => false,
            'CSS'                                  => 'width_pct_50'],

        'desc_ar'            => ['STEP' => 2, 'SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MAXLENGTH' => 32, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY'  => false,
            'CSS'                                  => 'width_pct_50'],

        'desc_en'            => ['STEP' => 2, 'SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MAXLENGTH' => 32, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY'  => false,
            'CSS'                                  => 'width_pct_50'],

        'end_point_id'       => ['STEP' => 2, 'SHORTNAME' => 'endpoint', 'SEARCH'       => true, 'QSEARCH'          => false, 'SHOW'      => true, 'AUDIT'                   => false, 'RETRIEVE' => true,
            'EDIT'                                    => true, 'QEDIT'           => true,
            'SIZE'                                    => 32, 'MAXLENGTH'         => 32, 'MIN-SIZE'           => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8'      => false,
            'TYPE'                                    => 'FK', 'ANSWER'          => 'end_point', 'ANSMODULE' => 'etl',
            'RELATION'                                => 'ManyToOne', 'READONLY' => false, 'DNA'             => true,
            'CSS'                                     => 'width_pct_50'],


        'data_api_id'        => ['STEP' => 2, 'SHORTNAME' => 'api', 'SEARCH'         => true, 'QSEARCH'         => false, 'SHOW'      => true, 'AUDIT'                   => false, 'RETRIEVE' => true,
            'EDIT'                                    => true, 'QEDIT'           => true,
            'SIZE'                                    => 32, 'MAXLENGTH'         => 32, 'MIN-SIZE'          => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8'      => false,
            'TYPE'                                    => 'FK', 'ANSWER'          => 'data_api', 'ANSMODULE' => 'etl',
            'RELATION'                                => 'ManyToOne', 'READONLY' => false, 'DNA'            => true,
            'CSS'                                     => 'width_pct_50'],

        'atable_name'        => ['STEP' => 3, 'SEARCH' => true, 'QSEARCH'    => false, 'SHOW'  => true, 'AUDIT'      => false, 'RETRIEVE'               => true,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 48, 'MAXLENGTH'    => 48, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY' => false,
            'CSS'                                  => 'width_pct_50'],

        'pk_cols'            => ['STEP' => 3, 'SEARCH' => true, 'QSEARCH'    => false, 'SHOW'  => true, 'AUDIT'      => false, 'RETRIEVE'               => false,
            'EDIT'                                 => true, 'QEDIT'      => false,
            'SIZE'                                 => 32, 'MAXLENGTH'    => 32, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY' => false, 'DNA'   => true,
            'CSS'                                  => 'width_pct_50'],

        'settings'           => ['STEP' => 3, 'SEARCH'         => true, 'QSEARCH' => true, 'SHOW'       => true, 'AUDIT'              => false, 'RETRIEVE' => false,
            'EDIT'                          => true, 'QEDIT'       => false,
            'SIZE'                          => 'AREA', 'MAXLENGTH' => 3333, 'MIN-SIZE'  => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'TYPE'                          => 'TEXT', 'READONLY'  => false, 'MANDATORY' => true,
            'CSS'                           => 'width_pct_100'],

        'mappingColList'     => ['STEP' => 4, 'TYPE'           => 'FK', 'ANSWER'                => 'mapping_col', 'ANSMODULE' => 'etl',
            'CATEGORY'                           => 'ITEMS', 'ITEM'     => 'mapping_job_id', 'SHORTNAME' => 'mappingCols',
            // 'WHERE'=>'xxx = §xxx§', 'HIDE_COLS' => array(),
            'SHOW'                               => true, 'FORMAT'      => 'retrieve', 'EDIT'            => false, 'READONLY'          => true,
            'ICONS'                              => true, 'DELETE-ICON' => true, 'BUTTONS'               => true, 'NO-LABEL'           => false,
            'CSS'                                => 'width_pct_100'],

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
