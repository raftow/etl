<?php

class AutoJobEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["auto_job"]["autojob.single"] = "automatic job";
		$trad["auto_job"]["autojob.new"] = "new";
		$trad["auto_job"]["auto_job"] = "automatic jobs";
		$trad["auto_job"]["name_ar"] = "Arabic Auto job name";
		$trad["auto_job"]["desc_ar"] = "Arabic Auto job description";
		$trad["auto_job"]["name_en"] = "English Auto job name";
		$trad["auto_job"]["desc_en"] = "English Auto job description";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new AutoJobArTranslator();
		return new AutoJob();
	}
}