<?php

function formataValores($dollars) {
    $formatted = number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2);
    return $dollars < 0 ? "({$formatted})" : "{$formatted}";
}

function tirarAcentos($string) {
    return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
}

function parametros($stringparametro) {
    $retornoparametro = str_replace("@PESSOAUSUARIOLOGADO", $_SESSION['pessoa'], $stringparametro);
    $retornoparametro = str_replace("@USUARIOLOGADO", $_SESSION['handleUsuario'], $retornoparametro);
    $retornoparametro = str_replace("@USUARIO", $_SESSION['handleUsuario'], $retornoparametro);
    $retornoparametro = str_replace("@FILIALLOGADA", $_SESSION['filial'], $retornoparametro);
    $retornoparametro = str_replace("@FILIAL", $_SESSION['filial'], $retornoparametro);
    $retornoparametro = str_replace("@EMPRESALOGADA", $_SESSION['empresa'], $retornoparametro);
    $retornoparametro = str_replace("@EMPRESA", $_SESSION['empresa'], $retornoparametro);
    //$retornoparametro = str_replace("@REFERENCIAPAPELUSUARIO", $_SESSION['referenciaPapelUsuario'], $retornoparametro);
    $retornoparametro = str_replace("@EXECUTANDOPELATELAPRINCIPAL", "S", $retornoparametro);

    return $retornoparametro;
}

$queryPainel = $connect->prepare("SELECT A.ORDEM ORDEM,
										   A.REFERENCIA REFERENCIA,
										   A.TITULOREDUZIDO TITULOREDUZIDO,
										   B.TITULOREDUZIDO TITULOREDUZIDODEFAULT,
										   B.HANDLE HANDLE  
			  FROM MS_PAPELPAINELINDICADOR A  
					  INNER JOIN BI_PAINEL B ON B.HANDLE = A.PAINELINDICADOR  
									 WHERE A.PAPEL = '" . $papel . "'
									   AND B.STATUS = 4  
									ORDER BY A.ORDEM
							 ");
$queryPainel->execute();
$queryPainelTabs = $connect->prepare("SELECT A.ORDEM ORDEM,
										   B.TITULOREDUZIDO TITULOREDUZIDODEFAULT,
										   B.HANDLE HANDLE  
			  FROM MS_PAPELPAINELINDICADOR A  
					  INNER JOIN BI_PAINEL B ON B.HANDLE = A.PAINELINDICADOR  
									 WHERE A.PAPEL = '" . $papel . "'
									   AND B.STATUS = 4  
									ORDER BY A.ORDEM
							 ");
$queryPainelTabs->execute();

$j = 0;
?>

<div class="row">
    <div id="carousel-mobile" class="carousel slide carousel-mobile" data-ride="carousel" data-interval="false">
        <div class="carousel-inner" role="listbox">
            <?php
            $active = "active";

            while ($rowPainel = $queryPainel->fetch(PDO::FETCH_ASSOC)) {
                $ordem = $rowPainel['ORDEM'];
                $referencia = $rowPainel['REFERENCIA'];
                $tituloreduzido = $rowPainel['TITULOREDUZIDO'];
                $tituloreduzidodefault = $rowPainel['TITULOREDUZIDODEFAULT'];
                $handlePainel = $rowPainel['HANDLE'];
                ?>

                <?php
                $queryPainelComponente = $connect->prepare("SELECT  A.HANDLE,
													A.NOME NOMECOMPONENTE, 
													B.NOME TIPO ,
													B.HANDLE TIPOHANDLE,
													A.STATUS,
													A.ALTURA,
													A.LARGURA,
													A.QUANTIDADEREGISTRO,
													A.SQL,
													A.EHEXIBIRTITULO,
													A.TITULOVARIAVEL,
													A.TITULOFIXO,
													A.EHEXIBIRRODAPE,
													A.RODAPEVARIAVEL,
													A.RODAPEFIXO,
													A.TIPOMEDIDOR,
													A.VALORMINIMOMEDIDOR,
													A.VALORMAXIMOMEDIDOR,
													A.VALORMEDIDOR,
													A.TIPOGRAFICO,
													A.EHEXIBIRLEGENDAGRAFICO,
													A.EHEXIBIRVALORGRAFICO,
													A.ORGANIZARREGISTRO,
													A.ALTURA,
													A.LARGURA,
													A.POSICAOX,
													A.POSICAOY,
													D.SQL SQLTITULOVARIAVEL,
													D.SQLORACLE SQLORACLETITULOVARIAVEL
						   FROM BI_PAINELCOMPONENTE A
				  LEFT JOIN BI_TIPOPAINELCOMPONENTE B ON A.TIPO = B.HANDLE 
				  			   INNER JOIN BI_PAINEL C ON C.HANDLE = A.PAINEL
				  FULL JOIN MS_VARIAVEL D ON D.HANDLE = A.TITULOVARIAVEL
											  WHERE A.PAINEL = '" . $handlePainel . "'
											  	AND A.STATUS = 2
												AND C.STATUS = 4
												AND A.ALTURA > 0
												AND A.LARGURA > 0
												
										  ORDER BY  A.PAINEL, A.POSICAOX, A.POSICAOY ASC
							 ");
                //AND A.EHUTILIZADO = 'S'
                $queryPainelComponente->execute();

                while ($rowPainelComponente = $queryPainelComponente->fetch(PDO::FETCH_ASSOC)) {
                    $handleComponente = $rowPainelComponente['HANDLE'];
                    $nomeComponente = $rowPainelComponente['NOMECOMPONENTE'];
                    $tipoComponente = $rowPainelComponente['TIPO'];
                    $tipoComponenteHandle = $rowPainelComponente['TIPOHANDLE'];
                    $statusComponente = $rowPainelComponente['STATUS'];
                    $quantidaderegistroComponente = $rowPainelComponente['QUANTIDADEREGISTRO'];
                    $sqlComponenteAcentos = parametros($rowPainelComponente['SQL']);
                    $ehexibirtitulo = $rowPainelComponente['EHEXIBIRTITULO'];
                    $titulovariavel = $rowPainelComponente['TITULOVARIAVEL'];
                    $titulofixo = $rowPainelComponente['TITULOFIXO'];
                    $ehexibirrodape = $rowPainelComponente['EHEXIBIRRODAPE'];
                    $rodapevariavel = $rowPainelComponente['RODAPEVARIAVEL'];
                    $rodapefixo = $rowPainelComponente['RODAPEFIXO'];
                    $tipomedidor = $rowPainelComponente['TIPOMEDIDOR'];
                    $valorminimomedidor = $rowPainelComponente['VALORMINIMOMEDIDOR'];
                    $valormaximomedidor = $rowPainelComponente['VALORMAXIMOMEDIDOR'];
                    $valormedidor = $rowPainelComponente['VALORMEDIDOR'];
                    $tipografico = $rowPainelComponente['TIPOGRAFICO'];
                    $ehexibirlegendagrafico = $rowPainelComponente['EHEXIBIRLEGENDAGRAFICO'];
                    $ehexibirvalorgrafico = $rowPainelComponente['EHEXIBIRVALORGRAFICO'];
                    $organizarregistro = $rowPainelComponente['ORGANIZARREGISTRO'];
                    $altura = $rowPainelComponente['ALTURA'];
                    $largura = $rowPainelComponente['LARGURA'];
                    $posicaoX = $rowPainelComponente['POSICAOX'];
                    $posicaoY = $rowPainelComponente['POSICAOY'];
                    $sqlComponente = tirarAcentos($sqlComponenteAcentos);
                    $sqlTituloVariavel = parametros($rowPainelComponente['SQLTITULOVARIAVEL']);
                    $sqlTituloVariavel = tirarAcentos($sqlTituloVariavel);
                    $sqlOracleTituloVariavel = parametros($rowPainelComponente['SQLORACLETITULOVARIAVEL']);
                    $sqlOracleTituloVariavel = tirarAcentos($sqlOracleTituloVariavel);

                    /*
                      $totalAltura = 642;
                      $totalLargura = 1194;

                      $alturaFormat = number_format($altura, '0', ',', '');
                      $larguraFormat = number_format($largura, '0', ',', '');

                      $alturaCalcula = (($totalAltura / $alturaFormat) * 100);
                      $larguraCalcula = (($totalLargura / $larguraFormat) * 100);

                      $alturaComponente = number_format($alturaCalcula, '2', ',', '');
                      $larguraComponente = number_format($larguraCalcula, '2', ',', '');
                     */
                    /*
                      if($largura <= '270'){
                      $colGrid = 'col-xs-2';
                      }
                      else if($largura > '270' and $largura <= '350' ){
                      $colGrid = 'col-xs-3';
                      }
                      else if($largura > '370' and $largura <= '450' ){
                      $colGrid = 'col-xs-4';
                      }
                      else if($largura > '470' and $largura <= '550' ){
                      $colGrid = 'col-xs-5';
                      }
                      else if($largura > '570' and $largura <= '650' ){
                      $colGrid = 'col-xs-6';
                      }
                      else if($largura > '670' and $largura <= '750' ){
                      $colGrid = 'col-xs-7';
                      }
                      else if($largura > '770' and $largura <= '850' ){
                      $colGrid = 'col-xs-8';
                      }
                      else if($largura > '870' and $largura <= '950' ){
                      $colGrid = 'col-xs-9';
                      }
                      else if($largura > '970' and $largura <= '1000' ){
                      $colGrid = 'col-xs-10';
                      }
                      else if($largura > '1000'){
                      $colGrid = 'col-xs-12';
                      }
                      $colGrid = 'col-xs-12';


                      if($posicaoX > NULL and $posicaoY > NULL and $altura > NULL and $largura > NULL){ */
                    $colGrid = 'col-xs-12';
                    switch ($tipoComponenteHandle) {
                        case 1:
                            include('../../model/dashboard/painelTabela.php');
                            break;
                        case 2:
                            include('../../model/dashboard/painelRelogio.php');
                            break;
                        case 3:
                            include('../../model/dashboard/painelCalendario.php');
                            break;
                        case 4:
                            include('../../model/dashboard/painelMedidor.php');
                            break;
                        case 5:
                            include('../../model/dashboard/painelGrafico.php');
                            break;
                        case 6:
                            include('../../model/dashboard/painelIndicador.php');
                            break;
                    }//end switch
                    $active = "";

                //}// end if posição > null
                }//end while


                $j++;
            }
            ?>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-mobile"  role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-mobile" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div><!-- /.carousel -->

    </div><!-- /.carousel-inner -->
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $("div.carousel-mobile").on("touchstart", function (event) {
            var xClick = event.originalEvent.touches[0].pageX;
            $(this).one("touchmove", function (event) {
                var xMove = event.originalEvent.touches[0].pageX;
                if (Math.floor(xClick - xMove) > 7) {
                    $("div.carousel-mobile").carousel('next');
                }
                else if (Math.floor(xClick - xMove) < -7) {
                    $("div.carousel-mobile").carousel('prev');
                }
            });

            $("div.carousel-mobile").on("touchend", function () {
                $(this).off("touchmove");
            });
            $("div.carousel-mobile").carousel({
                interval: false,
            });
        });

    });
</script>



