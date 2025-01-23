<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
// include("dbconnect.inc.php");
protegePagina(); // Chama a função que protege a página
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php include "head.html"; ?>
        <script type="text/javascript" language="javascript">
            function confirmaExclusao(aURL) {
                if (confirm('Você tem certeza que deseja tornar este usuário inativo?')) {
                    location.href = aURL;
                }
            }
        </script>  

    </head>

    <?php include ("header.php"); ?>

    <body class="bg-fixed bg-1">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
            <![endif]-->
        <div class="main-container">
            <div class="main wrapper clearfix">
                <!-- Header Start 
                  <header>
                      
                      <div align="center">
                          <h2>
                              Cordas da Amazônia
                          </h2>
                          <h4>
                              Sistema de Avaliação
                          </h4>
                      </div>
                  </header>
                  Header End -->

                <!-- Main Tab Container -->
                <div id="tab-container">
                    <?php
                    $ind = 0;
                    $user = 0;
                    $cand = 0;
                    $ava = 1;
                    $perf = 0;

                    $idProcesso = (isset($_GET['idProcesso'])) ? $_GET['idProcesso'] : '';
                    $consultaidProcesso = mysqli_query($_SG['link'], "SELECT p.processo FROM procseletivo p WHERE p.idProcesso = $idProcesso");
                    $row = mysqli_fetch_row($consultaidProcesso);
                    $processo = $row[0];
                    // php 5 $processo = mysql_result($consulta, 0, 'processo');

                    $nomeProfessor = $_SESSION['usuarioNome'];

                    $consultaidProfessor = mysqli_query($_SG['link'], "SELECT u.id FROM usuarios u WHERE u.nome = '$nomeProfessor' AND u.estado=1");
                    $rowprofessor = mysqli_fetch_row($consultaidProfessor);
                    $idProfessor = $rowprofessor[0];
                    ?>
                    <!-- Tab List -->
                    <?php include ("menu.php"); ?>
                    <!-- End Tab List -->

                    <div id="tab-data-wrap">

                        <!-- About Tab Data -->
                        <div id="usuarios">
                            <section class="clearfix">
                                <div class="g3">
                                    <div>
                                        <div class="info">
                                            <h4>
                                                Selecione um canditado para avaliar - Entrevista
                                            </h4>
                                        </div>
                                        <div align="center">
                                            <form class="form-wrapper cf" method="post" action="avEntrevista1.php?idProcesso=<?php echo $idProcesso; ?>">
                                                <input name="busca" id="busca" type="text" placeholder="Digite o texto da pesquisa..." required>
                                                <button type="submit">Pesquisar</button>
                                            </form>
                                        </div>                                   
                                    </div>

                                    <?php
                                    $msg = (isset($_GET['msg'])) ? $_GET['msg'] : '';
                                    if ($msg == 1)
                                        echo "<center><b>Avaliação realizada com sucesso!</b></center><br />";
                                    else if ($msg == 2)
                                        echo "<center><b>Canditado atualizado com sucesso!</b></center><br />";
                                    else if ($msg == 3)
                                        echo "<center><b>Canditado deletado com sucesso!</b></center><br />";
                                    ?> 




                                    <div align='center'>                               <p>
                                            <?php
                                            include("dbconnect.inc.php");
                                            $per_page = 10;
                                            $usuarioID = $_SESSION["usuarioID"];
                                            $busca = (isset($_POST['busca'])) ? $_POST['busca'] : '';

                                            $result = mysqli_query($_SG['link'], "SELECT c.estado, c.estadoEntrevista, c.idCandidato, c.cpf, c.numInscricao, c.nome, c.notaProva1, c.notaProva2, c.notaAnteprojeto1, c.notaAnteprojeto2, c.avaliadorEntrevista1, c.avaliadorEntrevista2, c.notaEntrevista, c.tipoProcesso FROM candidato c WHERE  (c.cpf like '%$busca%') AND (((c.notaAnteprojeto1+c.notaAnteprojeto2)/2)>=7) AND (c.optOrientador1='$idProfessor') AND c.estado = 1 AND c.processo = '$idProcesso'  AND c.estadoHomologacao=1 ORDER BY c.nome")
                                                    or die(mysql_error()); //AND (avaliadorAnteprojeto1='$idProfessor')

                                            $total_results = mysqli_num_rows($result);

                                            //$total_pages = ceil($total_results / $per_page);
                                            /*
                                            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                                $show_page = $_GET['page'];

                                                // make sure the $show_page value is valid
                                                if ($show_page > 0 && $show_page <= $total_pages) {
                                                    $start = ($show_page - 1) * $per_page;
                                                    $end = $start + $per_page;
                                                } else {
                                                    // error - show first set of results
                                                    $start = 0;
                                                    $end = $per_page;
                                                }
                                            } else {
                                                // if page isn't set, show first set of results
                                                $start = 0;
                                                $end = $per_page;
                                            }


                                            echo "<table id='pages'> <tr><td> <ul>";

                                            if (isset($_GET['page'])) {
                                                $pg_atual = $_GET['page'];
                                            } else {
                                                $pg_atual = -1;
                                            }

                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                if ($pg_atual > 0) {
                                                    if ($i == $pg_atual) {
                                                        echo "<li ><a class='current' href='avEntrevistaMestDout.php?page=$i&idProcesso=$idProcesso'> $i </a></li>";
                                                    } else {
                                                        echo "<li><a href='avEntrevistaMestDout.php?page=$i&idProcesso=$idProcesso'> $i </a></li>";
                                                    }
                                                } else {
                                                    echo "<li ><a class='current' href='avEntrevistaMestDout.php?page=1&idProcesso=$idProcesso'> 1 </a></li>";
                                                    $pg_atual = 1;
                                                }
                                            }


                                            echo " </tr></td> </ul></table>";
                                            ?>
                                            */
                                            <?php if ($total_results != 0) { ?>                        
                                            <table id="rounded-corner">

                                                <tr><th scope="col" class="rounded-q1">Estado</th>
                                                    <th scope="col" class="rounded-q1">Tipo</th>   
                                                    <th scope="col" class="rounded-q1">Nome</th>
                                                    <th scope="col" class="rounded-q2">Nota</th>




                                                <?php
                                                while ($row = mysqli_fetch_array($result))
                                                //for ($i = $start; $i < $end; $i++) {
                                                    // make sure that PHP doesn't try to show results that don't exist
                                                    //if ($i == $total_results) {                                                         break;                                                     }

                                                    // echo out the contents of each row into a table
                                                    $estadoEntrevista = $row['estadoEntrevista'];

                                                    if ($estadoEntrevista == 0) {
                                                        $estado = "Não Avaliado";
                                                    } else {
                                                        $estado = "Avaliado";
                                                    }
                                                    
                                                    $tipoProcesso = $row['tipoProcesso'];
                                                    if ($tipoProcesso == 1) {
                                                        $tipo = "Mest";
                                                    } else {
                                                        $tipo = "Dout";
                                                    }
                                                          
                                                    
                                                    $idCandidato = $row['idCandidato'];

                                                    echo "<tr onclick=\"document.location = 'avEntrevistaFicha.php?idCandidato=$idCandidato&idProcesso=$idProcesso';\">";
                                                    echo '<td>' . $estado . '</td>';
                                                    echo '<td>' . $tipo . '</td>';
                                                    echo '<td>' . $row['nome'] . '</td>';
                                                    echo '<td>' . $row['notaEntrevista'] . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>

                                            </table>
                                                    <?php
                                                } else
                                                    echo "<br /><center>Nenhum candidato para esta fase.</center><br />";
                                                ?>     

                                    </div>                            
                                    </p>

                                </div>
                        </div>



                        </section><!-- content -->
                    </div>
                    <!-- End About Tab Data -->


                </div>
            </div>
            <!-- End Tab Container -->
            <footer>
<?php include "rodape.html"; ?>
            </footer>
        </div><!-- #main -->
    </div><!-- #main-container -->



</body>
</html>
