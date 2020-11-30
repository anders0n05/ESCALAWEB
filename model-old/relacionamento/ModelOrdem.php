<?php

    include_once('../../controller/tecnologia/Sistema.php');
    date_default_timezone_set('America/Sao_Paulo');
    include_once('../../controller/tecnologia/WS.php');

    class OrdemRelacionamento {
        
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
                                                FROM RE_ORDEMRELACIONAMENTO A
                                                LEFT JOIN MS_STATUS B ON B.HANDLE = A.STATUS
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

        public function getMarcas(){          
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM ME_MARCA A 

                                               WHERE A.STATUS = 2 ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getModelos($prMarca){  
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM ME_MODELO A

                                               WHERE A.STATUS = 2

                                                 AND EXISTS (SELECT X.HANDLE 
                                                               FROM ME_MARCAMODELO X
                                                              WHERE X.MODELO = A.HANDLE
                                                                AND X.MARCA = '$prMarca' ) ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getTipos(){
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM RE_TIPOORDEM A

                                               WHERE A.STATUS = 4 ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);
        }

        public function getTipoClienteObrigatorio($prTipo){
            $query = $this->connect->prepare("SELECT A.EHOBRIGATORIOPESSOA
                                                
                                                FROM RE_TIPOORDEM A

                                               WHERE A.HANDLE = '$prTipo' ");
            $query->execute();

            $dataSet = $query->fetch(PDO::FETCH_OBJ);
            
            echo json_encode($dataSet);
        }

        public function getDadosFromCepSemMascara($prCep){
            $query = $this->connect->prepare("SELECT A.LOGRADOURO,
                                            
                                                     B.HANDLE UFHANDLE,
                                                     B.SIGLA UFSIGLA,
                                                    
                                                     C.HANDLE MUNICIPIOHANDLE,
                                                     C.NOME MUNICIPIONOME,
                                            
                                                     D.HANDLE BAIRROHANDLE,
                                                     D.NOME BAIRRONOME
                                            
                                                FROM MS_CEP A
                                           LEFT JOIN MS_ESTADO B ON B.HANDLE = A.ESTADO
                                           LEFT JOIN MS_MUNICIPIO C ON C.HANDLE = A.MUNICIPIO
                                           LEFT JOIN MS_BAIRRO D ON D.HANDLE = A.BAIRRO
                                               WHERE A.CEPNUMERICO = '$prCep' 
                                                 AND A.STATUS = 4 ");
            $query->execute();

            $dataSet = $query->fetch(PDO::FETCH_OBJ);
            
            echo json_encode($dataSet);
        }

        public function getBairros($prMunicipio){
            
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM MS_BAIRRO A

                                               WHERE A.MUNICIPIO = '$prMunicipio'
                                                 
                                               ORDER BY A.NOME ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);

        }

        public function getEstados(){
            $query = $this->connect->prepare("SELECT A.HANDLE, A.SIGLA 
                                                
                                                FROM MS_ESTADO A

                                               WHERE A.PAIS = 1
                                               ORDER BY A.SIGLA ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);

        }

        public function getMunicipios($prEstado){
            
            $query = $this->connect->prepare("SELECT A.HANDLE, A.NOME 
                                                
                                                FROM MS_MUNICIPIO A

                                               WHERE A.ESTADO = '$prEstado'
                                                 AND A.STATUS = 4
                                                ORDER BY A.NOME ");
            $query->execute();
            $retorno = [];

            while($dataSet = $query->fetch(PDO::FETCH_OBJ)){
                array_push($retorno, $dataSet);
            }

            echo json_encode($retorno);

        }

        public function getDadosFromCnpjCpf($prCnpjCpf){
            $query = $this->connect->prepare("SELECT A.APELIDO,
                                                     A.CNPJCPF,
                                                     A.EMAIL,
                                                     A.TELEFONE,
                                                     B.COMPLEMENTO,
                                                     B.NUMERO,

                                                     C.CEPNUMERICO CEP
                                                     
                                                FROM MS_PESSOA A
                                               INNER JOIN MS_PESSOAENDERECO B ON B.HANDLE = A.ENDERECOFISCAL
                                               INNER JOIN MS_CEP C ON C.HANDLE = B.CEP
                                               WHERE A.CNPJCPFSEMMASCARA LIKE '$prCnpjCpf'
                                                 AND A.STATUS <> 6 ");
            $query->execute();

            $dataSet = $query->fetch(PDO::FETCH_OBJ);
            
            echo json_encode($dataSet);
        }

        public function cadastrarRelacionamento($prDados){
                
            $cnpjCpf = $prDados['CNPJCPFSEMMASCARA'];

            if ($cnpjCpf != ""){
                $cnpjCpfValido = (Sistema::validarCNPJ($cnpjCpf)) || (Sistema::validarCPF($cnpjCpf));
            }
            else{
                $cnpjCpfValido = true;
            }

            if (!$cnpjCpfValido){
                echo Sistema::retornoJson(500, "\n\nO CNPJ/CPF informado é inválido.\n\nCNPJ/CPF: ".$cnpjCpf);
            }
            else{
                $codigoIbgeMunicipio = "";
                $ufNome = "";
    
                if ($prDados["UFHANDLE"] != 0){
                    $municipioHandle = $prDados["MUNICIPIOHANDLE"];
                    $ufHandle = $prDados["UFHANDLE"];
    
                    $query = $this->connect->prepare("SELECT A.NOME ESTADONOME,
                                                             B.CODIGOIBGE MUNICIPIOIBGE
                                                        FROM MS_ESTADO A
                                                        LEFT JOIN MS_MUNICIPIO B ON B.HANDLE = '$municipioHandle'
                                                      WHERE A.HANDLE = '$ufHandle' ");
                    $query->execute();
    
                    $dataSet = $query->fetch(PDO::FETCH_ASSOC);
        
                    $codigoIbgeMunicipio = $dataSet['ESTADONOME'];
                    $ufNome = $dataSet['MUNICIPIOIBGE'];
                }
    
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
                                
                WebService::setupCURL("relacionamento/atendimento/incluiratendimento", [
                    "FILIAL" => 1,
                    "TIPO" => $prDados['TIPOHANDLE'],
                    "SEVERIDADE" => 3,
                    "DATA" => date('d/m/Y H:i:s'),
                    "CANALATENDIMENTO" => 1,
                    "CLIENTE" => $prDados['EMAIL'],
                    "CNPJCPF" => $prDados['CNPJCPFSEMMASCARA'],
                    "SOLICITANTE" => $prDados['NOME'],
                    "TELEFONE" => $prDados['TELEFONE'],
                    "CELULAR" => "",
                    "EMAIL" => $prDados['EMAIL'],
                    "MARCA" => $prDados['MARCANOME'], //Gravar na Infor Complementar
                    "MODELO" => $prDados['MODELONOME'], //Gravar na Infor Complementar
                    "NUMEROSERIE" => $prDados['NROSERIE'], //Gravar na Infor Complementar
                    "NUMERONFE" => $prDados['NRONFE'], //Gravar na Infor Complementar
                    "NUMEROCONTROLE" => "",
                    "DESCRICAO" => $prDados['DESCRICAO'],
                    "ANEXOS" => $anexos,
                    "CHAVE" => $prDados['CHAVE'],
                    "UFSIGLA" => $prDados["UFSIGLA"],
                    "MUNICIPIONOME" => $prDados["MUNICIPIONOME"],
                    "BAIRRONOME" => $prDados["BAIRRO"],
                    "LOGRADOURO" => $prDados["LOGRADOURO"], 
                    "ENDERECONUMERO" => $prDados["ENDERECONUMERO"],
                    "CEP" => $prDados["CEP"],
                    "COMPLEMENTO" => $prDados["COMPLEMENTO"],
                    "MUNICIPIOIBGE" => $codigoIbgeMunicipio,
                    "UFNOME" => $ufNome
                ]);
    
                WebService::execute();
    
                $body = WebService::getBody();
    
                $dados = json_decode($body, true);
    
                if (isset($dados["CHAVE"])) {
                    echo $dados["CHAVE"];
                } else {
                    echo Sistema::retornoJson(500, $body);
                }
            }

            
        }  
    }

?>