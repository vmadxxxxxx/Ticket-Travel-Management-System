<?php
  session_start();
  if (!isset($_SESSION["user"])) {
      header('Location: ../index.php');
      exit;
    }
  require_once('../mysqldb.php');
  $id = $_REQUEST['id'];
  $getUID = $_SESSION["UserID"];
        $sql = "SELECT * FROM user_info, user_ticket_info where user_ticket_info.flight_id IS NULL AND user_ticket_info.bus_id IS NULL AND user_info.user_id = '$getUID' and user_ticket_info.user_id = '$getUID' and user_ticket_info.ticket_id = '$id'";
        $result = mysql_query($sql);
        while($row = mysql_fetch_array($result)) {
            $trainId = $row['train_id'];
            $ticketNum = $row['ticket_id'];
            $getName = $row['name'];
            $getGen = $row['gender'];
            $getEmail = $row['email'];
            $getPhn = $row['phone'];
            $getVehicle = $row['vehicle_name'];
            $getDOJ = $row['jdate'];
            $getTime = $row['jtime'];
            $getRoute = $row['route'];
            $getSeats = $row['seats'];
            $getCategory = $row['category'];
            $getFare = $row['amount'];
            $getPaymethod = $row['pay_method'];
        }

date_default_timezone_set('Asia/Dhaka');
$date = date('d/m/Y h:i:s A', time());
$dateTime = "Print@: ".$date;
			
	  require ("fpdf/fpdf.php");
	  $pdf = new FPDF();

	  $pdf->AddPage();

	  $pdf->SetFont("Arial","B",10);
	  $pdf->Cell(190,10,"Your Ticket Information || Flight Ticket",1,1,"C");

      $pdf->Cell(95,10,"Ticket#: ",1,0,"C");
	  $pdf->Cell(95,10,$ticketNum,1,1,"C");

	  $pdf->Cell(95,10,"Train#: ",1,0,"C");
	  $pdf->Cell(95,10,$trainId,1,1,"C");

	  $pdf->Cell(95,10,"Name: ",1,0,"C");
	  $pdf->Cell(95,10,$getName,1,1,"C");

	  $pdf->Cell(95,10,"Gender: ",1,0,"C");
	  $pdf->Cell(95,10,$getGen,1,1,"C");

	  $pdf->Cell(95,10,"Email: ",1,0,"C");
	  $pdf->Cell(95,10,$getEmail,1,1,"C");

	  $pdf->Cell(95,10,"Phone: ",1,0,"C");
	  $pdf->Cell(95,10,$getPhn,1,1,"C");

	  $pdf->Cell(95,10,"Vehicle Name: ",1,0,"C");
	  $pdf->Cell(95,10,$getVehicle,1,1,"C");

	  $pdf->Cell(95,10,"Date-Of-Journey: ",1,0,"C");
	  $pdf->Cell(95,10,$getDOJ,1,1,"C");

	  $pdf->Cell(95,10,"Time: ",1,0,"C");
	  $pdf->Cell(95,10,$getTime,1,1,"C");

	  $pdf->Cell(95,10,"Route: ",1,0,"C");
	  $pdf->Cell(95,10,$getRoute,1,1,"C");
	  
	  $pdf->Cell(95,10,"Seat Number: ",1,0,"C");
	  $pdf->Cell(95,10,$getSeats,1,1,"C");
	  
	  $pdf->Cell(95,10,"Seat Category: ",1,0,"C");
	  $pdf->Cell(95,10,$getCategory,1,1,"C");

	  $pdf->Cell(95,10,"Total Fare: ",1,0,"C");
	  $pdf->Cell(95,10,$getFare,1,1,"C");

	  $pdf->Cell(95,10,"Payment Getway: ",1,0,"C");
	  $pdf->Cell(95,10,$getPaymethod,1,1,"C");
      
      $pdf->Cell(190,10,$dateTime,0,0,"R");
      $pdf->Output();
?>