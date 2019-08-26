<?php 
    include 'sms.php';

    class Visit extends DatabaseHandler {
        private $debug, $sms, $smsconfig,  $configModel, $errors, $accTypes;
        public function __construct($debug = NULL){
            $this->debug = $debug;
            parent::__construct($this->debug);
            $this->sms = new Sms($this->debug);
            $this->errors = array();
            $this->smsconfig = json_decode(file_get_contents("../../config/sms.config.json"), true);
            $this->configModel = json_decode(file_get_contents("../../models/visit.json"), true);
        }

        public function create ($visitModel, $userModel){
            $validRes = $this->utils->validateModel($visitModel, $this->configModel["createValidModel"]);
            if($validRes["success"]){
                $visitModel["code"] = $this->utils->generateRandom(1111, 9999, 4);
                $visitModel["doctorId"] = $userModel["id"];
                $visitModel["createdOn"] = $this->dates->getDateTimeNow();
                $dbRes=$this->insert("visits", $visitModel);
                if($dbRes[0] == 1){
                    return array(
                        "success"=>true,
                        "errors"=>null,
                        "status_code"=>1,
                        "status_message"=>'Successful.',
                        "message"=>"visit was created.",
                        "data"=>null
                    );
                }
                array_push($this->errors, $dbRes[1]);
                return array(
                    "success"=>true,
                    "errors"=>$this->errors,
                    "status_code"=>0,
                    "status_message"=>'Failed.',
                    "message"=>"visit details not saved.",
                    "data"=>null
                );
            }
            return $validRes;
        }
        
        public function fetch ($filterModel, $userModel){
            $searchModel = $this->configModel["getList"];
            // $searchModel["keyModel"] = array(
            //     "buyerId"=>"=".$userModel["id"]
            // );
            $dbRes = $this->search($searchModel);
            if($dbRes[0] == 1){
                return array(
                    "success"=>true,
                    "errors"=>null,
                    "status_code"=>1,
                    "status_message"=>'Succesful.',
                    "message"=>"Found " . count($dbRes[2]) . " visits",
                    "data"=>$dbRes[2]
                );
            }
            array_push($this->errors, $dbRes[1]);
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"No visits found.",
                "data"=>null
            );
        }
    }
?>