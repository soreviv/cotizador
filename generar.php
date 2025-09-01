<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once('tcpdf/tcpdf.php');

// --- Get data from POST ---
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : 'N/A';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : 'N/A';
$correo = isset($_POST['correo']) ? $_POST['correo'] : 'N/A';
$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : 'N/A';
$marca = isset($_POST['marca']) ? $_POST['marca'] : 'N/A';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'N/A';
$alimentacion = isset($_POST['alimentacion']) ? $_POST['alimentacion'] : 'N/A';
$cargador = isset($_POST['cargador']) ? $_POST['cargador'] : 'No';
$precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0.0;

// --- Create new PDF document ---
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// --- Set document information ---
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dr. Alejandro Viveros');
$pdf->SetTitle('Cotización - ' . $cliente);
$pdf->SetSubject('Cotización de Auxiliares Auditivos');

// --- Set header and footer data ---
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// --- Set margins ---
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// --- Add a page ---
$pdf->AddPage();

// --- Add Logo ---
$image_file = 'logo/logo210.png';
$pdf->Image($image_file, 15, 15, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);


// --- Set Font ---
$pdf->SetFont('helvetica', '', 12);

// --- Title ---
$pdf->SetY(15);
$pdf->SetX(60);
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Cotización de Auxiliares Auditivos', 0, 1, 'L');
$pdf->SetX(60);
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 8, 'Dr. Alejandro Viveros Domínguez', 0, 1, 'L');
$pdf->SetX(60);
$pdf->Cell(0, 8, 'RFC: VIDA851218DQ8 | www.otorrinonet.com', 0, 1, 'L');


// --- Customer Data ---
$pdf->Ln(20);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Datos del Cliente', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(30, 8, 'Nombre:', 0, 0, 'L');
$pdf->Cell(0, 8, $cliente, 0, 1, 'L');
$pdf->Cell(30, 8, 'Teléfono:', 0, 0, 'L');
$pdf->Cell(0, 8, $telefono, 0, 1, 'L');
$pdf->Cell(30, 8, 'Correo:', 0, 0, 'L');
$pdf->Cell(0, 8, $correo, 0, 1, 'L');

// --- Product Data ---
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Detalles del Producto', 0, 1, 'L');
$pdf->SetFont('helvetica', '', 11);
$html = '
<table border="1" cellpadding="5" style="border-collapse: collapse;">
    <tr style="background-color:#f2f2f2;">
        <td width="150"><b>Modelo</b></td>
        <td width="350">'.$modelo.'</td>
    </tr>
    <tr>
        <td><b>Marca</b></td>
        <td>'.$marca.'</td>
    </tr>
    <tr style="background-color:#f2f2f2;">
        <td><b>Tipo</b></td>
        <td>'.$tipo.'</td>
    </tr>
    <tr>
        <td><b>Alimentación</b></td>
        <td>'.$alimentacion.'</td>
    </tr>
    <tr style="background-color:#f2f2f2;">
        <td><b>Cargador</b></td>
        <td>'.$cargador.'</td>
    </tr>
</table>';
$pdf->writeHTML($html, true, false, true, false, '');


// --- Price ---
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(130, 10, 'Precio Unitario:', 0, 0, 'R');
$pdf->SetFont('helvetica', '', 14);
$pdf->Cell(40, 10, '$' . number_format($precio, 2) . ' MXN', 0, 1, 'R');


// --- Footer ---
$pdf->SetY(-30);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->MultiCell(0, 10, 'Esta cotización tiene una vigencia de 30 días. Los precios están sujetos a cambio sin previo aviso. Este documento no es un comprobante fiscal.', 0, 'C', 0, 1, '', '', true);
$pdf->SetY(-15);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->Cell(0, 10, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');


// --- Close and output PDF document ---
$pdf->Output('cotizacion_' . str_replace(' ', '_', $cliente) . '.pdf', 'I');

?>