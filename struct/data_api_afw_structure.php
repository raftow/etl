<?php

class EtlDataApiAfwStructure
{
    // token separator = §
    public static function initInstance(&$obj)
    {
        if ($obj instanceof DataApi) {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
            $obj->DISPLAY_FIELD_BY_LANG                 = ['ar' => 'name_ar', 'en' => 'name_en'];

            // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
            $obj->ORDER_BY_FIELDS = '';

            // $obj->UNIQUE_KEY = array( 'XXX', 'YYY' );
            $obj->editByStep = true;
			$obj->editNbSteps = 3;
            $obj->showQeditErrors      = true;
            $obj->showRetrieveErrors   = true;
            $obj->general_check_errors = true;
            // $obj->after_save_edit = array( 'class'=>'DataApi', 'attribute'=>'xxxx_id', 'currmod'=>'etl', 'currstep'=>2 );
            $obj->after_save_edit = ['mode' => 'qsearch', 'currmod' => 'etl', 'class' => 'DataApi', 'submit' => true];
        } else {
            DataApiArTranslator::initData();
            DataApiEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE =
    [
        'id'                 => ['SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'],

        'name_ar'            => ['SEARCH' => true, 'QSEARCH'    => true, 'SHOW'    => true, 'AUDIT'      => false, 'RETRIEVE-AR'                 => true,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 128, 'MAXLENGTH'   => 128, 'MIN-SIZE' => 5, 'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE', 'MANDATORY' => true, 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY' => false,
            'CSS'                                  => 'width_pct_50'],

        'name_en'            => ['SEARCH' => true, 'QSEARCH'    => true, 'SHOW'    => true, 'AUDIT'      => false, 'RETRIEVE-EN'               => true,
            'EDIT'                                 => true, 'QEDIT'      => true,
            'SIZE'                                 => 128, 'MAXLENGTH'   => 128, 'MIN-SIZE' => 5, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY' => false,
            'CSS'                                  => 'width_pct_50'],

        'desc_ar'            => ['SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MAXLENGTH' => 32, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => true,
            'TYPE'                                 => 'TEXT', 'READONLY'  => false,
            'CSS'                                  => 'width_pct_50'],

        'desc_en'            => ['SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MAXLENGTH' => 32, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY'  => false,
            'CSS'                                  => 'width_pct_50'],

        'test_end_point_id'  => ['SHORTNAME' => 'point', 'SEARCH'       => true, 'QSEARCH'          => false, 'SHOW'      => true, 'AUDIT'                   => false, 'RETRIEVE' => false,
            'EDIT'                                    => true, 'QEDIT'           => true,
            'SIZE'                                    => 32, 'MAXLENGTH'         => 32, 'MIN-SIZE'           => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8'      => false,
            'TYPE'                                    => 'FK', 'ANSWER'          => 'end_point', 'ANSMODULE' => 'etl',
            'WHERE'                                   => "production = 'N'",
            'RELATION'                                => 'OneToMany', 'READONLY' => false, 'DNA'             => true,
            'CSS'                                     => 'width_pct_50'],

        'end_point_id'       => ['SHORTNAME' => 'point', 'SEARCH'       => true, 'QSEARCH'          => false, 'SHOW'      => true, 'AUDIT'                   => false, 'RETRIEVE' => false,
            'EDIT'                                    => true, 'QEDIT'           => true,
            'SIZE'                                    => 32, 'MAXLENGTH'         => 32, 'MIN-SIZE'           => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8'      => false,
            'TYPE'                                    => 'FK', 'ANSWER'          => 'end_point', 'ANSMODULE' => 'etl',
            'WHERE'                                   => "production = 'Y'",
            'RELATION'                                => 'OneToMany', 'READONLY' => false, 'DNA'             => true,
            'CSS'                                     => 'width_pct_50'],

        'relative_url'       => ['SEARCH' => true, 'QSEARCH'    => true, 'SHOW'    => true, 'AUDIT'      => false, 'RETRIEVE'               => true,
            'EDIT'                            => true, 'QEDIT'      => true,
            'SIZE'                            => 128, 'MAXLENGTH'   => 128, 'MIN-SIZE' => 5, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'MANDATORY' => true, 'UTF8' => false,
            'TYPE'                            => 'TEXT', 'READONLY' => false,
            'CSS'                             => 'width_pct_100'],

        'settings'            => ['STEP' => 2, 'SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MAXLENGTH' => 3333, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY'  => false, 'MANDATORY' => true,
            'COLS' => 80, 'ROWS' => 20,
            'CSS'                                  => 'width_pct_100'],

        'errorInSettings'            => ['STEP' => 2, 'SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 256, 'MAXLENGTH' => 256, 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'CATEGORY' => 'FORMULA', 'TYPE' => 'TEXT', 'READONLY'  => true, 'NO-LABEL'           => true,
            'CSS'                                  => 'width_pct_100'],


        'input'            => ['STEP' => 3, 'SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY'  => false, 
            'COLS' => 80, 'ROWS' => 8,
            'CSS'                                  => 'width_pct_100'],

        'output'            => ['STEP' => 3, 'SEARCH' => true, 'QSEARCH'     => true, 'SHOW'   => true, 'AUDIT'      => false, 'RETRIEVE'          => false,
            'EDIT'                                 => true, 'QEDIT'       => false,
            'SIZE'                                 => 'AREA', 'MIN-SIZE' => 1, 'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE', 'UTF8' => false,
            'TYPE'                                 => 'TEXT', 'READONLY'  => true, 
            'COLS' => 80, 'ROWS' => 20, 'PRE' => true,
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
