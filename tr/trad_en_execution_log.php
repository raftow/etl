<?php

class ExecutionLogEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["execution_log"]["step1"] = "Execution";
		$trad["execution_log"]["step2"] = "Results";

		$trad["execution_log"]["executionlog.single"] = "API Execution log";
		$trad["execution_log"]["executionlog.new"] = "new";
		$trad["execution_log"]["execution_log"] = "API Execution logs";
		$trad["execution_log"]["findword"] = "Filter";
		$trad["execution_log"]["input"] = "Input";
		$trad["execution_log"]["output"] = "Output";

		$trad["execution_log"]["mapping_job_id"] = "mapping job";
		$trad["execution_log"]["data_api_id"] = "Data api";
		$trad["execution_log"]["run_date"] = "Run Date";
		$trad["execution_log"]["output_title"] = "Output Title";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new ExecutionLogArTranslator();
		return new ExecutionLog();
	}
}