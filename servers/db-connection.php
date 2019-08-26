<?php
    ini_set('display_errors', 1);
    ini_set('log_errors',true);

    @require_once('adodb/adodb.inc.php');
    @require_once('adodb/adodb-active-record.inc.php');

    $db_type  = 'postgres';//Driver={PostgreSQL}
    $db_host  = '206.81.26.7:5432';
    $db_user  = 'calista';
    $db_pass  = 'r00t';
    $db_name  = 'calista_loan';

    $db = ADONewConnection($db_type);
    $db->debug = true;
    if(!@$db->Connect($db_host,$db_user,$db_pass,$db_name)){
    echo("Could Not Connect to {$db_host}/{$db_name} ");
    }

    $db->SetFetchMode(ADODB_FETCH_ASSOC);

    ADODB_Active_Record::SetDatabaseAdapter( $db );
?>
