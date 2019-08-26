<?php 
    class Analytics extends DatabaseHandler {
        private $debug, $configModel, $errors;
        public function __construct($debug = NULL){
            $this->debug = $debug;
            parent::__construct($this->debug);
            $this->errors = array();
            $this->configModel = json_decode(file_get_contents("../../models/analytics.json"), true);
        }

        public function dataBlocks ($userModel) {
            return array(
                "success"=>true,
                "errors"=>null,
                "status_code"=>1,
                "status_message"=>'Success.',
                "message"=>"Worked",
                "data"=>array(
                    "appointmentsCount"=>$this->fetchItem(null, null, "SELECT COUNT(*) FROM appointments WHERE patientId=".$userModel["id"])[2],
                    "visitsCount"=>$this->fetchItem(null, null, "SELECT COUNT(*) FROM visits WHERE patientId=".$userModel["id"])[2]
                )
            );
            return $this->jsonResponse($this->search($this->configModel["data-blocks"]));
        }
    }
?>