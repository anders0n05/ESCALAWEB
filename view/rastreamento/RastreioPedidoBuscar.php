<?php
include_once('../../controller/tecnologia/Sistema.php');

$connect = Sistema::getConexao();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Escalasoft Tecnologia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
        <!-- Bootstrap Core CSS -->
        <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
        <link href="../tecnologia/css/styleCustom.css" rel='stylesheet' type='text/css' />
        <!-- font CSS -->
        <!-- font-awesome icons -->
        <link href="../tecnologia/css/font-awesome.css" rel="stylesheet"> 
        <!-- //font-awesome icons -->
        <!-- js-->
        <script src="../tecnologia/js/jquery-1.11.1.min.js"></script>
        <script src="../tecnologia/js/modernizr.custom.js"></script>

        <script>

            $(function () {
                let campoLogo = $("#LOGO");
                let campoH1Logo = $("#H1LOGO");
                campoLogo.on("error", 
                    function(){
                        document.getElementById("LOGO").remove();
                        
                        $.ajax({
                            url: "../../controller/rastreamento/Pedido.php",
                            method: "POST",
                            dataType: "JSON",
                            data: {
                                "ACAO" : "getPrimeiraEmpresa"
                            },
                            success: function (retorno) {    
                                campoH1Logo.append(retorno.APELIDOPRIMEIRAEMPRESA);
                            },
                            error: function(retorno){
                                campoH1Logo.append("Escalasoft tecnologia");
                            }
                        });
                    });

                campoLogo.attr("src", "../tecnologia/img/logo.png");
            });
                
        </script>

    </head> 
    <body class="fundoAzul" id="bodyFullScreen">
        <div class="main-content">
            <!-- main content start-->
            <div class="main-page">
                <div class="rastreioForm">
                    <div class="col-sm-3 centering-v" id="formRastreio">
			<input type="hidden" id="RASTREAMENTO" value="<?php echo $_GET['r'] ?>" >
	                <input type="hidden" id="HANDLE" >
        	        <h1 style="text-align: center;" id="H1LOGO"></h1>
                        <img id="LOGO" width="80%" class="img-responsive" alt="Escalasoft tecnologia">
                        <br>
                        <p class="text-right" style="font-size: 15px;">Acompanhe o rastreamento <br>de todas as informações sobre seu <br> Pedido de rastreamento</p>
                        <br>
                        <form method="get" id="FormRastreioPedidoBuscar" action="RastreioPedidoVisualizar.php">
                            <input type="text" name="r" name="rastreamento" style="border-radius: 3px; font-size: 16px;" id="rastreamento" class="form-control" placeholder="Informe seu código de rastreamento" required>
                            <br>
                            <input type="submit" name="enviar"  class="btn btn-default" style="float: right; font-size: 15px; border-radius: 3px;" value="Enviar">
                        </form>
                        <div id="retornoRastreio">
                        <?php
                        if (isset($_SESSION['retorno'])) {
                            echo $_SESSION['retorno'];
                            unset($_SESSION['retorno']);
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-sm-9" id="conteudoRastreio" style="margin-right: 0;">
                        <div class="row">
                        </div>
                    </div>
                </div>
                <!--footer -->
                <div class="col-md-3 col-sm-3 text-center">
                    <div style="color: white; bottom: 0; position: fixed; font-size: 15px; width: 100%">
                        <a href="http://www.escalasoft.com.br/" target="_blank" style="color: white;"><p>Escalasoft tecnologia</p></a>
                    </div>
                    <div style="color: white; bottom: 0; position: absolute; font-size: 15px; width: 100%">
                        <a href="http://www.escalasoft.com.br/" target="_blank" style="color: white;">
		                <img src="../tecnologia/img/logologin.png" style="margin-left: 27%;" id="LOGOESCALA" width="40%" class="img-responsive" alt="Escalasoft tecnologia">
		            </a>
                    </div>
                </div>
                <!--//footer-->
            </div>
        </div>
        <!-- Classie -->
        <script src="../tecnologia/js/classie.js"></script>
        <!--scrolling js-->
        <script src="../tecnologia/js/jquery.nicescroll.js"></script>
        <!--script src="../tecnologia/js/script.js"></script-->
        <!--//scrolling js-->
        <!-- Bootstrap Core JavaScript -->
        <script src="../tecnologia/js/bootstrap.js"></script>
    </body>
</html>