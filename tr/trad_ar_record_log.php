<?php

class RecordLogArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["record_log"]["step1"] = "التنفيذ";
		$trad["record_log"]["step2"] = "النتائج";
		$trad["record_log"]["step3"] = "عرض جدولي";
		

		$trad["record_log"]["recordlog.single"] = "أثر تنفيذ خدمة";
		$trad["record_log"]["recordlog.new"] = "جديد(ة)";
		$trad["record_log"]["record_log"] = "آثار تنفيذ الخدمات";
		
		$trad["record_log"]["record_definition"] = "تعريف السجل";
		$trad["record_log"]["record_json"] = "بيانات جيسون";
		$trad["record_log"]["log_title"] = "عنوان الأثر";
		$trad["record_log"]["log_details"] = "تفاصيل الأثر";
		$trad["record_log"]["showHtml"] = "عرض جدولي";

		$trad["record_log"]["mapping_job_id"] = "مهمة التقابل";
		$trad["record_log"]["data_api_id"] = "خدمة البيانات";
		$trad["record_log"]["run_date"] = "تاريخ التنفيذ";
		
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new RecordLogEnTranslator();
		return new RecordLog();
	}
}