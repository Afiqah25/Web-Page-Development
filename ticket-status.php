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
	<TITLE>Ticket Status</TITLE>
	
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

<?php $tcolor = "bgcolor='#8888FF'";?>
 <!------------------------------------------------------------>

 <!--<form action="ticket-status.php" method="post">-->
 <!------------------------------------------------------------>
 <!------------------------------------------------------------>

 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

 <!------------------------------------------------------------>
<span class="bold">Ticket Status</span><br>

	<p class="body">Note: This list shows the ticket that have been submitted under your name.</p>
	<table width="900" cellpadding="0" cellspacing="2" border="1" frame="box" id ="Activetable" name ="Activetable" >
	
    <tr>
    <td <?php echo $tcolor?> align="center" width="200" class="menu">Status</td>
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Ticket Number</td>
	<strong><td <?php echo $tcolor?> align="center" width="200" class="menu">Date</td></strong>
	<td <?php echo $tcolor?> align="center" width="200" class="menu">Requestor</td>
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Incident</td>
	
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Request Number</td>
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Location</td>
	<td <?php echo $tcolor?> align="center" width="200" class="menu">Tester</td>
	<td <?php echo $tcolor?> align="center" width="200" class="menu">Description</td>
    <td <?php echo $tcolor?> align="center" width="200" class="menu">Attachment</td>
    <td <?php echo $tcolor?> align="center" width="200" class="menu">Comment</td>
	</tr>

<?php
$tbname = "raise_ticket";
//$sql = "SELECT DISTINCT  Ticket_number,Status,Date,Name,Incident,RequestNumber,Location,Tester,Description FROM  $tbname";
$sql = "SELECT * from $tbname";
$result = mysqli_query($db,$sql);

//$sql2= "UPDATE raise_ticket SET Status = 'Active' WHERE Ticket_number = 'T2400006'";
//mysqli_query($db,$sql2);


$i=0;
$color = "FFFFFF";	
while($myrow = mysqli_fetch_array($result)){
    //if(($myrow["request_by"] == $_SESSION['log_userid'])||($myrow["request_for"] == $_SESSION['log_userid'])){
                        //printf("<tr bgcolor='#%s'>",$color);
                        if($i%2==0 ) 	
                        {
                        $color = "FFFFFF";
                        }
                        else
                        {
                        $color="DDDDDD";
                        }
                    
                        printf("<tr bgcolor='#%s'>",$color);

                        if ( $myrow["Status"] == "Active" )  {        
                                    //Status
                                    //printf("<td class='bodysmall' align='center'><button type="."button"." onclick="."myActiveFunction()"." id="."ActiveButton"."> %s </button></td>",$myrow["Status"]);
                                    printf("<td class='bodysmall' align='center'><button type='button' class='ActiveButton' > %s </button></td>",$myrow["Status"]);

                                    //Ticket NUmber
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Ticket_number"]);

                                    //Date
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Date"]);

                                    //Requestor
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Name"]);

                                    //Incident
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Incident"]);

                                    //request number
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["RequestNumber"]);

                                    //Location
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Location"]);

                                    //Tester
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Tester"]);

                                    //Description
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Description"]);

                                    //Attachment
                                    printf("<td class='bodysmall' align='center'><a href=raiseticket/".$myrow["Ticket_number"]." > Link </td>");

                                    //Comment
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Comment"]);


                                    ///////////////////////////////////////////////////////////
                                    ?>
                                    <?php
                                    //////////////////////////////////////////////////////////////






                        }

                   
                        //printf("<td class='bodysmall' align='center'><a href='showproject.php?project=%s' class='chartlinks'>%s</a></td>", $myrow['project'], $myrow['project']);
                        //printf("<td class='bodysmall' align='center'><a href='d-show.php?request_id=%s' class='chartlinks'>%s</a></td>", $myrow2['request_id'], $myrow2['request_id']);
                        //printf("<td class='bodysmall'>%s</td><td class='bodysmall'>%s</td><td class='bodysmall'>%s</td><td class='bodysmallpurple'>%s</td><td class='bodysmall'>%s</td><td class='bodysmall'>%s</td><td class='bodysmall'>%s</td> <td class='bodysmall'>%s</td><td class='bodysmall'>%s</td><td class='bodysmall'>%s</td><td class='bodysmall'>%s</td><td class='bodysmall'>%s</td></tr>", $myrow2['part_number'], $myrow2['lot_num'],$myrow2['request_by'], $myrow2['request_date'], $myrow2['request_type'],  $myrow2['test_description'],$myrow2['request_location'], $myrow2['log_date'], $myrow2['schedule_date'], $estimate_complete,$project_status,$submissionstatus);
                        
    //}

    $i++;
}


?>
                                    <script>
                                    //function myActiveFunction() {  
                                    //alert("Do you want to close the ticket?");
                                    //}

                                    $(function(){
                                    $('button.ActiveButton').on('click',function(){
                                           //alert($(this).closest('tr').index())

                                    var tableActive = document.getElementById('Activetable');
                                    var row = $(this).closest('tr').index();
                                    var ticketNUMActive = tableActive.rows[row].cells[1].innerHTML;
                                    var requestNUMActive = tableActive.rows[row].cells[5].innerHTML;
                                    
                                    document.cookie = "ticketNUMActive="+ticketNUMActive+" ; requestNUMActive="+requestNUMActive+ ";" ;
                                    //document.cookie = 'ticketNUM = tableActive.rows[row].cells[1].innerHTML;requestNUM = tableActive.rows[row].cells[5].innerHTML';
                                    //alert ("The row : " +row+ "contain ticket : "+ticketNUM+"and request: "+requestNUM);
                                    //alert (row);
                                    
                                    <?php
                                    $tbname3 = "raise_ticket";
                                    $closedTicket = "Closed";
                                    $columnStatus = "Status";
                                    $columnTicketNumber = "Ticket_number";
                                    $columnRequestNumber = "RequestNumber";
                                   
                                    ?>

                                    <?php 
                                    
                                    $columnTicketActive = $_COOKIE['ticketNUMActive']; 
                                    $columnRequestActive = $_COOKIE['requestNUMActive']; 
                                    
                                    //echo ($columnTicket);
                                    //echo ($columnRequest);
                                    
                                    ?>
                                    
                                    var booleanTicketActive;
                                    booleanTicketActive = confirm("Do you want to CLOSE the Ticket :" +ticketNUMActive+ "and Request :"+requestNUMActive+" ?" );

                                    document.cookie = "booleanTicketActive="+booleanTicketActive+ ";" ;
                                    

                                    <?php 
                                    $booleanTicketActive = $_COOKIE['booleanTicketActive']; 

                                    if ($booleanTicketActive == 'true') {
                                        
                                        $sql3 = "UPDATE $tbname3 SET $columnStatus = '$closedTicket' WHERE $columnTicketNumber = '$columnTicketActive' " ; 
                                        //echo ($sql3);
                                        mysqli_query($db,$sql3);


                                    }else{}
                                    ?>
                                    
                                    if (booleanTicketActive==true){
                                        window.location.reload();
                                        window.location.reload();
                                    }




                                    })
                                    })


                                    </script>

                                    <?php



echo "</table>";
	if($i == 0){
	echo "<span class='bold'>No Projects</span><br><br>";
	}
    ?>

    

    <?php
    $tcolor = "bgcolor='#8888FF'";
    //////////////////////////////////////////////////show recently finished
    ?>
    
    <br><br><span class="bold">Recently Completed</span><br>
	<p class="body">Note: This list shows the requests that have been submitted under your name that have been completed in the last month.</p>
	<table width="900" cellpadding="0" cellspacing="2" border="1" frame="box" id ="Closetable" name ="Closetable">
	
    
    <tr>
    <td <?php echo $tcolor?> align="center" width="200" class="menu">Status</td>
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Ticket Number</td>
	<strong><td <?php echo $tcolor?> align="center" width="200" class="menu">Date</td></strong>
	<td <?php echo $tcolor?> align="center" width="200" class="menu">Requestor</td>
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Incident</td>
	
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Request Number</td>
	<td <?php echo $tcolor?> align="center" width="100" class="menu">Location</td>
	<td <?php echo $tcolor?> align="center" width="200" class="menu">Tester</td>
	<td <?php echo $tcolor?> align="center" width="200" class="menu">Description</td>
    <td <?php echo $tcolor?> align="center" width="200" class="menu">Attachment</td>
    <td <?php echo $tcolor?> align="center" width="200" class="menu">Comment</td>
	</tr>

   
    <?php
$tbname = "raise_ticket";
//$sql = "SELECT DISTINCT  Ticket_number,Status,Date,Name,Incident,RequestNumber,Location,Tester,Description FROM  $tbname";
$sql = "SELECT * from $tbname";
$result = mysqli_query($db,$sql);


$i=0;
$color = "FFFFFF";	
while($myrow = mysqli_fetch_array($result)){
    //if(($myrow["request_by"] == $_SESSION['log_userid'])||($myrow["request_for"] == $_SESSION['log_userid'])){
                        //printf("<tr bgcolor='#%s'>",$color);
                        if($i%2==0 ) 	
                        {
                        $color = "FFFFFF";
                        }
                        else
                        {
                        $color="DDDDDD";
                        }
                    
                        printf("<tr bgcolor='#%s'>",$color);

                        if ( $myrow["Status"] == "Closed" )  {        
                                    //Status
                                    //printf("<td class='bodysmall' align='center'><button type="."button"." onclick="."myActiveFunction()"." id="."ActiveButton"."> %s </button></td>",$myrow["Status"]);
                                    printf("<td class='bodysmall' align='center'><button type=button class='CloseButton' > %s </button></td>",$myrow["Status"]);

                                    //Ticket NUmber
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Ticket_number"]);

                                    //Date
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Date"]);

                                    //Requestor
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Name"]);

                                    //Incident
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Incident"]);

                                    //request number
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["RequestNumber"]);

                                    //Location
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Location"]);

                                    //Tester
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Tester"]);

                                    //Description
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Description"]);

                                    //Attachment
                                    printf("<td class='bodysmall' align='center'><a href=raiseticket/".$myrow["Ticket_number"]." > Link </td>");

                                    //Comment
                                    printf("<td class='bodysmall' align='center'> %s </td>",$myrow["Comment"]);

                                    ///////////////////////////////////////////////////////////
                                    ?>
                                     <?php
                                
            
                                   
                                    






                        }

                   
                      
    //}

    $i++;
}

?>
                                    <script>
                                    //function myActiveFunction() {  
                                    //alert("Do you want to close the ticket?");
                                    //}

                                    $(function(){
                                    $('button.CloseButton').on('click',function(){
                                        //alert($(this).closest('tr').index())

                                    var tableClose = document.getElementById('Closetable');
                                    var row = $(this).closest('tr').index();
                                    var ticketNUMClose = tableClose.rows[row].cells[1].innerHTML;
                                    var requestNUMClose = tableClose.rows[row].cells[5].innerHTML;

                                    document.cookie = "ticketNUMClose="+ticketNUMClose+" ; requestNUMClose="+requestNUMClose+ ";" ;
                                    //document.cookie = 'ticketNUM = tableActive.rows[row].cells[1].innerHTML;requestNUM = tableActive.rows[row].cells[5].innerHTML';
                                    //alert ("The row : " +row+ "contain ticket : "+ticketNUM+"and request: "+requestNUM);
                                    //alert (row);

                                    <?php
                                    $tbname3 = "raise_ticket";
                                    $activeTicket = "Active";
                                    $columnStatus = "Status";
                                    $columnTicketNumber = "Ticket_number";
                                    $columnRequestNumber = "RequestNumber";

                                    ?>

                                    <?php 

                                    $columnTicketClose = $_COOKIE['ticketNUMClose']; 
                                    $columnRequestClose = $_COOKIE['requestNUMClose']; 

                                    //echo ($columnTicket);
                                    //echo ($columnRequest);

                                    ?>

                                    var booleanTicketClose;
                                    booleanTicketClose = confirm("Do you want to OPEN the Ticket :" +ticketNUMClose+ "and Request :"+requestNUMClose+" ?" );

                                    document.cookie = "booleanTicketClose="+booleanTicketClose+ ";" ;


                                    <?php 
                                    $booleanTicketClose = $_COOKIE['booleanTicketClose']; 

                                    if ($booleanTicketClose == 'true') {
                                        
                                        $sql4 = "UPDATE $tbname3 SET $columnStatus = '$activeTicket' WHERE $columnTicketNumber = '$columnTicketClose' " ; 
                                        //echo ($sql3);
                                        mysqli_query($db,$sql4);


                                    }else{}
                                    ?>

                                    if (booleanTicketClose==true){
                                        window.location.reload();
                                        window.location.reload();
                                    }




                                    })
                                    })


                                    </script>




<?php




                                    //temp
                                   
                                    echo "<br>cookie ticket active is  " .$columnTicketActive;
                                    echo "<br>cookie ticket active boolean is  " .$booleanTicketActive;
                                    echo "<br>";
                                    echo "<br>cookie ticket close is  " .$columnTicketClose;
                                    echo "<br>cookie ticket close boolean is  " .$booleanTicketClose;
                                    echo "<br>";
                                    echo "<br>sql3 is  " .$sql3;
                                    echo "<br>sql4 is  " .$sql4;
                                    //echo "<br>testing is  " .$testing;
                                    //..end temp
echo "</table>";
	if($i == 0){
	echo "<span class='bold'>No Projects</span><br><br>";
	}

    ?>