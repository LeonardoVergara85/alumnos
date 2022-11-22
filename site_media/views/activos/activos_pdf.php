<?php 
include_once '../../../public/libs/fpdf17/fpdf.php';

 $nro_activo = $_GET['nroactivo'];
 $descripcion = $_GET['descripcion'];
 $importe = $_GET['importe'];
 $forma_pago = $_GET['formapago'];
 $fecha = $_GET['fecha'];

 $pago = '';
 
 switch ($forma_pago) {
    case 1:
        $pago = 'Efectivo';
        break;
    case 2:
        $pago = 'Débito';
        break;
    case 3:
        $pago = 'Transferencia bancaria';
        break;
    case 4:
        $pago = 'Otro';
        break;  
    case 5:
        $pago = 'Mercado Pago';
        break;
    case 6:
        $pago = 'Crédito';
        break;         
}

class PDF extends FPDF {

    function Header() {

        global $nro_activo;

        $this->SetMargins(20, 10);

        $this->Image('../../../public/img/skills_logo_recibo.png',30,8,50);

        $this->Cell(10,5,utf8_decode(''),0,0,'C');

        $this->Image('../../../public/img/skills_logo_recibo.png',130,8,50);

        $this->SetMargins(40, 10);

        // $this->Image('../../../public/img/skills_logo.png',10,8,50);

        $this->SetMargins(10, 10);

        $this->Ln(18);

        $this->SetFont('Arial','I',8);

        $this->Cell(75,5,utf8_decode('COMPROBANTE Nº: '),0,0,'R');
        $this->Cell(15,5,utf8_decode($nro_activo),0,0,'L');
        $this->Cell(10,5,utf8_decode(''),0,0,'C');
        $this->Cell(75,5,utf8_decode('COMPROBANTE Nº: '),0,0,'R');
        $this->Cell(15,5,utf8_decode($nro_activo),0,0,'L');

        $this->Ln(5);

        $this->SetFont('Arial','I',10);

        $this->Cell(90,5,utf8_decode('ENGLISH LANGUAGE INSTITUTE'),1,0,'C');
        $this->Cell(10,5,utf8_decode(''),0,0,'C');
        $this->Cell(90,5,utf8_decode('ENGLISH LANGUAGE INSTITUTE'),1,0,'C');

        $this->Ln(5);

        $this->Cell(90,5,utf8_decode('Avda. de las Américas 2650 - Tel.: 4352026'),0,0,'C');
        $this->Cell(10,5,utf8_decode(''),0,0,'C');
        $this->Cell(90,5,utf8_decode('Avda. de las Américas 2650 - Tel.: 4352026'),0,0,'C');

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
$a->Cell(90,5,utf8_decode(' Descripción:'),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->Cell(90,5,utf8_decode(' Descripción:'),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','I',10);
$a->Cell(90,5,utf8_decode($descripcion),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->Cell(90,5,utf8_decode($descripcion),0,0,'L');
$a->Ln(10);
$a->SetFont('Arial','B',10);
$a->Cell(15,5,utf8_decode(' Importe:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(75,5,utf8_decode('$ '.$importe.' ('.$pago.')'),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->SetFont('Arial','B',10);
$a->Cell(15,5,utf8_decode(' Importe:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(75,5,utf8_decode('$ '.$importe.' ('.$pago.')'),0,0,'L');
$a->Ln(5);
$a->SetFont('Arial','B',10);
$a->Cell(27,5,utf8_decode(' Fecha de pago:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(63,5,utf8_decode($fecha),0,0,'L');
$a->Cell(10,5,utf8_decode(''),0,0,'L');
$a->SetFont('Arial','B',10);
$a->Cell(27,5,utf8_decode(' Fecha de pago:'),0,0,'L');
$a->SetFont('Arial','I',10);
$a->Cell(63,5,utf8_decode($fecha),0,0,'L');


$a->Output('activos_pagos.pdf', 'I');
