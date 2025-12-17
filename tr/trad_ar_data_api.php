<?php

class DataApiArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["data_api"]["dataapi.single"] = "خدمة بيانات";
		$trad["data_api"]["dataapi.new"] = "جديد(ة)";
		$trad["data_api"]["data_api"] = "خدمات بيانات";
		$trad["data_api"]["name_ar"] = "مسمى  بالعربية";
		$trad["data_api"]["desc_ar"] = "وصف  بالعربية";
		$trad["data_api"]["name_en"] = "مسمى  بالانجليزية";
		$trad["data_api"]["desc_en"] = "وصف  بالانجليزية";
		$trad["data_api"]["end_point_id"] = "نقطة النهاية للبيئة الفعلية";
		$trad["data_api"]["test_end_point_id"] = "نقطة النهاية للبيئة التجريبية";
		$trad["data_api"]["relative_url"] = "الرابط النسبى";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new DataApiEnTranslator();
		return new DataApi();
	}
}