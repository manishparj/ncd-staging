<?php
session_start();
error_reporting(0);
session_regenerate_id(true);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
	header("Location: index.php"); //
	}
	else{?>
<table border="1">
	<thead>
		<tr>
		<th>#</th>
																<th>Application ID.</th>
																<th>Date of ODKSubmission</th>
																<th>Date of sample taken</th>
																<th>District</th>
																<th>Block-Ud</th>
																<th>Block-Sr</th>
																<th>Block-Br</th>
																<th>Panchayat</th>
																<th>Village</th>
																<th>Name of Place</th>
																<th>Specify name </th>
																<th>Name of the Individual</th>
																<th>Tribe</th>
																<th>Specify other</th>
																<th>Clan name</th>
																<th>Age</th>
																<th>Gender</th>
																<th>Father’s Name	</th>
																<th>Mother’s Name</th>
																<th>Contact No</th>
																<th>ID Proof (Aadhar no.)</th>
																<th>Marital Status</th>
																<th>Education Status</th>
																<th>Have you ever heard about SCA?</th>
																<th>if yes</th>
																<th>Result of Solubility Test (Field)?</th>
																<th>If Positive – Sample collected for HPLC </th>
																<th>If Positive – get_locaton Latitude</th>
																<th>If Positive – get_locaton Longitude</th>
																<th>If Positive – get_locaton Altitude</th>
																<th>If Positive – get_locaton Accuracy</th>
																<th>Name of Interviewer</th>
		</tr>
	</thead>
<?php
$filename="SCA";
$sql =<<<EOF
			SELECT * from aggregate."SCA_CORE";
EOF;
	 $ret = pg_query($db, $sql);
	 if(!$ret) {
			echo pg_last_error($db);
			exit;
	 }
	 $i=0;
	 $cnt=1;
	 while($row = pg_fetch_row($ret)) {
		 $i++;
echo '
<tr>
<td>'.$cnt.'</td>
<td>'.$row[16].'</td>
<td>'.$row[8].'</td>
<td>'.$row[21].'</td>
<td>'.$row[25].'</td>
<td>'.$row[35].'</td>
<td>'.$row[30].'</td>
<td>'.$row[28].'</td>
<td>'.$row[34].'</td>
<td>'.$row[45].'</td>
<td>'.$row[31].'</td>
<td>'.$row[19].'</td>
<td>'.$row[32].'</td>
<td>'.$row[27].'</td>
<td>'.$row[23].'</td>
<td>'.$row[11].'</td>
<td>'.$row[38].'</td>
<td>'.$row[24].'</td>
<td>'.$row[33].'</td>
<td>'.$row[51].'</td>
<td>'.$row[15].'</td>
<td>'.$row[39].'</td>
<td>'.$row[12].'</td>
<td>'.$row[41].'</td>
<td>'.$row[29].'</td>
<td>'.$row[40].'</td>
<td>'.$row[37].'</td>
<td>'.$row[49].'</td>
<td>'.$row[20].'</td>
<td>'.$row[17].'</td>
<td>'.$row[14].'</td>
<td>'.$row[43].'</td>
<td>'.$row[46].'</td>
</tr>
';

header("Content-Encoding: UTF-8");
header("Content-type: tpplication/octet-stream; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$filename."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
$cnt++;
}
?>
</table>
<?php } ?>
