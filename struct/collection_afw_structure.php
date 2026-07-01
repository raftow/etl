<?php

class EtlCollectionAfwStructure
{
    // token separator = §
    public static function initInstance(&$obj)
    {
        if ($obj instanceof Collection) {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
            $obj->DISPLAY_FIELD_BY_LANG = ['ar' => 'name_ar', 'en' => 'name_en'];

            $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
            $obj->ORDER_BY_FIELDS = '';

            $obj->UNIQUE_KEY = ['collection_code'];

            $obj->general_check_errors = true;
            $obj->editByStep = true;
            $obj->editNbSteps = 3;
            // $obj->after_save_edit = array( 'class'=>'Collection', 'attribute'=>'xxxx_id', 'currmod'=>'etl', 'currstep'=>2 );
            $obj->after_save_edit = ['mode' => 'qsearch', 'currmod' => 'etl', 'class' => 'Collection', 'submit' => true];
        } else {
            CollectionArTranslator::initData();
            CollectionEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE =
    [
        'id'                 => ['SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'],

        'collection_code'    => [
            'SEARCH' => true,
            'QSEARCH'    => true,
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'               => true,
            'EDIT'                            => true,
            'QEDIT'      => true,
            'SIZE'                            => 16,
            'MAXLENGTH'    => 16,
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'MANDATORY' => true,
            'UTF8' => true,
            'TYPE'                            => 'TEXT',
            'READONLY' => false,
            'DNA'   => true,
            'CSS'                             => 'width_pct_33'
        ],

        'name_ar'            => [
            'SEARCH' => true,
            'QSEARCH'    => true,
            'SHOW'    => true,
            'AUDIT'      => false,
            'RETRIEVE-AR'                 => true,
            'EDIT'                                 => true,
            'QEDIT'      => true,
            'SIZE'                                 => 128,
            'MAXLENGTH'   => 128,
            'MIN-SIZE' => 5,
            'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
            'MANDATORY' => true,
            'UTF8' => true,
            'TYPE'                                 => 'TEXT',
            'READONLY' => false,
            'CSS'                                  => 'width_pct_33'
        ],

        'name_en'            => [
            'SEARCH' => true,
            'QSEARCH'    => true,
            'SHOW'    => true,
            'AUDIT'      => false,
            'RETRIEVE-EN'               => true,
            'EDIT'                                 => true,
            'QEDIT'      => true,
            'SIZE'                                 => 128,
            'MAXLENGTH'   => 128,
            'MIN-SIZE' => 5,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'MANDATORY' => true,
            'UTF8' => false,
            'TYPE'                                 => 'TEXT',
            'READONLY' => false,
            'CSS'                                  => 'width_pct_33'
        ],

        'desc_ar'            => [
            'SEARCH' => true,
            'QSEARCH'     => true,
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'          => false,
            'EDIT'                                 => true,
            'QEDIT'       => false,
            'SIZE'                                 => 'AREA',
            'MAXLENGTH' => 32,
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'UTF8' => true,
            'TYPE'                                 => 'TEXT',
            'READONLY'  => false,
            'CSS'                                  => 'width_pct_100'
        ],

        'desc_en'            => [
            'SEARCH' => true,
            'QSEARCH'     => true,
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'          => false,
            'EDIT'                                 => true,
            'QEDIT'       => false,
            'SIZE'                                 => 'AREA',
            'MAXLENGTH' => 32,
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'UTF8' => false,
            'TYPE'                                 => 'TEXT',
            'READONLY'  => false,
            'CSS'                                  => 'width_pct_100'
        ],

        'mappingJobList' => array(
            'STEP' => 2,
            'SHOW' => true,
            'FORMAT' => 'retrieve',
            'ICONS' => true,
            'DELETE-ICON' => true,
            'BUTTONS' => true,
            'SEARCH' => false,
            'QSEARCH' => false,
            'AUDIT' => false,
            'RETRIEVE' => false,
            'EDIT' => false,
            'QEDIT' => false,
            'SIZE' => 32,
            'MAXLENGTH' => 32,
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",
            'MANDATORY' => false,
            'UTF8' => false,
            'TYPE' => 'FK',
            'CATEGORY' => 'ITEMS',
            'ANSWER' => 'mapping_job',
            'ANSMODULE' => 'etl',
            'ITEM' => 'collection_id',
            'READONLY' => true,
            'CAN-BE-SETTED' => true,
            'CSS' => 'width_pct_100',
        ),

        'settings'            => [
            'STEP' => 99,
            'SEARCH' => true,
            'QSEARCH'     => true,
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'          => false,
            'EDIT'                                 => true,
            'QEDIT'       => false,
            'SIZE'                                 => 'AREA',
            'MAXLENGTH' => 3333,
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'UTF8' => false,
            'TYPE'                                 => 'TEXT',
            'READONLY'  => false,
            'MANDATORY' => true,
            'COLS' => 100,
            'ROWS' => 20,
            'CSS'                                  => 'width_pct_100'
        ],

        'errorInSettings'            => [
            'STEP' => 99,
            'SEARCH' => true,
            'QSEARCH'     => true,
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'          => false,
            'EDIT'                                 => true,
            'QEDIT'       => false,
            'SIZE'                                 => 256,
            'MAXLENGTH' => 256,
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'UTF8' => false,
            'CATEGORY' => 'FORMULA',
            'TYPE' => 'TEXT',
            'READONLY'  => true,
            'NO-LABEL'           => true,
            'CSS'                                  => 'width_pct_100'
        ],


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
