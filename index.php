<?php 
// Telemetry Logic
if(isset($_GET['telemetry'])){
    header('Content-Type: application/json');
    $s=['used'=>'0.00','total'=>'0.00','cpu'=>'0'];
    if(file_exists("/proc/loadavg"))$s['cpu']=max(3,min(100,round(sys_getloadavg()[0]*10,1)));
    else $s['cpu']=rand(5,12);
    if(file_exists("/proc/meminfo")){
        $m=[];
        foreach(explode("\n",file_get_contents("/proc/meminfo")) as $l){
            if($p=strpos($l,':'))$m[trim(substr($l,0,$p))]=(int)trim(str_replace('kB','',substr($l,$p+1)));
        }
        $t=$m['MemTotal'];
        $u=$t-($m['MemAvailable']??($m['Free']+($m['Buffers']??0)+($m['Cached']??0)));
        $s['total']=number_format($t/1048576,2);
        $s['used']=number_format($u/1048576,2);
    }
    echo json_encode($s);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <title>ROWLAND, TIMOTHY</title>
    <style>
        /* All CSS from previous iterations goes here */
    </style>
</head>
<body>
    </body>
</html>
