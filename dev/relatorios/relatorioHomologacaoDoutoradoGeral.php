<?php
 include("../principal/seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
 protegePagina(); // Chama a fun��o que protege a p�gina
 //include("funcoes.php");


//importa bibliotecas necess�rias
require ("fpdf.php");
define ("FPDF_PATH", "font");

$idProcesso = $_GET['idProcesso'];
$consulta = mysqli_query($_SG['link'], "SELECT p.processo FROM procseletivo p WHERE p.idProcesso = $idProcesso");
$row = mysqli_fetch_row($consulta);
$processo = $row[0];    

class PDF extends FPDF
{
 function Header()
 {
      global $pdf, $processo;
     // $processo = $_GET['processo']; 
      
      //t�tulo do relat�rio
      $titulo="PROGRAMA DE PÓS-GRADUAÇÃO EM ARTES";
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
      $periodo= " PROCESSO SELETIVO ".$processo." - RELATÓRIO DE HOMOLOGAÇÃO (Doutorado)";
      $pdf->setXY(1.5, 2);
      $pdf->SetFont('arial','',10);
      $pdf->MultiCell(18, 0.8, $periodo, 0, 'C');
      $pdf->Ln();

    
     //cabe�alho da tabela
     $pdf->SetFont('arial','B',9);
     $pdf->setXY(1.7,4);
     $pdf->Cell(9,0.6,'Nome do candidato',1,0,"C");
     $pdf->Cell(3,0.6,'Nº de Inscrição',1,0,"C");
     $pdf->Cell(3,0.6,'CPF',1,0,"C");
     $pdf->Cell(3,0.6,'Estado',1,1,"C");


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
include("../principal/dbconnect.inc.php");




//tabela de dados
$result = mysqli_query($_SG['link'], "SELECT DISTINCT c.nome, c.numInscricao, c.cpf, c.estadoHomologacao from candidato c WHERE c.processo = $idProcesso AND c.estado=1 AND c.tipoProcesso = 2 ORDER BY c.nome");
$total_results = mysqli_num_rows($result);

$pdf->SetFont('arial','',9);
while ($row = mysqli_fetch_array($result) )
{

    $nome = $row['nome']; 
    $numInscricao = $row['numInscricao'];   
    $cpf = $row['cpf']; 
    $estadoHomologacao = $row['estadoHomologacao']; 
    
    if ($estadoHomologacao == 2){
                                    $estado = "Não Homologado";
                                }else if ($estadoHomologacao == 1){$estado = "Homologado";
                                }else {$estado ="-";}   
    
       $pdf->setX(1.7);
       $pdf->Cell(9,0.6,$nome,1,0,"L");
       $pdf->Cell(3,0.6,$numInscricao,1,0,"C");
       $pdf->Cell(3,0.6,$cpf,1,0,"C");
       $pdf->Cell(3,0.6,$estado,1,1,"C");
       
      
    
    
}


    
//fun��o para exibir o relat�rio gerado em um arquivo .pdf no navegador
$pdf->Output("RELATÓRIO GERAL DE HOMOLOGAÇÃO Doutorado (Processo Seletivo ".$processo.").pdf","I");


?>