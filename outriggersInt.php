<!DOCTYPE html>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "180";
?>
<html>
<head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
function HVinst(chan,node,buttonId) {
    var InstConfirm = confirm('Change '+buttonId+' State?');
    if ((InstConfirm == false)) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
	var button=document.getElementById(buttonId);
	if (button.value=="0")
	{
	   var str='ON_C'+chan+'/'+node;
	}
	else if (button.value=="1")
	{
	   var str='OFF_C'+chan+'/'+node;
	}
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var PlainText = this.responseText;
		var ArrayData = PlainText.split("/");
		if(ArrayData[2].length > 35) {
			document.getElementById("channel"+chan).inenrHTML=ArrayData[0]+" V/ "+ArrayData[1]+" mA";
			document.getElementById("txtHint").innerHTML = ArrayData[2];
			if ((ArrayData[0]>1100)&&(ArrayData[0]<2300)&&(ArrayData[1]<750))
				{
				document.getElementById("channel"+chan).style.color = "#000000";
				}
			else 
				{
				document.getElementById("channel"+chan).style.color = "#FF0000";
				}
		}
		else
		{
			document.getElementById("channel"+chan).innerHTML=ArrayData[0]+" V/ "+ArrayData[1]+" mA";
			document.getElementById("txtHint").innerHTML = ArrayData[2];
			if ((ArrayData[0]>1100)&&(ArrayData[0]<2300)&&(ArrayData[1]<750))
				{
				document.getElementById("channel"+chan).style.color = "#000000";
				}
			else 
				{
				document.getElementById("channel"+chan).style.color = "#FF0000";
				}
			ChangeState(buttonId);
		}
            }
        };
        xmlhttp.open("GET", "ajax.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
        <div id="txtHint">

        </div>
	<div id="txtData">

	</div>
<h1 style="text-align:center">HAWC Outriggers Control</h1>
<div style="text-align:center; padding-bottom: 1cm">
<?php
echo "Last Update" . "<br>";
echo gmdate("d/m/Y") . " " . gmdate("H:i:s") . " " .  "UTC" . "<br>";	
date_default_timezone_set("America/Mexico");
echo date("d/m/Y") . " " . date("H:i:s") . " " . "MX" . "<br>";

chmod("/home/solidbit/public_html/HVmon.c", 0755);  //<<<<<Important!>>>>>   Change this path to the actual HVmon.c
chmod("/home/solidbit/public_html/HVcontrol.c", 0755); //<<<<<Important!>>>>>  Change this path to the actual HVcontrol.c

global $ValVolt1, $ValVolt2, $ValVolt3, $ValVolt4, $ValVolt5, $ValVolt6, $ValVolt7, $ValVolt8, $ValVolt9, $ValVolt10, $ValVolt11, $ValVolt12;
global $ValCurr1, $ValCurr2, $ValCurr3, $ValCurr4, $ValCurr5, $ValCurr6, $ValCurr7, $ValCurr8, $ValCurr9, $ValCurr10, $ValCurr11, $ValCurr12;
global $ValStat1, $ValStat2, $ValStat3, $ValStat4, $ValStat5, $ValStat6, $ValStat7, $ValStat8, $ValStat9, $ValStat10, $ValStat11, $ValStat12;

exec('cc HVmon.c -o HVmon.out -std=c99'); //<<<<<Important!>>>>>   Change this path to the actual HVmon output file
exec('cc HVcontrol.c -o HVcontrol.out -std=c99'); //<<<<<Important!>>>>>   Change this path to the actual HVcontrol output file

$result = shell_exec('./HVmon.out -s 1 -a');
$out = explode("\n",$result);
$tamS = sizeof($out);
for ($i=0; $i<=$tamS; $i++){
$out2[] = explode(" ",$out[$i]);
}

$ValStat1 = ($out2[0][2]=='OFF') ? 0:1;
$ValVolt1 = $out2[1][2];
$ValCurr1 = $out2[3][2];
$ValStat2 = ($out2[6][2]=='OFF') ? 0:1;
$ValVolt2 = $out2[7][2];
$ValCurr2 = $out2[9][2];
$ValStat3 = ($out2[12][2]=='OFF') ? 0:1;
$ValVolt3 = $out2[13][2];
$ValCurr3 = $out2[15][2];
$ValStat4 = ($out2[18][2]=='OFF') ? 0:1;
$ValVolt4 = $out2[19][2];
$ValCurr4 = $out2[21][2];
$ValStat5 = ($out2[24][2]=='OFF') ? 0:1;
$ValVolt5 = $out2[25][2];
$ValCurr5 = $out2[27][2];
$ValStat6 = ($out2[30][2]=='OFF') ? 0:1;
$ValVolt6 = $out2[31][2];
$ValCurr6 = $out2[33][2];
$ValStat7 = ($out2[36][2]=='OFF') ? 0:1;
$ValVolt7 = $out2[37][2];
$ValCurr7 = $out2[39][2];
$ValStat8 = ($out2[42][2]=='OFF') ? 0:1;
$ValVolt8 = $out2[43][2];
$ValCurr8 = $out2[45][2];
$ValStat9 = ($out2[48][2]=='OFF') ? 0:1;
$ValVolt9 = $out2[49][2];
$ValCurr9 = $out2[51][2];
$ValStat10 = ($out2[54][2]=='OFF') ? 0:1;
$ValVolt10 = $out2[55][2];
$ValCurr10 = $out2[57][2];
$ValStat11 = ($out2[60][2]=='OFF') ? 0:1;
$ValVolt11 = $out2[61][2];
$ValCurr11 = $out2[63][2];
$ValStat12 = ($out2[66][2]=='OFF') ? 0:1;
$ValVolt12 = $out2[67][2];
$ValCurr12 = $out2[69][2];

global $colorV;
$colorV="color: #00A000";
global $colorR;
$colorR="color: #FF0000";
?>
</div>

<table style="width:100%">
  <tr>
    <th></th>
    <th></th>
    	<th>Node A</th>
	<th>Node B</th>
	<th>Node C</th>
	<th>Node D</th>
	<th>Node E</th>
  </tr>
  <tr>
    <td>Temperature</td>
    <td>EMS</td>
    <td><?php 
	$ValTemp1=rand(8,35);	
	if (($ValTemp1>10)&&($ValTemp1<32)){
		echo $ValTemp1 . " C";
	}
	else {
		echo "<span style='color: red'> {$ValTemp1}  C </span>";
	}
	?></td>
	<td><?php 
	$ValTemp2=rand(8,35);	
	if (($ValTemp2>10)&&($ValTemp2<32)){
		echo $ValTemp2 . " C";
	}
	else {
		echo "<span style='color: red'> {$ValTemp2}  C </span>";
	}
	?></td>
	<td><?php 
	$ValTemp3=rand(8,35);	
	if (($ValTemp3>10)&&($ValTemp3<32)){
		echo $ValTemp3 . " C";
	}
	else {
		echo "<span style='color: red'> {$ValTemp3}  C </span>";
	}
	?></td>
	<td><?php 
	$ValTemp4=rand(8,35);	
	if (($ValTemp4>10)&&($ValTemp4<32)){
		echo $ValTemp4 . " C";
	}
	else {
		echo "<span style='color: red'> {$ValTemp4}  C </span>";
	}
	?></td>
	<td><?php 
	$ValTemp5=rand(8,35);	
	if (($ValTemp5>10)&&($ValTemp5<32)){
		echo $ValTemp5 . " C";
	}
	else {
		echo "<span style='color: red'> {$ValTemp5}  C </span>";
	}
	?></td>
  </tr>
  <tr>
    <td> </td>
    <td> </td>
    <td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
	<td> </td>
  </tr>
  <tr>
    <th>PDU</th>
  </tr>
  <tr>
	<td>channel #1</td>
	<td>FADC</td>
	<td> <button type="button" onclick="ChangeState('ButtonFADC1'); alert('Event FADC1')" id="ButtonFADC1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonFADC2'); alert('Event FADC2')" id="ButtonFADC2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonFADC3'); alert('Event FADC3')" id="ButtonFADC3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonFADC4'); alert('Event FADC4')" id="ButtonFADC4"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonFADC5'); alert('Event FADC5')" id="ButtonFADC5"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #2</td>
	<td>HV</td>
	<td> <button type="button" onclick="ChangeState('ButtonHV1'); alert('Event HV1')" id="ButtonHV1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonHV2'); alert('Event HV2')" id="ButtonHV2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonHV3'); alert('Event HV3')" id="ButtonHV3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonHV4'); alert('Event HV4')" id="ButtonHV4"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonHV5'); alert('Event HV5')" id="ButtonHV5"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #3</td>
	<td>WR</td>
	<td> <button type="button" onclick="ChangeState('ButtonWR1'); alert('Event WR1')" id="ButtonWR1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonWR2'); alert('Event WR2')" id="ButtonWR2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonWR3'); alert('Event WR3')" id="ButtonWR3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonWR4'); alert('Event WR4')" id="ButtonWR4"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonWR5'); alert('Event WR5')" id="ButtonWR5"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #4</td>
	<td>Network 1</td>
	<td> <button type="button" onclick="ChangeState('ButtonNet1_1'); alert('Event Net1_1')" id="ButtonNet1_1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet1_2'); alert('Event Net1_2')" id="ButtonNet1_2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet1_3'); alert('Event Net1_3')" id="ButtonNet1_3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet1_4'); alert('Event Net1_4')" id="ButtonNet1_4"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet1_5'); alert('Event Net1_5')" id="ButtonNet1_5"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #5</td>
	<td>Network 2</td>
	<td> <button type="button" onclick="ChangeState('ButtonNet2_1'); alert('Event Net2_1')" id="ButtonNet2_1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet2_2'); alert('Event Net2_2')" id="ButtonNet2_2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet2_3'); alert('Event Net2_3')" id="ButtonNet2_3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet2_4'); alert('Event Net2_4')" id="ButtonNet2_4"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonNet2_5'); alert('Event Net2_5')" id="ButtonNet2_5"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #6</td>
	<td>X</td>
<!--	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td> -->
  </tr>
    <tr>
	<td>channel #7</td>
	<td>X</td>
<!--	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td> -->
  </tr>
  <tr>
	<td>channel #8</td>
	<td>X</td>
<!--	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="alert('Hello world!')" id="ButtonNX"style="color: #00A000"  value="1">ON</button> </td> -->
  </tr>
    <tr>
    <th>HV</th>
	<th>Voltage/Current</th>
  </tr>
  <tr>
	<td>channel #0</td>
	<td> <div id="channel0"><?php
	if (($ValVolt1>1100)&&($ValVolt1<2300)&&($ValCurr1<750)){
		echo $ValVolt1 . " V/ " . $ValCurr1 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt1} V/ {$ValCurr1} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('0','0','ButtonCh0N0')" id="ButtonCh0N0" style="<?php if($ValStat1==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat1==1) echo $ValStat1; else echo $ValStat1; ?>"><?php if($ValStat1==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh0N1'); alert('Event Ch1N2')" id="ButtonCh0N1" style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh0N2'); alert('Event Ch1N3')" id="ButtonCh0N2" style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh0N3'); alert('Event Ch1N4')" id="ButtonCh0N3" style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh0N4'); alert('Event Ch1N5')" id="ButtonCh0N4" style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #1</td>
	<td> <div id="channel1"><?php
	if (($ValVolt2>1100)&&($ValVolt2<2300)&&($ValCurr2<750)){
		echo $ValVolt2 . " V/ " . $ValCurr2 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt2} V/ {$ValCurr2} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('1','0','ButtonCh1N0')" id="ButtonCh1N0" style="<?php if($ValStat2==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat2==1) echo $ValStat2; else echo $ValStat2; ?>"><?php if($ValStat2==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh1N1'); alert('Event Ch2N2')" id="ButtonCh1N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh1N2'); alert('Event Ch2N3')" id="ButtonCh1N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh1N3'); alert('Event Ch2N4')" id="ButtonCh1N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh1N4'); alert('Event Ch2N5')" id="ButtonCh1N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #2</td>
	<td> <div id="channel2"> <?php
	if (($ValVolt3>1100)&&($ValVolt3<2300)&&($ValCurr3<750)){
		echo $ValVolt3 . " V/ " . $ValCurr3 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt3} V/ {$ValCurr3} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('2','0','ButtonCh2N0')" id="ButtonCh2N0" style="<?php if($ValStat3==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat3==1) echo $ValStat3; else echo $ValStat3; ?>"><?php if($ValStat3==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh2N1'); alert('Event Ch3N2')" id="ButtonCh2N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh2N2'); alert('Event Ch3N3')" id="ButtonCh2N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh2N3'); alert('Event Ch3N4')" id="ButtonCh2N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh2N4'); alert('Event Ch3N5')" id="ButtonCh2N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #3</td>
	<td> <div id="channel3"> <?php
	if (($ValVolt4>1100)&&($ValVolt4<2300)&&($ValCurr4<750)){
		echo $ValVolt4 . " V/ " . $ValCurr4 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt4} V/ {$ValCurr4} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('3','0','ButtonCh3N0')" id="ButtonCh3N0" style="<?php if($ValStat4==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat4==1) echo $ValStat4; else echo $ValStat4; ?>"><?php if($ValStat4==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh3N1'); alert('Event Ch4N2')" id="ButtonCh3N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh3N2'); alert('Event Ch4N3')" id="ButtonCh3N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh3N3'); alert('Event Ch4N4')" id="ButtonCh3N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh3N4'); alert('Event Ch4N5')" id="ButtonCh3N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #4</td>
	<td> <div id="channel4"> <?php
	if (($ValVolt5>1100)&&($ValVolt5<2300)&&($ValCurr5<750)){
		echo $ValVolt5 . " V/ " . $ValCurr5 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt5} V/ {$ValCurr5} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('4','0','ButtonCh4N0')" id="ButtonCh4N0" style="<?php if($ValStat5==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat5==1) echo $ValStat5; else echo $ValStat5; ?>"><?php if($ValStat5==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh4N1'); alert('Event Ch5N2')" id="ButtonCh4N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh4N2'); alert('Event Ch5N3')" id="ButtonCh4N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh4N3'); alert('Event Ch5N4')" id="ButtonCh4N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh4N4'); alert('Event Ch5N5')" id="ButtonCh4N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #5</td>
	<td> <div id="channel5"> <?php
	if (($ValVolt6>1100)&&($ValVolt6<2300)&&($ValCurr6<750)){
		echo $ValVolt6 . " V/ " . $ValCurr6 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt6} V/ {$ValCurr6} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('5','0','ButtonCh5N0')" id="ButtonCh5N0" style="<?php if($ValStat6==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat6==1) echo $ValStat6; else echo $ValStat6; ?>"><?php if($ValStat6==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh5N1'); alert('Event Ch6N2')" id="ButtonCh5N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh5N2'); alert('Event Ch6N3')" id="ButtonCh5N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh5N3'); alert('Event Ch6N4')" id="ButtonCh5N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh5N4'); alert('Event Ch6N5')" id="ButtonCh5N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
    <tr>
	<td>channel #6</td>
	<td> <div id="channel6"> <?php
	if (($ValVolt7>1100)&&($ValVolt7<2300)&&($ValCurr7<750)){
		echo $ValVolt7 . " V/ " . $ValCurr7 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt7} V/ {$ValCurr7} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('6','0','ButtonCh6N0')" id="ButtonCh6N0" style="<?php if($ValStat7==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat7==1) echo $ValStat7; else echo $ValStat7; ?>"><?php if($ValStat7==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh6N1'); alert('Event Ch7N2')" id="ButtonCh6N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh6N2'); alert('Event Ch7N3')" id="ButtonCh6N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh6N3'); alert('Event Ch7N4')" id="ButtonCh6N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh6N4'); alert('Event Ch7N5')" id="ButtonCh6N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
  <tr>
	<td>channel #7</td>
	<td> <div id="channel7"> <?php
	if (($ValVolt8>1100)&&($ValVolt8<2300)&&($ValCurr8<750)){
		echo $ValVolt8 . " V/ " . $ValCurr8 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt8} V/ {$ValCurr8} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('7','0','ButtonCh7N0')" id="ButtonCh7N0" style="<?php if($ValStat8==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat8==1) echo $ValStat8; else echo $ValStat8; ?>"><?php if($ValStat8==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh7N1'); alert('Event Ch8N2')" id="ButtonCh7N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh7N2'); alert('Event Ch8N3')" id="ButtonCh7N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh7N3'); alert('Event Ch8N4')" id="ButtonCh7N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh7N4'); alert('Event Ch8N5')" id="ButtonCh7N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
  <tr>
	<td>channel #8</td>
	<td> <div id="channel8"> <?php
	if (($ValVolt9>1100)&&($ValVolt9<2300)&&($ValCurr9<750)){
		echo $ValVolt9 . " V/ " . $ValCurr9 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt9} V/ {$ValCurr9} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('8','0','ButtonCh8N0')" id="ButtonCh8N0" style="<?php if($ValStat9==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat9==1) echo $ValStat9; else echo $ValStat9; ?>"><?php if($ValStat9==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh8N1'); alert('Event Ch9N2')" id="ButtonCh8N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh8N2'); alert('Event Ch9N3')" id="ButtonCh8N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh8N3'); alert('Event Ch9N4')" id="ButtonCh8N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh8N4'); alert('Event Ch9N5')" id="ButtonCh8N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
  <tr>
	<td>channel #9</td>
	<td> <div id="channel9"> <?php
	if (($ValVolt10>1100)&&($ValVolt10<2300)&&($ValCurr10<750)){
		echo $ValVolt10 . " V/ " . $ValCurr10 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt10} V/ {$ValCurr10} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('9','0','ButtonCh9N0')" id="ButtonCh9N0" style="<?php if($ValStat10==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat10==1) echo $ValStat10; else echo $ValStat10; ?>"><?php if($ValStat10==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh9N1'); alert('Event Ch10N2')" id="ButtonCh9N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh9N2'); alert('Event Ch10N3')" id="ButtonCh9N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh9N3'); alert('Event Ch10N4')" id="ButtonCh9N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh9N4'); alert('Event Ch10N5')" id="ButtonCh9N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
  <tr>
	<td>channel #10</td>
	<td> <div id="channel10"> <?php
	if (($ValVolt11>1100)&&($ValVolt11<2300)&&($ValCurr11<750)){
		echo $ValVolt11 . " V/ " . $ValCurr11 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt11} V/ {$ValCurr11} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('10','0','ButtonCh10N0')" id="ButtonCh10N0" style="<?php if($ValStat11==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat11==1) echo $ValStat11; else echo $ValStat11; ?>"><?php if($ValStat11==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh10N1'); alert('Event Ch11N2')" id="ButtonCh10N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh10N2'); alert('Event Ch11N3')" id="ButtonCh10N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh10N3'); alert('Event Ch11N4')" id="ButtonCh10N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh10N4'); alert('Event Ch11N5')" id="ButtonCh10N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
  <tr>
	<td>channel #11</td>
	<td> <div id="channel11"> <?php
	if (($ValVolt12>1100)&&($ValVolt12<2300)&&($ValCurr12<750)){
		echo $ValVolt12 . " V/ " . $ValCurr12 . " mA";
	}
	else {
		echo "<span style='color: red'> {$ValVolt12} V/ {$ValCurr12} mA</span>";
	}
	?> </div> </td>
	<td> <button type="button" onclick="HVinst('11','0','ButtonCh11N0')" id="ButtonCh11N0" style="<?php if($ValStat12==1) echo $colorV; else  echo $colorR; ?>" value="<?php if($ValStat12==1) echo $ValStat12; else echo $ValStat12; ?>"><?php if($ValStat12==1) echo ON; else echo OFF; ?></button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh11N1'); alert('Event Ch12N2')" id="ButtonCh11N1"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh11N2'); alert('Event Ch12N3')" id="ButtonCh11N2"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh11N3'); alert('Event Ch12N4')" id="ButtonCh11N3"style="color: #00A000"  value="1">ON</button> </td>
	<td> <button type="button" onclick="ChangeState('ButtonCh11N4'); alert('Event Ch12N5')" id="ButtonCh11N4"style="color: #00A000"  value="1">ON</button> </td>
  </tr>
</table>
	<p>Version 1.05</p>
</body>

<script LANGUAGE="JavaScript">

function ChangeState(buttonId)	
{
	var CurrentVal=document.getElementById(buttonId);
	if (CurrentVal.value=="1")
	{
	document.getElementById(buttonId).value = "0"; 
	replaceButtonText(buttonId, 'OFF');
    document.getElementById(buttonId).style.color = "#FF0000";
	}
	else
	{
	document.getElementById(buttonId).value = "1";
	replaceButtonText(buttonId, 'ON');
    document.getElementById(buttonId).style.color = "#00A000";
	}
}
	
function replaceButtonText(buttonId, text)
{
  if (document.getElementById)
  {
    var button=document.getElementById(buttonId);
    if (button)
    {
      if (button.childNodes[0])
      {
        button.childNodes[0].nodeValue=text;
      }
      else if (button.value)
      {
        button.value=text;
      }
      else //if (button.innerHTML)
      {
        button.innerHTML=text;
      }
    }
  }
}
</script>
<?php
//exec('cc HVmon.c -o HVmon.out -std=c99 2>&1', $output);
//print_r($output);
?>
</html>
