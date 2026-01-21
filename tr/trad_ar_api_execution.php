<?php

class ApiExecutionArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["api_execution"]["step1"] = "التنفيذ";
		$trad["api_execution"]["step99"] = "النتائج";
		$trad["api_execution"]["step2"] = "عرض جدولي";
		$trad["api_execution"]["showHtml"] = "عرض جدولي";
		$trad["api_execution"]["step3"] = "آثار التنفيذ";
		$trad["api_execution"]["executionLogList"] = "آثار التنفيذ";
		$trad["api_execution"]["step4"] = "الأخطاء";
		$trad["api_execution"]["erronedRecordLogList"] = "الأخطاء";
		$trad["api_execution"]["step5"] = "التنبيهات";
		$trad["api_execution"]["erronedRecordLogList"] = "التنبيهات"; 
		$trad["api_execution"]["apiExecutionList"] = "سجلات التنفيذ";
		

		$trad["api_execution"]["apiexecution.single"] = "تنفيذ خدمة";
		$trad["api_execution"]["apiexecution.new"] = "جديد(ة)";
		$trad["api_execution"]["api_execution"] = "تنفيذ الخدمات";
		$trad["api_execution"]["findword"] = "فلترة";
		$trad["api_execution"]["input"] = "مدخلات الخدمة";
		$trad["api_execution"]["output"] = "مخرجات الخدمة";
		$trad["api_execution"]["mapping_job_id"] = "مهمة الترحيل";
		$trad["api_execution"]["data_api_id"] = "خدمة البيانات";
		$trad["api_execution"]["run_date"] = "تاريخ التنفيذ";
		$trad["api_execution"]["output_title"] = "عنوان المخرجات";
		$trad["api_execution"]["inputOutputHtml"] = "مدخلات ومخرجات الخدمة";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new ApiExecutionEnTranslator();
		return new ApiExecution();
	}
}