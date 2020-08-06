<?php
require("fpdf17/fpdf17/fpdf.php");
include('db.php');
$pid = $_GET['pid'];
$sql ="select * from payment where id = '$pid' ";
	$re = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($re))
	{
		$id = $row['id'];
		$title = $row['title'];
		$fname = $row['fname'];
		$lname = $row['lname'];
		$email = $row['Email'];
		$troom = $row['troom'];
		$bed = $row['tbed'];
		$nroom = $row['nroom'];
		$cin = $row['cin'];
		$cout = $row['cout'];
		$meal = $row['meal'];
		$ttot = $row['ttot'];
		$mepr = $row['mepr'];
		$btot = $row['btot'];
		$fintot = $row['fintot'];
		$days = $row['noofdays'];
		$tax= $fintot *12/100;
		$total = $fintot + $tax;
	}
	$type_of_room = 0;       
	if($troom=="Single Room")
	{
		$type_of_room = 1000;
	
	}
	else if($troom=="Classic Room")
	{
		$type_of_room = 1500;
	}
	else if($troom=="Deluxe Room")
	{
		$type_of_room = 2200;
	}
	else if($troom=="Luxury Room")
	{
		$type_of_room = 3000;
	}
	
	if($bed=="Single")
	{
		$type_of_bed = 100;
	}
	else if($bed=="Double")
	{
		$type_of_bed = 150;
	}
	else if($bed=="Triple")
	{
		$type_of_bed = 250;
	}
	else if($bed=="Quad")
	{
		$type_of_bed = 350;
	}
	else if($bed=="None")
	{
		$type_of_bed = 0;
	}
	
	if($meal=="Room only")
	{
		$type_of_meal= 0;
	}
	else if($meal=="Breakfast")
	{
		$type_of_meal= 250;
	}else if($meal=="Half Board")
	{
		$type_of_meal= 550;
	
	}else if($meal=="Full Board")
	{
		$type_of_meal= 750;
	}

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
/*output the result*/

/*set font to arial, bold, 14pt*/
$pdf->SetFont('Arial','B',20);

/*Cell(width , height , text , border , end line , [align] )*/
$pdf->SetFont('Arial','B',25);
$pdf->Cell(80 ,10,'',0,0);
$pdf->Cell(80 ,10,'Invoice',0,0);
$pdf->Cell(80 ,10,'',0,1);

$pdf->Image('assets/img/sun.jpg',130, 25, 65, 15);
$pdf->Cell(175	,10,'',0,1);

$pdf->SetFont('Arial','B',16);
$pdf->Cell(130	,6,'COUNTRY INN',0,1);
$pdf->SetFont('Arial','',14);
$pdf->Cell(130	,6,'Scheme VI-M,',0,1);
$pdf->Cell(130	,6,'Kankurgachi, Kolkata,',0,1);
$pdf->Cell(130	,6,'West Bengal (WB), India (IN) 700054',0,1);
$pdf->Cell(130	,6,'Phone: +91 7003427493',0,1);
$pdf->Cell(130	,6,'Email: countryinn04@gmail.com',0,1);

$pdf->Cell(189	,15,'',0,1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(130	,6,'Bill To:',0,1);

$pdf->SetFont('Arial','B',16);
$pdf->Cell(10	,6,'',0,0);
$pdf->Cell(120	,6,$title.$fname." ".$lname,0,0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30	,6,'Date:- ',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40	,6,$cout,0,1);

$pdf->Cell(10	,6,'',0,0);
$pdf->Cell(120	,6,$email,0,0);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(30	,6,'Invoice #',0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(40	,6,$id,0,1);

$pdf->Cell(189	,15,'',0,1);

$pdf->SetFont('Arial','B',12);
/*Heading Of the table*/
$pdf->Cell(13 ,7,'Sl No.',1,0,'C');
$pdf->Cell(47 ,7,'Item',1,0,'C');
$pdf->Cell(30 ,7,'No of Days',1,0,'C');
$pdf->Cell(30 ,7,'Unit Price',1,0,'C');
$pdf->Cell(30 ,7,'No of unit',1,0,'C');
$pdf->Cell(8 ,7,'Rs',1,0,'C');
$pdf->Cell(30 ,7,'Price',1,1,'C');
/*end of line*/
/*Heading Of the table end*/

$pdf->SetFont('Arial','',12);
$pdf->Cell(13 ,7,'1',1,0,'C');
$pdf->Cell(47 ,7,$troom,1,0);
$pdf->Cell(30 ,7,$days,1,0);
$pdf->Cell(30 ,7,$type_of_room,1,0);
$pdf->Cell(30 ,7,$nroom,1,0);
$pdf->Cell(8 ,7,'Rs',1,0,'R');
$pdf->Cell(30 ,7,number_format($ttot),1,1,'R'); 

$pdf->SetFont('Arial','',12);
$pdf->Cell(13 ,7,'2',1,0,'C');
$pdf->Cell(47 ,7,$bed,1,0);
$pdf->Cell(30 ,7,$days,1,0);
$pdf->Cell(30 ,7,$type_of_bed,1,0);
$pdf->Cell(30 ,7,$nroom,1,0);
$pdf->Cell(8 ,7,'Rs',1,0,'R');
$pdf->Cell(30 ,7,number_format($btot),1,1,'R');

$pdf->SetFont('Arial','',12);
$pdf->Cell(13 ,7,'3',1,0,'C');
$pdf->Cell(47 ,7,$meal,1,0);
$pdf->Cell(30 ,7,$days,1,0);
$pdf->Cell(30 ,7,$type_of_meal,1,0);
$pdf->Cell(30 ,7,$nroom,1,0);
$pdf->Cell(8 ,7,'Rs',1,0,'R');
$pdf->Cell(30 ,7,number_format($mepr),1,1,'R');

$pdf->SetFont('Arial','',12);
$pdf->Cell(120	,7,'',0,0);
$pdf->Cell(30	,7,'Subtotal',0,0);
$pdf->Cell(8	,7,'Rs',1,0,'R');
$pdf->Cell(30	,7,number_format($fintot),1,1,'R');

$pdf->SetFont('Arial','',12);
$pdf->Cell(120	,7,'',0,0);
$pdf->Cell(30	,7,'Tax (12%)',0,0);
$pdf->Cell(8	,7,'Rs',1,0,'R');
$pdf->Cell(30	,7,number_format($tax),1,1,'R');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(120	,7,'',0,0);
$pdf->Cell(30	,7,'Total Amt',0,0);
$pdf->Cell(8	,7,'Rs',1,0,'R');
$pdf->Cell(30 ,7,number_format($total),1,1,'R');

$pdf->SetY(275);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,'Email :- countryinn04@gmail.com || COUNTRY INN || Phone :- +91 7003427493 ',0,1,'C');

$pdf->Output();

?>

<?php
$free="Free";
$nul = null;
$rpsql = "UPDATE `room` SET `place`='$free',`cusid`='$nul' where `cusid`='$id'";
if(mysqli_query($con,$rpsql))
{
	$delsql= "DELETE FROM `roombook` WHERE id='$id' ";
	
	if(mysqli_query($con,$delsql))
	{
	
	}
}
?>