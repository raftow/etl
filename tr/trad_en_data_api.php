<?php

class DataApiEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["data_api"]["dataapi.single"] = "data api";
		$trad["data_api"]["dataapi.new"] = "new";
		$trad["data_api"]["data_api"] = "data apis";
		$trad["data_api"]["name_ar"] = "Arabic Data api name";
		$trad["data_api"]["desc_ar"] = "Arabic Data api description";
		$trad["data_api"]["name_en"] = "English Data api name";
		$trad["data_api"]["desc_en"] = "English Data api description";
		$trad["data_api"]["end_point_id"] = "end point";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new DataApiArTranslator();
		return new DataApi();
	}
}