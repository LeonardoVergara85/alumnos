<?php 
include_once '../../../public/libs/fpdf17/fpdf.php';

$nro_recibo = $_GET['nrorecibo'];
$nombre = $_GET['nom'];
$apellido = $_GET['ape'];
$curso = $_GET['curso'];
$cuota = $_GET['cuota'];
$meses = $_GET['meses'];
$importe = $_GET['imp'];
$vencimiento = $_GET['fechav'];
$pago = $_GET['fechap'];
$pagotipo = $_GET['tipop'];

class PDF extends FPDF {

    function Header() {

        global $nro_recibo;

        $this->SetMargins(20, 10);

        $this->Image('../../../public/img/skills_logo_recibo.png',30,8,50);

        $this->Cell(10,5,utf8_decode(''),0,0,'C');

        $this->Image('../../../public/img/skills_logo_recibo.png',130,8,50);

        $this->SetMargins(40, 10);

        // $this->Image('../../../public/img/skills_logo.png',10,8,50);

        $this->SetMargins(10, 10);

        $this->Ln(18);

        $this->SetFont('Arial','I',8);

        $this->Cell(75,5,utf8_decode('RECIBO Nº: '),0,0,'R');
        $this->Cell(15,5,utf8_decode($nro_recibo),0,0,'L');
        $this->Cell(10,5,utf8_decode(''),0,0,'C');
        $this->Cell(75,5,utf8_decode('RECIBO Nº: '),0,0,'R');
        $this->Cell(15,5,utf8_decode($nro_recibo),0,0,'L');

        $this->Ln(5);

        $this->SetFont('Arial','I',10);

        $this->Cell(90,5,utf8_decode('ENGLISH LANGUAGE INSTITUTE'),1,0,'C');
        $this->Cell(10,5,utf8_decode(''),0,0,'C');
        $this->Cell(90,5,utf8_decode('ENGLISH LANGUAGE INSTITUTE'),1,0,'C');

        $this->Ln(5);

        $this->Cell(90,5,utf8_decode('Avda. de las Américas 2677 - Cel.: 3434050888'),0,0,'C');
        $this->Cell(10,5,utf8_decode(''),0,0,'C');
        $this->Cell(90,5,utf8_decode('Avda. de las Américas 2677 - Cel.: 3434050888'),0,0,'C');

        $this->Ln(5);

        $this->Cell(90,5,utf8_decode('3100 Paraná - Entre Ríos'),'B',0,'C');
        $this->Cell(10,5,utf8_decode(''),0,0,'C');
        $this->Cell(90,5,utf8_decode('3100 Paraná - Entre Ríos'),'B',0,'C');

        $this->Ln(8);

    }

    function Footer() {
//           // Go to 1.5 cm from bottom
        $this->SetY(-15);
    // Select Arial italic 8
        $this->SetFont('Arial','I',8);
    // Print current and total page numbers
        $this->Cell(0,10,  utf8_decode('Página '.$this->PageNo()),0,0,'C');
    }

}

// $a = new PDF('L', 'mm', 'A4');
$a = new PDF('P', 'mm', 'A4');
$a->AddPage();

$a->Header();

$a->SetFont('Arial','B',10);
$a->Cell(90,5,utf8_decode(' Alumno:'),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->Cell(90,5,utf8_decode(' Alumno:'),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','I',10);
$a->Cell(90,5,utf8_decode($apellido.', '.$nombre),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->Cell(90,5,utf8_decode($apellido.', '.$nombre),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','B',10);
$a->Cell(90,5,utf8_decode(' Curso:'),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->Cell(90,5,utf8_decode(' Curso:'),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','I',10);
$a->Cell(90,5,utf8_decode($curso),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->Cell(90,5,utf8_decode($curso),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','B',10);
$a->Cell(12,5,utf8_decode(' Cuota:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(78,5,utf8_decode($cuota.'/'.$meses),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->SetFont('Arial','B',10);
$a->Cell(12,5,utf8_decode(' Cuota:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(78,5,utf8_decode($cuota.'/'.$meses),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','B',10);
$a->Cell(15,5,utf8_decode(' Importe:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(75,5,utf8_decode('$ '.$importe.' ('.$pagotipo.')'),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->SetFont('Arial','B',10);
$a->Cell(15,5,utf8_decode(' Importe:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(75,5,utf8_decode('$ '.$importe.' ('.$pagotipo.')'),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','B',10);
$a->Cell(35,5,utf8_decode(' Fecha vencimiento:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(55,5,utf8_decode($vencimiento),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->SetFont('Arial','B',10);
$a->Cell(35,5,utf8_decode(' Fecha vencimiento:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(55,5,utf8_decode($vencimiento),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','B',10);
$a->Cell(22,5,utf8_decode(' Fecha pago:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(68,5,utf8_decode($pago),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->SetFont('Arial','B',10);
$a->Cell(22,5,utf8_decode(' Fecha pago:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(68,5,utf8_decode($pago),0,0,'L');


$a->Output('recibo_pago.pdf', 'I');
