<?php

class MappingJobEnTranslator{
    public static function initData()
    {
        $trad = [];
		$trad["mapping_job"]["step1"] = "Define the mapping job";
		$trad["mapping_job"]["step2"] = "Implement the mapping job";
		$trad["mapping_job"]["step3"] = "Advanced settings";
		$trad["mapping_job"]["step4"] = "Mapping columns";

		$trad["mapping_job"]["mappingjob.single"] = "mapping job";
		$trad["mapping_job"]["mappingjob.new"] = "new";
		$trad["mapping_job"]["mapping_job"] = "mapping jobs";
		$trad["mapping_job"]["name_ar"] = "Arabic Mapping job name";
		$trad["mapping_job"]["desc_ar"] = "Arabic Mapping job description";
		$trad["mapping_job"]["name_en"] = "English Mapping job name";
		$trad["mapping_job"]["desc_en"] = "English Mapping job description";
		$trad["mapping_job"]["end_point_id"] = "end point";
		$trad["mapping_job"]["lookup_code"] = "Lookup code";
		$trad["mapping_job"]["data_api_id"] = "data api";
		$trad["mapping_job"]["pk_cols"] = "Primary Key columns";
		$trad["mapping_job"]["atable_name"] = "Table code";
		$trad["mapping_job"]["mappingColList"] = "Mapping columns";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingJobArTranslator();
		return new MappingJob();
	}
}