<?php 
    include 'sms.php';

    class Appointment extends DatabaseHandler {
        private $debug, $sms, $smsconfig,  $configModel, $errors, $accTypes;
        public function __construct($debug = NULL){
            $this->debug = $debug;
            parent::__construct($this->debug);
            $this->sms = new Sms($this->debug);
            $this->errors = array();
            $this->smsconfig = json_decode(file_get_contents("../../config/sms.config.json"), true);
            $this->configModel = json_decode(file_get_contents("../../models/appointment.json"), true);
        }

        public function create ($appointmentModel, $userModel){
            $validRes = $this->utils->validateModel($appointmentModel, $this->configModel["createValidModel"]);
            if($validRes["success"]){
                $appointmentModel["code"] = $this->utils->generateRandom(1111, 9999, 4);
                $appointmentModel["patientId"] = $userModel["id"];
                $appointmentModel["createdOn"] = $this->dates->getDateTimeNow();
                $dbRes=$this->insert("appointments", $appointmentModel);
                if($dbRes[0] == 1){
                    return array(
                        "success"=>true,
                        "errors"=>null,
                        "status_code"=>1,
                        "status_message"=>'Successful.',
                        "message"=>"appointment was created.",
                        "data"=>null
                    );
                }
                array_push($this->errors, $dbRes[1]);
                return array(
                    "success"=>true,
                    "errors"=>$this->errors,
                    "status_code"=>0,
                    "status_message"=>'Failed.',
                    "message"=>"appointment details not saved.",
                    "data"=>null
                );
            }
            return $validRes;
        }
        
        public function view ($filterModel, $userModel){
            if(!empty($filterModel)){ 
                $searchModel = $this->configModel["viewList"];
                $keyModel = array();
                foreach ($filterModel as $key => $value){  
                    $keyModel[$key] = "='".$value."'";
                } 
                $searchModel["keyModel"] = $keyModel;
            } 
            else {
                $searchModel = $this->configModel["viewList"];
            }
            $dbRes = $this->search($searchModel);
            if($dbRes[0] == 1){
                return array(
                    "success"=>true,
                    "errors"=>null,
                    "status_code"=>1,
                    "status_message"=>'Succesful.',
                    "message"=>"Found " . count($dbRes[2]) . " appointments",
                    "data"=>$dbRes[2][0]
                );
            }
            array_push($this->errors, $dbRes[1]);
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"No appointments found.",
                "data"=>null
            );
        }

        public function fetch ($filterModel, $userModel){
            if(!empty($filterModel)){ 
                $searchModel = $this->configModel["viewList"];
                $keyModel = array();
                foreach ($filterModel as $key => $value){  
                    $keyModel[$key] = "='".$value."'";
                } 
                $searchModel["keyModel"] = $keyModel;
            } 
            else {
                $searchModel = $this->configModel["viewList"];
            }
            $dbRes = $this->search($searchModel);
            if($dbRes[0] == 1){
                return array(
                    "success"=>true,
                    "errors"=>null,
                    "status_code"=>1,
                    "status_message"=>'Succesful.',
                    "message"=>"Found " . count($dbRes[2]) . " appointments",
                    "data"=>$dbRes[2]
                );
            }
            array_push($this->errors, $dbRes[1]);
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"No appointments found.",
                "data"=>null
            );
        }
    }
?>