<?php

class MappingJobEnTranslator{
    public static function initData()
    {
        $trad = [];
		$trad["mapping_job"]["step1"] = "Definition";
		$trad["mapping_job"]["step2"] = "Implementation";
		$trad["mapping_job"]["step3"] = "Advanced settings";
		$trad["mapping_job"]["step4"] = "columns mapping";
		$trad["mapping_job"]["step5"] = "Execution Records";
		$trad["mapping_job"]["apiExecutionList"] = "Execution Records";


		$trad["mapping_job"]["mappingjob.single"] = "Individual Job";
		$trad["mapping_job"]["mappingjob.new"] = "new";
		$trad["mapping_job"]["mapping_job"] = "Individual Jobs";
		$trad["mapping_job"]["name_ar"] = "Arabic job name";
		$trad["mapping_job"]["desc_ar"] = "Arabic job description";
		$trad["mapping_job"]["name_en"] = "English job name";
		$trad["mapping_job"]["desc_en"] = "English job description";
		$trad["mapping_job"]["end_point_id"] = "end point";
		$trad["mapping_job"]["lookup_code"] = "Lookup code";
		$trad["mapping_job"]["data_api_id"] = "data api";
		$trad["mapping_job"]["pk_cols"] = "Target table primary key columns";
		$trad["mapping_job"]["atable_name"] = "Target table name";
		$trad["mapping_job"]["mappingColList"] = "columns mapping";
		$trad["mapping_job"]["collection_id"] = "Collection";
		$trad["mapping_job"]["statusHtml"] = "ُRun status";
		$trad["mapping_job"]["data_load_type_enum"] = "Load type";
		$trad["mapping_job"]["data_source_type_enum"] = "Extract type";
		
        
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new MappingJobArTranslator();
		return new MappingJob();
	}
}