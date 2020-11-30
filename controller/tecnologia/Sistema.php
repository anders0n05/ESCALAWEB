<?php

include_once "Conexao.php";
ob_start();
session_start();

//define inicializações do php com seus parametros
ini_set('max_file_uploads', '100');
ini_set('upload_max_filesize', '512M');
ini_set('post_max_size ', '2500M');
set_time_limit(99000);

if (isset($_SESSION['loginUsuario'])) {
    $empresa = $_SESSION['empresa'];
    $papel = $_SESSION['papel'];
    $filial = $_SESSION['filial'];
    $NomeEmpresa = $_SESSION['NomeEmpresa'];
    $ApelidoEmpresa = $_SESSION['ApelidoEmpresa'];
    $NomeFilial = $_SESSION['NomeFilial'];
    $pessoa = $_SESSION['pessoa'];
    $handleUsuario = $_SESSION['handleUsuario'];
    $loginUsuario = $_SESSION['loginUsuario'];
    $papelNome = $_SESSION['papelNome'];
	
    //$referenciaPapelUsuario  = $_SESSION['referenciaPapelUsuario '];
}

date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y');
$hora = date('H:i:s');
$date = date('Y-m-d');
$time = date('H:i:s');
$datetime = date('Y-m-d H:i:s');
$datahora = date('d/m/Y H:i:s');

function limitarTexto($texto, $limite) {
    $contador = strlen($texto);
    if ($contador >= $limite) {
        $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '';
        return $texto;
    } else {
        return $texto;
    }
}

class Sistema {

    static function getConexao($transacao = true) {
        try {
            $conexao = Conexao::getInstancia();

            if (!isset($conexao)) {
                throw new Exception('Não foi possível conectar com o banco de dados.');
            }

            if ($transacao) {
                $conexao->beginTransaction();
            }

            return $conexao;
        } catch (Exception $erro) {
            echo "<script language='javascript' type='text/javascript'>window.location.href='../../view/estrutura/login.php?mensagem=Não foi possível conectar com o servidor.</br>{$erro->getMessage()}'</script>";
        }
    }

    static function getFiltroSuperGlobal($superGlobal, $variavel, $tipoVariavel, $options = null) {
        return filter_input($superGlobal, $variavel, $tipoVariavel, $options);
    }

    static function getPost($variavel, $tipoVariavel = FILTER_SANITIZE_STRING, $options = null) {
        return self::getFiltroSuperGlobal(INPUT_POST, $variavel, $tipoVariavel, $options);
    }

    static function getPostArray($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
        return self::getPost($variavel, $tipoVariavel, FILTER_REQUIRE_ARRAY);
    }

    static function getGet($variavel, $tipoVariavel = FILTER_SANITIZE_STRING, $options = null) {
        return self::getFiltroSuperGlobal(INPUT_GET, $variavel, $tipoVariavel, $options);
    }

    static function getGetArray($variavel, $tipoVariavel = FILTER_SANITIZE_STRING) {
        return self::getGet($variavel, $tipoVariavel, FILTER_REQUIRE_ARRAY);
    }

    static function getServer($variavel, $tipoVariavel = FILTER_SANITIZE_STRING, $options = null) {
        return self::getFiltroSuperGlobal(INPUT_SERVER, $variavel, $tipoVariavel, $options);
    }

    static function getImagem($resourceName, $statusName = '') {
        if (!empty($resourceName)) {
            $resourceArray = explode("_", $resourceName, 2);
            return "<img src='../../view/tecnologia/img/status/" . strtolower($resourceArray[0]) . "/" . strtolower($resourceArray[1]) . ".png' width='13px' height='auto' title='" . $statusName . "' alt='" . $statusName . "'>";
        } else {
            return "";
        }
    }

    static function getDataAtual() {
        return date('Y-m-d H:i:s');
    }

    static function formataDataHoraMascara($dataHora, $mascara) {
        if (!empty($dataHora)) {
            return date($mascara, strtotime($dataHora));
        } else {
            return '';
        }
    }

    static function formataDataHoraMascaraTimeZone($dataHora) {
        return str_replace(' ', 'T', Sistema::formataDataHoraMascara($dataHora, 'Y-m-d H:i'));
    }

    static function formataDataHoraSegundo($dataHora) {
        return static::formataDataHoraMascara($dataHora, 'd/m/Y H:i:s');
    }
    static function formataDataHora($dataHora) {
        return static::formataDataHoraMascara($dataHora, 'd/m/Y H:i');
    }

    static function formataData($dataHora) {
        return static::formataDataHoraMascara($dataHora, 'd/m/Y');
    }

    static function formataHora($dataHora) {
        return static::formataDataHoraMascara($dataHora, 'H:i');
    }

    static function formataDuracao($dataInicial, $dataFinal = '') {
        $duracao = '';

        if (!empty($dataInicial)) {

            if (empty($dataFinal)) {
                $dataFinal = Sistema::getDataAtual();
            }

            $datetime1 = new DateTime($dataInicial);
            $datetime2 = new DateTime($dataFinal);
            $interval = $datetime1->diff($datetime2);

            if (!empty($interval->format('%d'))) {
                $duracao = $interval->format('%d') . ' dia(s) ';
            }

            if (!empty($interval->format('%h'))) {
                $duracao .= $interval->format('%h') . ' hora(s) ';
            }

            if (!empty($interval->format('%i'))) {
                $duracao .= $interval->format('%i') . ' minuto(s) ';
            }

            if (empty($duracao)) {
                $duracao = $interval->format('%s') . ' segundo(s)';
            }
        }

        return $duracao;
    }

    static function formataTexto($texto, $limite = 50) {
        $textoFormatado = trim($texto);

        if (!empty($textoFormatado)) {
            if (strlen($textoFormatado) > $limite) {
                return substr($textoFormatado, 0, $limite) . " [...]";
            } else {
                return $textoFormatado;
            }
        } else {
            return "";
        }
    }

    static function formataValor($valor, $decimal = 2) {
        return number_format($valor, $decimal, ',', '.');
    }

    static function formataInt($handle) {
        if (empty($handle)) {
            return 0;
        } else {
            return (int) $handle;
        }
    }

    static function getNaoEncontrado() {
        echo "<div class=\"col-md-12\">
                  <div class=\"alert alert-warning\">
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                          <span aria-hidden=\"true\">&times;</span>
                      </button>
                      <strong>Atenção: </strong> Não encontramos registros a serem exibidos!
                  </div>
              </div>";
    }

    static function iniciaCarregando() {
        echo "<script>$('#loader').removeAttr('hidden');</script>";
    }

    static function finalizaCarregando() {
        echo "<script>$('#loader').hide();</script>";
    }

    static function tratarErro(Exception $erro) {
        self::finalizaCarregando();
        echo "<div class=\"alert alert-warning\">{$erro->getMessage()}</div>";
    }

    static function getFiltroPostTexto($id, $coluna) {
        $valueTexto = self::getPost($id);
        
        $query = "";

        if (!empty($valueTexto)) {
            $expressaoPercentual = strpos($valueTexto, ';') !== false ? '' : '%';
            $valueExplode = explode(';', $valueTexto);
            
            foreach($valueExplode as $value) {
                if (empty($query)) {
                    $query = " AND ($coluna LIKE '$expressaoPercentual$value$expressaoPercentual' ";
                } else {
                    $query .= " OR $coluna LIKE '$expressaoPercentual$value$expressaoPercentual' ";
                }
            }
            
            $query .= ") ";
            
            return $query;
        } else {
            return "";
        }
    }


    static function getFiltroGetTexto($id, $coluna) {
        $valueTexto = self::getGet($id);
        
        $query = "";

        if (!empty($valueTexto)) {
            $expressaoPercentual = strpos($valueTexto, ';') !== false ? '' : '%';
            $valueExplode = explode(';', $valueTexto);
            
            foreach($valueExplode as $value) {
                if (empty($query)) {
                    $query = " AND ($coluna LIKE '$expressaoPercentual$value$expressaoPercentual' ";
                } else {
                    $query .= " OR $coluna LIKE '$expressaoPercentual$value$expressaoPercentual' ";
                }
            }
            
            $query .= ") ";
            
            return $query;
        } else {
            return "";
        }
    }

    static function getFiltroPostIn($id, $coluna) {
        $valueTexto = self::getPost($id);

        if (!empty($valueTexto)) {            
            $query = " AND $coluna IN ($valueTexto) ";                        
            return $query;
        } else {
            return "";
        }
    }

    static function getFiltroGetIn($id, $coluna) {
        $valueTexto = self::getGet($id);

        if (!empty($valueTexto)) {            
            $query = " AND $coluna IN ($valueTexto) ";                        
            return $query;
        } else {
            return "";
        }
    }

    static function getFiltroPostLookup($id, $coluna) {
        $value = self::getPost($id);
        
        if (!empty($value)) {
            return " AND ($coluna = $value) ";
        } else {
            return "";
        }
    }

    static function getFiltroPostLike($id, $coluna) {
        $value = self::getPost($id);

        $value = "%" . $value . "%";
        
        if (!empty($value)) {
            return " AND $coluna LIKE '$value'";
        } else {
            return "";
        }
    }

    static function getFiltroGetLike($id, $coluna) {
        $value = self::getGet($id);

        $value = "%" . $value . "%";
        
        if (!empty($value)) {
            return " AND $coluna LIKE '$value'";
        } else {
            return "";
        }
    }

    static function getFiltroPostLookupArray($id, $coluna) {
        $valueArray = Sistema::getPostArray($id);
        
        $query = "";
                
        if (!empty($valueArray)) {

            foreach ($valueArray as $value) {
                
                $valueExplode = explode(';', $value, 2);
                $handle = $valueExplode[0];
                
                if (empty($query)) {
                    $query = " AND $coluna IN ($handle";
                } else {                
                    $query .= ", $handle ";
                }
            }
            
            $query .= ")";
            
            return $query;
        } else {
            return "";
        }
    }

    static function getFiltroGetLookupArray($id, $coluna) {
        $valueArray = Sistema::getGetArray($id);
        
        $query = "";
                
        if (!empty($valueArray)) {

            foreach ($valueArray as $value) {
                
                $valueExplode = explode(';', $value, 2);
                $handle = $valueExplode[0];
                
                if (empty($query)) {
                    $query = " AND $coluna IN ($handle";
                } else {                
                    $query .= ", $handle ";
                }
            }
            
            $query .= ")";
            
            return $query;
        } else {
            return "";
        }
    }

    static function getFiltroPostDataMascara($id, $coluna, $mascaraFiltro, $mascaraColuna) {
        $value = self::formataDataHoraMascara(self::getPost($id), $mascaraFiltro);

        if (!empty($value)) {
            return " AND DATEADD($mascaraColuna, DATEDIFF($mascaraColuna, 0, $coluna), 0) = '$value' ";
        } else {
            return "";
        }
    }

    static function getFiltroPostData($id, $coluna) {
        return self::getFiltroPostDataMascara($id, $coluna, Conexao::getMascaraData(), 'DAY');
    }

    static function getFiltroPostDataPeriodo($id, $coluna) {
        if (!empty(self::getPost($id))) {
            return " AND $coluna BETWEEN (GETDATE() - ".self::getPost($id).") AND GETDATE()";
        } else {
            return "";
        }
    }

    static function getFiltroPostDataMinuto($id, $coluna) {
        return self::getFiltroPostDataMascara($id, $coluna, Conexao::getMascaraDataHora(), 'MINUTE');
    }

    static function getFiltroPostEntreDataMascara($idInicial, $idFinal, $coluna, $mascaraFiltro, $mascaraColuna) {
        $valueInicial = self::formataDataHoraMascara(self::getPost($idInicial), $mascaraFiltro);
        $valueFinal = self::formataDataHoraMascara(self::getPost($idFinal), $mascaraFiltro);

        if (!empty($valueInicial) && !empty($valueFinal)) {
            return " AND DATEADD($mascaraColuna, DATEDIFF($mascaraColuna, 0, $coluna), 0) BETWEEN '$valueInicial' AND '$valueFinal' ";
        } else if (!empty($valueInicial)) {
            return " AND DATEADD($mascaraColuna, DATEDIFF($mascaraColuna, 0, $coluna), 0) >= '$valueInicial' ";
        } else if (!empty($valueFinal)) {
            return " AND DATEADD($mascaraColuna, DATEDIFF($mascaraColuna, 0, $coluna), 0) <= '$valueFinal' ";
        } else {
            return "";
        }
    }

    static function getFiltroGetEntreDataMascara($idInicial, $idFinal, $coluna, $mascaraFiltro, $mascaraColuna) {
        $valueInicial = self::formataDataHoraMascara(self::getGet($idInicial), $mascaraFiltro);
        $valueFinal = self::formataDataHoraMascara(self::getGet($idFinal), $mascaraFiltro);

        if (!empty($valueInicial) && !empty($valueFinal)) {
            return " AND DATEADD($mascaraColuna, DATEDIFF($mascaraColuna, 0, $coluna), 0) BETWEEN '$valueInicial' AND '$valueFinal' ";
        } else if (!empty($valueInicial)) {
            return " AND DATEADD($mascaraColuna, DATEDIFF($mascaraColuna, 0, $coluna), 0) >= '$valueInicial' ";
        } else if (!empty($valueFinal)) {
            return " AND DATEADD($mascaraColuna, DATEDIFF($mascaraColuna, 0, $coluna), 0) <= '$valueFinal' ";
        } else {
            return "";
        }
    }

    static function getFiltroPostEntreData($idInicial, $idFinal, $coluna) {
        return self::getFiltroPostEntreDataMascara($idInicial, $idFinal, $coluna, Conexao::getMascaraData(), 'DAY');
    }

    static function getFiltroGetEntreData($idInicial, $idFinal, $coluna) {
        return self::getFiltroGetEntreDataMascara($idInicial, $idFinal, $coluna, Conexao::getMascaraData(), 'DAY');
    }

    static function getFiltroPostEntreDataMinuto($idInicial, $idFinal, $coluna) {
        return self::getFiltroPostEntreDataMascara($idInicial, $idFinal, $coluna, Conexao::getMascaraDataHora(), 'MINUTE');
    }

    static function getUsuario() {
        return $_SESSION['handleUsuario'];
    }

    static function getPessoaUsuario($connect) {
        $queryPessoasUsuario = "SELECT PESSOA
                                  FROM MS_USUARIOPESSOA (NOLOCK)
                                 WHERE USUARIO = " . self::getUsuario();
        try {
            $queryPessoasUsuarioPrepare = $connect->prepare($queryPessoasUsuario);
            $queryPessoasUsuarioPrepare->execute();

            $resultPessoaUsuario = array();

            while ($rowPessoaUsuario = $queryPessoasUsuarioPrepare->fetch(PDO::FETCH_ASSOC)) {
                $resultPessoaUsuario[] = $rowPessoaUsuario;
            }

            return $resultPessoaUsuario;
        } catch (Exception $e) {
            Sistema::tratarErro($e);
        }
    }

    static function getPessoaUsuarioToStr($connect) {
        $filtro = "";

        $pessoaUsuarioLista = Self::getPessoaUsuario($connect);

        if (count($pessoaUsuarioLista) > 0) {
            foreach ($pessoaUsuarioLista as $pessoasUsuario) {
                if (empty($filtro)) {
                    $filtro = $pessoasUsuario['PESSOA'];
                } else {
                    $filtro .= ',' . $pessoasUsuario['PESSOA'];
                }
            }
        }
        
        return $filtro;
    }

    static function getDadosPessoaUsuarioLogado($connect){
        $usuario = self::getUsuario();

        $sqlPessoa = "SELECT B.* FROM MS_USUARIO A
                        INNER JOIN MS_PESSOA B ON A.PESSOA = B.HANDLE
                        WHERE A.HANDLE = $usuario";

        try {
            $queryPessoa = $connect->prepare($sqlPessoa);
            $queryPessoa->execute();

            $pessoa = $queryPessoa->fetch(PDO::FETCH_ASSOC);

            return $pessoa;
        } catch (Exception $e) {
            Sistema::tratarErro($e);
        }

    }
    
    static function getDadosUsuarioLogado($connect){
        $usuario = self::getUsuario();

        $sqlPessoa = "SELECT A.* FROM MS_USUARIO A
                        WHERE A.HANDLE = $usuario";

        try {
            $queryPessoa = $connect->prepare($sqlPessoa);
            $queryPessoa->execute();

            $pessoa = $queryPessoa->fetch(PDO::FETCH_ASSOC);

            return $pessoa;
        } catch (Exception $e) {
            Sistema::tratarErro($e);
        }

    }

    static function echoToJson($retorno) {
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
    }

    static function verificarWebservice($WebServiceOffline) {
        if ($WebServiceOffline) {
            throw new Exception('Erro ao conectar com o webservice, serviço offline.');
        }
    }

    static function verificarSoapFault($result) {
        if (is_soap_fault($result)) {
            throw new SoapFault($result->faultcode, $result->faultstring);
        }
    }

    static function setRetornoWebService(&$result, &$retorno) {
        if (!empty($result->mensagem)) {
            $retorno['mensagem'] = $result->mensagem;
        } else {
            $retorno['mensagem'] = '';
        }

        if (!empty($result->protocolo)) {
            $retorno['protocolo'] = $result->protocolo;
        } else {
            $retorno['protocolo'] = 0;
        }

        if (!empty($result->sucesso)) {
            if (strtolower($result->sucesso) === 'true') {
                $retorno['sucesso'] = true;
            } else {
                $retorno['sucesso'] = false;
            }
        } else {
            $retorno['sucesso'] = false;
        }
    }

    static function setSoapFault(&$erro, &$retorno) {
        $retorno['mensagem'] = $erro->faultstring;
        $retorno['protocolo'] = 0;
        $retorno['sucesso'] = false;
    }

    static function setException(&$erro, &$retorno) {
        $retorno['mensagem'] = $erro->getMessage();
        $retorno['protocolo'] = 0;
        $retorno['sucesso'] = false;
    }

    static function fileToBase64($fileContent){
        return base64_encode($fileContent);
    }

    static function criarGuid()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
    
    static function retornoJson($codigo, $mensagem = null){
        http_response_code($codigo);
        
        return json_encode([
            "code" => $codigo,
            "message" => $mensagem
        ]);
    }

    static function validarCNPJ($prCnpj)
    {
        $prCnpj = preg_replace('/[^0-9]/', '', (string) $prCnpj);
        
        // Valida tamanho
        if (strlen($prCnpj) != 14)
            return false;
    
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $prCnpj))
            return false;	
    
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $prCnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        if ($prCnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
    
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $prCnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        return $prCnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    function validarCPF($prCpf) {
 
        // Extrai somente os números
        $prCpf = preg_replace( '/[^0-9]/is', '', $prCpf );
         
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($prCpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $prCpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $prCpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($prCpf{$c} != $d) {
                return false;
            }
        }
        return true;
    
    }
}
