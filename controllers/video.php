<?php 
    include 'sms.php';

    class Video extends DatabaseHandler {
        private $debug, $sms, $smsconfig,  $configModel, $errors, $accTypes;
        public function __construct($debug = NULL){
            $this->debug = $debug;
            parent::__construct($this->debug);
            $this->sms = new Sms($this->debug);
            $this->errors = array();
            $this->smsconfig = json_decode(file_get_contents("../../config/sms.config.json"), true);
            $this->configModel = json_decode(file_get_contents("../../models/video.json"), true);
        }

        public function create ($videoModel, $userModel){
            $validRes = $this->utils->validateModel($videoModel, $this->configModel["createValidModel"]);
            if($validRes["success"]){
                $videoModel["code"] = $this->utils->generateRandom(1111, 9999, 4);
                $videoModel["createdById"] = $userModel["id"];
                $videoModel["createdOn"] = $this->dates->getDateTimeNow();
                $dbRes=$this->insert("videos", $videoModel);
                if($dbRes[0] == 1){
                    return array(
                        "success"=>true,
                        "errors"=>null,
                        "status_code"=>1,
                        "status_message"=>'Successful.',
                        "message"=>"video was created.",
                        "data"=>null
                    );
                }
                array_push($this->errors, $dbRes[1]);
                return array(
                    "success"=>true,
                    "errors"=>$this->errors,
                    "status_code"=>0,
                    "status_message"=>'Failed.',
                    "message"=>"video details not saved.",
                    "data"=>null
                );
            }
            return $validRes;
        }

        public function view ($filterModel, $userModel){
            $searchModel = $this->configModel["viewModel"];
            $searchModel["keyModel"] = array(
                "id"=>"='".$filterModel["id"]."'"
            );
            $dbRes = $this->search($searchModel);
            if($dbRes[0] == 1){
                return array(
                    "success"=>true,
                    "errors"=>null,
                    "status_code"=>1,
                    "status_message"=>'Succesful.',
                    "message"=>"Found " . count($dbRes[2]) . " videos",
                    "data"=>$dbRes[2][0]
                );
            }
            array_push($this->errors, $dbRes[1]);
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"No videos found.",
                "data"=>null
            );
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
                    "message"=>"Found " . count($dbRes[2]) . " videos",
                    "data"=>$dbRes[2]
                );
            }
            array_push($this->errors, $dbRes[1]);
            return array(
                "success"=>true,
                "errors"=>$this->errors,
                "status_code"=>0,
                "status_message"=>'Failed.',
                "message"=>"No videos found.",
                "data"=>null
            );
        }
    }
?>