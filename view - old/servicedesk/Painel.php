<?php
include_once('../../controller/tecnologia/Sistema.php');

if (!isset($_SESSION['usuario']) and ! isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}// not isset sessions of login
else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
    <title>Painel de Visualização</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../tecnologia/css/bootstrap3/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/datatable/datatables.min.css" />
    <!-- CSS do Painel -->
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/painel.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="top fixed-top"> 
            <div class="row">
                <div class="col-md-1">
                    <div class="panel verde">
                        <div class="panel-heading">Atual</div>
                        <div class="panel-body" id="atualcima"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel preto">
                        <div class="panel-heading">Inicial</div>
                        <div class="panel-body" id="inicialcima"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel azul">
                        <div class="panel-heading">Novos</div>
                        <div class="panel-body" id="novoscima"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel amarelo">
                        <div class="panel-heading">Devolução</div>
                        <div class="panel-body" id="devolucaocima"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel verde">
                        <div class="panel-heading">Liberado</div>
                        <div class="panel-body" id="liberadocima"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel laranja">
                        <div class="panel-heading">SLA Vencido</div>
                        <div class="panel-body" id="slavencidocima"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel vermelho">
                        <div class="panel-heading">Crítico</div>
                        <div class="panel-body" id="criticocima"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel preto">
                        <div class="panel-heading">Retrabalho</div>
                        <div class="panel-body" id="porcentoretrabalhocima"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="recursos" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Recurso</th>
                            <th class="text-center">Ok</th>
                            <th class="text-center">Dev</th>
                            <th class="text-center">Hrs</th>
                            <th class="text-center">Retr</th>
                            <th>Cliente</th>
                            <th class="text-center">SD</th>
                            <th class="text-center">Hrs</th>
                            <th class="text-center">SLA</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bottom fixed-bottom">
            <div class="row">
                <div class="col-md-1">
                    <div class="panel verde">
                        <div class="panel-heading">Atual</div>
                        <div class="panel-body" id="atualbaixo"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel preto">
                        <div class="panel-heading">Inicial</div>
                        <div class="panel-body" id="inicialbaixo"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel azul">
                        <div class="panel-heading">Novos</div>
                        <div class="panel-body" id="novosbaixo"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel amarelo">
                        <div class="panel-heading">Correção</div>
                        <div class="panel-body" id="correcaobaixo"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel verde">
                        <div class="panel-heading">Liberado</div>
                        <div class="panel-body" id="liberadobaixo"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel laranja">
                        <div class="panel-heading">SLA Vencido</div>
                        <div class="panel-body" id="slavencidobaixo"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel vermelho">
                        <div class="panel-heading">Crítico</div>
                        <div class="panel-body" id="criticobaixo"></div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="panel preto">
                        <div class="panel-heading">Retrabalho</div>
                        <div class="panel-body" id="porcentoretrabalhobaixo"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <audio id="bling" src="../../model/servicedesk/painel/bling.mp3" type="audio/mp3">
    <!-- jQuery -->
    <script type="text/javascript" src="../tecnologia/js/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="../tecnologia/js/bootstrap3/bootstrap.min.js"></script>
    <!-- CountUp -->
    <script type="text/javascript" src="../tecnologia/js/countup/countup.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="../tecnologia/js/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../tecnologia/js/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- MomentJS -->
    <script type="text/javascript" src="../tecnologia/js/momentjs/moment.js"></script>
    <script type="text/javascript" src="../tecnologia/js/momentjs/moment-duration-format.js"></script>
    <!-- SweetAlert -->
    <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
    <!-- Scripts -->
    <script type="text/javascript" src="../tecnologia/js/painel.js"></script>
</body>

</html>
    <?php
}