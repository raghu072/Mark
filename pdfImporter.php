<?php
require ("fpdf181/fpdf.php");

$pdfGenerator = new FPDF();

// var_dump(get_class_methods($pdfGenerator)); //prints all methods in class in array form
$pdfGenerator->AddPage();
$pdfGenerator->SetFont("Arial", "", "15");
$pdfGenerator->Cell(0, 10, "First PDF Page", 1, 1, "C");
$pdfGenerator->Output();
?>