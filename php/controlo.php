<?php
session_start();

require('db_connection.php');


if($_SESSION['nome'] == 'user'){

  $_SESSION['erro'] = "Não tem permissão para aceder a esta página.";

  echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=index.php\"> ";
}
else if ($_SESSION['logged'] != true) {//verificacao se tem login feito

   $_SESSION['erro'] = "Não tem sessão iniciada. Inicie sessão para continuar.";

    echo "<META HTTP-EQUIV=\"refresh\" content=\"2; URL=index.php\"> ";

} else {

    $nome = $_SESSION['nome'];

  $Serial_Number_Povoa = "032E280C4321000002";
  $Serial_Number_Aveiro = "018E22DC44F1000003";
//  $query_serial("SELECT Unit_ID FROM `ProCat_ID`");
  //$result_serial = mysqli_query($con,$query_serial);
  //$row_serial = mysqli_fetch_assoc($resul_serial);

  //for($i =0; $i<count($row_serial); $i++){
    //array_push($new_data, substr($row_serial['Unit_ID'],0,3));
  //}

  $Serial_Number_UAR1 = "0111180A3E26000002";
  $Serial_Number_UAR2= "0311180A3E26000003";
  $Serial_Number_UAR3= "0311180A3E26000004";

  $query_uar_parametros = "SELECT Start_Date,Start_Time,Period FROM `ProCat_Cut` WHERE Serial_Number='$Serial_Number_UAR1' ORDER BY Input DESC LIMIT 1";
  $queryPovoa = "SELECT System,UMAX_Config,IMAX_Config,UREF_Config,UREF_MIN_Config,UREF_MAX_Config,Operation_Mode,Operation_Type,Maintenance_Duration,Maintenance_TON,Maintenance_TOFF,I_Config FROM `UPR_Operation` WHERE Serial_Number='$Serial_Number_Povoa' ORDER BY Input DESC LIMIT 1" ;

  $queryAveiro = "SELECT System,UMAX_Config,IMAX_Config,UREF_Config,UREF_MIN_Config,UREF_MAX_Config,Operation_Mode,Operation_Type,Maintenance_Duration,Maintenance_TON,Maintenance_TOFF,I_Config FROM `UPR_Operation` WHERE Serial_Number='$Serial_Number_Aveiro' ORDER BY Input DESC LIMIT 1" ;

  $resultAveiro = mysqli_query($con,$queryAveiro) or die(mysqli_error($con));

  $rowAveiro = mysqli_fetch_assoc($resultAveiro);

  $resultPovoa = mysqli_query($con,$queryPovoa) or die(mysqli_error($con));

  $rowPovoa = mysqli_fetch_assoc($resultPovoa);

  $result_uar_parametros = mysqli_query($con,$query_uar_parametros);

  $rowParametros = mysqli_fetch_assoc($result_uar_parametros);

  $queryAveiro2 = "SELECT Start_Date, Period,Start_Time, Duration, TON, TOFF FROM `ProCat_Cut` WHERE Serial_Number='$Serial_Number_Aveiro' ORDER BY Input DESC LIMIT 1";

  $resultAveiro2 = mysqli_query($con,$queryAveiro2) or die(mysqli_error($con));
  $rowAveiro2 = mysqli_fetch_assoc($resultAveiro2);

  $data = $rowAveiro2['Start_Date'];
  $hora = $rowAveiro2['Start_Time'];
  $duracao = $rowAveiro2['Duration'];
  $periodo = $rowAveiro2['Period'];
  $ton = $rowAveiro2['TON'];
  $toff = $rowAveiro2['TOFF'];
  $duracaoMan = $rowAveiro['Maintenance_Duration'];
  $tonMan = $rowAveiro['Maintenance_TON'];
  $toffMan = $rowAveiro['Maintenance_TOFF'];
  $data_uar = $rowParametros['Start_Date'];
  $hora_uar = $rowParametros['Start_Time'];
  $periodo_uar = $rowParametros['Period'];


  $umaxAveiro =  $rowAveiro['UMAX_Config'];

  $imaxAveiro = $rowAveiro['IMAX_Config'];

  $urefAveiro = $rowAveiro['UREF_Config'];

  $urefMinAveiro = $rowAveiro['UREF_MIN_Config'];

  $urefMaxAveiro = $rowAveiro['UREF_MAX_Config'];

  $systemAveiro = $rowAveiro['System'];

  $iConfigAveiro = $rowAveiro['I_Config'];




  $umaxPovoa =  $rowPovoa['UMAX_Config'];

  $imaxPovoa = $rowPovoa['IMAX_Config'];

  $urefPovoa = $rowPovoa['UREF_Config'];

  $urefMinPovoa = $rowPovoa['UREF_MIN_Config'];

  $urefMaxPovoa = $rowPovoa['UREF_MAX_Config'];

  $systemPovoa = $rowPovoa['System'];

  $iConfigPovoa = $rowPovoa['I_Config'];



  $operationModeAveiro = $rowAveiro['Operation_Mode'];

  $operationTypeAveiro = $rowAveiro['Operation_Type'];



  $operationModePovoa = $rowPovoa['Operation_Mode'];

  $operationTypePovoa = $rowPovoa['Operation_Type'];



  $srcOn = "imagens/swe.png";

  $srcOff = "imagens/swv.png";



  $srcSw1 ="imagens/sw1.png";

  $srcSw2 = "imagens/sw2.png";



  $queryCommandAveiro = "SELECT Command,CMD_Electric,CMD_Operation,CMD_Maintenance FROM `UPR_Operation` WHERE Serial_Number='$Serial_Number_Aveiro' ORDER BY Input DESC LIMIT 1";

  $resultCommandAveiro = mysqli_query($con,$queryCommandAveiro) or die(mysqli_error($con));

  $rowCommandAveiro = mysqli_fetch_assoc($resultCommandAveiro);

  $commandAveiro = $rowCommandAveiro['Command'];

  $eletricAveiro = $rowCommandAveiro['CMD_Electric'];

  $operationCmdAveiro = $rowCommandAveiro['CMD_Operation'];

  $MaintenanceAveiro = $rowCommandAveiro['CMD_Maintenance'];



  $queryCommandPovoa = "SELECT Command,CMD_Electric,CMD_Operation,CMD_Maintenance FROM `UPR_Operation` WHERE Serial_Number='$Serial_Number_Povoa' ORDER BY Input DESC LIMIT 1";

  $resultCommandPovoa = mysqli_query($con,$queryCommandPovoa) or die(mysqli_error($con));

  $rowCommandPovoa = mysqli_fetch_assoc($resultCommandPovoa);

  $commandPovoa = $rowCommandPovoa['Command'];

  $eletricPovoa = $rowCommandPovoa['CMD_Electric'];

  $operationCmdPovoa = $rowCommandPovoa['CMD_Operation'];

  $MaintenancePovoa = $rowCommandPovoa['CMD_Maintenance'];



    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTROLO</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" />
    <link rel="stylesheet" href="../css/cssdeteste3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

<!-- SCRIPTS -->

        <script src="../js/jquery-3.2.1.min.js"></script>

        <script src="../js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

        <script src="../js/jquery.timepicker.min.js"></script>

        <script src="../js/datepicker/datepicker.js"></script>

        <script src="../js/jquery-ui.js"></script>

        <!-- CSS -->

        <link rel="stylesheet" href="../css/jquery-ui.css">

        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <link rel="stylesheet" href="../css/jquery.timepicker.min.css">

        <link rel="stylesheet" href="../js/datepicker/datepicker.css">

        <style>
          input.direita { float: right; clear: both; }
          input { float: right; clear: both; }
          select { float: right; clear: both; width: 103px; height:30px; }


            .table-borderless > tbody > tr > td,

            .table-borderless > tbody > tr > th,

            .table-borderless > tfoot > tr > td,

            .table-borderless > tfoot > tr > th,

            .table-borderless > thead > tr > td,

            .table-borderless > thead > tr > th {

                border: none;           }

            .bg-primary> input{

                color: black;            }



            #infoToggler{

              cursor: hand;

              cursor: pointer;

              opacity: .9;

            }

            .infoToggler2{

              cursor: hand;

              cursor: pointer;

              opacity: .9;

            }

            #infoToggler3{

              cursor: hand;

              cursor: pointer;

              opacity: .9;

            }



            #infoToggler4{

              cursor: hand;

              cursor: pointer;

              opacity: .9;

            }

            #infoToggler5{

              cursor: hand;

              cursor: pointer;

              opacity: .9;

            }
            #infoToggler6{

              cursor: hand;

              cursor: pointer;

              opacity: .9;

            }

            </style>

            <script>





$(document).ready(function(){

  $("#periodo").val(<?php echo $periodo;?>);
  $("#duracao").val(<?php echo $duracao; ?>);
  $("#ton").val(<?php echo $ton; ?>);
  $("#toff").val(<?php echo $toff; ?>);
  $("#duracaoManutencao").val(<?php echo$duracaoMan;?>);
  $("#tonManutencao").val(<?php echo$tonMan;?>);
  $("#toffManutencao").val(<?php echo$toffMan;?>);
  $("#dataUAR").val('<?php echo$data_uar?>');
  $("#horaUAR").val('<?php echo$hora_uar?>');
  $("#periodoUAR").val('<?php echo$periodo_uar?>');




function online() {



      setInterval(function teste2(){

        $("#buttonUpdate2").trigger("click")

      }, 3000);

  };

  function repetir() {



      setInterval(function teste(){

        $("#buttonUpdate").trigger("click");


      }, 20000);

  };
  $("#buttonUpdate2").hide();
    $("#buttonUpdate2").click(function(){

        $.ajax({url: "online.php?local=ambos", success: function(data){


             }});

    });

  $("#buttonUpdate").hide();

    $("#buttonUpdate").click(function(){

        $.ajax({url: "controloMudarEstado.php", success: function(data){

            var myObj = JSON.parse(data);

            if(data.manutencaoAveiro === 1 || data.manutencaoPovoa === 1){

              $("#subManutencao").attr("class","btn btn-warning");

              $("#subManutencao").val("Aguarde...");

              $('#subManutencao').prop('disabled', true);

            }

            else if(data.manutencaoAveiro === 0 && data.manutencaoPovoa === 0){

              $("#subManutencao").attr("class","btn btn-success");

              $("#subManutencao").val("Submeter");

              $('#subManutencao').prop('disabled', false);

            }
             if(data.funcionamentoAveiro === 1){

              $("#subManutencao").attr("class","btn btn-warning");

              $("#subManutencao").val("Aguarde...");

              $('#subManutencao').prop('disabled', true);

            }
            else if(data.funcionamentoAveiro === 0){

              $("#subManutencao").attr("class","btn btn-success");

              $("#subManutencao").val("Submeter");

              $('#subManutencao').prop('disabled', false);

            }
            if(data.funcionamentoPovoa === 1){

              $("#subManutencao").attr("class","btn btn-warning");

              $("#subManutencao").val("Aguarde...");

              $('#subManutencao').prop('disabled', true);

            }
            else if(data.funcionamentoPovoa === 0){

              $("#subManutencao").attr("class","btn btn-success");

              $("#subManutencao").val("Submeter");

              $('#subManutencao').prop('disabled', false);

            }
            if(data.eletricoAveiro === 1){
               $("#subManutencao").attr("class","btn btn-warning");

              $("#subManutencao").val("Aguarde...");

              $('#subManutencao').prop('disabled', true);

            }
            else if(data.eletricoAveiro === 0){

              $("#subManutencao").attr("class","btn btn-warning");

              $("#subManutencao").val("Aguarde...");

              $('#subManutencao').prop('disabled', true);
            }

            if(data.eletricoPovoa === 1){
              $("#subManutencao").attr("class","btn btn-warning");

              $("#subManutencao").val("Aguarde...");

              $('#subManutencao').prop('disabled', true);

            }
            else if(data.eletricoPovoa === 0){

              $("#subManutencao").attr("class","btn btn-warning");

              $("#subManutencao").val("Aguarde...");

              $('#subManutencao').prop('disabled', true);
            }


          }});

      });


      online();
      repetir();

function fu(){

 var text = document.getElementById("data").value;
 var take = text.split('/');
  var mo = parseInt(take[1], 10);
 var da = parseInt(take[2], 10);
  var ye = parseInt(take[0], 10);
 var date = new Date(ye,mo-1,da);
 if (date.getFullYear() === ye && date.getMonth() + 1 === mo && date.getDate()
   ===  da) {
              var data = $("#data").val();

              var periodo = $("#periodo").val();

              var hora = $("#hora").val();

              var duracao = $("#duracao").val();

              var ton = $("#ton").val();

              var toff =  $("#toff").val();
              console.log(data);
              console.log(hora);
   $.ajax({url: "controloUpdate.php?id=1&data=" + data + "&periodo=" + periodo + "&hora=" + hora + "&duracao=" +duracao+ "&ton="+ton+"&toff="+toff+"", success: function(data){

                 var myObj = JSON.parse(data);

                  alert(myObj.result);

}

});
    } else {
    alert('Data Inválida. Tente Novamente');
  }
   }

            $("#subCortes").click(function(){


              fu();

});



$("#subManutencao").click(function(){

  var duracao = $("#duracaoManutencao").val();

  var ton = $("#tonManutencao").val();

  var toff =  $("#toffManutencao").val();

      $("#subManutencao").attr("class","btn btn-warning");

      $("#subManutencao").val("Aguarde...");

      $('#subManutencao').prop('disabled', true);


    $.ajax({url: "controloUpdate.php?id=2&duracao=" +duracao+ "&ton="+ton+"&toff="+toff+"", success: function(data){

      var myObj = JSON.parse(data);

      alert(myObj.result);

}

})});

$("#subCortesUAR").click(function(){
var data = $("#dataUAR").val();
var hora = $("#horaUAR").val();
var periodo = $("#periodoUAR").val();

//chamda ajax
//console.log(data +"-" + hora+"-"+periodo);
$.ajax({url: "controloUpdateUAR.php?id=3&data="+data+"&hora="+hora+"&periodo="+periodo+"", success: function(data){

  var myObj = JSON.parse(data);
  alert("Comando enviado com sucesso!");


}})

});
$("#uar").change(function() {
  var uar = $("#uar").val();
  $("#canal_1").prop('checked', false);
  $("#canal_2").prop('checked', false);
  $("#canal_3").prop('checked', false);
  $("#canal_4").prop('checked', false);
  $.ajax({url: "controloUpdateUAR.php?id=1&uar="+uar+"", success: function(data){

    var myObj = JSON.parse(data);

    if(myObj.ch1 === "1"){
      $("#canal_1").prop('checked', true);
    }
    if(myObj.ch2 === "1"){
      $("#canal_2").prop('checked', true);
    }
    if(myObj.ch3 === "1"){
      $("#canal_3").prop('checked', true);
    }
    if(myObj.ch4 === "1"){
      $("#canal_4").prop('checked', true);
    }
    if(myObj.amostra === "1"){
        $("#bAmostra").prop('checked', true);
    }


  }

  })});
  $("#uar").trigger("change");
$("#subManutencaoUAR").click(function(){
  var serial = $("#uar").find('option:selected').text();
  var canal_1 = 0;
  var canal_2 = 0;
  var canal_3 = 0;
  var canal_4 = 0;
  var modo = 0;
  var amostra = 0;
  var e = $("#sw6").attr("src");


    if($("#canal_1").is(':checked')){
       canal_1 = 1;
    }
    if($("#canal_2").is(':checked')){
       canal_2 = 1;
    }
    if($("#canal_3").is(':checked')){
       canal_3 = 1;
    }
    if($("#canal_4").is(':checked')){
       canal_4 = 1;
    }
    if(e === "imagens/sw1.png"){
      modo = 1;
    }else if(e === "imagens/sw2.png"){
      modo = 0;
    }

  if($("#bAmostra").is(':checked')){
      amostra = 1;
  }
  //ajax aqui
  //console.log(serial+"-"+canal_1 + "-" +canal_2 +"-"+ canal_3 + "-"+ canal_4 +"-"+ modo + "-" + pedido);
  $.ajax({url: "controloUpdateUAR.php?id=2&uar=" +serial+ "&c1="+canal_1+"&c2="+canal_2+"&c3="+canal_3+"&c4="+canal_4+"&operation="+modo+"&amostra="+amostra+"", success: function(data){

    var myObj = JSON.parse(data);
    alert("Comando enviado com sucesso!");

}

})

});
$("#infoToggler6").click(function(){

  var d = $("#sw6").attr("src");

  if(d === "imagens/sw1.png"){

  //  $("#bAmostra").attr("class","btn btn-warning");


    $("#bAmostra").prop('checked', false);
    $('#bAmostra').prop('disabled', true);
  }
  else if(d === "imagens/sw2.png"){
  //  $("#bAmostra").attr("class","btn btn-primary");


    $('#bAmostra').prop('disabled', false);
  }
});


$("#subFunAveiro").click(function(){
  var c = $("#sw4").attr("src");

  var  a = $("#sw1").attr("src");

  var b = $(".sw2").attr("src");

if(c === "imagens/swv.png"){

    var systemAveiro = 0;

  }
  else if( c === "imagens/swe.png"){

     var systemAveiro = 1;
  }

  if(b === "imagens/sw1.png"){

    var operationTypeAveiro = 1;

    var operationTypePovoa = 1;

  }

  else if(b === "imagens/sw2.png"){

    var operationTypeAveiro = 0;

    var operationTypePovoa = 0;

  }

  if(a === "imagens/sw1.png"){

    var operationModeAveiro = 1; //UREF CONSTANTE

  }

  else if(a=== "imagens/sw2.png"){

    var operationModeAveiro = 0; //IOUT CONSTANTE

  }

      $("#subFunAveiro").attr("class","btn btn-warning");

      $("#subFunAveiro").val("Aguarde...");

      $('#subFunAveiro').prop('disabled', true);

    $.ajax({url: "controloUpdate.php?id=3&operationModeAveiro=" +operationModeAveiro+ "&operationTypeAveiro="+operationTypeAveiro+"&operationTypePovoa="+operationTypePovoa+"&systemAveiro="+systemAveiro+"", success: function(data){

      var myObj = JSON.parse(data);


      alert(myObj.result);

}

})});

$("#subFunPovoa").click(function(){


var a = $("#sw5").attr("src");

  var b = $(".sw2").attr("src");

  var c = $("#sw3").attr("src");

  if(c === "imagens/sw1.png" ){

    var operationModePovoa = 1;

  }

  else if(c=== "imagens/sw2.png"){

    var operationModePovoa = 0;

  }

  if(b === "imagens/sw1.png"){

    var operationTypeAveiro = 1;

    var operationTypePovoa = 1;

  }

  else if(b === "imagens/sw2.png"){

    var operationTypeAveiro = 0;

    var operationTypePovoa = 0;

  }

if(a === "imagens/swv.png"){

    var systemPovoa = 0;

  }
  else if( a === "imagens/swe.png"){

     var systemPovoa = 1;
  }


      $("#subFunPovoa").attr("class","btn btn-warning");

      $("#subFunPovoa").val("Aguarde...");

      $('#subFunPovoa').prop('disabled', true);

    $.ajax({url: "controloUpdate.php?id=4&operationModePovoa=" +operationModePovoa+ "&operationTypeAveiro="+operationTypeAveiro+"&operationTypePovoa="+operationTypePovoa+"&systemPovoa="+systemPovoa+"", success: function(data){

      var myObj = JSON.parse(data);



      alert(myObj.result);

}

})});

$("#subParAveiro").click(function(){

  var umaxAveiro = $('#umaxAveiro').val();

  var imaxAveiro = $('#imaxAveiro').val();

  var urefAveiro = $('#urefAveiro').val();

  var urefMinAveiro = $('#urefMinAveiro').val();

  var urefMaxAveiro = $('#urefMaxAveiro').val();

  var iConfigAveiro = $('#iConfigAveiro').val();


      $("#subParAveiro").attr("class","btn btn-warning");

      $("#subParAveiro").val("Aguarde...");

      $('#subParAveiro').prop('disabled', true);

    $.ajax({url: "controloUpdate.php?id=5&umaxAveiro=" +umaxAveiro+ "&imaxAveiro="+imaxAveiro+"&urefAveiro="+urefAveiro+"&urefMinAveiro="+urefMinAveiro+"&urefMaxAveiro="+urefMaxAveiro+"&iConfigAveiro="+iConfigAveiro+"", success: function(data){

      var myObj = JSON.parse(data);


      alert(myObj.result);

}

})});

$("#subParPovoa").click(function(){

  var umaxPovoa = $('#umaxPovoa').val();

  var imaxPovoa = $('#imaxPovoa').val();

  var urefPovoa = $('#urefPovoa').val();

  var urefMinPovoa = $('#urefMinPovoa').val();

  var urefMaxPovoa = $('#urefMaxPovoa').val();

  var iConfigPovoa = $('#iConfigPovoa').val();

      $("#subParPovoa").attr("class","btn btn-warning");

      $("#subParPovoa").val("Aguarde...");

      $('#subParPovoa').prop('disabled', true);


    $.ajax({url: "controloUpdate.php?id=6&umaxPovoa=" +umaxPovoa+ "&imaxPovoa="+imaxPovoa+"&urefPovoa="+urefPovoa+"&urefMinPovoa="+urefMinPovoa+"&urefMaxPovoa="+urefMaxPovoa+"&iConfigPovoa="+iConfigPovoa+"", success: function(data){

      var myObj = JSON.parse(data);


      alert(myObj.result);

}

})});

});

                //funcao para permitir os botoes mudarem

                $(function () {

                    var src1 = "imagens/sw1.png";

                    var src2 = "imagens/sw2.png";

                    var srcOn = "imagens/swe.png";

                    var srcOff = "imagens/swv.png";



                    $("#infoToggler").click(function () {

                        var src = $('#infoToggler img').attr('src');

                        if (src === src1) {

                            $('#infoToggler img').attr('src', src2);

                        } else {

                            $('#infoToggler img').attr('src', src1);

                        }

                    });

                    $(".infoToggler2").click(function () {

                        var src = $('.infoToggler2 img').attr('src');

                        if (src === src1) {

                            $('.infoToggler2 img').attr('src', src2);

                        } else {

                            $('.infoToggler2 img').attr('src', src1);

                        }

                    });

                    $("#infoToggler3").click(function () {

                        var src = $('#infoToggler3 img').attr('src');

                        if (src === src1) {

                            $('#infoToggler3 img').attr('src', src2);

                        } else {

                            $('#infoToggler3 img').attr('src', src1);

                        }

                    });

                    $("#infoToggler4").click(function () {

                        var src = $('#infoToggler4 img').attr('src');

                        if (src === srcOn) {

                            $('#infoToggler4 img').attr('src', srcOff);

                        } else {

                            $('#infoToggler4 img').attr('src', srcOn);

                        }

                    });

                    $("#infoToggler5").click(function () {

                        var src = $('#infoToggler5 img').attr('src');

                        if (src === srcOn) {

                            $('#infoToggler5 img').attr('src', srcOff);

                        } else {

                            $('#infoToggler5 img').attr('src', srcOn);

                        }

                    });
                    $("#infoToggler6").click(function () {

                        var src = $('#infoToggler6 img').attr('src');

                        if (src === src1) {

                            $('#infoToggler6 img').attr('src', src2);

                        } else {

                            $('#infoToggler6 img').attr('src', src1);

                        }

                    });



                    // dialog é um pop up caso um valor seja introduzido errado

                    $("#dialog").dialog();

                    $("#dialog").dialog("close");



                    // dados para por o calendario em Portugues

                    $.datepicker.regional['pt'] = {clearText: 'Apagar', clearStatus: '',

                        closeText: 'Fechar', closeStatus: 'Fechar sem guardar',

                        prevText: '<Anterior', prevStatus: 'Ver mês anterior',

                        nextText: 'Seguinte>', nextStatus: 'Ver mês seguinte',

                        currentText: 'Atual', currentStatus: 'Ver mês atual',

                        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',

                            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],

                        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',

                            'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],

                        monthStatus: 'Ver outro mês', yearStatus: 'Ver outro ano',

                        weekHeader: 'Sm', weekStatus: '',

                        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],

                        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

                        dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

                        dayStatus: 'Utilizar DD como primeiro dia da semana', dateStatus: 'Escolher  DD, MM d',

                        dateFormat: 'yy/mm/dd', firstDay: 0,

                        initStatus: 'Escolher uma data', isRTL: false};

                    $.datepicker.setDefaults($.datepicker.regional['pt']);//define o calendario para portugues





                    //verificaçao se Umax Aveiro e Povoa é numero e se está dentro de 0 e 24000



                    $('#umaxAveiro').change(function () {

                        if (isNaN($('#umaxAveiro').val())) {

                            $("#dialog").dialog("open");

                        } else {

                            if ($('#umaxAveiro').val() < 0 || $('#umaxAveiro').val() > 24000) {

                                $("#dialog").dialog("open");

                            }

                        }

                    });

                    $('#umaxPovoa').change(function () {

                        if (isNaN($('#umaxPovoa').val())) {

                            $("#dialog").dialog("open");

                        } else {

                            if ($('#umaxPovoa').val() < 0 || $('#umaxPovoa').val() > 24000) {

                                $("#dialog").dialog("open");

                            }

                        }

                    });
                     $('#iConfigAveiro').change(function () {

                        if (isNaN($('#iConfigAveiro').val())) {

                            $("#dialog").dialog("open");

                        } else {

                            if ($('#iConfigAveiro').val() < 100 || $('#iConfigAveiro').val() > 5000) {

                                $("#dialog").dialog("open");

                            }

                        }

                    });

                     $('#iConfigPovoa').change(function () {

                        if (isNaN($('#iConfigPovoa').val())) {

                            $("#dialog").dialog("open");

                        } else {

                            if ($('#iConfigPovoa').val() < 100 || $('#iConfigPovoa').val() > 5000) {

                                $("#dialog").dialog("open");

                            }

                        }

                    });

                    //verificaçao se Imax Aveiro e Povoa é numero e se está dentro de 0 e 5000

                    $('#imaxAveiro').change(function () {

                        if (isNaN($('#imaxAveiro').val())) {

                            $("#dialog").dialog("open");

                        } else {

                            if ($('#imaxAveiro').val() < 0 || $('#imaxAveiro').val() > 5000) {

                                $("#dialog").dialog("open");

                            }

                        }

                    });

                    $('#imaxPovoa').change(function () {

                        if (isNaN($('#imaxPovoa').val())) {

                            $("#dialog").dialog("open");

                        } else {

                            if ($('#imaxPovoa').val() < 0 || $('#imaxPovoa').val() > 5000) {

                                $("#dialog").dialog("open");

                            }

                        }

                    });

                    //verificaçao se Uref Aveiro e Povoa é numero e se está dentro de 0 e 3000

                    $('#urefAveiro').change(function () {

                        if (isNaN($('#urefAveiro').val())) {

                            $("#dialog").dialog("open");

                            $('#urefMaxAveiro').val("");

                            $('#urefMinAveiro').val("");

                        } else if ($('#urefAveiro').val() < 750 || $('#urefAveiro').val() > 1900) {

                            $("#dialog").dialog("open");

                            $('#urefMaxAveiro').val("");

                            $('#urefMinAveiro').val("");

                        } else {

                            var urefMaxAveiro = ($('#urefAveiro').val() * 1.5).toFixed(0);

                            var urefMinAveiro = ($('#urefAveiro').val() * 0.5).toFixed(0);

                            $('#urefMaxAveiro').val(urefMaxAveiro);

                            $('#urefMinAveiro').val(urefMinAveiro);

                        }

                    });

                    $('#urefPovoa').change(function () {

                        if (isNaN($('#urefPovoa').val())) {

                            $("#dialog").dialog("open");

                            $('#urefMaxPovoa').val("");

                            $('#urefMinPovoa').val("");

                        } else if ($('#urefPovoa').val() < 0 || $('#urefPovoa').val() > 3000) {

                            $("#dialog").dialog("open");

                            $('#urefMaxPovoa').val("");

                            $('#urefMinPovoa').val("");

                        } else {

                            var urefMaxPovoa = ($('#urefPovoa').val() * 1.5).toFixed(0);

                            var urefMinPovoa = ($('#urefPovoa').val() * 0.5).toFixed(0);

                            $('#urefMaxPovoa').val(urefMaxPovoa);

                            $('#urefMinPovoa').val(urefMinPovoa);

                        }

                    });

                    //configuracao das setas de selecao da hora

                    $("#data").datepicker();

                    $('#hora').timepicker({ 'timeFormat': 'H:i:s' });

                    $("#dataUAR").datepicker();

                    $('#horaUAR').timepicker({ 'timeFormat': 'H:i:s' });
                });

            </script>

</head>

<body>

    <div class="container" id="container">

        <aside class="sidebar" id="mySidebar" style="left:0;margin-left:0;position:absolute">
            <div class="top" id="main" >
                <div class="menu">
                <h2 style="color:white; display: none;" id="nomeProjeto">PROCAT</h2>
                    <i class="material-symbols-sharp" style="color:white" onclick="openNav()" id="abrirside">menu</i>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                        <span class="material-symbols-sharp" id="closeside" style="display: none; color: white; justify-content: center;">close</span>
                    </a>
                </div>
             <!--   <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>  -->

            </div>
            <div class="sidebar">
              <a href="index.php" class="active">
              <span class="material-symbols-sharp">dashboard</span>
                  <h3 id="dashboard">Monitorização</h3>
              </a>
              <a href="mapa.php">
                  <span class="material-symbols-sharp">distance</span>
                  <h3 id="localizacao">Localização</h3>
              </a>
              <a href="graficos.php">
                  <span class="material-symbols-sharp">query_stats</span>
                  <h3 id="consulta">Consulta</h3>
              </a>
              <a href="historico.php">
                  <span class="material-symbols-sharp">history</span>
                  <h3 id="historico">Histórico</h3>
              </a>
              <a href="controlo.php">
                  <span class="material-symbols-sharp">toggle_on</span>
                  <h3 id="controlo">Controlo</h3>
              </a>
              <a href="gestao.php">
                  <span class="material-symbols-sharp">manage_accounts</span>
                  <h3 id="profile">Gestão</h3>
              </a>
              <a href="logout.php" id="traco">
                  <span class="material-symbols-sharp">logout</span>
                  <h3 id="logout">LOGOUT</h3>
              </a>
            </div>
        </aside>
        <!-- fim da sidebar -->
        <main style="height:100%;top: 0;left:15%;position:absolute" >
            <h1 class="titulo">Controlo</h1>

            <br><br><br>

<!-- tabelas -->

<button id="buttonUpdate">.</button>
<button id="buttonUpdate2">.</button>
<h3 align="center">Unidades de Proteção Catódica (UPC)</h3>
<div align="center" class="container col-sm-6">

    <h3 align="center">Parâmetros de Corte</h3>

    <br>



    <form target="">

        <table class="table table-borderless">

            <tbody>

                <tr>

                    <td class="bg-success" > Data

                        <input type="text" id="data" size="8" value="<?php echo $data; ?>"></input>

                    </td>

                    <td  class="bg-success">Hora

                        <input id="hora" type="text" name="timepicker" class="timepicker" size="8" value="<?php echo $hora; ?>"></input>

                    </td>



                </tr>

                <tr>

                     <td  class="bg-success">

                        Periodo(h)  <select name="periodo" id="periodo" >

                            <option value="1">1</option>

                            <option value="3">3</option>

                            <option value="6">6</option>

                            <option value="12">12</option>

                            <option value="24">24</option>

                            <option value="48">48</option>

                            <option value="96">96</option>

                            <option value="168">168</option>

                        </select>

                    </td>

                    <td  class="bg-success">Duração(min)

                        <select name="duracao" id="duracao">

                            <option value="5">5</option>

                            <option value="10">10</option>

                            <option value="15">15</option>

                            <option value="20">20</option>

                            <option value="25">25</option>

                            <option value="30">30</option>

                            <option value="35">35</option>

                            <option value="40">40</option>

                            <option value="45">45</option>

                            <option value="50">50</option>

                            <option value="55">55</option>

                            <option value="60">60</option>

                        </select>

                    </td>



                </tr>

                <tr>

                    <td  class="bg-success"> Ton(seg)

                        <select name="ton" id="ton">

                            <option value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                            <option value="4">4</option>

                            <option value="5">5</option>

                            <option value="6">6</option>

                            <option value="7">7</option>

                            <option value="8">8</option>

                            <option value="9">9</option>

                            <option value="10">10</option>

                        </select>

                    </td>

                    <td  class="bg-success">Toff(seg)

                        <select name="toof" id="toff">

                            <option value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                            <option value="4">4</option>

                            <option value="5">5</option>

                            <option value="6">6</option>

                            <option value="7">7</option>

                            <option value="8">8</option>

                            <option value="9">9</option>

                            <option value="10">10</option>

                        </select>

                    </td>

                </tr>
                <tr>
                  <td class="bg-success" COLSPAN=2 >

                    <button type="submit" class="btn btn-success" id="subCortes" style="margin:auto;display:block">Submeter</button>
                  </td>


                </tr>
            </tbody>


        </table>

    </form>





</div>

<div style="text-align:center;" class="container col-sm-6">

    <h3 align="center">Manutenção</h3>

    <br>



        <table align="center" class="table table-borderless">

            <tbody>

                <tr>

                    <td class="bg-warning" style="text-align:center">Duração(h)

                        <select name="duracao" id="duracaoManutencao">

                            <option value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                            <option value="4">4</option>

                            <option value="5">5</option>

                            <option value="6">6</option>

                            <option value="7">7</option>

                            <option value="8">8</option>

                            <option value="9">9</option>

                            <option value="10">10</option>

                            <option value="11">11</option>

                            <option value="12">12</option>

                        </select>

                    </td>

                </tr>

                <tr>



                     <td class="bg-warning" style="text-align:center">Ton(seg)

                        <select name="ton" id="tonManutencao">

                            <option value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                            <option value="4">4</option>

                            <option value="5">5</option>

                            <option value="6">6</option>

                            <option value="7">7</option>

                            <option value="8">8</option>

                            <option value="9">9</option>

                            <option value="10">10</option>

                        </select>

                    </td>

                </tr>

                <tr>

                    <td class="bg-warning" style="text-align:center">Toff(seg)

                        <select name="toof" id="toffManutencao">

                            <option value="1">1</option>

                            <option value="2">2</option>

                            <option value="3">3</option>

                            <option value="4">4</option>

                            <option value="5">5</option>

                            <option value="6">6</option>

                            <option value="7">7</option>

                            <option value="8">8</option>

                            <option value="9">9</option>

                            <option value="10">10</option>

                        </select>

                    </td>

                </tr>

                <tr>
                    <?php  if($MaintenancePovoa == 0 && $MaintenanceAveiro == 0){?>
                    <td class="bg-warning" COLSPAN="2"><button type="submit" class="btn btn-success" id="subManutencao" style="margin:auto;display:block">Submeter</button></td>
                  <?php } else if($MaintenancePovoa == 1 && $MaintenanceAveiro == 1){ ?>

                     <td class="bg-warning" COLSPAN="2"><button type="submit" class="btn btn-warning" id="subManutencao" style="margin:auto;display:block" disabled>Aguarde...</button></td>
                   <?php } ?>

                </tr>

            </tbody>

        </table>

        <br>

        <br>





</div>

<div class="container col-sm-12">

    <h3 align="center">Parâmetros de Funcionamento</h3>

    <div class="container col-sm-6">

        <h4>TR Aveiro</h4>


        <table class="table table-borderless">

          <tr class="bg-info">

              <td>Sistema Ligado</td>

              <td>

                  <div id="infoToggler4">

                      <img id="sw4" src="<?php if($systemAveiro == 1){

                        echo "imagens/swe.png";

                      }

                      else if($systemAveiro == 0){

                        echo "imagens/swv.png";

                      }?>" width="60" height="30">

                  </div>

              </td>

              <td>Sistema Desligado</td>

          </tr>

            <tr class="bg-info">

                <td>Manual</td>

                <td>

                    <div id="infoToggler">

                        <img id="sw1" src="<?php if($operationModeAveiro == 1){

                          echo $srcSw1;

                        }

                        else if($operationModeAveiro == 0){

                          echo $srcSw2;

                        }?>" width="60" height="30">

                    </div>

                </td>

                <td>Automático</td>

            </tr>

            <tr class="bg-info">

                <td>Normal</td>

                <td>

                    <div class="infoToggler2">

                        <img class="sw2" src="<?php if($operationTypeAveiro == 1){

                          echo $srcSw1;

                        }

                        else if($operationTypeAveiro == 0){

                          echo $srcSw2;

                        }?>" width="60" height="30">

                    </div>

                </td>

                <td>Manutenção</td>

            </tr>
            <tr>

           <?php if($operationCmdAveiro == 0){ ?>
        <td class="bg-info" COLSPAN="3"><button class="btn btn-success" id="subFunAveiro" style="margin:auto;display:block">Submeter</button></td>
        <?php } else if($operationCmdAveiro == 1){ ?>
        <td class="bg-info" COLSPAN="3"><button class="btn btn-warning" id="subFunAveiro" style="margin:auto;display:block" disabled>Aguarde...</button> </td>
<?php } ?>


            </tr>

        </table>

        <br>


    </div>

    <div class="container col-sm-6">

        <h4>TR Povoa</h4>


        <table class="table table-borderless">

          <tr class="bg-danger">

              <td>Sistema Ligado</td>

              <td>

                  <div id="infoToggler5">

                      <img id="sw5" src="<?php if($systemPovoa== 1){


                        echo "imagens/swe.png";

                      }

                      else if($systemPovoa ==0){

                        echo "imagens/swv.png";

                      }?>" width="60" height="30">

                  </div>

              </td>

              <td>Sistema Desligado</td>

          </tr>

            <tr class="bg-danger">



                <td>Manual</td>

                <td>

                    <div id="infoToggler3">

                        <img id="sw3" src="<?php if($operationModePovoa == 1){

                          echo $srcSw1;

                        }

                        else if($operationModePovoa == 0){

                          echo $srcSw2;

                        }?>" width="60" height="30">

                    </div>

                </td>

                <td>Automático</td>

            </tr>

            <tr class="bg-danger">

                <td>Normal</td>

                <td>

                    <div class="infoToggler2">

                        <img class="sw2"src="<?php if($operationTypePovoa == 1){

                          echo $srcSw1;

                        }

                        else if($operationTypePovoa == 0){

                          echo $srcSw2;

                        }?>" width="60" height="30">

                    </div>

                </td>

                <td>Manutenção</td>

            </tr>
            <tr>

            <?php if($operationCmdPovoa == 0){ ?>
        <td class="bg-danger" COLSPAN="3"><button id="subFunPovoa" class="btn btn-success" style="margin:auto;display:block">Submeter</button></td>
        <?php } else if($operationCmdPovoa == 1){ ?>
         <td class="bg-danger" COLSPAN="3"><button id="subFunPovoa" class="btn btn-warning" style="margin:auto;display:block" disabled>Aguarde...</button></td>
       <?php } ?>

            </tr>

        </table>



    </div>

</div>

<div type="submit" id="dialog" title="Erro">

    <p>Valor introduzido é inválido. Por favor volte a tentar.</p>

</div>

<div class="container col-sm-12" >

    <h3 align="center">Parâmetros Elétricos </h3>

    <div class="container col-sm-6">

        <h4>TR Aveiro</h4>

        <table class="table table-borderless">

            <tbody>

                <tr class="bg-warning">

                    <td>Umax(mV)

                        <input class="direita" id="umaxAveiro" type="text" placeholder="0-24000" maxlength="5" size="5" style="width:70px;" value="<?php echo $umaxAveiro ?>"/>

                    </td>

                    <td>UrefMin(mV)

                        <input class="direita" id="urefMinAveiro" disabled="disabled" type="text" size="8" style="width:70px;" value="<?php echo $urefMinAveiro ?>"/>

                    </td>

                </tr>

                <tr class="bg-warning">

                    <td>Imax(mA)

                        <input class="direita" id="imaxAveiro" type="text" placeholder="0-5000" maxlength="4" size="5" style="width:70px;" value="<?php echo $imaxAveiro ?>"/>

                    </td>

                    <td>Uref(mV)

                        <input class="direita" id="urefAveiro" type="text" placeholder="750-1900" maxlength="4" size="5" style="width:70px;" value="<?php echo $urefAveiro ?>"/>

                    </td>

                </tr>

                <tr class="bg-warning">

                    <td>Uconfig(mV)
                        <input class="direita" id="iConfigAveiro" type="text" placeholder="100-5000" maxlength="4" size="5" style="width:70px;" value="<?php echo $iConfigAveiro ?>"/>

                    </td>



                     <td>UrefMax(mV)

                        <input class="direita" id="urefMaxAveiro" disabled="disabled" type="text" size="8" style="width:70px;" value="<?php echo $urefMaxAveiro ?>"/>

                    </td>

                </tr>
                <tr>

                <?php if($eletricoAveiro == 0){ ?>
        <td class="bg-warning" COLSPAN="2"><button id="subParAveiro" class="btn btn-success" style="margin:auto;display:block">Submeter</button></td>
        <?php }else if($eletricoAveiro == 1){ ?>
          <td class="bg-warning" COLSPAN="2"><button id="subParAveiro" class="btn btn-warning" style="margin:auto;display:block" disabled>Aguarde...</button></td>
        <?php } ?>
                </tr>

            </tbody>

        </table>

    </div>

    <div class="container col-sm-6">

        <h4>TR Povoa</h4>

        <table class="table table-borderless">

            <tbody>

                <tr class="bg-success">

                    <td>Umax(mV)

                        <input class="direita" id="umaxPovoa" type="text" placeholder="0-24000" maxlength="5" size="5" style="width:70px;" value="<?php echo $umaxPovoa ?>"></input>

                    </td>

                    <td>UrefMin(mV)

                        <input class="direita" id="urefMinPovoa" type="text" disabled="disabled" size="8" style="width:70px;" value="<?php echo $urefMinPovoa ?>"></input>

                    </td>

                </tr>

                <tr class="bg-success">

                    <td> Imax(mA)

                        <input class="direita" id="imaxPovoa" type="text" placeholder="0-5000" maxlength="4" size="5" style="width:70px;" value="<?php echo $imaxPovoa ?>" align="right"></input>

                    </td>

                      <td>Uref(mV)

                        <input class="direita" id="urefPovoa" type="text" placeholder="0-3000" maxlength="4" size="5" style="width:70px;" value="<?php echo $urefPovoa ?>" align="right"></input>

                    </td>

                </tr>

                <tr class="bg-success">

                  <td>Uconfig(mV)
                        <input class="direita" id="iConfigPovoa" type="text" placeholder="100-5000" maxlength="4" size="5" style="width:70px;" value="<?php echo $iConfigPovoa ?>" align="right"/>

                    </td>

                     <td>UrefMax(mV)

                        <input class="direita" id="urefMaxPovoa" type="text" disabled="disabled" size="8" style="width:70px;" value="<?php echo $urefMaxPovoa ?>" align="right"></input>

                    </td>

                </tr>
                <tr>

            <?php if($eletricoPovoa == 0){ ?>
            <td class="bg-success" COLSPAN="2"><button type="submit" id="subParPovoa" class="btn btn-success" style="margin:auto;display:block">Submeter</button>
            <?php } else if($eletricoPovoa == 1){ ?>
           <td class="bg-success" COLSPAN="2"><button type="submit" id="subParPovoa" class="btn btn-warning" style="margin:auto;display:block" disabled>Aguarde...</button></td>
        <?php } ?>

                </tr>


            </tbody>

        </table>

        <br><br>

    </div>

    <br></div>
    <div align="center" >

        <h3 align="center">Unidades de Aquisição Remota (UAR)</h3>
</div>
<br>
<div class="col-sm-6">
<h3 align="center">Parâmetros de Corte</h3>
<br>
<table align="center" class="table table-borderless">



    <tr>

        <td class="bg-success" style="text-align:center"> Data

            <input type="text" id="dataUAR" size="8"></input>

        </td>
</tr><tr>
        <td  class="bg-success" style="text-align:center">Hora

            <input id="horaUAR" type="text" name="timepicker" class="timepicker" size="8"></input>

        </td>
</tr><tr>
      <td class="bg-success" style="text-align:center"> Periodo(h) <select name="periodoUAR" id="periodoUAR">

          <option value="1">1</option>

          <option value="3">3</option>

          <option value="6">6</option>

          <option value="12">12</option>

          <option value="24">24</option>

          <option value="48">48</option>

          <option value="96">96</option>

          <option value="168">168</option>

      </select></td>


    </tr>

      <td class="bg-success" COLSPAN=2 >

        <button type="submit" class="btn btn-success" id="subCortesUAR" style="margin:auto;display:block">Submeter</button>
      </td>


    </tr>
  </table>
</div>
<div style="text-align:center;" class="container col-sm-6">

    <h3 align="center">Operação</h3>

    <br>



        <table align="center" class="table table-borderless" >

            <tbody>
              <tr>
                <td class="bg-warning" > UAR <select name="uar" id="uar" style="width:130px;">

                    <option value="1">UAR1-Aveiro</option>

                    <option value="2">UAR2-Povoa</option>

                    <option value="3">UAR3-Cires</option>



                </select></td>
                <td class="bg-warning" ></td>

                        <td class="bg-warning" style="text-align:right"><label style="font-weight: normal;"><input type="checkbox" id="bAmostra" value="" disabled>Amostra&nbsp;&nbsp;</lavel></td>

              </tr>

                <tr>

                    <td class="bg-warning" style="font-weight: normal;">

<label style="font-weight: normal;"><input type="checkbox" id="canal_1" value="">Canal 1&nbsp;&nbsp;</label>


<label style="font-weight: normal;"><input type="checkbox" id="canal_2" value="">Canal 2&nbsp;&nbsp;</label></td>
<td class="bg-warning"></td>

<td class="bg-warning" style="text-align:right"><label style="font-weight: normal;"><input  type="checkbox" id="canal_3" value="">Canal 3&nbsp;&nbsp;</label>


<label style="font-weight: normal;"><input  type="checkbox" id="canal_4" value="">Canal 4&nbsp;&nbsp;</label></td>






                </tr>

                <tr >
                <td class="bg-warning" >Normal</td>

                <td class="bg-warning" >

                    <div id="infoToggler6">

                        <img align id="sw6" src="<?php if($operationModeDemo == 1){

                          echo $srcSw1;

                        }

                        else if($operationModeDemo == 0){

                          echo $srcSw2;

                        }?>" width="60" height="30">

                    </div>

                </td>

                <td class="bg-warning" style="text-align:right">Manutenção</td>
              </tr>


                <tr>


                    <td class="bg-warning"></td>
                     <td class="bg-warning"><button type="submit" class="btn btn-success" id="subManutencaoUAR" style="margin:auto;display:block">Submeter</button></td>
                   <td class="bg-warning"></td>


                </tr>

            </tbody>

        </table>

        <br><br><br>

        <br>

        </main>
        <!--Fim da main-->

    </div>



    <script src="../js/index3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>
<?php } ?>