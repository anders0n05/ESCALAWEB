<?php

    include_once('../../controller/tecnologia/Sistema.php');
    date_default_timezone_set('America/Sao_Paulo');
    include_once('../../controller/tecnologia/WS.php');

    class Pedido {
        
        private $handle;
        private $numero;
        private $filial;
        private $status;
        private $statusNome;
        private $connect;
        private $documentoHandle;

        function __construct() {
            $this->connect = Sistema::getConexao();
        }
        
        public function setHandle($prHandle){
            $this->handle = $prHandle;

            $query = $this->connect->prepare("SELECT A.NUMERO,
                                                     A.FILIAL,
                                                     A.STATUS,
                                                     B.NOME STATUSNOME
                                                FROM RA_PEDIDO A
                                                LEFT JOIN RA_STATUSPEDIDO B ON B.HANDLE = A.STATUS
                                               WHERE A.HANDLE = '$prHandle' ");
            $query->execute();
            $dataSet = $query->fetch(PDO::FETCH_ASSOC);

            $this->filial = $dataSet['FILIAL'];
            $this->numero = $dataSet['NUMERO'];
            $this->status = $dataSet['STATUS'];
            $this->statusNome = $dataSet['STATUSNOME'];
        }        

        public function setDocumentoHandle($prDocumentoHandle){
            $this->documentoHandle = $prDocumentoHandle;
        }

        public function getDocumentoHandle(){
            return $this->documentoHandle;
        }

        public function getHandle(){
            return $this->handle;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function getHandlePorRastreamento($prRastreamento){
            $query = $this->connect->prepare("SELECT HANDLE FROM RA_PEDIDO WHERE RASTREAMENTO = '" . $prRastreamento . "'");

            $query->execute();

            $dataSet = $query->fetch(PDO::FETCH_OBJ);
            
            echo json_encode($dataSet);
        }
        
        public function getPrimeiraEmpresa(){
            $query = $this->connect->prepare("SELECT COALESCE(B.APELIDO, A.NOME) APELIDOPRIMEIRAEMPRESA
                                                FROM MS_EMPRESA A
                                                LEFT JOIN MS_PESSOA B ON B.HANDLE = A.PESSOA
                                               WHERE A.STATUS = 4
                                                 AND NOT EXISTS (SELECT X.HANDLE
                                                                   FROM MS_EMPRESA X
                                                                  WHERE X.STATUS = 4
                                                                    AND X.HANDLE < A.HANDLE) ");

            $query->execute();

            $dataSet = $query->fetch(PDO::FETCH_OBJ);
            
            echo json_encode($dataSet);
        }

        public function getEtapaEvento(){            
            $query = $this->connect->prepare("SELECT HANDLE, 
                                                    DATA, 
	                                                SEQUENCIAL,
                                                    ETAPA, 
                                                    LOWER(REPLACE(ETAPAIMAGEMSTATUS, '_', '/')) ETAPAIMAGEMSTATUS, 
                                                    COALESCE(OBSERVACAO, '') OBSERVACAO, 
	                                                EVENTOHANDLE,
                                                    EVENTODATA, 
                                                    TIPOEVENTO, 
                                                    COALESCE(EVENTOOBSERVACAO, '') EVENTOOBSERVACAO,
                                                    LOWER(REPLACE(EVENTOIMAGEMSTATUS, '_', '/')) EVENTOIMAGEMSTATUS
                                            FROM (
                                                SELECT A.HANDLE HANDLE, 
                                                        1 SUB,
                                                        A.DATA DATA, 
		                                                A.SEQUENCIAL,
                                                        B01.RESOURCENAME ETAPAIMAGEMSTATUS,
                                                        B1.NOME ETAPA, 
                                                        B1.OBSERVACAO OBSERVACAO,
		                                                COALESCE(C.HANDLE, 0) EVENTOHANDLE,
                                                        C.DATA EVENTODATA,
                                                        C.OBSERVACAO EVENTOOBSERVACAO,
                                                        D.NOME TIPOEVENTO,
                                                        F.RESOURCENAME EVENTOIMAGEMSTATUS
                                                FROM RA_PEDIDOETAPA A  
                                                LEFT JOIN MS_STATUS B0 ON A.STATUS = B0.HANDLE 
                                                LEFT JOIN MD_IMAGEM B01 ON B01.HANDLE = B0.IMAGEM
                                                LEFT JOIN RA_TIPOETAPA B1 ON A.ETAPA = B1.HANDLE 
                                                LEFT JOIN RA_PEDIDOETAPAEVENTO C ON C.PEDIDOETAPA = A.HANDLE AND C.STATUS <> 6
                                                LEFT JOIN RA_TIPOEVENTO D ON D.HANDLE = C.TIPO
                                                LEFT JOIN MS_STATUS E ON E.HANDLE = C.STATUS
                                                LEFT JOIN MD_IMAGEM F ON F.HANDLE = E.IMAGEM
                                                WHERE A.PEDIDO = '" . $this->handle . "'
                                                  AND A.STATUS = 9
                                            
                                                UNION ALL
                                            
                                                SELECT A.HANDLE HANDLE, 
                                                        2 SUB,
                                                        A.DATA DATA,  
		                                                A.NUMERO SEQUENCIAL,
                                                        NULL ETAPAIMAGEMSTATUS,
                                                        B3.NOME ETAPA, 
                                                        A.OBSERVACAO OBSERVACAO,
                                                        0 EVENTOHANDLE,
                                                        NULL EVENTODATA,
                                                        NULL EVENTOOBSERVACAO,
                                                        NULL TIPOEVENTO,
                                                        NULL EVENTOIMAGEMSTATUS
                                                FROM OP_OCORRENCIA A  
                                                LEFT JOIN OP_STATUSOCORRENCIA B0 ON A.STATUS = B0.HANDLE 
                                                LEFT JOIN MS_FILIAL B1 ON A.FILIAL = B1.HANDLE 
                                                LEFT JOIN OP_TIPOOCORRENCIA B2 ON A.TIPO = B2.HANDLE 
                                                LEFT JOIN OP_ACAOOCORRENCIA B3 ON A.ACAO = B3.HANDLE 
                                                WHERE A.EMPRESA IN (1)
                                                AND A.STATUS = 4
                                                AND EXISTS(SELECT X.HANDLE           
                                                            FROM RA_PEDIDOMOVIMENTACAO X          
                                                            INNER JOIN GD_DOCUMENTO  X1 ON X1.HANDLE = X.DOCUMENTO          
                                                            WHERE X.PEDIDO = '" . $this->handle . "'
                                                            AND X1.DOCUMENTOTRANSPORTE = A.DOCUMENTOTRANSPORTE) 
                                            )
                                            AS ETAPAS
                                            ORDER BY DATA DESC, SUB, SEQUENCIAL DESC, HANDLE, EVENTODATA DESC");
            $query->execute();

            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getDocumentoPdf(){
            WebService::setupCURL("/rastreio/pedido/baixarDocumentoPdf", ["DOCUMENTO" => $this->GetDocumentoHandle()]);
            
            WebService::execute();

            $body = WebService::getBody();

            $dados = json_decode($body);

            //-- QUANDO O DATATYPE É JSON, PRECISA RETORNAR UM JSON VÁLIDO PRA CAIR NO SUCESS
            if (isset($dados->Arquivo)) {
                echo $body;
            } else {
                echo Sistema::retornoJson(500, $body);
            }
        }

        public function getDocumentoXml(){
            WebService::setupCURL("/rastreio/pedido/baixarDocumentoXml", ["DOCUMENTO" => $this->GetDocumentoHandle()]);
            
            WebService::execute();

            $body = WebService::getBody();
            
            $dados = json_decode($body);

            //-- QUANDO O DATATYPE É JSON, PRECISA RETORNAR UM JSON VÁLIDO PRA CAIR NO SUCESS
            if (isset($dados->Arquivo)) {
                echo $body;
            } else {
                echo Sistema::retornoJson(500, $body);
            }
        }
    }

?>