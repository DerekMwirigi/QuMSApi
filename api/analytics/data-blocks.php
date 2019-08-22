<?php 
    include '../../controllers/request.php';
    $requestHandler = new RequestHandler();
    $reqRes = $requestHandler->flagRequest($_SERVER, $_POST);
    if($reqRes["success"]){
        include '../../controllers/analytics.php';
        $analytics = new Analytics();
        $reqRes = $analytics->dataBlocks();
    }
    echo json_encode($reqRes);
?>