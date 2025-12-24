<?php

class EtlObject extends AfwMomkenObject
{
    // lookup Value List codes

    public static function executeIndicator($object, $indicator, $normal_class, $arrObjectsRelated, $sens = 'asc', $default_red_pct = 0, $default_orange_pct = 0)
    {
        global $MODE_SQL_PROCESS_LOURD, $nb_queries_executed;
        $old_nb_queries_executed    = $nb_queries_executed;
        $old_MODE_SQL_PROCESS_LOURD = $MODE_SQL_PROCESS_LOURD;
        $MODE_SQL_PROCESS_LOURD     = true;

        if (! $normal_class) {
            $normal_class = 'vert';
        }

        $methodIndicator         = 'get' . $indicator . 'Indicator';
        list($objective, $value) = $object->$methodIndicator($arrObjectsRelated);

        $objective_red_pct = $object->getVal(strtolower($indicator) . '_red_pct');
        if (! $objective_red_pct) {
            $objective_red_pct = $default_red_pct;
        }

        if (! $objective_red_pct) {
            $objective_red_pct = ($sens == 'asc') ? 80.0 : 120.0;
        }

        $objective_red = $objective_red_pct * $objective / 100.0;

        $orange_pct = $object->getVal('orange_pct');

        if (! $orange_pct) {
            $orange_pct = $default_orange_pct;
        }

        if (! $orange_pct) {
            $orange_pct = ($sens == 'asc') ? 90.0 : 110.0;
        }

        // %
        $objective_orange_pct = round($objective_red_pct * 100.0 / $orange_pct);
        $objective_orange     = $objective_orange_pct * $objective / 100.0;

        if (($sens == 'asc')) {
            if ($value < $objective_red) {
                $value_class = "$indicator rouge";
            } elseif ($value < $objective_orange) {
                $value_class = 'orange';
            } else {
                $value_class = $normal_class;
            }

        } else {
            if ($value > $objective_red) {
                $value_class = "$indicator rouge";
            } elseif ($value > $objective_orange) {
                $value_class = 'orange';
            } else {
                $value_class = $normal_class;
            }

        }

        $MODE_SQL_PROCESS_LOURD = $old_MODE_SQL_PROCESS_LOURD;
        $nb_queries_executed    = $old_nb_queries_executed;

        // die( "$objective, $value, $value_class, $objective_red, $objective_orange" );
        return [$objective, $value, $value_class, $objective_red, $objective_orange];
    }

    public function getSettings()
    {
        return json_decode($this->getVal('settings'), true);
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
        return 'active';
    }


    public function calcErrorInSettings($what="value")
    {
        $settings = $this->getVal("settings");
        return AfwSettingsHelper::calcErrorInSettings($settings);
    }
    

    

    public function resetSettings()
    {
        $this->set('settings', '{
            "bearer_token":"",
            "timeout_seconds":30,            
            "batch_size":1000,
            "max_errors":100,
            "log_level":"ERROR",
            "notify_on_error":true,
            "notify_on_completion":true,
            "email_recipients":[],
            "retry_failed_records":false,
            "input":[],
            "output":[],


        }');

        $this->commit();
    }


    public function getPublicMethodsStandard()
    {
        $pbms = [];
        $settings_step = $this->stepOfAttribute('settings');
        if($settings_step>0)
        {
            $methodConfirmationWarningEn = "This action can not be canceled !";
            $methodConfirmationWarning = $this->tm($methodConfirmationWarningEn, "ar");

            $methodConfirmationQuestionEn = "Are you sure you want to reset the settings ?";
            $methodConfirmationQuestion = $this->tm($methodConfirmationQuestionEn, "ar");
                        
            $color    = 'green';
            $title_ar = 'تصفير الاعدادات';
            $title_en = 'Reset settings';
            $methodName = 'resetSettings';

            $pbms[AfwStringHelper::hzmEncode($methodName)] = ['METHOD' => $methodName, 
                    'COLOR' => $color, 
                    'LABEL_AR' => $title_ar, 
                    'LABEL_EN' => $title_en,
                    'ADMIN-ONLY' => true, 'BF-ID' => '', 
                    'STEP' => $settings_step,
                    'CONFIRMATION_NEEDED' => true,
                    'CONFIRMATION_WARNING' => array('ar' => $methodConfirmationWarning, 'en' => $methodConfirmationWarningEn),
                    'CONFIRMATION_QUESTION' => array('ar' => $methodConfirmationQuestion, 'en' => $methodConfirmationQuestionEn),
            
                ];
        }
        

        return $pbms;
    }
}
