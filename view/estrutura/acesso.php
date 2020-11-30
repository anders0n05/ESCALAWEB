<!DOCTYPE HTML>
<html>
    <head>
        <title>Escalasoft Tecnologia - Currículos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
        <!-- Bootstrap Core CSS -->
        <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
        <!-- font CSS -->
        <!-- font-awesome icons -->
        <link href="../tecnologia/css/font-awesome.css" rel="stylesheet"> 
        <!-- //font-awesome icons -->
        <!-- js-->
        <script src="../tecnologia/js/jquery-1.11.1.min.js"></script>
        <script src="../tecnologia/js/modernizr.custom.js"></script>
        <!-- Custom -->
        <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
        <script src="../tecnologia/js/bootstrap-show-password.js"></script>    
    </head> 
    
    <body class="fundoAzul" id="bodyFullScreen">
        <div class="main-content">
            <?php
            include_once('../../model/estrutura/loginModal.php');
            ?>
            <div>

                <div class="main-page login-page  FlexContainer">
                    <img src="../tecnologia/img/logologin.png" class="logologin" alt="Escalasoft tecnologia">
                    <br>
                    <div class="login-body FlexItem">
                        <form method="POST" action="../../controller/estrutura/LoginControllerCurriculo.php">
                            <div class="inner-addon left-addon pullBottomLogin">
                                <i class="icone fa fa-user"></i> 
                                <input type="text"  name="usuario" value="" id="usuario" class="form-control" placeholder="CPF" required>
                            </div>
                            <div class="inner-addon left-addon">
                                <i class="icone fa fa-lock"></i> 
                                <input type="password" name="senha" id="senha" style="border-right:none;" data-toggle="password" class="form-control" data-placement="after" placeholder="Senha" required> 
                            </div>
                            <input type="submit" name="entrar" value="Entrar">
                            <a class="botaoCadastrar" href="../estrutura/cadastrar.php" title="Cadastro de acesso">Cadastre-se</a>
                            <a class="botaoCadastrar" href="../estrutura/novasenhacurriculo.php" title="Esqueceu sua senha?">Esqueceu sua senha?</a>
                        </form>
                    </div>
                </div>
            </div>
            <!--footer -->
            <div class="footer">
                <p></p>
            </div>
            <!--//footer-->
        </div>
        <script src="../tecnologia/js/classie.js"></script>
        <script src="../tecnologia/js/jquery.nicescroll.js"></script>
        <script src="../tecnologia/js/bootstrap.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script>
            function focosenha() {
                $('#senha').focus();
            }
            $(function () {
               $('#usuario').mask('000.000.000-00');
            });
        </script>
    </body>
</html>