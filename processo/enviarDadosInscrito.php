<?php
/*
 * Variáveis querystring
 */
$idCandidato = $_GET['id'];


/*
 * INICIANDO O EMAIL
 */
include "../ferramentas/phpmailer/PHPMailerAutoload.php";
//require("phpmailer/class.phpmailer.php");
//$mail = new \PHPMailer\PHPMailer\PHPMailer ;
$mail = new PHPMailer();

$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <!--?php header("Content-type: text/html; charset=ISO-8859-1"); ?-->  
<?php header("Content-type: text/html; charset=UTF-8"); ?>  
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"-->
        <title>PSPPGARTES</title>
        <link rel="stylesheet" type="text/css" href="view.css" media="all">
        <script type="text/javascript" src="view.js"></script>

    </head>
    <body id="main_body" >

        <img id="top" src="top.png" alt="">
        <div id="form_container">

            <h1><a>PSPPGARTES</a></h1>
            <form id="form_98277" class="appnitro"  method="post" action="">
                <div class="form_description">
                    <p>Formulário de Reenvio de Inscrição - Edital 2022</p>
                </div>						
                <ul >
                    <!--h3>Processando arquivos</h3-->
                    <p></p>

<?php
/*
 * ABRINDO CONEX�O COM O BANCO DE DADOS 
 */
//hostinger 
$conn = mysqli_connect('localhost', 'u613711144_psppgartes', ':2!2g6G#', 'u613711144_psppgartes', '3306');
//local $conn = mysqli_connect('localhost', 'u268037633_psppgartes', ':2!2g6G#', 'u268037633_psppgartes', '3306');
//$conn = mysqli_connect('localhost', 'u268037633_psppgartes', ':2!2g6G#', 'st_psppgartes', '3306');
if (!$conn) {
    die('Erro na conexão com o servidor de dados: ' . mysqli_connect_error());
}
mysqli_query($conn, "SET NAMES 'utf8_general_ci'");
mysqli_query($conn, "SET time_zone = '-3:00'");

$result = mysqli_query($conn,"SELECT * FROM `viewHtmlInscritos` WHERE idCandidato = $idCandidato");
$html = mysqli_fetch_assoc($result);



$cpf = $html['txtCPF'];
$txtNome = $html['txtNome'];
if ($html['optTipoProcesso'] == '1') {
    $tipoTitulo = "Mestrado";
} else {
    $tipoTitulo = "Doutorado";
}

//echo "<br />ARQUIVOS PROCESSADOS";
?>
                    <!--h3>Processando dados do formul�rio de inscri��o</h3-->
                    <p></p>
                    <?php
                    /*
                     * FECHANDO A CONEX�O DO BANCO DE DADOS
                     */
                    mysqli_close($conn);
                    ?>                   

                    <!--h3>Finalizando</h3-->
                    <p></p>
                    <?php
                    /*
                     * ENVIANDO EMAIL PARA O PPGARTES
                     */

// Define os dados do servidor e tipo de conex�o
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->IsSMTP(); // Define que a mensagem ser� SMTP
                    $mail->Host = 'smtp.hostinger.com.br';
                    $mail->Port = '587';

                    $mail->SMTPSecure = 'tls'; //PODE SER "ssl"
                    $mail->SMTPAuth = true; // Usa autentica��o SMTP? (opcional)
                    $mail->Username = 'naoresponder@psppgartes.4gestor.net'; // Usu�rio do servidor SMTP
                    $mail->Password = '9]:CifrSDd'; // Senha do servidor SMTP
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->Sender = "naoresponder@ufpa.br";
                    date_default_timezone_set('America/Belem');
                    $mail->From = "naoresponder@psppgartes.4gestor.net"; // Seu e-mail
                    $mail->FromName = "Sistema PPGARTES"; // Seu nome
                    $mail->AddReplyTo("naoresponder@ufpa.br");
// Define os destinat�rio(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAddress('fulano@dominio.com.br', 'Fulano da Silva');
//EMAIL DA PPGARTES $mail->AddAddress("psppgartesdoutorado2@gmail.com");
//
                    if ($html['optTipoProcesso'] == 1) {
                        $mail->AddAddress("psppgartes.mestrado@gmail.com");
                    } else {
                        $mail->AddAddress("psppgartesdoutorado2@gmail.com");
                    }

                    $mail->AddBCC('alexmota.br@gmail.com', 'Alexandre PPGARTES');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // C�pia Oculta
// Define os dados t�cnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
                    $mail->CharSet = 'UTF-8';
                    //date_default_timezone_set('America/Belem');
//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->Subject = "PSPPGARTES2022 " . $tipoTitulo . " - " . $txtNome; // Assunto da mensagem
//$mail->Body

$cpf1 = $html['txtCPF'] . "_1.pdf";
$cpf2 = $html['txtCPF'] . "_2.pdf";
$cpf3 = $html['txtCPF'] . "_3.pdf";
$cpf4 = $html['txtCPF'] . "_4.pdf";
$cpf5 = $html['txtCPF'] . "_5.pdf";
$cpf6 = $html['txtCPF'] . "_6.pdf";
$cpf7 = $html['txtCPF'] . "_7.pdf";
                    $textoEmail = "<p>Novo Cadastro no Sistema do Processo Seletivo do PPGARTES - 2022.</p>" .
                            "<p>Dados da inscrição<br/></p>" .
                            $html['txtHtml'].
                            "<p><a href = 'https://psppgartes.4gestor.net/up2022/$cpf1' target = '_blank'>$cpf1</a></p>".
                            "<p><a href = 'https://psppgartes.4gestor.net/up2022/$cpf2' target = '_blank'>$cpf2</a></p>".
                            "<p><a href = 'https://psppgartes.4gestor.net/up2022/$cpf3' target = '_blank'>$cpf3</a></p>".
                            "<p><a href = 'https://psppgartes.4gestor.net/up2022/$cpf4' target = '_blank'>$cpf4</a></p>".
                            "<p><a href = 'https://psppgartes.4gestor.net/up2022/$cpf5' target = '_blank'>$cpf5</a></p>".
                            "<p><a href = 'https://psppgartes.4gestor.net/up2022/$cpf6' target = '_blank'>$cpf6</a></p>".
                            "<p><a href = 'https://psppgartes.4gestor.net/up2022/$cpf7' target = '_blank'>$cpf7</a></p>";

echo $textoEmail;                    
                          

/*
                    $textoEmail = "<p>Novo Cadastro no Sistema do Processo Seletivo do PPGARTES - 2022.</p>" .
                            "<p>Dados da inscrição<br/></p>" .
                            "<table Border = 1>" .
                            "<tr><td>Tipo</td><td>" . $tipoTitulo . "</td><tr/>" .
                            "<tr><td>Matrícula</td><td>" . $Matricula . "</td><tr/>" .
                            "<tr><td>Nome</td><td>" . $txtNome . "</td><tr/>" .
                            "<tr><td>Cv Lattes</td><td>" . $txtLinkCvLattes . "</td></tr>" .
                            "<tr><td>Nacionalidade</td><td>" . $txtNacionalidade . "</td></tr>" .
                            "<tr><td>Naturalidade</td><td>" . $txtNaturalidade . "</td></tr>" .
                            "<tr><td>Data Nascimento</td><td>" . $dtNascimento . "</td></tr>" .
                            "<tr><td>NumRG</td><td>" . $txtNumRG . "</td></tr>" .
                            "<tr><td>EmissorRg</td><td>" . $txtEmissorRg . "</td></tr>" .
                            "<tr><td>CPF</td><td>" . $txtCPF . "</td></tr>" .
                            "<tr><td>Visto</td><td>" . $txtVisto . "</td></tr>" .
                            "<tr><td>Data Início Visto</td><td>" . $dtInicioVigenciaVisto . "</td></tr>" .
                            "<tr><td>Data Término Visto</td><td>" . $dtTerminoVigenciaVisto . "</td></tr>" .
                            "<tr><td>Endereco</td><td>" . $txtEndereco . "</td></tr>" .
                            "<tr><td>Telefone</td><td>" . $txtTelefone . "</td></tr>" .
                            "<tr><td>Celular</td><td>" . $txtCelular . "</td></tr>" .
                            "<tr><td>Email</td><td>" . $txtEmail . "</td></tr>" .
                            "optLocaldeProva</td><td>" . $txtLocaldeProva . "</td></tr>" .
                            "<tr><td>Atendimento Especial</td><td>" . $txtAtendimentoEspecial . "</td></tr>" .
                            "<tr><td>Qual Atendimento Especial</td><td>" . $txtEspecial . "</td></tr>" .
                            "<tr><td>Nome Ensino Superior</td><td>" . $txtNomeEnsinoSuperior . "</td></tr>" .
                            "<tr><td>Sigla EnsinoSuperior</td><td>" . $txtSiglaEnsinoSuperior . "</td></tr>" .
                            "<tr><td>Curso</td><td>" . $txtCurso . "</td></tr>" .
                            "<tr><td>Título</td><td>" . $txtTitulo . "</td></tr>" .
                            "<tr><td>dt Inicio Curso</td><td>" . $dtInicioCurso . "</td></tr>" .
                            "<tr><td>dt Termino Curso</td><td>" . $dtTerminoCurso . "</td></tr>" .
                            "<tr><td>Título do Projeto</td><td>" . $txtTituloProjeto . "</td></tr>" .
                            "<tr><td>Campo</td><td>" . $txtcampo . "</td></tr>" .
                            "<tr><td>LinhaPesquisa</td><td>" . $optLinhaPesquisa . "</td></tr>" .
                            "<tr><td>Orientador1</td><td>" . orientador($txtOrientador1) . "</td></tr>" .
                            "<tr><td>Orientador2</td><td>" . orientador($txtOrientador2) . "</td></tr>" .
                            "<tr><td>Vinculo Empregatício</td><td>" . $txtVinculoEmpregatici . "</td></tr>" .
                            "<tr><td>None da Instituição</td><td>" . $txtNomeInstituicao . "</td></tr>" .
                            "</table><br/>" .
                            $listalinks;
*/
                    //die($textoEmail);
//$txtNomeInstituicao
                    $mail->Body = $textoEmail;
                    $mail->AltBody = "---------\r\n ";

//$mail->AddAttachment("/uploads", "documento.pdf");
// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
// Envia o e-mail
//$enviado = $mail->Send();
                    if (!$mail->send()) {
                        echo "Erro no envio do E-mail para o PSPPGARTES";
                    } else {
                        echo "E-mail enviado para o PSPPGARTES<br />";
                    }
// Limpa os destinat�rios e os anexos
                    $mail->ClearAllRecipients();
                    $mail->ClearAttachments();
                    echo "<p>Email enviado</br></p>"
                    //session_unset();
                    //session_destroy();
                    ?>

                    <!--li class="buttons">
                        <input type="hidden" name="form_id" value="98277" />

                        <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
                    </li-->
                </ul>
            </form>	

        </div>
        <img id="bottom" src="bottom.png" alt="">
    </body>

</html>


