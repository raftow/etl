<?php

class CollectionEnTranslator{
    public static function initData()
    {
        $trad = [];
		$trad["collection"]["step1"] = "Define Collection";
		$trad["collection"]["step2"] = "Jobs";
		
		$trad["collection"]["mappingJobList"] = "Jobs";

		$trad["collection"]["collection.single"] = "collection";
		$trad["collection"]["collection.new"] = "new";
		$trad["collection"]["collection"] = "collections";
		$trad["collection"]["collection_code"] = "Collection Code";
		$trad["collection"]["name_ar"] = "Arabic Collection name";
		$trad["collection"]["name_en"] = "English Collection name";
		$trad["collection"]["desc_ar"] = "Arabic Collection description";
		$trad["collection"]["desc_en"] = "English Collection description";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new CollectionArTranslator();
		return new Collection();
	}
}