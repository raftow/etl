<?php

class DataTransformationEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["data_transformation"]["step1"] = "Definition";
		$trad["data_transformation"]["step2"] = "Run";

		$trad["data_transformation"]["datatransformation.single"] = "transformation";
		$trad["data_transformation"]["datatransformation.new"] = "new";
		$trad["data_transformation"]["data_transformation"] = "transformations";
		$trad["data_transformation"]["name_ar"] = "Arabic Data transformation name";
		$trad["data_transformation"]["desc_ar"] = "Arabic Data transformation description";
		$trad["data_transformation"]["name_en"] = "English Data transformation name";
		$trad["data_transformation"]["desc_en"] = "English Data transformation description";
		$trad["data_transformation"]["lookup_code"] = "Transformation PHP method";
		$trad["data_transformation"]["validation_code"] = "Transformation validation PHP method";
		$trad["data_transformation"]["similar_methods"] = "Try also these transformations";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new DataTransformationArTranslator();
		return new DataTransformation();
	}
}