<?php

class EtlApiExecutionAfwStructure
{
    // token separator = §
    public static function initInstance(&$obj)
    {
        if ($obj instanceof ApiExecution) {
            $obj->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
            $obj->FORMULA_DISPLAY_FIELD = "concat('api-exec-', data_api_id, '-at-',run_date)";
            // $obj->ENABLE_DISPLAY_MODE_IN_QEDIT = true;
            $obj->ORDER_BY_FIELDS = 'mapping_job_id, data_api_id, run_date desc';

            $obj->UNIQUE_KEY = ['mapping_job_id', 'data_api_id', 'run_date'];

            $obj->showQeditErrors      = true;
            $obj->showRetrieveErrors   = true;
            $obj->general_check_errors = true;
            $obj->editByStep           = true;
            $obj->editNbSteps          = 5;
            $obj->after_save_edit = array( 'class'=>'MappingJob', 'attribute'=>'mapping_job_id', 'currmod'=>'etl', 'currstep'=>5 );
            // $obj->after_save_edit = ['mode' => 'qsearch', 'currmod' => 'etl', 'class' => 'ApiExecution', 'submit' => true];
        } else {
            ApiExecutionArTranslator::initData();
            ApiExecutionEnTranslator::initData();
        }
    }

    public static $DB_STRUCTURE =
    [
        'id'                 => ['SHOW' => true, 'RETRIEVE' => true, 'EDIT' => false, 'TYPE' => 'PK'],

        'mapping_job_id'     => [
            'SHORTNAME' => 'job',
            'SEARCH'    => true,
            'QSEARCH'            => true,
            'SHOW'      => true,
            'AUDIT'                   => false,
            'RETRIEVE' => true,
            'EDIT'                                    => true,
            'QEDIT'      => true,
            'SIZE'                                    => 32,
            'MAXLENGTH'    => 32,
            'MIN-SIZE'             => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'MANDATORY' => true,
            'UTF8'      => false,
            'TYPE'                                    => 'FK',
            'ANSWER'     => 'mapping_job',
            'ANSMODULE' => 'etl',
            'RELATION'                                => 'OneToMany',
            'READONLY' => true,
            'DNA'               => true,
            'CSS'                                     => 'width_pct_50'
        ],

        'data_api_id'        => [
            'SHORTNAME' => 'api',
            'SEARCH'    => true,
            'QSEARCH'         => true,
            'SHOW'      => true,
            'AUDIT'                   => false,
            'RETRIEVE' => true,
            'EDIT'                                    => true,
            'QEDIT'      => true,
            'SIZE'                                    => 32,
            'MAXLENGTH'    => 32,
            'MIN-SIZE'          => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'MANDATORY' => true,
            'UTF8'      => false,
            'TYPE'                                    => 'FK',
            'ANSWER'     => 'data_api',
            'ANSMODULE' => 'etl',
            'RELATION'                                => 'OneToMany',
            'READONLY' => true,
            'DNA'            => true,
            'CSS'                                     => 'width_pct_50'
        ],

        'run_date'           => [
            'SEARCH' => true,
            'QSEARCH'        => false,
            'SHOW'  => true,
            'AUDIT'      => false,
            'RETRIEVE'               => true,
            'EDIT'                                 => true,
            'QEDIT'          => true,
            'SIZE'                                 => 10,
            'MAXLENGTH'        => 10,
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'MANDATORY' => true,
            'UTF8' => false,
            'TYPE'                                 => 'DATETIME',
            'READONLY' => true,
            'CSS'                                  => 'width_pct_50'
        ],

        'findword'           => [
            'SEARCH' => true,
            'QSEARCH'    => true,
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'   => false,
            'EDIT'       => true,
            'CAN-BE-FORCED' => true,
            'QEDIT'      => true,
            'SIZE'                                 => 32,
            'MAXLENGTH'    => 64,
            'MIN-SIZE' => 5,
            'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
            'MANDATORY' => false,
            'UTF8' => true,
            'TYPE'                                 => 'TEXT',
            'READONLY' => false,
            'CSS'                                  => 'width_pct_50'
        ],

        'input'              => [
            'STEP' => 99,
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
            'READONLY'  => true,
            'CSS'                                  => 'width_pct_100'
        ],

        'output_title'           => [
            'STEP' => 99,
            'SEARCH' => true,
            'QSEARCH'    => true,
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'                 => true,
            'EDIT'                                 => true,
            'QEDIT'      => true,
            'SIZE'                                 => 96,
            'MAXLENGTH'    => 128,
            'MIN-SIZE' => 5,
            'CHAR_TEMPLATE' => 'ARABIC-CHARS,SPACE',
            'MANDATORY' => true,
            'UTF8' => true,
            'TYPE'                                 => 'TEXT',
            'READONLY' => true,
            'CSS'                                  => 'width_pct_100'
        ],

        'output'             => [
            'STEP' => 99,
            'SEARCH'         => true,
            'QSEARCH' => true,
            'SHOW'       => true,
            'AUDIT'              => false,
            'RETRIEVE' => false,
            'EDIT'                               => true,
            'QEDIT'       => false,
            'SIZE'                               => 'AREA',
            'MAXLENGTH' => 9999999999999,
            'MIN-SIZE'  => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'UTF8' => true,
            'TYPE'                               => 'TEXT',
            'READONLY'  => true,
            'ROWS'                               => 5,
            'CSS'                                => 'width_pct_100'
        ],

        'inputOutputHtml'            => [
            'STEP' => 1,
            'CATEGORY' => 'FORMULA',
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'          => false,
            'EDIT'                                 => true,
            'QEDIT'       => false,
            'SIZE'                                 => 'AREA',
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'UTF8' => false,
            'TYPE'                                 => 'TEXT',
            'READONLY'  => true,
            'FORMAT' => 'HTML',
            'CSS'                                  => 'width_pct_100'
        ],

        'showHtml'            => [
            'STEP' => 2,
            'CATEGORY' => 'FORMULA',
            'SHOW'   => true,
            'AUDIT'      => false,
            'RETRIEVE'          => false,
            'EDIT'                                 => true,
            'QEDIT'       => false,
            'SIZE'                                 => 'AREA',
            'MIN-SIZE' => 1,
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'UTF8' => false,
            'TYPE'                                 => 'TEXT',
            'READONLY'  => true,
            'FORMAT' => 'HTML',
            'CSS'                                  => 'width_pct_100'
        ],

        'executionLogList' => array(
            'STEP' => 3,
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
            'CHAR_TEMPLATE' => 'ALPHABETIC,SPACE',
            'MANDATORY' => false,
            'UTF8' => false,
            'TYPE' => 'FK',
            'CATEGORY' => 'ITEMS',
            'ANSWER' => 'execution_log',
            'ANSMODULE' => 'etl',
            'ITEM' => 'api_execution_id',
            'READONLY' => true,
            'CAN-BE-SETTED' => true,
            'CSS' => 'width_pct_100',
        ),

        'ignoredRecordLogList' => array('STEP' => 4,  'SHOW' => true,  'FORMAT' => 'retrieve',  'ICONS' => false,  'BUTTONS' => true,  'SEARCH' => false,  'QSEARCH' => false,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'FK', 'CATEGORY' => 'ITEMS',  'ANSWER' => 'record_log',  'ANSMODULE' => 'etl',  
                'ITEM' => 'api_execution_id',  'WHERE' => "status='ignore' and (§findword§='' or record_definition=§findword§)", 'LIMIT' => 50,
                'READONLY' => true,  
				'CSS' => 'width_pct_100', ),


        'erronedRecordLogList' => array('STEP' => 5,  'SHOW' => true,  'FORMAT' => 'retrieve',  'ICONS' => false, 'BUTTONS' => true,  'SEARCH' => false,  'QSEARCH' => false,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'FK', 'CATEGORY' => 'ITEMS',  'ANSWER' => 'record_log',  'ANSMODULE' => 'etl',  
                'ITEM' => 'api_execution_id',  'WHERE' => "status='error'", 'LIMIT' => 50,
                'READONLY' => true,  
				'CSS' => 'width_pct_100', ),

        'erroned_count' => array(
			'SHOW' => true,
			'CSS' => 'width_pct_25',
			'CATEGORY' => 'FORMULA',
            'PHP_FORMULA'=>'countItems.erronedRecordLogList',
			'TYPE' => 'INT',
			'EDIT' => true,
			'READONLY' => true,
			'RETRIEVE' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

        'ignored_count' => array(
			'SHOW' => true,
			'CSS' => 'width_pct_25',
			'CATEGORY' => 'FORMULA',
            'PHP_FORMULA'=>'countItems.ignoredRecordLogList',
			'TYPE' => 'INT',
			'EDIT' => true,
			'READONLY' => true,
			'RETRIEVE' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),


        'recordLogList' => array('STEP' => 99,  'SHOW' => true,  'FORMAT' => 'retrieve',  'ICONS' => true,  'DELETE-ICON' => true,  'BUTTONS' => true,  'SEARCH' => false,  'QSEARCH' => false,  'AUDIT' => false,  'RETRIEVE' => false,  
				'EDIT' => false,  'QEDIT' => false,  
				'SIZE' => 32,  'MAXLENGTH' => 32,  'MIN-SIZE' => 1,  'CHAR_TEMPLATE' => "ALPHABETIC,SPACE",  'MANDATORY' => false,  'UTF8' => false,  
				'TYPE' => 'FK',  
				'CATEGORY' => 'ITEMS',  'ANSWER' => 'record_log',  'ANSMODULE' => 'etl',  'ITEM' => 'api_execution_id',  'READONLY' => true,  'CAN-BE-SETTED' => true, 
				'CSS' => 'width_pct_100', ),

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
