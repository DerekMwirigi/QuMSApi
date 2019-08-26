<?php 
    include '../../controllers/request.php';
    $requestHandler = new RequestHandler();
    $reqRes = $requestHandler->flagRequest($_SERVER, json_decode(file_get_contents('php://input'), true));
    if($reqRes["success"]){
        include '../../controllers/appointment.php';
        $appointment = new Appointment();
        $reqRes = $appointment->fetch($_GET, $reqRes["data"]);
    }
    echo json_encode($reqRes);
?>