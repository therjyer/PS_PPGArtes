<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
// put your code here

if (session_status() !== PHP_SESSION_ACTIVE)
    {
    session_start();
    }

if ($_SESSION['tipoinscrito'] == '')
{
    header("Location: https://www.ppgartes.propesp.ufpa.br/");
}
    
    if ($_SESSION['tipoinscrito'] == '1')
    {
    $tipoTitulo = "Mestrado";
    $tipoinscrito = '1';
    } else
    {
    $tipoTitulo = "Doutorado";
    $tipoinscrito = '2';
    }

//$tipoinscrito = $_SESSION['tipoinscrito'];
?>
    </body>
</html>
-->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->


    <?php header("Content-type: text/html; charset=UTF-8"); ?>
    <!--html xmlns="http://www.w3.org/1999/xhtml"-->
    <head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"-->
        <title>PSPPGARTES</title>
        <link rel="stylesheet" type="text/css" href="../css/view.css" media="all">
        <script type="text/javascript" src="../ferramentas/js/view.js"></script>
        <script type="text/javascript" src="../ferramentas/js/calendar.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="../ferramentas/js/valida_cpf_cnpj.js"></script>
        <script>

            /*
             * 
             *  VALIDA CEP
             */
            $(function () {
                $("#txtCPF").on("change", function () {
                    //Verificar o tamanho
                    var cpf_cnpj = $(this).val();
                    if (!valida_cpf_cnpj(cpf_cnpj)) {
                        $('#CPF_DOWN').text('CPF inválido');
                        this.value = "";
                    } else {
                        $('#CPF_DOWN').text(' ');
                    }

                });

                /*
                 * CONFIGURA DROPDOWN ORIENTADORES
                 */
                //$("#drpLinha").change(function () {
                $("#drpLinha").change(function () {
                    //$("#drpOrientador").load("textdata/" + $(this).val() + ".txt");
                    //var tipoInscrito = <?php echo json_encode($tipoTitulo); ?>;
                    var strCaminho = "../ferramentas/textdata/" + <?php echo json_encode($tipoTitulo); ?> + +$(this).val() + ".txt";
                    //if (tipoInscrito === "Mestrado") 
                    $("#drpOrientador").load(strCaminho);
                    //#2024 $("#drpOrientadorOpcional").load(strCaminho);
                    /*
                     switch (tipoInscrito) {
                     case 'Mestrado':                        
                     {
                     //$("#drpOrientador").load("../ferramentas/textdata/M" + $(this).val() + ".txt");
                     $("#drpOrientador").load(strCaminho);
                     $("#drpOrientadorOpcional").load(strCaminho);
                     $('#Orientador1l').text("../ferramentas/textdata/M" + $(this).val() + ".txt");
                     $('#Orientador2l').text(strCaminho);
                     } //else
                     case 'Doutorado':
                     {
                     $("#drpOrientador").load("strCaminho);
                     $("#drpOrientadorOpcional").load(strCaminho);
                     $('#Orientador1l').text("../ferramentas/textdata/D" + $(this).val() + ".txt");
                     $('#Orientador2l').text(strCaminho);
                     }
                     
                     }
                     */
                }); // $("#drpLinha").change
                /*
                 * VERIFICA SE ORIENTADORES SE REPETEM NOS DOIS DROPDOWNS
                 #2024
                    $("#drpOrientador").change(function () {
                        var select = document.getElementById('drpOrientadorOpcional');
                        var value = select.options[select.selectedIndex].value;
                        var strCaminho = "../ferramentas/textdata/" + <?php echo json_encode($tipoTitulo); ?> + +$(this).val() + ".txt";
                        if (this.value == value)
                        { 
                            //$('#drpOrientador').text('Não pode repetir o orientador da 2ª opção');
                            //this.select.selectedIndex.value=0;
                        this.value = "";
                        //$("#drpOrientadorOpcional").load(strCaminho);
                        }            
                    });
                $("#drpOrientadorOpcional").change(function () {
                        var select = document.getElementById('drpOrientador');
                        var value = select.options[select.selectedIndex].value;
                        var strCaminho = "../ferramentas/textdata/" + <?php echo json_encode($tipoTitulo); ?> + +$(this).val() + ".txt";
                        if (this.value == value)
                        { 
                            //$('#drpOrientadorOpcional').text('Não pode repetir o orientador da 1ª opção');
                            //this.select.selectedIndex.value=0;
                            this.value = "";
                            //$("#drpOrientador").load(strCaminho);
                        }
                                               
                    });
*/
                /*
                 
                 
                 $("#json-one").change(function () {
                 
                 var $dropdown = $(this);
                 $.getJSON("../ferramentas/jsondata/data.json", function (data) {
                 
                 var key = $dropdown.val();
                 var vals = [];
                 switch (key) {
                 case '1':
                 vals = data.beverages.split(",");
                 break;
                 case '2':
                 vals = data.beverages.split(",");
                 break;
                 case '3':
                 vals = data.beverages.split(",");
                 break;
                 case '0':
                 //vals = ['Escolha a Linha antes'];
                 vals = data.snacks.split(",");
                 }
                 
                 var $jsontwo = $("#json-two");
                 $jsontwo.empty();
                 $.each(vals, function (index, value) {
                 $jsontwo.append("<option>" + value + "</option>");
                 });
                 });
                 }); //$("#json-one").change
                 */
                /*
                 * ARQUIVO ETNIA
                 */
                $("#fileAutodeclaraçãoDeEtnia").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#ETNIA_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#ETNIA_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#ETNIA_DOWN').text('O Arquivo não é PDF');
                        this.value = "";

                    } else {
                        $('#ETNIA_DOWN').text(' ');
                    }

                });

                /*
                 * ARQUIVO LAUDO M�DICO
                 */
                $("#fileLaudoMedico").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#LAUDO_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#LAUDO_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#LAUDO_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#LAUDO_DOWN').text(' ');
                    }

                });
                /*
                 * ARQUIVO CONTRACHEQUE
                 */
                $("#fileContraCheque").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#CHEQUE_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#CHEQUE_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#CHEQUE_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#CHEQUE_DOWN').text(' ');
                    }

                });
                /*
                 * ARQUIVO DIPLOMA
                 */
                $("#arquivoDiploma").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#DIPLOMA_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#DIPLOMA_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#DIPLOMA_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#DIPLOMA_DOWN').text(' ');
                    }

                }); //$("#arquivoDiploma").on("change"

                /*
                 * ARQUIVO HIST�RICO
                 */
                $("#arquivoHistorico").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#HISTORICO_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#HISTORICO_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#HISTORICO_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#HISTORICO_DOWN').text(' ');
                    }

                }); //$("#arquivoHistorico").on("change"

                /*
                 * ARQUIVO RG
                 */
                $("#arquivoRg").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#RGA_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#RGA_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#RGA_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#RGA_DOWN').text(' ');
                    }

                }); //$("#arquivoRg").on("change",

                /*
                 * ARQUIVO CPF
                 */
                $("#arquivoCpf").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#CPFA_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#CPFA_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#CPFA_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#CPFA_DOWN').text(' ');
                    }

                }); //$("#arquivoCpf").on("change"

                /*
                 * ARQUIVO GRU
                 */
                $("#arquivoGru").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#GRU_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#GRU_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#GRU_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#GRU_DOWN').text(' ');
                    }

                }); //$("#arquivoGru").on("change"

                /*
                 * ARQUIVO CONCOD�NCIA
                 */
                $("#arquivoConcordancia").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#CONCORDANCIA_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#CONCORDANCIA_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#CONCORDANCIA_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#CONCORDANCIA_DOWN').text(' ');
                    }

                }); //$("#arquivoConcordancia").on("change"

                /*
                 * ARQUIVO ANU�NCIA
                 */
                 
                $("#arquivoAnuencia").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#ANUENCIA_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#ANUENCIA_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#ANUENCIA_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#ANUENCIA_DOWN').text(' ');
                    }

                });//$("#arquivoAnuencia").on("change" 


                 

                /*
                 * ARQUIVO PROFICIÊNCIA 1
                 */
                $("#arquivoProficiencia").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#PROFICIENCIA_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#PROFICIENCIA_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#PROFICIENCIA_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#PROFICIENCIA_DOWN').text(' ');
                    }

                }); //$("#arquivoProficiencia").on("change"

                /*
                 * ARQUIVO PROFICI�NCIA 2
                 */
                $("#arquivoProficiencia2").on("change", function () {
                    //Verificar o tamanho

                    if (this.files[0].size > 2000000) {
                        $('#PROFICIENCIA2_DOWN').text('O Arquivo ultrassa 2Mb');
                        this.value = "";
                    } else {
                        $('#PROFICIENCIA2_DOWN').text(' ');
                    }

                    var fileName = this.files[0].name;
                    var fileExt = fileName.substring(fileName.length - 3);
                    if (fileExt !== 'pdf') {
                        $('#PROFICIENCIA2_DOWN').text('O Arquivo Não é PDF');
                        this.value = "";

                    } else {
                        $('#PROFICIENCIA2_DOWN').text(' ');
                    }

                }); //$("#arquivoProficiencia").on("change"

                $("#txtVisto").on("change", function () {
                    //Verificar o tamanho
                    var vistoValor = $(this).val();
                    if (vistoValor === "") {
                        document.getElementById("dtVisto").style.display = "none";
                        document.getElementById("txtEndereco").focus();

                    } else {
                        document.getElementById("dtVisto").style.display = "block";
                        document.getElementById("dtInicioVigenciaVisto_1").focus();
                    }
                }); //$("#txtCPF").on("change"
                $("#optAtendimentoEspecial").on("change", function () {
                    //Verificar o tamanho
                    var atendimentoValor = $(this).val();
                    if (atendimentoValor === "0") {
                        document.getElementById("litxtEspecial2").style.display = "none";
                        //RETIRADO NO PSPPGARTES 202 1
                        //document.getElementById("txtLocaldeProva").focus();

                    } else {
                        document.getElementById("litxtEspecial2").style.display = "block";
                        document.getElementById("litxtEspecial2").focus();
                    }
                }); //$("#txtCPF").on("change"
                $("#optVinculoEmpregaticio").on("change", function () {
                    //Verificar o tamanho
                    var atendimentoValor = $(this).val();
                    if (atendimentoValor === "0") {
                        document.getElementById("litxtNomeInstituicao").style.display = "none";
                        document.getElementById("litxtNomeInstituicao").focus();

                    } else {
                        document.getElementById("litxtNomeInstituicao").style.display = "block";
                    }
                }); //$("#optVinculoEmpregaticio").on("change"

            }); // $(function () {
        </script>


    </head>
    <body id="main_body" >

        <!--img id="top" src="top.png" alt=""-->
        <div id="form_container">
            <div style="float:center;">
                <img src="images/logoPpgArtes.jpg" width="198" height="110" alt="PPGARTES"/>
            </div>
            <h1><a>PSPPGARTES</a></h1>
            <form id="form_cadastrarInscrito" class="appnitro" enctype="multipart/form-data" method="post" action="../processo/processarInscrito.php">
                <div class="form_description">
                    <h2>PSPPGARTES</h2>
                    <p>Formulário de Solicitação de Inscrição - Edital 2024 ( <?php echo $tipoTitulo; ?> )  
                    </p>
                    <p><b>Todos os documentos deverão ser enviados em formato PDF com, no máximo, 2Mb. Cada arquivo enviado deverá ser nomeado de forma clara, incluindo o nome do/a candidato/a e o tipo (por exemplo: o PDF contendo o RG de um candidato chamado Fulano de Tal deverá ser designado "RG_Fulano_de_Tal.pdf")". Evitar a utilização de acentuação gráfica ao nomear o arquivo.
                        </b></p>
                </div>						
                <ul >

                    <li id="liLinkCvLattes" >
                        <label class="description" for="txtLinkCvLattes">Endereço para acessar CV (plataforma lattes CNPq):<span class="required">*</span>
                        </label>
                        <div>
                            <input id="txtLinkCvLattes" name="txtLinkCvLattes" class="element text medium"  required type="text" maxlength="255"  value="http://"/> 
                        </div><p class="guidelines" id="guide_1"><small>informar o link válido para o seu CV</small></p> 
                    </li>		
                    <li id="liNome" >
                        <label class="description" for="txtNome">Nome Completo:<span class="required">*</span>
                        </label>
                        <div>
                            <input id="txtNome" name="txtNome" class="element text large"  required type="text" maxlength="255"  value=""/> 
                        </div> 
                    </li>
                    <li id="liNomeSocial" >
                        <label class="description" for="txtNomeSocial">Nome Social:</label>
                        <div>
                            <input id="txtNomeSocial" name="txtNomeSocial" class="element text large"   type="text" maxlength="255"  value=""/> 
                        </div> 
                    </li>
                    <li id="liNacionalidade" >
                        <label class="description" for="txtNacionalidade">Nacionalidade:<span class="required">*</span></label>
                        <div>
                            <input id="txtNacionalidade" name="txtNacionalidade" class="element text medium"  required type="text" maxlength="255" value=""/> 
                        </div> 
                    </li>		
                    <li id="liNaturalidade" >
                        <label class="description" for="txtNaturalidade">Naturalidade:<span class="required">*</span></label>
                        <div>
                            <input id="txtNaturalidade" name="txtNaturalidade" class="element text medium"  required type="text" maxlength="255" value=""/> 
                        </div> 
                    </li>		
                    <li id="lidtNascimento" >
                        <label class="description" for="dtNascimento_1">Data de Nascimento:<span class="required">*</span>
                        </label>
                        <span>
                            <input id="dtNascimento_1" name="dtNascimento_1" class="element text" size="2" maxlength="2" min="1" max="31"  required value="" type="number"> /
                            <label for="dtNascimento_1">DD</label>
                        </span>
                        <span>
                            <input id="dtNascimento_2" name="dtNascimento_2" class="element text" size="2" maxlength="2" min="1" max="12"  required value="" type="number"> /
                            <label for="dtNascimento_2">MM</label>
                        </span>
                        <span>
                            <input id="dtNascimento_3" name="dtNascimento_3" class="element text" size="4" maxlength="4" min="1920" max="2024"   required value="" type="number">
                            <label for="dtNascimento_3">AAAA</label>
                        </span>

                        <span id="calendar_5">
                            <img id="cal_img_5" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
                        </span>
                        <script type="text/javascript">
                            Calendar.setup({
                                inputField: "dtNascimento_3",
                                baseField: "dtNascimento",
                                displayArea: "calendar_5",
                                button: "cal_img_5",
                                ifFormat: "%B %e, %Y",
                                onSelect: selectEuropeDate
                            });
                        </script>

                    </li>		
                    <li id="liRG" >
                        <label class="description" for="txtNumRG">RG:<span class="required">*</span></label>
                        <div>
                            <input id="txtNumRG" name="txtNumRG" class="element text small"  required type="text" maxlength="255" value=""/> 
                        </div><p class="guidelines" id="guide_6"><small>Informar o número do seu documento de identificação</small></p> 
                    </li>		
                    <li id="liEmissorRG" >
                        <label class="description" for="txtEmissorRg">Órgão Expeditor:<span class="required">*</span></label>
                        <div>
                            <input id="txtEmissorRg" name="txtEmissorRg" class="element text small"  required type="text" maxlength="255" value=""/> 
                        </div><p class="guidelines" id="guide_7"><small>Informar o Órgão emissor do seu documento de identidade</small></p> 
                    </li>		
                    <li id="lidtRg" >
                        <label class="description" for="dtRg_1">Data de Emissão:<span class="required">*</span></label>
                        <span>
                            <input id="dtRg_1" name="dtRg_1" class="element text" size="2" maxlength="2" min="1" max="31"  required value="" type="number"> /
                            <label for="dtRg_1">DD</label>
                        </span>
                        <span>
                            <input id="dtRg_2" name="dtRg_2" class="element text" size="2" maxlength="2" min="1" max="12"  required value="" type="number"> /
                            <label for="dtRg_2">MM</label>
                        </span>
                        <span>
                            <input id="dtRg_3" name="dtRg_3" class="element text" size="4" maxlength="4" min="1920" max="2024"   required value="" type="number">
                            <label for="dtRg_3">AAAA</label>
                        </span>

                        <span id="calendar_8">
                            <img id="cal_img_8" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
                        </span>
                        <script type="text/javascript">
                            Calendar.setup({
                                inputField: "dtRg_3",
                                baseField: "dtRg",
                                displayArea: "calendar_8",
                                button: "cal_img_8",
                                ifFormat: "%B %e, %Y",
                                onSelect: selectEuropeDate
                            });
                        </script>
                        <p class="guidelines" id="guide_8"><small>Informar a data da emissão do seu documento de identificação</small></p> 
                    </li>		
                    <li id="liCPF" >
                        <label class="description" for="txtCPF">CPF:<span class="required">*</span></label>
                        <div>
                            <input id="txtCPF" name="txtCPF" class="cpf_cnpj"  required type="text" maxlength="11" value=""/> 
                            <p id="CPF_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p> 
                            
                        </div><p class="guidelines" id="guide_10"><small>Digite somente números sem "." ou "-"</small></p> 
                    </li>		
                    <li id="liVisto" >
                        <label class="description" for="txtVisto">Visto Permanente (preencher apenas se for estrangeiro):</label>
                        <div>
                            <input id="txtVisto" name="txtVisto" class="element text medium"   type="text" maxlength="255" value=""/> 
                        </div> 
                    </li>
                    <div id ="dtVisto" style="display: none;" >
                        <li id="lidtInicioVigenciaVisto" >
                            <label class="description" for="dtInicioVigenciaVisto_1">Início Período de Vigência:</label>
                            <span>
                                <input id="dtInicioVigenciaVisto_1" name="dtInicioVigenciaVisto_1" class="element text" size="2" maxlength="2" min="1" max="31" value="" type="number"> /
                                <label for="dtInicioVigenciaVisto_1">DD</label>
                            </span>
                            <span>
                                <input id="dtInicioVigenciaVisto_2" name="dtInicioVigenciaVisto_2" class="element text" size="2" maxlength="2" min="1" max="12" value="" type="number"> /
                                <label for="dtInicioVigenciaVisto_2">MM</label>
                            </span>
                            <span>
                                <input id="dtInicioVigenciaVisto_3" name="dtInicioVigenciaVisto_3" class="element text" size="4" maxlength="4" min="1920" max="2050" value="" type="number">
                                <label for="dtInicioVigenciaVisto_3">AAAA</label>
                            </span>

                            <span id="calendar_22">
                                <img id="cal_img_22" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
                            </span>
                            <script type="text/javascript">
                                Calendar.setup({
                                    inputField: "dtInicioVigenciaVisto_3",
                                    baseField: "dtInicioVigenciaVisto",
                                    displayArea: "calendar_22",
                                    button: "cal_img_22",
                                    ifFormat: "%B %e, %Y",
                                    onSelect: selectEuropeDate
                                });
                            </script>

                        </li>		
                        <li id="lidtTerminoVigenciaVisto" >
                            <label class="description" for="dtTerminoVigenciaVisto_1">Término Periodo de Vigência:</label>
                            <span>
                                <input id="dtTerminoVigenciaVisto_1" name="dtTerminoVigenciaVisto_1" class="element text" size="2" maxlength="2" min="1" max="31"  value="" type="number"> /
                                <label for="dtTerminoVigenciaVisto_1">DD</label>
                            </span>
                            <span>
                                <input id="dtTerminoVigenciaVisto_2" name="dtTerminoVigenciaVisto_2" class="element text" size="2" maxlength="2" min="1" max="12" value="" type="number"> /
                                <label for="dtTerminoVigenciaVisto_2">MM</label>
                            </span>
                            <span>
                                <input id="dtTerminoVigenciaVisto_3" name="dtTerminoVigenciaVisto_3" class="element text" size="4" maxlength="4" min="1920" max="2050"  value="" type="number">
                                <label for="dtTerminoVigenciaVisto_3">AAAA</label>
                            </span>

                            <span id="calendar_23">
                                <img id="cal_img_23" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
                            </span>
                            <script type="text/javascript">
                                Calendar.setup({
                                    inputField: "dtTerminoVigenciaVisto_3",
                                    baseField: "dtTerminoVigenciaVisto",
                                    displayArea: "calendar_23",
                                    button: "cal_img_23",
                                    ifFormat: "%B %e, %Y",
                                    onSelect: selectEuropeDate
                                });
                            </script>

                        </li>
                    </div>
                    <li id="liEndereço" >
                        <label class="description" for="txtEndereco">Endereço:<span class="required">*</span></label>
                        <div>
                            <textarea id="txtEndereco" name="txtEndereco" required class="element textarea medium"></textarea> 
                        </div> 
                    </li>		
                    <li id="liTelefone" >
                        <label class="description" for="txtTelefone">Telefone:</label>
                        <div>
                            <input id="txtTelefone" name="txtTelefone" class="element text medium"  type="text" maxlength="255" value=""/> 
                        </div><p class="guidelines" id="guide_11"><small>informar no formato (##) #####-####</small></p> 
                    </li>		
                    <li id="liCelular" >
                        <label class="description" for="txtCelular">Celular:<span class="required">*</span></label>
                        <div>
                            <input id="txtCelular" name="txtCelular" class="element text medium"  required type="text" maxlength="255" value=""/> 
                        </div><p class="guidelines" id="guide_12"><small>informar no formato (##) #####-####</small></p> 
                    </li>		
                    <li id="liEmail" >
                        <label class="description" for="txtEmail">E-mail:<span class="required">*</span></label>
                        <div>
                            <input id="txtEmail" name="txtEmail" class="element text medium"  required type="text" maxlength="255" value=""/> 
                        </div><p class="guidelines" id="guide_13"><small>Informe um e-mail válido para contato</small></p> 
                    </li>		
                    <li id="libolAtendimentoEspecial" >
                        <label class="description" for="optAtendimentoEspecial">Necessita de Atendimento Especial para a realização da prova?<span class="required">*</span>
                        </label>
                        <div>
                            <select class="element select medium" required value=''  id="optAtendimentoEspecial" name="optAtendimentoEspecial"> 
                                <option value="" ></option>
                                <option value="0" >Não</option>
                                <option value="1" >Sim</option>                                
                            </select>
                        </div> 
                    <li id="litxtEspecial2" style="display: none;">
                        <label class="description" for="txtEspecial">Especificar atendimento especial:</label>
                        <div>
                            <input id="txtEspecial" name="txtEspecial" class="element text large"  type="text" maxlength="255" value=""/> 
                        </div><p class="guidelines" id="guide_13"><small>Especificar qual o atendimento especial</small></p> 
                    </li>
                    <li id="liAutodeclaraçãoDeEtnia" >
                        <label class="description" for="fileAutodeclaraçãoDeEtnia">Autodeclaração de etnia/pessoas trans (item 2.4 e 2.6 e anexo 06 e 07)</label>
                        <div>
                            <input id="fileAutodeclaraçãoDeEtnia" name="Anexos[]" class="element file" type="file"/> 
                            <p id="ETNIA_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_15"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>
                    <li id="liLaudoMedico" >
                        <label class="description" for="fileLaudoMedico">Laudo Médico/Relatório Médico/autodeclaração PCD (item 2.5 do Edital)</label>
                        <div>
                            <input id="fileLaudoMedico" name="Anexos[]" class="element file" type="file"/> 
                            <p id="LAUDO_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_41"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>
                   <li id="liArquivoIndigena" >
                        <label class="description" for="arquivoIndigena">Autodeclaração de Identidade indígena e Declaração de Pertencimento Étnico(Item 2.7 do EDITAL)</label>
                        <div>
                            <input id="arquivoIndigena" name="Anexos[]"  class="element file" type="file"/> 
                            <p id="ANUENCIA_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_29"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>
                    <li id="liContraCheque" >
                        <label class="description" for="fileContraCheque">Anexar o último contracheque ou declaração funcional - Vaga PADT (item 2.8 do Edital)</label>
                        <div>
                            <input id="fileContraCheque" name="Anexos[]" class="element file" type="file"/> 
                            <p id="CHEQUE_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_43"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>
                    <li id="liNomeEnsinoSuperior" >
                        <label class="description" for="txtNomeEnsinoSuperior">Instituição de Ensino Superior:<span class="required">*</span></label>
                        <div>
                            <input id="txtNomeEnsinoSuperior" name="txtNomeEnsinoSuperior" class="element text large"  required type="text" maxlength="200" value=""/> 
                        </div><p class="guidelines" id="guide_16"><small>Informe nome por extenso</small></p> 
                    </li>
                    <li id="liSiglaEnsinoSuperior" >
                        <label class="SiglaEnsinoSuperior" for="txtSiglaEnsinoSuperior">Sigla da Instituição:<span class="required">*</span></label>
                        <div>
                            <input id="txtSiglaEnsinoSuperior" name="txtSiglaEnsinoSuperior" class="element text small"  required type="text" maxlength="20" value=""/> 
                        </div> 
                    </li>		
                    <li id="liCurso" >
                        <label class="description" for="txtCurso">Curso:<span class="required">*</span></label>
                        <div>
                            <input id="txtCurso" name="txtCurso" class="element text large"  required type="text" maxlength="255" value=""/> 
                        </div> 
                    </li>		
                    <li id="liTitulo" >
                        <label class="description" for="txtTitulo">Título obtido:<span class="required">*</span></label>
                        <div>
                            <input id="txtTitulo" name="txtTitulo" class="element text medium"  required type="text" maxlength="255" value=""/> 
                        </div> 
                    </li>		
                    <li id="lidtInicioCurso" >
                        <label class="description" for="dtInicioCurso_1">Início do curso:<span class="required">*</span></label>
                        <span>
                            <input id="dtInicioCurso_1" name="dtInicioCurso_1" class="element text" size="2" maxlength="2" min="1" max="31"  required value="" type="number"> /
                            <label for="dtInicioCurso_1">DD</label>
                        </span>
                        <span>
                            <input id="dtInicioCurso_2" name="dtInicioCurso_2" class="element text" size="2" maxlength="2" min="1" max="12"  required value="" type="number"> /
                            <label for="dtInicioCurso_2">MM</label>
                        </span>
                        <span>
                            <input id="dtInicioCurso_3" name="dtInicioCurso_3" class="element text" size="4" maxlength="4" min="1920" max="2024"   required value="" type="number">
                            <label for="dtInicioCurso_3">AAAA</label>
                        </span>

                        <span id="calendar_20">
                            <img id="cal_img_20" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
                        </span>
                        <script type="text/javascript">
                            Calendar.setup({
                                inputField: "dtInicioCurso_3",
                                baseField: "dtInicioCurso",
                                displayArea: "calendar_20",
                                button: "cal_img_20",
                                ifFormat: "%B %e, %Y",
                                onSelect: selectEuropeDate
                            });
                        </script>

                    </li>		
                    <li id="lidtTerminoCurso" >
                        <label class="description" for="dtTerminoCurso_1">Término do curso:</label>
                        <span>
                            <input id="dtTerminoCurso_1" name="dtTerminoCurso_1" class="element text" size="2" maxlength="2" min="1" max="31"  required value="" type="number"> /
                            <label for="dtTerminoCurso_1">DD</label>
                        </span>
                        <span>
                            <input id="dtTerminoCurso_2" name="dtTerminoCurso_2" class="element text" size="2" maxlength="2" min="1" max="12"  required value="" type="number"> /
                            <label for="dtTerminoCurso_2">MM</label>
                        </span>
                        <span>
                            <input id="dtTerminoCurso_3" name="dtTerminoCurso_3" class="element text" size="4" maxlength="4" min="1920" max="2024"   required value="" type="number">
                            <label for="dtTerminoCurso_3">AAAA</label>
                        </span>

                        <span id="calendar_21">
                            <img id="cal_img_21" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
                        </span>
                        <script type="text/javascript">
                            Calendar.setup({
                                inputField: "dtTerminoCurso_3",
                                baseField: "dtTerminoCurso",
                                displayArea: "calendar_21",
                                button: "cal_img_21",
                                ifFormat: "%B %e, %Y",
                                onSelect: selectEuropeDate
                            });
                        </script>

                    </li>		
                    <li id="liTituloProjeto" >
                        <label class="description" for="txtTituloProjeto">Título do Projeto Proposto para o <?php echo $tipoTitulo; ?>:<span class="required">*</span></label>
                        <div>
                            <textarea id="txtTituloProjeto" name="txtTituloProjeto" required class="element textarea medium"></textarea> 
                        </div> 
                    </li>		
                    <li id="lioptCampo" >
                        <label class="description" for="optCampo">Selecione o Campo de Atuação:<span class="required">*</span></label>
                        <div>
                            <select class="element select medium" required id="optCampo" name="optCampo"> 
                                <option value="" selected="selected"></option>
                                <option value="1" >Teatro</option>
                                <option value="2" >Música</option>
                                <option value="3" >Dança</option>
                                <option value="4" >Artes Visuais</option>
                                <option value="5" >Cinema</option>
                            </select>
                        </div> 
                    </li>		
                    <li id="lioptLinhaPesquisa" >
                        <label class="description" for="drpLinha">Selecione sua linha de pesquisa:<span class="required">*</span></label>
                        <div>
                            <select id="drpLinha" required name="optLinhaPesquisa">
                                <!--select class="element select medium" required id="optLinhaPesquisa" name="optLinhaPesquisa"--> 
                                <option selected value="0">Selecionar Linha</option>
                                <option value="1">Poéticas e processos de atuação em artes</option>
                                <option value="2">Teorias e Interfaces Epistêmicas em Artes</option>
                                <option value="3">Memórias, Histórias e Educação em Artes</option>
                            </select>
                        </div> 
                    </li>		
                    <li  id="liOrientador1"  >
                        <label id="Orientador1l" class="description" for="drpOrientador">Orientador(a)<span class="required">*</span></label>
                        <div>
                            <select class="element select medium" id="drpOrientador" required name="optOrientador1"> 
                                <option></option>
                            </select>
                        </div> 
                    </li>	
                    
                    <!--li id="Orientador2" >  #2024
                        <label id="Orientador2l" class="description" for="optOrientador2">Orientador(a) (2ª Opção)<span class="required">*</span></label>
                        <div>
                            <select id="drpOrientadorOpcional" required name="optOrientador2">
                                <option Value = ""></option>
                            </select>
                        </div> 
                    </li-->		
                    <li id="liArquivoDiploma" >
                        <label class="description" for="arquivoDiploma">Diploma/Declaração Conclusão/Declaração Concluinte (Conforme subitem 3.2.2 do Edital):<span class="required">*</span></label>
                        <div>
                            <input id="arquivoDiploma" name="Anexos[]" required class="element file" type="file"/> 
                            <p id="DIPLOMA_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_23"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>		
                    <li id="liArquivoHistorico" >
                        <label class="description" for="arquivoHistorico">Histórico (Conforme subitem 3.2.2 do Edital):<span class="required">*</span></label>
                        <div>
                            <input id="arquivoHistorico" name="Anexos[]" required class="element file" type="file"/> 
                            <p id="HISTORICO_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_24"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>		
                    <li id="liArquivoRG" >
                        <label class="description" for="arquivoRg">RG (Conforme subitem 3.2.3):<span class="required">*</span></label>
                        <div>
                            <input id="arquivoRg" name="Anexos[]" required class="element file" type="file"/> 
                            <p id="RGA_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_25"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>		
                    <li id="liArquivoCPF" >
                        <label class="description" for="arquivoCpf">CPF (Conforme subitem 3.2.3):<span class="required">*</span></label>
                        <div>
                            <input id="arquivoCpf" name="Anexos[]" required class="element file" type="file"/> 
                            <p id="CPFA_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_26"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>		
                    <li id="liArquivoGRU" >
                        <label class="description" for="arquivoGru">GRU e Comprovante de Pagamento (Conforme subitem 3.2.4- ANEXO 2):<span class="required">*</span></label>
                        <div>
                            <input id="arquivoGru" name="Anexos[]" required class="element file" type="file"/> 
                            <p id="GRU_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_27"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>		
                    <li id="liArquivoConcordancia" >
                        <label class="description" for="arquivoConcordancia">Declaração de Concordância (Conforme subitem 3.2.5):<span class="required">*</span></label>
                        <div>
                            <input id="arquivoConcordancia" name="Anexos[]" required class="element file" type="file"/> 
                            <p id="CONCORDANCIA_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_28"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>
                    <li id="liArquivoProficiencia" >
                        <label class="description" for="arquivoProficiencia">Comprovante 1 de proficiência em língua estrangeira (Conforme subitem 3.2.1.5)</label>
                        <div>
                            <input id="arquivoProficiencia" name="Anexos[]" class="element file" type="file"/> 
                            <p id="PROFICIENCIA_DOWN" style="color:red; font-size: 12px; font-weight: bold;"></p>
                        </div> <p class="guidelines" id="guide_30"><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p> 
                    </li>
                    <?php
                    //Exibe somente para Doutorado

                    if ($tipoinscrito == '2')
                        {
                        echo "<li id='liArquivoProficiencia2' >" .
                        "<label class='description' for='arquivoProficiencia2'>Comprovante 2 de proficiência em lígua estrangeira  (Conforme subitem 3.2.1.6)</label> " .
                        "<div>" .
                        "<input id='arquivoProficiencia2' name='Anexos[]' class='element file' type='file'/>" .
                        "<p id='PROFICIENCIA2_DOWN' style='color:red; font-size: 12px; font-weight: bold;'></p> " .
                        "</div> <p class='guidelines' id='guide_32'><small>Obrigatório que esteja no formato PDF e tamanho máximo de 2Mb</small></p>" .
                        "</li>";
                        }
                    ?>
                    <li id="liVinculoEmpregaticio" >
                        <label class="description" for="optVinculoEmpregaticio">Vínculo Empregatício:<span class="required">*</span></label>
                        <div>
                            <select class="element select medium" required id="optVinculoEmpregaticio" name="optVinculoEmpregaticio"> 
                                <option value="" ></option>
                                <option value="0" >Não</option>
                                <option value="1" >Sim</option>                                
                            </select>
                        </div> <p class="guidelines" id="guide_31"><small>Informar com SIM se possui vículo empregatício</small></p> 
                        <!--span>
                            <input id="element_33_1" name="element_33_1" class="element checkbox" type="checkbox" value="1" />
                            <label class="choice" for="element_33_1">SIM</label>
                        </span--> 
                    </li>
                    <li id="litxtNomeInstituicao" style="display: none;">
                        <label class="description" for="txtNomeInstituicao">Instituição / Empresa:</label>
                        <div>
                            <input id="txtNomeInstituicao" name="txtNomeInstituicao" class="element text large" type="text" maxlength="200" value=""/> 
                        </div><p class="guidelines" id="guide_16"><small>Informe nome da Instituição / Empresa que está vinculado atualmente</small></p> 
                    </li>

                    <li class="buttons">
                        <input type="hidden" name="form_id" value="97971" />

                        <input id="saveForm" class="button_text" type="submit" name="submit" value="Enviar solicitação de inscrição" />
                    </li>
                </ul>
            </form>	
            <!--div id="footer">
                Generated by <a href="http://www.phpform.org">pForm</a>
            </div-->
        </div>
        <img id="bottom" src="images/bottom.png" alt="">
    </body>
</html>