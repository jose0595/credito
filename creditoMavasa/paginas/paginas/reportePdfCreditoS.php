<?php 
session_start();
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once 'librerias/html2pdf/vendor/autoload.php';


$status=$_GET['status'];

$_SESSION['id']= $status;	

// Introducimos HTML de prueba
  ob_start();
  require_once 'reporteCreditoStatus.php';
 $content = ob_get_clean();

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('P', 'LETTER', 'es', true, 'UTF-8');
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->output("ReporteCreditoStatus.pdf", 'D');