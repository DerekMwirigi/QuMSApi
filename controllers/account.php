<?php 
    include 'sms.php';

    class Account extends DatabaseHandler {
        private $debug, $sms, $smsconfig,  $configModel, $errors, $accTypes;
        public function __construct($debug = NULL){
            $this->debug = $debug;
            parent::__construct($this->debug);
            $this->sms = new Sms($this->debug);
            $this->errors = array();
            $this->smsconfig = json_decode(file_get_contents("../../config/sms.config.json"), true);
            $this->configModel = json_decode(file_get_contents("../../models/account.json"), true);
            $this->accTypes = array("users", "lwy", "clients");
        }

        public function create ($accountModel){
            $validRes = $this->utils->validateModel($accountModel, $this->configModel["createValidModel"]);
            if($validRes["success"]){
                $accountModel["code"] = $this->utils->generateRandom(1111, 9999, 4);
                $accountModel["token"] = $this->utils->createToken();
                $accountModel["password"] = $this->utils->encryptPassword($accountModel["password"]);
                $dbRes=$this->insert($this->accTypes[$accountModel["roleId"]], $accountModel);
                if($dbRes[0] == 1){
                    return array(
                        "success"=>true,
                        "errors"=>null,
                        "status_code"=>1,
                        "status_message"=>'Successful.',
                        "message"=>"account was created.",
                        "data"=>null
                    );
                }
                array_push($this->errors, $dbRes[1]);
                return array(
                    "success"=>true,
                    "errors"=>$this->errors,
                    "status_code"=>0,
                    "status_message"=>'Failed.',
                    "message"=>"account details not saved.",
                    "data"=>null
                );
            }
            return $validRes;
        }

        public function edit ($accountModel, $keyModel){
            unset($accountModel["id"]);
            unset($keyModel["roleId"]);
            $dbRes = $this->update($this->accTypes[$accountModel["roleId"]], $accountModel, $keyModel);
            if($dbRes[0] == 1){
                return array(
                    "success"=>true,
                    "errors"=>null,
                    "status_code"=>1,
                    "status_message"=>'Successful.',
                    "message"=>"account was updated.",
                    "data"=>null
                );
            }
            array_push($this->errors, $dbRes[1]);
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"account was not updated.",
                "data"=>null
            );
        }

        public function updateFirebaseToken ($payLoad, $userModel){
            $dbRes = $this->update("users", $payLoad, $userModel);
            if($dbRes[0] == 1){
                return array(
                    "success"=>true,
                    "errors"=>null,
                    "status_code"=>1,
                    "status_message"=>'Succesful.',
                    "message"=>"Signed In.",
                    "data"=>$this->fetchRow("users", $payLoad)[2]
                );
            }
            array_push($this->errors, "FirebaseToken Not updated");
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"FirebaseToken update failed.",
                "data"=>null
            );
        }  
    }
?>