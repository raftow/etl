<?php

class MappingColEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["mapping_col"]["mappingcol.single"] = "mapping column";
		$trad["mapping_col"]["mappingcol.new"] = "new";
		$trad["mapping_col"]["mapping_col"] = "mapping columns";
		$trad["mapping_col"]["name_ar"] = "Arabic Mapping row name";
		$trad["mapping_col"]["desc_ar"] = "Arabic Mapping row description";
		$trad["mapping_col"]["name_en"] = "English Mapping row name";
		$trad["mapping_col"]["desc_en"] = "English Mapping row description";
		$trad["mapping_col"]["mapping_job_id"] = "mapping job";
		$trad["mapping_col"]["source_field_name"] = "Source field name";
		$trad["mapping_col"]["destination_field_name"] = "Destination field name";
		$trad["mapping_col"]["field_name"] = "??? ?????";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingColArTranslator();
		return new MappingCol();
	}
}