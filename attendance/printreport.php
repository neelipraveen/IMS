<title>Online Attendance - Avadh Tutor</title>
<style type="text/css">
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
</style>
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
      <tr>
        <td><div align="center">
        <form action="" method="post">
          <table width="606" border="2" align="center" bordercolor="#9966FF" bgcolor="#C7B6B1">
          	<tr><td colspan="3" align="center"><h3>Search Enrolment No Wise Records Here</h3></td></tr>
            <tr>
              <td width="308" bgcolor="#9999CC"><div align="center"><strong><span class="style2">Enter the enrolment no</span></strong></div></td>
              <td width="144" bgcolor="#9999CC"><span class="style6">
                <input type="text" name="eno" />
              </span></td>
              <td width="130" bgcolor="#9999CC"><input type="submit" value="View Information" name="btnsubmit"/></td>
            </tr>
          </table>
          </form>
        </div></td>
      </tr>
		<?php
		if(isset($_POST["btnsubmit"]))
		{
			include "z_db.php";
			extract($_POST);
			$query = "select * from `member` where enrolment_no = ".$eno." limit 1";

			$result = mysqli_query($con,$query)or die("select error error");
			while($rec = mysqli_fetch_array($result))
			{
				echo '<tr><td colspan="2"><table width="400" border="2" align="center" bordercolor="#9966FF" bgcolor="#C7B6B1">
				<tr>
				  <td width="160" bgcolor="#9999CC"><span class="style2">Enrolment No</span></td>
				  <td width="160" bgcolor="#9999CC"><span class="style2">Name</span></td>';
				  $query1 = "select * from `attandance` where `member_id` = ".$rec["member_id"]." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td bgcolor="#9999CC" class=style2>'.$rec1["date"].'</td>';
					}
				echo '</tr>
				<tr>
				  <td width="222"><span class="style6">'.$rec["enrolment_no"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["name"].'</span></td>';
				  $query1 = "select *from `attandance` where `member_id` = ".$rec["member_id"]." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td>';
						if($rec1["attendance"]==0)
							echo "Absent";
						else
							echo "Present";
						echo '</td>';
					}
				
				echo '
				</tr>
								
			  </table></td></tr>';
			}
		}
		else
		{
			include "z_db.php";
			extract($_POST);
			$query = "select * from `member` ";

			$result = mysqli_query($con,$query)or die("select error error");
			while($rec = mysqli_fetch_array($result))
			{
				echo '<tr><td colspan="2"><table width="90%" border="2" align="center" bordercolor="#9966FF" bgcolor="#C7B6B1">
				<tr>
				  <td width="160" bgcolor="#9999CC"><span class="style2">Enrolment No</span></td>
				  <td width="160" bgcolor="#9999CC"><span class="style2">Name</span></td>';
				  $query1 = "select * from `attandance` where `member_id` = ".$rec["member_id"]." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td bgcolor="#9999CC" class=style2>'.$rec1["date"].'</td>';
					}
				echo '</tr>
				<tr>
				  <td width="222"><span class="style6">'.$rec["enrolment_no"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["name"].'</span></td>';
				  $query1 = "select *from `attandance` where `member_id` = ".$rec["member_id"]." order by date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td>';
						if($rec1["attendance"]==0)
							echo "Absent";
						else
							echo "Present";
						echo '</td>';
					}
				
				echo '
				</tr>
								
			  </table></td></tr>';
			}
		}
		?>    
	</table>
<?php include "footer.php"; ?>
