<?php
include("include/database.php");
error_reporting(0);
include("session.php");

$p=$_REQUEST['id'];
$qry="select * from quotation where q_id='$p'";
$res=mysql_query($qry);
$row=mysql_fetch_array($res);

$qry_detail="select * from sub_quotation where q_id='$p'";
$res_detail=mysql_query($qry_detail);

$qry_t="select SUM(Amount) from sub_quotation where q_id='$p' and less='0'";
$res_t=mysql_query($qry_t);
$row_t=mysql_fetch_array($res_t);
?>
<?php
$term="select * from terms";
$term_res=mysql_query($term);

$service="select * from service_tax";
$ser_res=mysql_query($service);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rajesh Electric Works</title>

<style type="text/css">
.heading{
	font-size:32px;
	font-family:"MS Serif", "New York", serif;
	text-align:right;
}
.sub_heading
{
	font-size:18px;
	font-family:"MS Serif", "New York", serif;
	text-align:right;
}
.quotation
{
	font-size:24px;
	font-weight:bold;
	text-decoration:underline;
}
.date
{	
	margin-left:80%;
}
.description ul
{
	border:1px solid #000; 
}
.description ul li
{	
	list-style:none;
	display:inline;
	padding:20px;
}
.report
{
	width:720px;
	margin-top:15px;
}
.report td{
		border:1px solid #000;
		text-align:center;
		height:25px;
}
.total{
	width:720px;
}
.total td{
}
.tow{
	margin-top:-80px;
	padding-top:-37px;
}
.da{
	margin-left:550px;
}
.linedata{
	font-size:15px;
}
.left{
  float: left;
}

.right{
  float:right;
}
.right1{
	margin-left:600px;
	margin-top:-20px;
}
.terms{
	font-size:10px;
	font-family:Calibri ;
}
.guaranty{
	font-size:10px;
	font-family:Calibri;
	margin-left:5px;
}
.guaranty li{
	margin-top:-10px;
	margin-left:-25px;
	text-decoration:underline;
}
.sign{
	font-size:10px;
	font-family:Calibri;
	margin-left:5px;
	font-style:italic;

}
</style>


</head>

<body>
<br>
<br>
<font face="Calibri" size="12px;">
<div class="heading" >M/s. Rajesh Electric Works</center></div>
<div class="sub_heading"><b>Office:</b>Opp.Satpur Bus Stand, Trimbak Road,Satpur,Nashik - 7. Ph. 2353366 </div>
<div class="sub_heading"><b>Works:</b>Plot No. C/42, M.I.D.C. Industrial Estate, Malegaon, Tal. Sinnar, Dist. Nashik-422113.</div>
<div class="sub_heading"><b>Ph. :</b>02551-230829 <b>E-mail :</b> rew.nsk@rediffmail.com</div>
<hr noshade>
<div class="linedata"><b>Specialist in Rewinding of :</b> Ac Servo Motors, DC Servo Motors, High Frequency Spindle Motors,Transformers, </div>
<div class="linedata">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 Welding Generators, Welding Machine, Power Generators & Alternators, All types of Industrial coils etc.</div>
<hr noshade size="1px"> 
<div class="left1"><B>Our Ref No:-</B><?php echo $row[2]; ?>
 <div class="right1"><b> Date:-<?php echo date('d-m-Y',strtotime($row[3])); ?></b></div> </div>
<br><br>

<div class="quotation"><center>REPAIRING QUOTATION</center></div>
<div class="to">
<div class="da">
<br>
Vendor No:<label><?php echo $row[9]; ?></label>
</div>
<div class="tow">
<b>To
<br>
<textarea>Mr./Mrs.&nbsp;&nbsp;<?php echo $row[4]; ?></textarea>
<br>
 <label><?php echo $row[5]; ?></label></b>
<br>
						Contact No :- <label><?php echo $row[7]; ?></label>
<br>
						TeleFax :-
 <label><?php echo $row[11]; ?></label>
<br>
						E-Mail :-
 <label><?php echo $row[8]; ?></label>
 <br>
 <br>
<b>Sub:-</b> <label><?php echo $row[10]; ?></label>
<br>
Dear Sir,
<br>

<p  >      We are pleased in quoting our most competitive prices for Rewinding & Repairing of <?php ?> as given below details against to esteemed requirment. Kindly consider our prices as worth to the quality and favour us with your valuable order.</p>
</div>
</div>
<div class="description">
<table class="report">
<tr>
<td>SR</td>
<td width="400px;" height="10px;">Description</td>
<td>Rate/Each</td>
<td>Qty/Nos</td>
<td>Amount</td>
</tr>
<?php
$count=0;
while($row_d=mysql_fetch_array($res_detail))
{$count+=1;
	if($row_d['2']==0)
	{
	echo "<tr>";
	echo "<td>";
	echo $count;
	echo "</td>";
	echo "<td>";
	echo $row_d[3];
	echo "</td>";
	echo "<td>";
	echo $row_d[4];
	echo "</td>";
	echo "<td>";
	echo $row_d[5];
	echo "</td>";
	echo "<td>";
	echo $row_d[6];
	echo "</td>";
	
	echo "</tr>";
	}	 
}
$qry_detail="select * from sub_quotation where q_id='$p'";
$res_detail=mysql_query($qry_detail); 
$less_res=mysql_fetch_array($res_detail);
if($less_res['less']=='0')
{
?>
<!-- Appy this Condition when less amount is not included   -->
    <tr>
<td colspan="4" height="10px;" style="text-align:right;font-weight:800;">SUB TOTAL:</td>
<td style="text-align:right;"><?php echo $row_t[0]; ?></td>
</tr>
 <?php
}elseif($less_res['less']=='1')
 {
	 echo"<tr><td colspan='4'></td><td style='font-weight:800;'> Total Rs</td><td>$row_t[0]</td>";
	  echo "<tr>";
	echo "<td colspan='2'>";
	echo $less_res[3];
	echo "</td>";
	echo "<td>";
	echo $less_res[4];
	echo "</td>";
	echo "<td>";
	echo $less_res[5];
	echo "</td>";
	echo "<td style='text-align:right; align=right;'>";
	echo $less_res[6];
	echo "</td>";
	
	echo "</tr>";		
       
 ?>
<!-- Appy this Condition when less amount is apply    -->
<tr>
<td colspan="4" height="10px;" style="text-align:right; font-weight:800;">SUB TOTAL:</td>
<td style="text-align:right;"><?php  $les= $row_t[0]-$less_res['Amount']; $ans=round($les,2); echo $ans; ?></td>
</tr>
<?php
 }
?>
<!-- Check Service Tax which is apply to the quotation -->
<?php
if($row['q_tax']=='1')
{
?>

<tr>
<?php
$qry_detail="select * from sub_quotation where q_id='$p'";
$res_detail=mysql_query($qry_detail); 
$less_res=mysql_fetch_array($res_detail);

if($less_res['less']=='0')
{
 $plus=$row_t[0];
 $per70=round (($plus* 0.7)/2);
$serv_tax=$per70 *.12;
$e_cess=$serv_tax *0.02;
$she_cess=$serv_tax * 0.01;
$vat=$plus * .05;
$g_total=$row_t[0]+$serv_tax+$e_cess+$she_cess+$vat+$row[12];
}
elseif($less_res['less']=='1')
{
$plus=$ans;
$per70=round (($plus* 0.7)/2);
$serv_tax=$per70 *.12;
$e_cess=$serv_tax *0.02;
$she_cess=$serv_tax * 0.01;
$vat=$plus * .05;
$g_total=$row_t[0]+$serv_tax+$e_cess+$she_cess+$vat+$row[12];
	
}
?>
<td colspan='2' rowspan="5" height="10px;" style="text-align:left; vertical-align:text-top;">
<font size="-1">
<b><u>SERVICE TAX @ 12% ON LABOUR CHARGES ONLY<br> (A)</u>Value of the <u>LABOUR</u> is <u>70%</u> of <u>SUB TOTAL</u> i.e. <u>Rs. <?php echo round ($plus* 0.7,00).'.00';?></u> / <u>50% </u>=<u><?php echo $per70.'.00';?></u><br>
<font size="-2"><u>{PAYABLE 50% BY SERVICE PROVIDER & 50% BY SERVICE UNDER REVERSE CHARGE MECHANISE}</u></font></b><BR>
<u>(B) VAT </u>@<u> 5%</u> of the <u>SUB TOTAL</u> i.e. <u>Rs. <?php echo $plus; ?></u></font>
</td>
<td colspan="2" style="text-align:right;">Services Tax 12% on <?php echo $per70.'/-';?></td>
<td><?php echo $serv_tax; ?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">E.Cess @2%</td>
<td><?php echo $e_cess;?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">She.Cess @1%</td>
<td><?php echo $she_cess;?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">VAT 05% on <?php $plus.'./-'; ?> </td>
<td><?php echo $vat;?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">Transportation Charges</td>
<td><?php echo $row[12]; ?></td>
</tr>
<tr>
<td colspan="4" style="text-align:right; font-weight:800; "> GRAND TOTAL:-</td>
<td><?php echo round($g_total,2) ;?></td>
<?php
}
			/* apply this code if service tax is 33%*/
elseif($row['q_tax']=='2')
{
?>
<tr>
<?php
$qry_detail="select * from sub_quotation where q_id='$p'";
$res_detail=mysql_query($qry_detail); 
$less_res=mysql_fetch_array($res_detail);

if($less_res['less']=='0')
{
 $plus=$row_t[0];
$per33=round ($plus* 0.33);
$serv_tax=$per33 *.12;
$e_cess=$serv_tax *0.02;
$she_cess=$serv_tax * 0.01;
$vat=($plus * .67 ) * .05;
$g_total=$row_t[0]+$serv_tax+$e_cess+$she_cess+$vat+$row[12];
}
elseif($less_res['less']=='1')
{
$plus=$ans;
$per33=round($plus* 0.33);
$serv_tax=$per33 *.12;
$e_cess=$serv_tax *0.02;
$she_cess=$serv_tax * 0.01;
$vat=($plus * .67 ) * .05;
$g_total=$row_t[0]+$serv_tax+$e_cess+$she_cess+$vat+$row[12];
}
?>
<td colspan='2' rowspan="5" height="10px;" style="text-align:left; vertical-align:text-top;">
<font size="-1">
<b>
<u>SERVICE TAX @ 12% ON LABOUR CHARGES ONLY<br> (A)</u></b>
Value of the <u>LABOUR</u> is <u>33%</u>
 of the<u>SUB TOTAL</u> 
 i.e. <u>Rs. <?php echo round ($plus * 0.33,00).'.00';?></u> <br>
<u>(B) VAT </u>@<u> 5%</u>on<u><b>(R/M)</b></u>Which is <u><b>67%</b></u>of the <u><b>SUB TOTAL</b></u> i.e. <u>Rs. <?php echo $plus * .67; ?></u>
</font>
</td>
<td colspan="2" style="text-align:right;">Services Tax 12% on <?php echo $per33.'/-';?></td>
<td><?php echo $serv_tax; ?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">E.Cess @2%</td>
<td><?php echo $e_cess;?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">She.Cess @1%</td>
<td><?php echo $she_cess;?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">VAT 05% on <?php $plus.'./-'; ?> </td>
<td><?php echo $vat;?></td>
</tr>
<tr>
<td colspan="2" style="text-align:right;">Transportation Charges</td>
<td><?php echo $row[12]; ?></td>
</tr>
<tr>
<td colspan="4" style="text-align:right; font-weight:800; "> GRAND TOTAL:-</td>
<td><?php echo round($g_total,2) ;?></td>

<?php
}
else
{
?>
<td colspan="4" style="font-size:24px;">No any service tax selected
</td>
<?php
}
?>
</tr>
</table>
<br><br><br>
<div> <b>Analysis Of Failure :- </b><?php echo $row[15] ?>
</div>

<div style="page-break-after:always;"></div>
<div class="terms">
<u>*</u> &nbsp;&nbsp;&nbsp;&nbsp;<u><b>Terms & Conditions</b></u>
<?php
while($row=mysql_fetch_array($term_res))
{
	echo "<br>";
	echo "<b>$row[1]</b>";
	echo "}      ";
	echo "<u>$row[2]</u>";
	
}
?>
</div>
<br><br><br>
<div class="terms">
<u>*</u> &nbsp;&nbsp;&nbsp;&nbsp;<u><b>SERVICE TAX DETAILS</b></u>
<?php
while($row=mysql_fetch_array($ser_res))
{
	echo "<br>";
	echo "<b>$row[1]</b>";
	echo "}      ";
	echo "<u>$row[2]</u>";	
}
?>
</div>
<br><br><br><br><br>
<div class="guaranty">
	<u>*</u> &nbsp;&nbsp;&nbsp;&nbsp;<u><b>Guaranty not valid for Un-Propper use of motor Eg..</b></u>
    <ol>
    <li>Water/Oil/Metal Burs going inside the winding.</li>
    <li>Shaft/Bearing/Cover/found Crack,lock,bend or damage.</li>
    <li>Single or two volt phasing supply.</li>
    <li>Overload Works.</li>
    <li>Unequal rotor and stator line and rotor bus bar open.</li>
    <li>Any reason motor found jam.</li>
    </ol>
</div>
<br><br><br><br>
<div class="terms">
	<u><b>Note:-</b></u> &nbsp;&nbsp;&nbsp;&nbsp;<u>This is a Computer Generated Document and Hence Does Not Require Any Signature.</u>
</div>

<br><br>
</div>
</font>

</body>
</html>

<?php
$htmlcontent=ob_get_clean();

include("dompdf/dompdf_config.inc.php");


  $htmlcontent = stripslashes($htmlcontent);
  $dompdf = new DOMPDF();
  $dompdf->load_html($htmlcontent);
  $dompdf->set_paper("folio", "portrait");
  $dompdf->render();
  $canvas = $dompdf->get_canvas();
  $font = Font_Metrics::get_font("", "bold");
  $canvas->page_text(50,850, "RAJESH ELECTRIC WORKS", $font, 7, array(0,0,0));
  $canvas->page_text(500,850, "PAGE: {PAGE_NUM} OF {PAGE_COUNT}", $font, 8, array(0,0,0));

  $dompdf->stream($filename, array("Attachment" => false));	
  exit(0);
?>