<?php

class EndPointEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["end_point"]["endpoint.single"] = "end point";
		$trad["end_point"]["endpoint.new"] = "new";
		$trad["end_point"]["end_point"] = "end points";
		$trad["end_point"]["name_ar"] = "Arabic End point name";
		$trad["end_point"]["desc_ar"] = "Arabic End point description";
		$trad["end_point"]["name_en"] = "English End point name";
		$trad["end_point"]["desc_en"] = "English End point description";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new EndPointArTranslator();
		return new EndPoint();
	}
}