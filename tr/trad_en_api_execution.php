<?php

class ApiExecutionEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["api_execution"]["step1"] = "Execution";
		$trad["api_execution"]["step99"] = "Results";
		$trad["api_execution"]["step2"] = "Filtered records";
		$trad["api_execution"]["showHtml"] = "Filtered records";
		$trad["api_execution"]["step3"] = "Execution Log";
		$trad["api_execution"]["executionLogList"] = "Execution Log";
		$trad["api_execution"]["step5"] = "Errors";
		$trad["api_execution"]["erronedRecordLogList"] = "Errors";
		$trad["api_execution"]["step4"] = "Warnings";
		$trad["api_execution"]["ignoredRecordLogList"] = "Warnings"; 

		$trad["api_execution"]["apiExecutionList"] = "Execution Records";

		$trad["api_execution"]["apiexecution.single"] = "API Execution";
		$trad["api_execution"]["apiexecution.new"] = "new";
		$trad["api_execution"]["api_execution"] = "API Execution";
		$trad["api_execution"]["findword"] = "Filter";
		$trad["api_execution"]["input"] = "Input";
		$trad["api_execution"]["output"] = "Output";

		$trad["api_execution"]["mapping_job_id"] = "Individual Job";
		$trad["api_execution"]["data_api_id"] = "Data api";
		$trad["api_execution"]["run_date"] = "Run Date";
		$trad["api_execution"]["output_title"] = "Output Title";
		$trad["api_execution"]["inputOutputHtml"] = "Input & Output";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new ApiExecutionArTranslator();
		return new ApiExecution();
	}
}