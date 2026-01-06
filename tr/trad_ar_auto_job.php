<?php

class AutoJobArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["auto_job"]["autojob.single"] = "مهمة آلية";
		$trad["auto_job"]["autojob.new"] = "جديد(ة)";
		$trad["auto_job"]["auto_job"] = "مهام آلية";
		$trad["auto_job"]["name_ar"] = "مسمى  بالعربية";
		$trad["auto_job"]["desc_ar"] = "وصف  بالعربية";
		$trad["auto_job"]["name_en"] = "مسمى  بالانجليزية";
		$trad["auto_job"]["desc_en"] = "وصف  بالانجليزية";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new AutoJobEnTranslator();
		return new AutoJob();
	}
}