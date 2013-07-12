<?php
include("include/database.php");
$per_page = 20; 
$sql = "select * from invoice";
$rsd = mysql_query($sql);
$count = mysql_num_rows($rsd);
$pages = ceil($count/$per_page)
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rajesh Electic Works</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>

	<script type="text/javascript">
	
	$(document).ready(function(){
		
	//Display Loading Image
	function Display_Load()
	{
	    $("#loading").fadeIn(900,0);
	
	}
	//Hide Loading Image
	function Hide_Load()
	{
		$("#loading").fadeOut('slow');
	};
	

    //Default Starting Page Results
   
	$("#pagination li:first").css({'color' : '#FF0084'}).css({'border' : 'none'});
	
	Display_Load();
	
	$("#content").load("invoicepagination.php?page=1", Hide_Load());



	//Pagination Click
	$("#pagination li").click(function(){
			
		Display_Load();
		
		//CSS Styles
		$("#pagination li")
		.css({'color' : '#0063DC'});
		
		$(this)
		.css({'color' : '#FF0084'})
		.css({'border' : 'none'});

		//Loading Data
		var pageNum = this.id;
		
		$("#content").load("invoicepagination.php?page=" + pageNum, Hide_Load());
	});
	
	
});
	</script>
	
<style>
a
{
text-decoration:none;
color:#B2b2b2;

}

a:hover
{

color:#DF3D82;
text-decoration:underline;

}
#loading { 
width: 100%; 
position: absolute;
}

#pagination
{
text-align:center;
color:#6F0;
margin-left:10px;
margin-top:0px;
}
#pagination li {	
list-style: none; 
float: left; 
margin-right: 16px; 
padding:5px;3 
color:#FFF;
margin-left:-10px;
background-color:#00a1d2;

}
#pagination li:hover
{ 
color:#FF0084; 
cursor: pointer; 

}


</style>


</head>

<body>
<div id="container">
	
    <?php
	include("header.php");
	?>
    
    <div id="sub-header">
    			
                <div class="quo">
                <br />
                 <?php
		
		if(isset($_REQUEST['search']))
		  {
		 	 $srch=$_REQUEST['search'];			
			 $query="select * from invoice where q_name LIKE '%$srch%'OR q_date LIKE '%$srch%' OR po_no LIKE '%$srch%' OR rgp_no LIKE '%$srch%' OR q_address LIKE '%$srch%' OR dc_no LIKE '%$srch%' OR tin_no LIKE '%$srch%'" ;
	 		 $ans=mysql_query($query);
	 
	?>
        <table class="emp_tab">
        <?php
        if(mysql_num_rows($ans)==0)
		{
		?>
        <tr class='emp_header'>
         <td colspan='6' align="center"><h3> No Data available</h3></td>
        </tr>
		
		<?php
        }
		?>
        <?php
		while($row=mysql_fetch_array($ans))
		{		
        	echo "<tr class='emp_header'>";
                echo "<td width='80'>";
                echo $row[0];
                echo "</td>";
                echo "<td width='250'>";
                echo $row[4];
                echo "</td>";
                echo "<td width='160'>";
                echo $row[3];
                echo "</td>";
                echo "<td width='300'>";
                echo $row[5];
                echo "</td>";
				 echo "<td width='200'>";
                echo $row[2];
                echo "</td>";
				echo "<td width='70' class='print'>";
                echo "<a href='updatequo.php?id=$row[0]'>Update</a>&nbsp;<a href='qreport.php?id=$row[0]'>Print</a>";
                echo "</td>";
                echo "</tr>";
                
		}
		?>        
        </table>
        <?php
		  }
		?>
                 <form action="" method="post" name="search">
				<table class="quotation">
                <tr>
                <td>Invoice Details</td>
                <td><input type='text' name="search"  title="Enter client name,address,date,tin_no,rgp_no,po_no here" />
                </td>
                <td><input type="submit" name="result" value="search" class="formbutton" /></td>
                </tr>
                </table>
                </form>
                                
                <div id="loading" ></div>
		<div id="content" ></div>
        <table width="800px">
	<tr><Td>
			<ul id="pagination">
				<?php
				//Show page links
				for($i=1; $i<=$pages; $i++)
				{
					echo '<li id="'.$i.'">'.$i.'</li>';
				}
				?>
	</ul>	
	</Td></tr></table>

                          
               
  				</div>
                
                </div>
                
        
    
    	<div class="clear"></div>
    
</div>
 <div id="footer">
     <div class="clear"></div> 
    </div>
    </div>
</body>
</html>