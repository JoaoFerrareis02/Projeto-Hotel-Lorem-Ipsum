<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html lang="pt-br">
    <head>
        <meta content="text/html;charset=UTF-8" http-equiv="content-type">
        <title>Hotel LOREM IPSUM</title>
        <link rel="stylesheet" href="css/estilos_gerais.css" type="text/css">
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css">
        <script>
            $(function() {$("#calendario").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            });});
        </script>
        <script>
            function carregar(pagina){$("#conteudo").load(pagina);}
        </script>
    </head>
    <body class="corpo-documento">
        <div class="topo_pagina">
            <div class="base-pagina">
                <div class="pagina">
                    <div class="main">
                        <div class="header">
                            <div class="header-topo">
                                <h1>Hotel LOREM IPSUM</h1>
                                <h2>A rede de hotéis com tudo que você precisa para seu descanso e lazer</h2>
                            </div>
                            <div class="header-base">
                                <p>Usuário:</p>
                            </div>
                            <div class="barra-menu">
                                <div class="dropdown">
                                    <button class="dropbutton" onclick="carregar('consulta_apartamento.php')">Consulta</button>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbutton">Cadastro</button>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbutton">Reserva</button>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbutton">Histórico</button>
                                </div>
                                <div class="dropdown">
                                    <button class="dropbutton">Login</button>
                                </div>
                            </div>
                        </div>
                        <div class="conteudo-corpo">
                            <div class="coluna-esquerda">
                                <?php 
                                require_once ("classBancoDados.inc");
                                $conexao_bd = new classBancoDados("localhost");
                                if(!$conexao_bd->AbriConexao()){
                                    echo "<p>Erro na conexão com o banco de dados!<br>" . $conexao_bd->MensagemErro() . "</p>";
                                } else {
                                    $conexao_bd->SetSELECT("*","hoteis");
                                    $conexao_bd->SetORDER("UF,Cidade");
                                    
                                    if($conexao_bd->ExecSELECT()){
                                        $NumeroRegistros = $conexao_bd->TotalRegistros();
                                        $DataSet = $conexao_bd->GetDataSet();
                                        
                                        if($NumeroRegistros > 0){
                                            while ($Registros = $DataSet->fetch_assoc()){
                                                $EnderecoHotel = "<p><b>" . trim($Registros["Endereco"]) . ", " . trim($Registros["Numero"]) . "<br>";
                                                $EnderecoHotel .= trim($Registros["Bairro"]) . " - " . trim($Registros["Cidade"]) . "<br>";
                                                $EnderecoHotel .= $Registros["UF"] . " - Fone: " . $Registros["Telefone"] . "<br></b></p>";
                                                echo $EnderecoHotel;
                                            }
                                        }
                                    }else{
                                        echo "<p>Erro na execução do comando SELECT</p>";
                                    }
                                }
                                $conexao_bd->FecharConexao();
                                ?>
                            </div>
                            <div class="coluna-central" id="conteudo">
                            </div>
                            <div class="coluna-direita">
                                <div class="linha1-coluna-direita">
                                    <div class="calendario" align="center" id="calendario"></div>
                                </div>
                                <div class="separacao-linhas"></div>
                                <div class="linha2-coluna-direita">
                                </div>
                            </div>
                        </div>
                        <div class="rodape-pagina">
                            <div align="center">
                                <p>&copy; Copyright 2023. Developed by João Victor Ferrareis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
