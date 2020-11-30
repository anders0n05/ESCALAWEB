<?php

    include_once('../../controller/tecnologia/Sistema.php');
    date_default_timezone_set('America/Sao_Paulo');
    include_once('../../controller/tecnologia/WS.php');

    class ViagemDespesa {

        private $handle;
        private $viagem;

        function __construct() {
            $this->connect = Sistema::getConexao();
        }
        
        public function setHandle($prHandle){
            $this->handle = $prHandle;

            $query = $this->connect->prepare("SELECT A.VIAGEM
                                                FROM OP_VIAGEMDESPESA A 
                                               WHERE A.HANDLE = '$this->handle'");
            $query->execute();
            $dataSet = $query->fetch(PDO::FETCH_ASSOC);

            $this->setViagem($dataSet['VIAGEM']);
        }

        public function setViagem($prViagem){
            $this->viagem = $prViagem;
        }
        
        public function getHandle(){
            return $this->handle;
        }

        public function getViagem(){
            return $this->viagem;
        }

        public function getListaTipoDespesa(){
            $query = $this->connect->prepare("SELECT A.HANDLE,
                                                     A.NOME
                                                FROM OP_TIPOVIAGEMDESPESA A 
                                               WHERE A.EHPERMITEUTILIZACAOWEB = 'S'
                                                 AND A.STATUS = 3");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getListaDespesa($tipoDespesa){
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME
                                                FROM MT_ITEM A
                                               WHERE EXISTS (SELECT Z.HANDLE 
                                                               FROM MT_ITEMOPERACAOFISCAL Z 
                                                              WHERE Z.ITEM = A.HANDLE 
                                                                AND Z.NATUREZA = 1
                                                                AND Z.STATUS = 3
                                                                AND Z.OPERACAO IS NOT NULL) 
                                                    AND (( EXISTS (SELECT ZZ.HANDLE 
                                                                     FROM OP_TIPOVIAGEMDESPESAITEM ZZ 
                                                                    WHERE ZZ.ITEM = A.HANDLE 
                                                                      AND ZZ.TIPODESPESA = '$tipoDespesa'  ) 
                                                        OR NOT EXISTS (SELECT ZZ.HANDLE 
                                                                         FROM OP_TIPOVIAGEMDESPESAITEM ZZ 
                                                                        WHERE ZZ.TIPODESPESA = '$tipoDespesa' )))");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function Cadastrar($dados){
            
            WebService::setupCURL("/operacional/viagem/cadastrardespesa", $dados);
            
            WebService::execute();

            $body = WebService::getBody();

            $dados = json_decode($body);

            //-- QUANDO O DATATYPE É JSON, PRECISA RETORNAR UM JSON VÁLIDO PRA CAIR NO SUCESS
            if (isset($dados->CHAVE)) {
                echo $body;
            } else {
                echo Sistema::retornoJson(500, $body);
            }       
        }

        public function getDespesasViagem(){
            $query = $this->connect->prepare("SELECT COALESCE(A.NUMERO, '') NUMERO,
                                                     FORMAT(A.DATA, 'dd/MM/yyyy hh:mm tt', 'en-gb' ) DATA,
                                                     A.VALOR,
                                            
                                                     B.SIGLA FILIAL,
                                            
                                                     C.NOME TIPO,

                                                     E.NOME DESPESA
                                            
                                                FROM OP_VIAGEMDESPESA A
                                            
                                                LEFT JOIN MS_FILIAL B ON B.HANDLE = A.FILIAL
                                                LEFT JOIN OP_TIPOVIAGEMDESPESA C ON C.HANDLE = A.TIPO
                                                LEFT JOIN MS_PESSOA D ON D.HANDLE = A.FORNECEDOR
                                                LEFT JOIN MT_ITEM E ON E.HANDLE = A.DESPESA
                                            
                                               WHERE A.VIAGEM = '$this->viagem'
                                                 AND A.STATUS <> 2 
                                               ORDER BY DATA");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }
        
    }
?>