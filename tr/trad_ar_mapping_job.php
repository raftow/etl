<?php

class MappingJobArTranslator{
    public static function initData()
    {
        $trad = [];
		$trad["mapping_job"]["step1"] = "تعريف المهمة";
		$trad["mapping_job"]["step2"] = "برمجة المهمة";
		$trad["mapping_job"]["step3"] = "الإعدادات المتقدمة";
		$trad["mapping_job"]["step4"] = "التقابل";
		$trad["mapping_job"]["step5"] = "سجلات التنفيذ";
		$trad["mapping_job"]["apiExecutionList"] = "سجلات التنفيذ";

		$trad["mapping_job"]["mappingjob.single"] = "مهمة ترحيل";
		$trad["mapping_job"]["mappingjob.new"] = "جديد(ة)";
		$trad["mapping_job"]["mapping_job"] = "مهمات الترحيل";
		$trad["mapping_job"]["name_ar"] = "مسمى  بالعربية";
		$trad["mapping_job"]["desc_ar"] = "وصف  بالعربية";
		$trad["mapping_job"]["name_en"] = "مسمى  بالانجليزية";
		$trad["mapping_job"]["desc_en"] = "وصف  بالانجليزية";
		$trad["mapping_job"]["end_point_id"] = "نقطة النهاية";
		$trad["mapping_job"]["lookup_code"] = "الرمز";
		$trad["mapping_job"]["data_api_id"] = "خدمة البيانات";
		$trad["mapping_job"]["atable_name"] = "رمز الجدول";
		$trad["mapping_job"]["pk_cols"] = "حقول المفتاح الوحيد";
		$trad["mapping_job"]["mappingColList"] = "تقابل الحقول";
		$trad["mapping_job"]["collection_id"] = "المجموعة";
		$trad["mapping_job"]["statusHtml"] = "حالة التنفيذ";
		$trad["mapping_job"]["data_load_type_enum"] = "نوع التحيل";
		$trad["mapping_job"]["data_source_type_enum"] = "نوع الاستخراج";
		

	
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingJobEnTranslator();
		return new MappingJob();
	}
}