<?php
	ob_start();	
	include ('db.php');
	$pid = $_GET['sid'];
	$sql ="select * from roombook where id = '$pid' ";
	$re = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($re))
	{
		$id = $row['id'];
		$title =  $row['Title'];
		$Fname = $row['FName'];
		$lname = $row['LName'];
		$email = $row['Email'];
		$National = $row['National'];
		$country = $row['Country'];
		$phone = $row['Phone'];
		$room_type = $row['TRoom'];
		$Bed_type = $row['Bed'];
		$meal_type = $row['Meal'];
		$cin_date = $row['cin'];
		$cout_date = $row['cout'];
		$nodays = $row['nodays'];
	}								

require("fpdf17/fpdf17/fpdf.php");

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/
$pdf->SetFont('Arial','B',25);
$pdf->Cell(50 ,10,'',0,0);
$pdf->Cell(50 ,10,'Information of Guest',0,0);
$pdf->Cell(50 ,10,'',0,1);

$pdf->Image('assets/img/sun.jpg',130, 25, 65, 15);
$pdf->Cell(175	,10,'',0,1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,6,'COUNTRY INN',0,1);
$pdf->Cell(130	,6,'Scheme VI-M,',0,1);
$pdf->Cell(130	,6,'Kankurgachi, Kolkata,',0,1);
$pdf->Cell(130	,6,'West Bengal (WB), India (IN) 700054',0,1);
$pdf->Cell(130	,6,'Phone: +91 7003427493',0,1);
$pdf->Cell(130	,6,'Email: countryinn04@gmail.com',0,1);
$pdf->Cell(189	,8,'',0,1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,7,'Coustomer Name  : -' ,0,0);
$pdf->Cell(150	,7,$title.$Fname." ".$lname,0,1);
$pdf->Cell(130	,7,'Customer phone : -',0,0);
$pdf->Cell(130	,7,$phone,0,1);
$pdf->Cell(130	,7,'Customer email : -',0,0);
$pdf->Cell(130	,7,$email,0,1);
$pdf->Cell(130	,7,'Customer Country : -',0,0);
$pdf->Cell(130	,7,$country,0,1);
$pdf->Cell(130	,7,'Customer National : -',0,0);
$pdf->Cell(130	,7,$National,0,1);
$pdf->Cell(189	,8,'',0,1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,6,'Check in Date: ',0,0);
$pdf->Cell(130	,6,$cin_date,0,1);
$pdf->Cell(130	,6,'Check out Date: ',0,0);
$pdf->Cell(130	,6,$cout_date,0,1);
$pdf->Cell(130	,6,'Customer ID: ',0,0);
$pdf->Cell(130	,6,$id,0,1);
$pdf->Cell(189	,8,'',0,1);

$pdf->SetFont('Arial','B',12);
/*Heading Of the table*/
$pdf->Cell(18 ,7,'Sl No.',1,0,'C');
$pdf->Cell(85 ,7,'Item',1,0,'C');
$pdf->Cell(85 ,7,'No of Days',1,0,'C');
$pdf->Cell(189	,7,'',0,1);
/*end of line*/
/*Heading Of the table end*/

$pdf->SetFont('Arial','',12);
$pdf->Cell(18 ,7,'1',1,0,'C');
$pdf->Cell(85 ,7,$room_type,1,0);
$pdf->Cell(85 ,7,$nodays,1,0);
$pdf->Cell(189	,7,'',0,1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(18 ,7,'2',1,0,'C');
$pdf->Cell(85 ,7,$Bed_type,1,0);
$pdf->Cell(85 ,7,$nodays,1,0);
$pdf->Cell(189	,7,'',0,1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(18 ,7,'3',1,0,'C');
$pdf->Cell(85 ,7,$meal_type,1,0);
$pdf->Cell(85 ,7,$nodays,1,0);
$pdf->Cell(189	,7,'',0,1);

$pdf->SetY(275);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,'Email :- countryinn04@gmail.com || COUNTRY INN || Phone :- +91 7003427493 ',0,1,'C');

$pdf->Output();

?>
<?php 

ob_end_flush();

?>