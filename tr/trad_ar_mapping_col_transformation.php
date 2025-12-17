<?php

class MappingColTransformationArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["mapping_col_transformation"]["mappingcoltransformation.single"] = "تحويل حقل";
		$trad["mapping_col_transformation"]["mappingcoltransformation.new"] = "جديد(ة)";
		$trad["mapping_col_transformation"]["mapping_col_transformation"] = "تحويلات الحقول";
		$trad["mapping_col_transformation"]["name_ar"] = "مسمى  بالعربية";
		$trad["mapping_col_transformation"]["desc_ar"] = "وصف  بالعربية";
		$trad["mapping_col_transformation"]["name_en"] = "مسمى  بالانجليزية";
		$trad["mapping_col_transformation"]["desc_en"] = "وصف  بالانجليزية";
		$trad["mapping_col_transformation"]["mapping_col_id"] = "حقل التقابل";
		$trad["mapping_col_transformation"]["data_transformation_id"] = "التحويلة";
		$trad["mapping_col_transformation"]["transformation_order"] = "الترتيب";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingColTransformationEnTranslator();
		return new MappingColTransformation();
	}
}