<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Attendance System - Avadh Tutor</title><style type="text/css">
<!--
.style1 {
	font-family: "Courier New", Courier, monospace;
	font-size: 60px;
	color: #FFFFFF;
	font-style: italic;
}
.style2 {
	font-size: 24px;
	color: #0000FF;
}
.style6 {font-size: 16px}
-->
tr{

}
tr:hover{
	background-color: yellow;

}
</style></head>

<body>
<table width="800" border="1" align="center">
      <tr>
        <td bordercolor="#330033" bgcolor="#CCCCFF"><h1 align="center"><strong><span class="style1">Attendance System</span></strong></h1></td>
      </tr>
      <tr>
        <td bgcolor="#999966"><div align="center">
       						<?php 
									include "menu.php";
							?> 
        				</div>       </td>
      </tr>
      
      	<tr style="background-color: white;"><td colspan="2">
        <form action="" method=post>
        
        <table width="500" border="2" align="center" cellpadding="5" cellspacing="10" bordercolor="#9966FF" bgcolor="#C7B6B1">
        	<tr>
				  <td colspan="5" bgcolor="#9999CC"><div align="center"><strong><span class="style2">Member information</span></strong></div></td>
			</tr>
            <tr>
				  <td  bgcolor="#9999CC"><div align="center"><strong><span class="style2">Enrolment No</span></strong></div></td>
                  <td  bgcolor="#9999CC"><div align="center"><strong><span class="style2">Name</span></strong></div></td>
                  <td  bgcolor="#9999CC"><div align="center"><strong><span class="style2">Mobile</span></strong></div></td>
                  <td  bgcolor="#9999CC"><div align="center"><strong><span class="style2">Email</span></strong></div></td>
                  <td  bgcolor="#9999CC"><div align="center"><strong><span class="style2">Delete</span></strong></div></td>
			</tr>
				
		<?php
			include "z_db.php";
			$query = "select *from `member` ";

			$result = mysqli_query($con,$query)or die("select error error");
			while($rec = mysqli_fetch_array($result))
			{
				echo '<tr height=30px>
				  <td width="222"><span class="style6">'.$rec["enrolment_no"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["name"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["mobile"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["email"].'</span></td>
				  <td width="222"><span class="style6">';
				  echo '<a style="background-color:#CCCCCC;color:#CC3333;border:solid;text-decoration:none;border-radius:10px;position:relative;top:0px;border-color:red;" href="deletemember.php?d='.$rec["member_id"].'">&nbsp;Delete&nbsp;</a></span></td></tr>';			  
			}
		
		?>    
        </table>
        </form>
        </td>
        </tr>
	</table>
    
<?php include "footer.php"; ?>

