<?php
error_reporting(0);
include("session.php");
include("include/database.php");

if(isset($_REQUEST['year']))
{
	$year=$_POST['year'];
	$month=$_POST['date_month'];
	$code=$_POST['emp_code'];				
}	
	$up_qry="select * from emp_sal where es_code='$code' and year='$year' and month='$month'";
	$up_res=mysql_query($up_qry);
	if(!$up_qry)
	{
		echo "Record not found...";
		exit();	
	}
		$cnt=mysql_num_rows($up_res);
		if($cnt==0)
		{
			echo "<h2 style='color:red;'> <center> Please first insert salary Record for this employee</h2>";
			}
	$row_up=mysql_fetch_array($up_res);
	
	 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rajesh Electric Works</title>

<style type="text/css">
.maintbl
{
	width:650px;
	height:180px;
	margin:1px auto;
	margin-top:10px;
	border-collapse:collapse;
}
.form
{
	font-size:12px;
	color:#000;
	margin-left:100px;
	margin-top:1px;
	height:20px;
}
.earning{
	width:650px;
	border-collapse:collapse;
	margin:1px auto;
}

</style>
</head>

<body>
        <h3 align="center">Rajesh Eectric Works</h3>
        <table class="maintbl" border="1">
          <tr><td colspan="4" align="center"><b>PAYSLIP FOR THE MONTH OF <?php   echo date ("F", mktime(0,0,0,$month,1,0)); echo ' '.$year;
 ?></b></td></tr>
      
         <tr>
        <td class="form"><b>Employee ID:</b></td>
		<td><?php echo $row_up[1]; ?></td>
        <td class="form"><b>Emp Name:</b></td>
        <td><?php echo $row_up[2]; ?></td>
        </tr>
       
        <tr>
        <td  class="form"><b>Address:</b></td>
        <td><?php echo $row_up[3]; ?></td>
         <td class="form"><b>Contact Details:</b></td>
        <td><?php echo $row_up[4]; ?></td>
        </tr>
       
        <tr>
        <td class="form"><b>Designation:</b></td>
        <td><?php echo $row_up[6]; ?></td>
        <td class="form"><b>Date of Joining:</b></td>
        <td><?php echo $row_up[5]; ?></td>
        </tr>
        
        <tr>
        <td class="form"><b>Bank Name:</b></td>
        <td><?php echo $row_up[8]; ?></td>
         <td class="form"><b>Bank Account No:</b></td>
        <td><?php echo $row_up[7]; ?></td>
        </tr>
        
        <tr>
        <td class="form"><b>PAN No:</b></td>
        <td><?php echo $row_up[9]; ?></td>
         <td class="form"><b>No of Days:</b></td>
        <td><?php echo $row_up[10]; ?></td>
        </tr>
        
        <tr>
        <td class="form"><b>No of Days Present:</b></td>
        <td><?php echo $row_up[11]?></td>
        
        <td class="form"><b>No of Days Paid:</b></td>
        <td><?php echo $row_up[12]?></td>
        </tr>
   
        </table>
       <br><br><br>
        <table class="earning" border="1" >
        	
           <tr><td colspan="3" align="center"><b>EARNINGS</b> </td>      
                <td colspan="2" align="center"><b>DEDUCTIONS</b></td>
           </tr>
            <tr>
            	<td class="form"><b>Sr.No</b></td>      
                <td class="form"><b>Description</b> </td>      
                <td class="form"><b>Amount</b></td>
                <td class="form"><b>Description</b></td>
                <td class="form"><b>Amount</b></td>
                
                </tr>
                <?php
				$count=0;
                $query="select * from sub_salary where sal_code='$row_up[0]'";
				$res=mysql_query($query);
				while($sal=mysql_fetch_array($res))
				{
					$count+=1;
				?>
                <tr>
                <td ><?php echo $count; ?></td>
                
                <td><?php echo $sal[2]; ?> </td>      
                <td><?php echo $sal[3]; ?></td>
                <td ><?php echo $sal[4]; ?></td>
                <td><?php echo $sal[5]; ?></td>
                
                </tr>
          <?php
				}
				
		  ?>
          		<tr>
                         
                <td colspan="2">GROSS EARNINGS</td>
                <td><?php echo $row_up[15];?></td>
                <td>GROSS DEDUCTIONS</td>
                <td><?php echo $row_up[16];?></td>                
                </tr>
                <tr>
                
                <td colspan="2">NET PAY</td>
                <td><?php echo $row_up[17];?></td>
                <td colspan="2"></td>
                </tr>
                
        </table>
        
     
               
        <br><br>
 
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
  $dompdf->stream($filename, array("Attachment" => false));	
  exit(0);
?>