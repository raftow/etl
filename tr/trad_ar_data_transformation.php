<?php

class DataTransformationArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["data_transformation"]["datatransformation.single"] = "تحويلة";
		$trad["data_transformation"]["datatransformation.new"] = "جديد(ة)";
		$trad["data_transformation"]["data_transformation"] = "التحويلات";
		$trad["data_transformation"]["name_ar"] = "مسمى  بالعربية";
		$trad["data_transformation"]["desc_ar"] = "وصف  بالعربية";
		$trad["data_transformation"]["name_en"] = "مسمى  بالانجليزية";
		$trad["data_transformation"]["desc_en"] = "وصف  بالانجليزية";
		$trad["data_transformation"]["lookup_code"] = "الرمز";
		$trad["data_transformation"]["validation_code"] = "برمجية التثبت";
		
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new DataTransformationEnTranslator();
		return new DataTransformation();
	}
}