<?php 
session_start(); 
header("Cache-control: private"); // IE 6 Fix. 

if(($_SESSION['log_authorization'] != 1) || ($_SESSION['log_customer'] != 1)){  
    Header("Location: ./badlog.php"); // Redirect unauthorized person
    exit();
}

$db = mysqli_connect("localhost", "root", "ilovebearuser");
mysqli_select_db($db,"charlab");

// ***Excel Chart OoutPut 2018 Aug ***
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/Reader/Excel5.php';
require_once 'PHPExcel-1.8/Classes/PHPExcel/Reader/Excel2007.php';	
// ***Excel Chart OoutPut 2018 Aug ***

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


<?php
$date = $today['weekday'] . ", " . $today['month'] . " " . $today['mday'] . ", " . $today['year'] ;
$name = $_SESSION['log_lname'] . ", " . $_SESSION['log_fname'] . "";
$incident = $_REQUEST['incident'];
$requestnumber =  $_REQUEST['requestnumber'];
$location = $_REQUEST['location'];
$tester = $_REQUEST['tester'];
$textarea = $_REQUEST['textarea'];
$status = "Active";

///////////////////////////////////////////////////////

//echo $date;
//echo "<br><br>" ;
//echo $name;
//echo "<br><br>" ;
//echo $incident;
if (!$incident){
  echo "<span style="."color:red".">*Please go back and insert incident.</span> ";
}
else echo $incident;
echo "<br><br>" ;


//echo $requestnumber;
if (!$requestnumber){
  echo "<span style="."color:red".">*Please go back and insert request number.</span> ";
}
else echo $requestnumber;
echo "<br><br>" ;


echo $location;
if (!$location){
  echo "<span style="."color:red".">*Please go back and insert location.</span> ";
}
else echo $location;
echo "<br><br>" ;


//echo $tester;
  if (!$tester){
    echo "<span style="."color:red".">*Please go back and insert tester.</span> ";
  }
  else echo $tester;
echo "<br><br>" ;


//echo $textarea;
if (!$textarea){
  echo "<span style="."color:red".">*Please go back and insert description.</span> ";
}
else echo $textarea;
echo "<br><br>" ;

echo "Thank you for filling in the form.<br>";
echo "Kindly check your ticket status on the link below.<br>";
echo "<a href ="."ticket-status.php"." style ="."color:blue"."> Ticket Status </a> <br>";

echo "<br><br>" ;
//echo $ticket;
//echo "<br><br>" ;
//echo $status;
//echo "<br><br>" ;
//////////////////////////////////////////////////////////////////////////////////////

if ((!$incident) || (!$requestnumber) || (!$location) || (!$tester) ||(!$textarea) ) {


}
else {

              //////////////////////////////////////////////////////

              $ticket_pre="T";
              $ticket = "";
              $tbname = "raise_ticket";

              //$sql="SELECT DISTINCT Ticket_number FROM $tbname  WHERE RIGHT( Ticket_number, 7 ) IN ( SELECT MAX( RIGHT( Ticket_number, 7 ) )  as Ticket_number from $tbname where Ticket_number like '" ."%".substr($today['year'],2,2)."%')";
              $sql="SELECT DISTINCT Ticket_number FROM $tbname";
              $result = mysqli_query($db,$sql);
              
              //echo $result."<br>";
              if ((!$result) || ($result == "")) {
                $ticket=$ticket_pre.substr($today['year'],2,2)."00001";
              }
              else
              {
                while ($myrow = mysqli_fetch_array($result)){

                $ticketnum = $myrow["Ticket_number"];
                //echo $ticketnum."<br>";
                $ticketnum = substr($ticketnum,4,5);
                $ticketnum = (int)$ticketnum+1;
                $ticketnum=sprintf("%05d", $ticketnum);
                $ticket=$ticket_pre.substr($today['year'],2,2).$ticketnum;
                
                }
              }

              //////////////////////////////////////////////////////


              $tbname = "raise_ticket";
              $sql = "INSERT INTO $tbname  VALUES 
              ('$ticket','$status','$date', '$name','$incident','$requestnumber','$location','$tester','$textarea')";

              if(mysqli_query($db, $sql)){
                  echo "Data has been updated." ;
              }
              //////////////////////////////////////////////////////////////////////////////////
              mkdir("raiseticket/".$ticket."/");
              $target_dir = "raiseticket/".$ticket."/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                } else {
                  echo "Sorry, there was an error uploading your file.";
                }
              ////////////////////////////////////////////////////////////////////////////////////////
              
                  //generate excel file base template
                  $exl_request_filename="Template_ticket.xlsx";
                  $directory = "template" ;
                $exl_request_filename = $directory . "/" . $exl_request_filename;
                $page=1;

                $objReader1 = new PHPExcel_Reader_Excel2007();
                $objPHPExcel1=$objReader1->load($exl_request_filename);

                $objPHPExcel1->setactivesheetindex(0);

                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('E3', $ticket);
                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('B4', $date);
                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('B6', $name);
                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('B8', $incident);
                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('B10', $requestnumber);
                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('B12', $location);
                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('B14', $tester);
                $objPHPExcel1->setActiveSheetIndex(0)->setCellValue('B16', $textarea);

                $directory_n = "raiseticket/".$ticket;
                $filename = $directory_n . "/" . $ticket . ".xlsx";
                $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel1,'Excel2007');
                $objWriter->setIncludeCharts(TRUE);
                $objWriter->save($filename); 

}




?>

