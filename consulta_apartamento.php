<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <title>Consulta de apartamento</title>
        <link rel="stylesheet" href="css/estilos_gerais.css" type="text/css">
        <link rel='stylesheet' href='css/retorno_consulta.css' type='text/css'>
        <script src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.4.0.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css">
  
        <script>
            $(function() {$(".data").datepicker({
                    showOn: "button",
                    buttonImage: "imagens/calendario.png",
                    buttonImageOnly: true,
                    changeMonth: true,
                    changeYear: true,
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'] } );
            });
        </script>

        <script>
            $(document).ready(function() {
                $("#btnPesquisar").click(function() {
                    var data_entrada = $("input[name=DataEntrada]").val();
                    var data_saida = $("input[name=DataSaida]").val();
                    var tipo_apartamento = $("select[name=TipoApartamento]").val();
                    var tipo_acomodacao = $("select[name=TipoAcomodacao]").val();
                    var qtd_camas = $("input[name=Camas]").val();
                    var tem_tv = ($("input[name=TV]").is(":checked")) ? "S":"N";
                    var tem_frigobar = ($("input[name=Frigobar]").is(":checked")) ? "S":"N";
                    var tem_banheira = ($("input[name=Banheira]").is(":checked")) ? "S":"N";
                    var tem_escrivaninha = ($("input[name=Escrivaninha]").is(":checked")) ? "S":"N";

                    $.ajax({
                        "url": "processa_consulta.php",
                        "dataType": "html",
                        "data": { "DataEntrada":data_entrada,
                                  "DataSaida":data_saida,
                                  "TipoApartamento":tipo_apartamento,
                                  "TipoAcomodacao":tipo_acomodacao,
                                  "Camas":qtd_camas,
                                  "TV":tem_tv,
                                  "Frigobar":tem_frigobar,
                                  "Banheira":tem_banheira,
                                  "Escrivaninha":tem_escrivaninha },
                        "success": function(response) { $("div#retorno").html(response); }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="formulario" id="formulario">
        <p class="titulo-formulario">Consulta de Apartamentos Disponíveis Para Reserva</p>

        <form name="formConsultaApartamento">
            Data de entrada:<input maxlength="10" size="10" tabindex="1" name="DataEntrada" class="data">
            Data de saída:<input maxlength="10" size="10" tabindex="2" name="DataSaida" class="data"><br>
            Tipo de apartamento:
            <select tabindex="3" name="TipoApartamento">
                <option value="1">Solteiro</option>
                <option value="2">Casal</option>
            </select><br>
            Tipo de acomodação:
            <select tabindex="4" name="TipoAcomodacao">
                <option value="1">Standard</option>
                <option value="2">Luxo</option>
                <option value="3">Suíte</option>
            </select><br>
            Quantidade de camas:<input maxlength="2" size="2" tabindex="5" name="Camas" value="1"><br>
            <input tabindex="6" name="TV" type="checkbox" value="TV">TV
            <input tabindex="7" name="Frigobar" type="checkbox" value="Frigobar">Frigobar
            <input tabindex="8" name="Banheira" type="checkbox" value="Banheira">Banheira
            <input tabindex="9" name="Escrivaninha" type="checkbox" value="Escrivaninha">Escrivaninha<br><br>
            <button type="button" name="Pesquisar" id="btnPesquisar">Pesquisar</button>
        </form>
        </div>
       
        <div id="retorno"></div>
    </body>
</html>