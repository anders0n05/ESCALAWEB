<?php

    include_once('../../controller/tecnologia/Sistema.php');
    date_default_timezone_set('America/Sao_Paulo');
    include_once('../../controller/tecnologia/WS.php');

    class Ocorrencia {
        
        private $handle;
        private $handleAnexo;
        private $connect;

        function __construct() {
            $this->connect = Sistema::getConexao();
        }
        
        public function setHandle($prHandle){
            $this->handle = $prHandle;
        }        
        
        public function setHandleAnexo($prHandleAnexo) {
            $this->handleAnexo = $prHandleAnexo;
        }

        public function getOcorrencia(){            
            $query = $this->connect->prepare("SELECT A.HANDLE, 
                                                     A.NUMERO, 
	                                                 B.NOMEREDUZIDO FILIAL,
                                                     C.NOME TIPO,
                                                     E.NUMERO DOCUMENTO,
                                                     A.DATA,
                                                     F.NOME RESPONSAVEL,
                                                     G.NOME MOTIVOATRASO,
                                                     A.OBSERVACAO
                                                FROM OP_OCORRENCIA A 
                                               INNER JOIN MS_FILIAL B ON B.HANDLE = A.FILIAL
                                               INNER JOIN OP_TIPOOCORRENCIA C ON C.HANDLE = A.TIPO
                                               INNER JOIN GD_DOCUMENTOTRANSPORTE D ON D.HANDLE = A.DOCUMENTOTRANSPORTE
                                               INNER JOIN GD_DOCUMENTO E ON E.HANDLE = D.DOCUMENTO 
                                                LEFT JOIN OP_RESPONSAVELOCORRENCIA F ON F.HANDLE = A.RESPONSAVEL 
                                                LEFT JOIN OP_MOTIVOATRASO G ON G.HANDLE = A.MOTIVOATRASO 
                                               WHERE A.HANDLE = $this->handle");
            $query->execute();

            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getOcorrenciaAnexo(){            
            $query = $this->connect->prepare("SELECT A.HANDLE OCORRENCIA,
                                                     B.HANDLE,   
                                                     B.DATA,
                                                     B.DESCRICAO     
                                                FROM OP_OCORRENCIA A 
                                               INNER JOIN OP_OCORRENCIAANEXO B ON B.OCORRENCIA = A.HANDLE                                               
                                               WHERE A.HANDLE = $this->handle");
            $query->execute();

            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getAnexo(){
            WebService::setupCURL("/rastreio/pedido/baixaranexo", ["OCORRENCIAANEXO" => $this->handleAnexo,
                                                                   "OCORRENCIA" => $this->handle]);            
            
            WebService::execute();

            $body = WebService::getBody();

            $dados = json_decode($body);        

            //-- QUANDO O DATATYPE É JSON, PRECISA RETORNAR UM JSON VÁLIDO PRA CAIR NO SUCESS
            
            if (isset($dados->Arquivo)) {  

                header('Content-type: binary/octet-stream');
                header( 'Content-Disposition: attachment; filename=' . $dados->NOME);
                echo $dados->Arquivo;
            } else {
                echo Sistema::retornoJson(500, $body);
            }
        }        
    }

?>