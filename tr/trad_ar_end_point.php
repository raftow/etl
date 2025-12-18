<?php

class EndPointArTranslator{
    public static function initData()
    {
        $trad = [];


		$trad["end_point"]["endpoint.single"] = "نقطة نهاية";
		$trad["end_point"]["endpoint.new"] = "جديد(ة)";
		$trad["end_point"]["end_point"] = "نقاط نهاية";
		$trad["end_point"]["name_ar"] = "مسمى  بالعربية";
		$trad["end_point"]["desc_ar"] = "وصف  بالعربية";
		$trad["end_point"]["name_en"] = "مسمى  بالانجليزية";
		$trad["end_point"]["desc_en"] = "وصف  بالانجليزية";
		$trad["end_point"]["production"] = "بيئة فعلية";
		$trad["end_point"]["dataApiList"] = "الخدمات";
		$trad["end_point"]["url"] = "الرابط";
		
		
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new EndPointEnTranslator();
		return new EndPoint();
	}
}