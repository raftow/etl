<?php

class RecordLogEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["record_log"]["step1"] = "Record";
		$trad["record_log"]["step2"] = "Results";
		$trad["record_log"]["step3"] = "Show Table";

		$trad["record_log"]["recordlog.single"] = "API Record log";
		$trad["record_log"]["recordlog.new"] = "new";
		$trad["record_log"]["record_log"] = "API Record logs";
		$trad["record_log"]["record_definition"] = "Record Definition";
		$trad["record_log"]["record_json"] = "JSON Data";
		$trad["record_log"]["log_title"] = "Log Title";
		$trad["record_log"]["log_details"] = "Log Details";
		$trad["record_log"]["showHtml"] = "Show Table";
		

		$trad["record_log"]["mapping_job_id"] = "mapping job";
		$trad["record_log"]["data_api_id"] = "Data api";
		$trad["record_log"]["run_date"] = "Run Date";
		
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new RecordLogArTranslator();
		return new RecordLog();
	}
}