<?php
// get the q parameter from URL
$request_label = $_REQUEST["q"];
$q = explode("/",$request_label);
$type = explode("_", $q[0]);

$V = '1000';	//Set Voltage [V]
$C = '2000';	//Set Trip Current [mA]

//Selection of the requested action

switch ($q[0]) {
    //Turn on Single Channel - Voltage and Current configuration
    case 'ON_C0':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 0 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 0 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 0 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C1':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 1 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 1 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 1 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C2':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 2 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
	$result2 = shell_exec('./HVcontrol.out -s 0 -c 2 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 2 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C3':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 3 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
	$result2 = shell_exec('./HVcontrol.out -s 0 -c 3 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 3 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C4':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 4 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 4 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 4 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C5':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 5 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 5 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 5 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C6':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 6 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 6 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 6 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C7':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 7 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 7 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 7 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C8':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 8 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 8 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 8 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C9':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 9 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
	$result2 = shell_exec('./HVcontrol.out -s 0 -c 9 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
        $tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 9 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C10':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 10 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
	$result2 = shell_exec('./HVcontrol.out -s 0 -c 10 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 10 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C11':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 11 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 11 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 11 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;

    case 'ON_C12':
	$result3 = shell_exec('./HVcontrol.out -s 0 -c 12 -I ' . $C);
    	$out5 = explode("\n",$result3);
	$tamSS = sizeof($out5);
	for ($i=0; $i<=$tamSS; $i++){
	$out6[] = explode(" ",$out5[$i]);
	}
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 12 -v ' . $V . ' -o');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 12 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    //Turn Off Single Channel
    case 'OFF_C0':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 0 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 0 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C1':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 1 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 1 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C2':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 2 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 2 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C3':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 3 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 3 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C4':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 4 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 4 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C5':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 5 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 5 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C6':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 6 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 6 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C7':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 7 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 7 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C8':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 8 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 8 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C9':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 9 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 9 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C10':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 10 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 10 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C11':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 11 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 11 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	

    case 'OFF_C12':
        $result2 = shell_exec('./HVcontrol.out -s 0 -c 12 -t');
    	$out3 = explode("\n",$result2);
	$tamSS = sizeof($out3);
	for ($i=0; $i<=$tamSS; $i++){
	$out4[] = explode(" ",$out3[$i]);
	}
	$result4 = shell_exec('./HVmon.out -s 0 -c 12 ');
    	$out7 = explode("\n",$result4);
	$tamSS = sizeof($out7);
	for ($i=0; $i<=$tamSS; $i++){
	$out8[] = explode(" ",$out7[$i]);
	}
        break;	
}

switch ($type[0]) {
case 'ON':
	if (($type[1][0]=='C')&&(sizeof($out4[1][3]) != 0)&&(sizeof($out6[1][3]) != 0)&&($out8[1][2] == $out4[1][3])){
		echo $out8[1][2] . '/';
		echo $out8[3][2] . '/';
		echo " ";
	}
	elseif (($type[1][0]=='C')&&(sizeof($out4[1][3]) != 0)&&(sizeof($out6[1][3]) != 0)&&($out8[1][2] != $out4[1][3])){
		echo $out8[1][2] . '/';
		echo $out8[3][2] . '/';
		echo "VSet & VMon values do not match.";
	}
	else{
		echo "Err/";
		echo "Err/";
		echo "Fatal Error HV scripts not responding, please verify connection ";
		echo 'Action' . $q[0] . 'node' . $q[1];
	}	
        break;

case 'OFF':
	if (($type[1][0]=='C')&&($out8[1][2] < 1)){
		echo $out8[1][2] . '/';
		echo $out8[3][2] . '/';
		echo " ";
	}
	elseif (($type[1][0]=='A')&&($out8[1][2] < 1)){
		echo $out8[1][2] . '/';
		echo $out8[3][2] . '/';
		echo "Error HV scripts not responding ";
	}
	else{
		echo "Err/";
		echo "Err/";
		echo "Fatal Error HV scripts not responding, please verify connection ";
		echo 'Action' . $q[0] . 'node' . $q[1];
	}	
        break;

}
?> 
