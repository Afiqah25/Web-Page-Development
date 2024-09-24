<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

if(($_SESSION['log_authorization'] != 1) || ($_SESSION['log_customer'] != 1)){  
    Header("Location: ./badlog.php"); // Redirect unauthorized person
    exit();
}

$db = mysqli_connect("localhost", "root", "ilovebearuser");
mysqli_select_db($db,"charlab");

?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<HEAD>
	<TITLE>New Raise Ticket</TITLE>
	
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name=description content="">
<!--meta http-equiv="X-UA-Compatible" content="IE=edge"></meta-->
<meta name=keywords content="">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"></meta>
<META HTTP-EQUIV="Expires" CONTENT="0"></meta>

<LINK REL="stylesheet" type="text/css" href="style.css">
 <script src="datepicker/WdatePicker.js"  type="text/jscript"></script> 

</head>

<BODY bgcolor="#ffffff" marginheight="0" marginwidth="0" onload="pagereturnload()">
<!-- Header -->
<?php include 'header.php'; ?>

<!-- Body -->
<br>
<table cellpadding="0" cellspacing="0" ><tr>
<td width="200" bgcolor="#016E74" valign="top">
<!-- menu -->
<?php include 'mainmenu.php'; ?>
</td>
<td width="900" bgcolor="#ffffff" valign="top">
<!-- Body Info -->


<form action="raise-ticket_update.php" method="post" enctype="multipart/form-data" onsubmit="return checkSubmit();">

<table width="650" cellpadding="0" cellspacing="2" border="1" frame="box">
<tr>
	<td bgcolor='#8888FF' align="center" class="menu" colspan="2">Ticket Information</td>
</tr>

 <!---------------------------------------> 
<!---------------------------------------> 
<tr>
    <td width="400"><!-- Request Information -->
		<table border="0" width="450" >
                

                <tr>
                    <td class="body" colspan="2"><span class='aster'>*</span> <span class='red'>Required Fields</span></td>
                </tr>


 <!---------------------------------------> 
                <tr>
                    <td class="body">Date:</td>
                    <td class="bodysmall" ><?php $today = getdate();
                        echo $today['weekday'] . ", " . $today['month'] . " " . $today['mday'] . ", " . $today['year']; ?>
                    </td>
                </tr>   


 <!---------------------------------------> 
                <tr>
                    <td class="body">Requested By:
                        <span class="bodysmall">
                        </span>
                    </td>
                    
                    <td class="bodysmall"><?php	echo $_SESSION['log_lname'] . ", " . $_SESSION['log_fname'] . "";?>
                    
                </td>
                
                </tr>

 <!----------------------------------(" . $_SESSION['log_userid'] . ")"-----> 
                <tr>
                    <td class="body"><span class='aster'>*</span> Incident occured during testing?
                    </td>
                </tr>

                <tr>
                    <td>
                    <input type="radio" name="incident"
                    <?php if (isset($name) && $name=="Yesincident") echo "checked";?>
                    value="Yes">Yes
                    <input type="radio" name="incident"
                    <?php if (isset($name) && $name=="Noincident") echo "checked";?>
                    value="No">No
                    </td>
                </tr>
 <!---------------------------------------> 
                <tr>
                <td class="body"><span class='aster'>*</span> If yes, Request ID : <input type="number" id="requestnumber" name="requestnumber" min="1" max="100000000"></td>
                </tr>

        </table>


    <!--------------------------------->
    <!--------------------------------->

<td width="400"><!-- Device Information -->
	<table width="400">
       
	
            <tr>
            <td class="body"><span class='aster'>*</span>Location :</td>
            <td class="bodysmall"><select name="location" id="location" style="font-size: 7pt;" >
        
            <?php	 
             
                        echo "<option value='' SELECTED>(Select Location)</option>";
                    

            $tbname = "labs";
            $sql = "SELECT * FROM $tbname ORDER BY description";
            $result = mysqli_query($db,$sql);
            if (!$result) {
                echo "<br>sql = " . $sql . "<br>";
            die('Query failed6: ' . mysqli_error());
            }
            while ($myrow = mysqli_fetch_array($result)){
                echo "<OPTION VALUE='" . $myrow[1] . "'>" . $myrow[1] . "</OPTION>";
            }
            ?>
                <OPTION VALUE="Other">(Other)</OPTION>
                </select>
            </td>
            </tr>
            
 <!--------------------------------------->      
            <tr>
            <td class="body"><span class='aster'>*</span>Tester:</td>
                    <td class="bodysmall"><select name="tester" id="tester" style="font-size: 7pt;" >
                    
            <?php	 
        
                        echo "<option value='' SELECTED>(Select Tester)</option>";
            

            $tbname = "tester";
            //$sql = "SELECT * FROM $tbname ORDER BY tester";
            $sql = "SELECT * FROM $tbname ";
            $result = mysqli_query($db,$sql);
            if (!$result) {
                echo "<br>sql = " . $sql . "<br>";
            die('Query failed6: ' . mysqli_error());
            }
            while ($myrow = mysqli_fetch_array($result)){
                //echo "test name " . $myrow['tester'];
                echo "<OPTION VALUE='" . $myrow["Tester"] . "'>" . $myrow[1] . "</OPTION>";
            }
            ?>
            <OPTION VALUE="Other">(Other)</OPTION>
            </select>
            
            </td>
            </tr>

 <!---------------------------------------> 

            <tr>
            <td class="body"><span class='aster'>*</span>Description:</td>
            <td>
            <textarea cols="20" rows="5" name="textarea"></textarea>
            </td>
            </tr>
	
  <!--------------------------------------->            

            <tr>
            <td class="body">
            <input type="file" name="fileToUpload" id="fileToUpload">  
            </td>
            <td class="body">
            <input type="submit" value="Submit">
            </td>
            </tr>


	
	</table>
    </td>

        </form>
        </html>