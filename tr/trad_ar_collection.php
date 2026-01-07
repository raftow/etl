<?php

class CollectionArTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["collection"]["step1"] = "تعريف المجموعة";
		$trad["collection"]["step2"] = "المهام";
		$trad["collection"]["step3"] = "الإعدادات";

		$trad["collection"]["collection.single"] = "مجموعة";
		$trad["collection"]["collection.new"] = "جديد(ة)";
		$trad["collection"]["collection"] = "المجموعات";
		$trad["collection"]["collection_code"] = "رمز المجموعة";
		$trad["collection"]["name_ar"] = "مسمى  بالعربية";
		$trad["collection"]["name_en"] = "مسمى  بالانجليزية";
		$trad["collection"]["desc_ar"] = "وصف  بالعربية";
		$trad["collection"]["desc_en"] = "وصف  بالانجليزية";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new CollectionEnTranslator();
		return new Collection();
	}
}