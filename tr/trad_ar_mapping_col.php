<?php

class MappingColArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["mapping_col"]["mappingcol.single"] = "حقل تقابل";
		$trad["mapping_col"]["mappingcol.new"] = "جديد(ة)";
		$trad["mapping_col"]["mapping_col"] = "حقول التقابل";
		$trad["mapping_col"]["name_ar"] = "مسمى  بالعربية";
		$trad["mapping_col"]["desc_ar"] = "وصف  بالعربية";
		$trad["mapping_col"]["name_en"] = "مسمى  بالانجليزية";
		$trad["mapping_col"]["desc_en"] = "وصف  بالانجليزية";
		$trad["mapping_col"]["mapping_job_id"] = "مهمة التقابل";
		$trad["mapping_col"]["source_field_name"] = "رمز الحقل المصدر";
		$trad["mapping_col"]["destination_field_name"] = "رمز الحقل الوجهة";
		$trad["mapping_col"]["field_name"] = "رمز الحقل";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingColEnTranslator();
		return new MappingCol();
	}
}