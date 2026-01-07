<?php

class ExecutionLogArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["execution_log"]["step1"] = "التنفيذ";
		$trad["execution_log"]["step2"] = "النتائج";
		$trad["execution_log"]["step3"] = "عرض جدولي";
		$trad["execution_log"]["showHtml"] = "عرض جدولي";

		$trad["execution_log"]["executionlog.single"] = "أثر تنفيذ خدمة";
		$trad["execution_log"]["executionlog.new"] = "جديد(ة)";
		$trad["execution_log"]["execution_log"] = "آثار تنفيذ الخدمات";
		$trad["execution_log"]["findword"] = "فلترة";
		$trad["execution_log"]["input"] = "مدخلات الخدمة";
		$trad["execution_log"]["output"] = "مخرجات الخدمة";
		$trad["execution_log"]["mapping_job_id"] = "مهمة التقابل";
		$trad["execution_log"]["data_api_id"] = "خدمة البيانات";
		$trad["execution_log"]["run_date"] = "تاريخ التنفيذ";
		$trad["execution_log"]["output_title"] = "عنوان المخرجات";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new ExecutionLogEnTranslator();
		return new ExecutionLog();
	}
}