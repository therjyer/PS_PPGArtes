<?php
 include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
 protegePagina(); // Chama a fun��o que protege a p�gina
 //include("funcoes.php");


//importa bibliotecas necess�rias
require ("fpdf.php");
define ("FPDF_PATH", "font");

$idProcesso = $_GET['idProcesso'];
$consulta = mysqli_query($_SG['link'], "SELECT p.processo FROM procseletivo p WHERE p.idProcesso = $idProcesso");
$processo = mysql_result($consulta, 0, 'processo');  

class PDF extends FPDF
{
 function Header()
 {
      global $pdf, $processo;
//$processo = $_GET['processo']; 
      
      //t�tulo do relat�rio
      $titulo="PROGRAMA DE P�S-GRADUA��O EM ARTES";
      $pdf->setXY(1.5, 1);
      $pdf->SetFont('arial','b',9);
      $pdf->MultiCell(18, 0.8, $titulo, 0, 'C');
      $pdf->Ln();
      
      $pdf->SetFillColor(0,0,0);
      $pdf->setXY(1.5, 1.7);
      $pdf->Cell(18,0.1,' ',1,1,"C");
      $pdf->setXY(1.5, 1.8);
      $pdf->Cell(18,0.1,' ',1,1,"C", true);
     
      //per�odo da busca
      $periodo= " PROCESSO SELETIVO ".$processo." - CANDIDATOS CLASSIFICADOS NA AN�LISE DE CURR�CULO(MESTRADO)";
      $pdf->setXY(1.5, 2);
      $pdf->SetFont('arial','',10);
      $pdf->MultiCell(18, 0.8, $periodo, 0, 'C');
      $pdf->Ln();

    
     //cabe�alho da tabela
     $pdf->SetFont('arial','B',9);
     $pdf->setXY(1.7,4);
     $pdf->Cell(13.5,0.6,'Nome do candidato',1,0,"C");
     $pdf->Cell(4,0.6,'Pontua��o',1,1,"C");



 }
 
  function Footer()
 {
       global $pdf;
       $hoje = date("d.m.y  -  H:i"); 
       $pdf->setY(24);
       $pdf->SetFont('arial','',8);
       $pdf->Cell(0,10,$hoje,0,0,'R');
 }
}


$pdf = new PDF('P', 'cm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setFont('times', '', 10);
$pdf->SetAutoPageBreak(true , 2.5);



//conex�o com o banco e consultas
include("dbconnect.inc.php");




//tabela de dados
$result = mysqli_query($_SG['link'], "SELECT c.nome, c.pontuacaoCurriculo, c.notaProva1, c.notaProva2 from candidato c WHERE c.processo = $idProcesso AND c.estado=1 AND c.estadoHomologacao = 1 AND c.tipoProcesso=1 AND c.pontuacaoCurriculo > 0 ORDER BY c.nome");
$total_results = mysqli_num_rows($result);

$pdf->SetFont('arial','',9);
for ($i=0;$i<$total_results;$i++){


    $nome = mysql_result($result, $i, 'nome');
    $pontuacao = mysql_result($result, $i, 'pontuacaoCurriculo');   
    $nota1 = mysql_result($result, $i, 'notaProva1');
    $nota2 = mysql_result($result, $i, 'notaProva2');
    $mediaNota = ($nota1+$nota2)/2;
    
    if ($mediaNota>=7){    
        $pdf->setX(1.7);
        $pdf->Cell(13.5,0.6,$nome,1,0,"L");
        $pdf->Cell(4,0.6,$pontuacao,1,1,"C");
    }
    
}


      
//fun��o para exibir o relat�rio gerado em um arquivo .pdf no navegador
$pdf->Output("Candidatos Classificados na An�lise de Curr�culo(Processo Seletivo ".$processo.").pdf","I");


?>



