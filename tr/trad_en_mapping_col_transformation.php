<?php

class MappingColTransformationEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["mapping_col_transformation"]["mappingcoltransformation.single"] = "mapping column transformation";
		$trad["mapping_col_transformation"]["mappingcoltransformation.new"] = "new";
		$trad["mapping_col_transformation"]["mapping_col_transformation"] = "mapping column transformations";
		$trad["mapping_col_transformation"]["name_ar"] = "Arabic Mapping col transformation name";
		$trad["mapping_col_transformation"]["desc_ar"] = "Arabic Mapping col transformation description";
		$trad["mapping_col_transformation"]["name_en"] = "English Mapping col transformation name";
		$trad["mapping_col_transformation"]["desc_en"] = "English Mapping col transformation description";
		$trad["mapping_col_transformation"]["mapping_col_id"] = "mapping column";
		$trad["mapping_col_transformation"]["data_transformation_id"] = "transformation";
		$trad["mapping_col_transformation"]["transformation_order"] = "order";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingColTransformationArTranslator();
		return new MappingColTransformation();
	}
}