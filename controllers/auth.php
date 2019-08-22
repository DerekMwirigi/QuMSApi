<?php 
    include 'sms.php';

    class Auth extends DatabaseHandler {
        private $debug, $sms, $smsconfig, $authModel, $errors, $accTypes;
        public function __construct($debug = NULL){
            $this->debug = $debug;
            parent::__construct($this->debug);
            $this->sms = new Sms($this->debug);
            $this->errors = array();
            $this->accTypes = array("users", "patients", "clients");
            $this->smsconfig = json_decode(file_get_contents("../../config/sms.config.json"), true);
            $this->authModel = json_decode(file_get_contents("../../models/auth.json"), true);
        }

        public function signUp ($authModel){
            $password = $authModel["password"];
            $dbRes = $this->insert($this->accTypes[$authModel["roleId"]], array(
                "code"=>$this->utils->generateRandom(11111, 99999, 5),
                "token"=>$this->utils->createToken(),
                "firstName"=>$authModel["firstName"],
                "lastName"=>$authModel["lastName"],
                "mobile"=>$authModel["mobile"],
                "email"=>$authModel["email"],
                "roleId"=>$authModel["roleId"],
                "password"=>$this->utils->encryptPassword($authModel["password"]),
                "firebaseToken"=>null,
                "image"=>"https://www.noetwo.com/98-home_default/reflexion.jpg"
            ));
            if($dbRes[0] == 1){
                return $this->verifyUSecret(array(
                    "uId"=>$authModel["email"],
                    "uSecret"=>$authModel["password"]
                ));
            }
            array_push($this->errors, $dbRes[1]);
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"Sign up failed.",
                "data"=>null
            );
        }

        public function verifyUSecret ($authModel){
            $validRes = $this->utils->validateModel($authModel, $this->authModel["verifyUSecret"]);
            if($validRes["success"]){
                $x = 0;
                foreach($this->accTypes as $accType){
                    $dbRes = $this->fetchRow($accType, array(
                        "email"=>$authModel["uId"],
                        "password"=>$this->utils->encryptPassword($authModel["uSecret"])
                    ));
                    if($dbRes[0] == 1){
                        $searchModel = $this->authModel["uProfile_".$x];
                        $searchModel["keyModel"] = array(
                            "id"=>"=".$dbRes[2]["id"]
                        ); 
                        return array(
                            "success"=>true,
                            "errors"=>null,
                            "status_code"=>1,
                            "status_message"=>'Succesful.',
                            "message"=>"Signed In.",
                            "data"=>$this->search($searchModel)[2][0]
                        );
                    }
                    $x ++;
                }
                array_push($this->errors, "Wrong details");
                return array(
                    "success"=>true,
                    "errors"=>$this->errors,
                    "status_code"=>0,
                    "status_message"=>'Failed.',
                    "message"=>"Sign in failed.",
                    "data"=>null
                );
            }
            return $validRes;
        }   
    }
?>