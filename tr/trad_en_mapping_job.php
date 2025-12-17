<?php

class MappingJobEnTranslator{
    public static function initData()
    {
        $trad = [];

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
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingJobArTranslator();
		return new MappingJob();
	}
}