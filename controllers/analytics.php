<?php 
    class Analytics extends DatabaseHandler {
        private $debug, $configModel, $errors;
        public function __construct($debug = NULL){
            $this->debug = $debug;
            parent::__construct($this->debug);
            $this->errors = array();
            $this->configModel = json_decode(file_get_contents("../../models/analytics.json"), true);
        }

        public function dataBlocks () {
           
            return array(
                "success"=>true,
                "errors"=>null,
                "status_code"=>1,
                "status_message"=>'Success.',
                "message"=>"Worked",
                "data"=>array(
                    "topLawyers"=>$this->fetchRows(null, null, null, "SELECT * FROM lwy LIMIT 5")[2],
                    "closeLawyers"=>$this->fetchRows(null, null, null, "SELECT * FROM lwy LIMIT 5")[2],
                    "topServices"=>$this->fetchRows(null, null, null, "SELECT * FROM lw_services LIMIT 5")[2]
                )
            );
            return $this->jsonResponse($this->search($this->configModel["data-blocks"]));
        }
    }
?>