<?php

    include_once('../../controller/tecnologia/Sistema.php');
    date_default_timezone_set('America/Sao_Paulo');
    include_once('../../controller/tecnologia/WS.php');

    class Viagem {

        private $handle;
        private $numero;
        private $filial;
        private $status;
        private $statusNome;
        private $connect;

        function __construct() {
            $this->connect = Sistema::getConexao();
        }

        public function setHandle($prHandle){
            $this->handle = $prHandle;

            $query = $this->connect->prepare("SELECT A.NUMERO,
                                                     A.FILIAL,
                                                     A.STATUS,
                                                     B.NOME STATUSNOME
                                                FROM OP_VIAGEM A
                                                LEFT JOIN OP_STATUSVIAGEM B ON B.HANDLE = A.STATUS
                                               WHERE A.HANDLE = '$prHandle' ");
            $query->execute();
            $dataSet = $query->fetch(PDO::FETCH_ASSOC);

            $this->filial = $dataSet['FILIAL'];
            $this->numero = $dataSet['NUMERO'];
            $this->status = $dataSet['STATUS'];
            $this->statusNome = $dataSet['STATUSNOME'];
        }

        public function getHandle(){
            return $this->handle;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function EfetuarSaida(){
            $json = json_encode([
                "viagem" => $this->handle,
                "filial" => $this->filial,
                "marcador" => $_POST["MARCADOR"],
                "data" => date('d/m/Y H:i')
            ]);
            
            //-- SEGUINTE, NÃO PODE INICIAR/TERMINAR VIAGEM COM DATA FUTURA..            
            date_default_timezone_set("America/Fortaleza");

            WebService::setupCURL("/operacional/viagem/efetuarsaida", [
                "VIAGEM" => $this->handle,
                "FILIAL" => $this->filial,
                "MARCADOR" => $_POST["MARCADOR"],
                "DATA" => date("d-m-y H:i")
            ]);
            
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

        public function EfetuarChegada(){
            $json = json_encode([
                "viagem" => $this->handle,
                "filial" => $this->filial,
                "marcador" => $_POST['MARCADOR'],
                "data" => date('d/m/Y H:i')
            ]);
            
            //-- SEGUINTE, NÃO PODE INICIAR/TERMINAR VIAGEM COM DATA FUTURA..
            //-- A BOSTA DO GOVERNO TIROU O HORÁRIO DE VERÃO E O APACHE NÃO ACEITOU ISSO MUITO BEM, ENTÃO ESSA FOI A SOLUÇÃO
            date_default_timezone_set("America/Fortaleza");

            WebService::setupCURL("/operacional/viagem/efetuarchegada", [
                "VIAGEM" => $this->handle,
                "FILIAL" => $this->filial,
                "MARCADOR" => $_POST['MARCADOR'],
                "DATA" => date("d-m-y H:i")
            ]);
            
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

        public function PodeIniciarViagem(){
            $query = $this->connect->prepare("SELECT COUNT(HANDLE) QUANTIDADE 
                                                FROM OP_VIAGEMPERCURSOFILIAL 
                                               WHERE VIAGEM = '$this->handle' 
                                                 AND DATACHEGADA IS NULL 
                                                 AND ((EHTERMINOVIAGEM <> 'S') OR (EHINICIOVIAGEM = 'S' AND EHTERMINOVIAGEM = 'S'))  ");
            $query->execute();
            $dataSet = $query->fetch(PDO::FETCH_ASSOC);

            return (($dataSet['QUANTIDADE'] > 0) && (in_array($this->status, [4, 8, 6, 12])));
        }

        public function PodeFinalizarViagem(){
            $query = $this->connect->prepare("SELECT COUNT(HANDLE) QUANTIDADE 
                                                FROM OP_VIAGEMPERCURSOFILIAL 
                                               WHERE VIAGEM = '$this->handle'
                                                 AND DATACHEGADA IS NULL 
                                                 AND ((EHINICIOVIAGEM <> 'S') OR (EHINICIOVIAGEM = 'S' AND EHTERMINOVIAGEM = 'S')) ");
            $query->execute();
            $dataSet = $query->fetch(PDO::FETCH_ASSOC);

            return ($dataSet['QUANTIDADE'] > 0) && (in_array($this->status, [5, 8, 6, 12]));
        }

        public function getPermissoesBotao(){
            $iniciar = $this->PodeIniciarViagem() ? 'true' : 'false';
            $finalizar = $this->PodeFinalizarViagem() ? 'true' : 'false';
            echo "{
                   \"podeIniciarViagem\":\"".$iniciar."\",
                   \"podeFinalizarViagem\":\"".$finalizar."\",
                   \"statusNome\":\"".$this->statusNome."\"
                  }";
        }

        public function getListaFiliaisEmpresa(){
            $query = $this->connect->prepare("SELECT D.HANDLE, D.NOME, 
                                                    COALESCE((SELECT X.FILIAL
                                                        FROM OP_VIAGEMPERCURSOFILIAL X
                                                    WHERE X.VIAGEM = A.HANDLE
                                                        AND NOT EXISTS (SELECT XX.HANDLE 
                                                                        FROM OP_VIAGEMPERCURSOFILIAL XX 
                                                                        WHERE XX.VIAGEM = X.VIAGEM 
                                                                            AND XX.HANDLE > X.HANDLE)), A.FILIAL) FILIALATUAL
                                                FROM OP_VIAGEM A
                                               INNER JOIN MS_FILIAL B ON B.HANDLE = A.FILIAL
                                               INNER JOIN MS_EMPRESA C ON C.HANDLE = B.EMPRESA
                                               INNER JOIN MS_FILIAL D ON D.EMPRESA = C.HANDLE
                                               WHERE A.HANDLE = '$this->handle' ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }
        
        public function getListaTipoOcorrencia(){
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME, A.ACAO 
                                                
                                                FROM OP_TIPOOCORRENCIA A  
                                                    
                                                WHERE (A.ACAO IN (6,11,37,7,18,13,2,15,4,27,29,11,37,13,16,28,30,38, 41))
                                                  AND (EHPERMITEMANUAL = 'S')
                                                  AND (A.EHDISPONIVELAPP = 'S')
                                                  AND (A.STATUS = 3) ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getListaMotivoOcorrencia(){
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM OP_MOTIVOATRASO A  
                                                    
                                                WHERE (A.STATUS = 3) ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getListaMotivoGenericoOcorrencia(){
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM MS_MOTIVO A                                                  
                                                    
                                                WHERE (A.STATUS = 4) 
                                                  AND EXISTS (SELECT X.HANDLE 
                                                                FROM MS_MOTIVOAPLICACAO X
                                                               WHERE X.MOTIVO = A.HANDLE 
                                                                 AND X.ORIGEM = 2212)");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }        


        public function getListaResponsavelOcorrencia(){
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM OP_RESPONSAVELOCORRENCIA A  ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function baixarItens($dados){
            $anexos = [];
    
            if (!empty($_FILES)) {
                foreach ($_FILES['file']['tmp_name'] as $key => $value) {
                    if ($_FILES['file']['name'][$key] !== 'blob') {
                        $tempFile = $_FILES['file']['tmp_name'][$key];
                        $base64 = Sistema::fileToBase64(file_get_contents($tempFile));
                        $anexos[] = ["NOME" => $_FILES['file']['name'][$key], "ARQUIVO" => $base64, "DATA" => date('d/m/Y H:i:s')];
                    }
                }
            }

            $dados = substr($dados, 0, (strlen($dados) - 1));
            $dados .= ",\"ANEXOS\":".json_encode($anexos)."}";

            WebService::setupCURL("/operacional/viagem/baixaritens",  json_decode($dados));
            
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

        public function baixarItensLocal($dados){            
            WebService::setupCURL("/operacional/viagem/baixaritenslocal", json_decode($dados));
            
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

        public function getPDFMDFe(){
            $query = $this->connect->prepare("SELECT C.HANDLE
                                                
                                                FROM OP_VIAGEM A
                                                INNER JOIN GD_DOCUMENTOCARGA B ON B.VIAGEM = A.HANDLE
                                                INNER JOIN GD_DOCUMENTO C ON C.HANDLE = B.DOCUMENTO                                                  
                                                    
                                                WHERE A.HANDLE = $this->handle");
            $query->execute();
            
            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                $documento = $dataSet->HANDLE;
            }

            WebService::setupCURL("/operacional/viagem/baixarpdf", ["DOCUMENTO" => $documento]);            
            
            WebService::execute();

            $body = WebService::getBody();

            $dados = json_decode($body);         
            
            if (isset($dados->Arquivo)) {  

                header('Content-type: binary/octet-stream');
                header( 'Content-Disposition: attachment; filename=Impressao_' . $documento . '.pdf');
                echo $dados->Arquivo;
            } else {
                echo Sistema::retornoJson(500, $body);
            }
        }      

        public function getDocumentoPdf(){           
            WebService::setupCURL("/operacional/viagem/baixarpdf", ["DOCUMENTO" => $this->handle]);            
            
            WebService::execute();

            $body = WebService::getBody();

            $dados = json_decode($body);         
            
            if (isset($dados->Arquivo)) {  

                header('Content-type: binary/octet-stream');
                header( 'Content-Disposition: attachment; filename=Impressao_' . $this->handle . '.pdf');
                echo $dados->Arquivo;
            } else {
                echo Sistema::retornoJson(500, $body);
            }
        }        

    }
?>