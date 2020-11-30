<?php

class minhasCargasDescargasModel {
    
    protected $handle;
    protected $status;
    protected $statusNome;
    protected $statusImagem;
    protected $numero;
    protected $tipo;
    protected $processo;
    protected $data;
    protected $cliente;
    protected $transportadora;
    protected $nrControle;
    protected $nrPedido;
    protected $nrOrdem;
    protected $quantidade;
    protected $volume;
    protected $pesoBruto;
    protected $pesoLiquido;
    protected $filial;    
    
    protected $filtro = Array("TIPO" => Array(), 
                              "CLIENTE" => Array(),
                              "PROCESSO" => Array(),                              
                              "TRANSPORTADORA" => Array());
    
    protected $filtroSelecionado = Array("TIPO" => Array(), 
                                         "CLIENTE" => Array(),
                                         "PROCESSO" => Array(),
                                         "TRANSPORTADORA" => Array(),
                                         "NRCONTROLE" => '',
                                         "NRORDEM" => '',
                                         );
       
    public function __construct() {
        
    }
    
    public function getQuery($filtro = '') {
        return "SELECT A.HANDLE HANDLE,
                       A.STATUS,
                       A.NUMERO NUMEROCARREGAMENTO,
		               B.NOME TIPO,
		               C.NOME PROCESSO,
		               A.CARREGAMENTO DATA,
		               D.NOME CLIENTE,
                       E.NOME TRANSPORTADORA,
                       A.NUMEROCONTROLE NUMEROCONTROLE,
                       F.NUMERO NUMEROORDEM,
                       F.NUMEROPEDIDO NUMEROPEDIDO,
                       A.QUANTIDADE QUANTIDADE,
                       A.QUANTIDADEVOLUME VOLUME,
                       A.PESOBRUTO PESOBRUTO,
                       A.PESOLIQUIDO PESOLIQUIDO,
                       A0.NOME STATUSNOME,
                       G.SIGLA FILIAL

                    FROM AM_CARREGAMENTO A
                        INNER JOIN AM_TIPOCARREGAMENTO B ON B.HANDLE = A.TIPO
                        INNER JOIN AM_TIPOPROCESSOCARREGAMENTO C ON C.HANDLE = A.TIPOPROCESSO
                        LEFT JOIN AM_STATUSCARREGAMENTO A0 (NOLOCK) ON A.STATUS = A0.HANDLE 
                        LEFT JOIN MS_PESSOA D ON D.HANDLE = A.CLIENTE
                        LEFT JOIN MS_PESSOA E ON E.HANDLE = A.TRANSPORTADORA
                        LEFT JOIN AM_ORDEM F ON F.HANDLE = A.ORDEM
                        INNER JOIN MS_FILIAL G ON G.HANDLE = A.FILIAL
                    WHERE A.STATUS <> 5 --CANCELADO
                         
                         AND A.EMPRESA = {$_SESSION['empresa']} 

                    $filtro 
                    ORDER BY A.NUMERO DESC";
    }       

    public function getHandle() {
        return $this->handle;
    }
    
    public function getStatus() {
        return $this->status;
    }

    public function getStatusNome() {
        return $this->statusNome;
    }
    
    public function getStatusImagem() {
        return $this->statusImagem;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getProcesso() {
        return $this->processo;
    }

    public function getData() {
        return $this->data;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getTransportadora() {
        return $this->transportadora;
    }

    public function getNrControle() {
        return $this->nrControle;
    }

    public function getNrPedido() {
        return $this->nrPedido;
    }

    public function getNrOdem() {
        return $this->nrOrdem;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function getVolume(){
        return $this->volume;
    }

    public function getPesoBruto() {
        return $this->pesoBruto;
    }

    public function getPesoLiquido() {
        return $this->pesoLiquido;
    }

    public function getFilial() {
        return $this->filial;
    }

    public function getFiltro($filtro) {
        return $this->filtro[$filtro];
    }

    protected function setHandle($handle) {
        $this->handle = $handle;
    }

    protected function setNumero($numero) {
        $this->numero = $numero;
    }

    protected function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    protected function setProcesso($processo) {
        $this->processo = $processo;
    }

    protected function setData($data) {
        $this->data = $data;
    }

    protected function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    protected function setTransportadora($transportadora) {
        $this->transportadora = $transportadora;
    }

    protected function setNrControle($nrControle) {
        $this->nrControle = $nrControle;
    }

    protected function setNrPedido($nrPedido) {
        $this->nrPedido = $nrPedido;
    }

    protected function setNrOrdem($nrOrdem) {
        $this->nrOrdem = $nrOrdem;
    }

    protected function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    protected function setVolume($volume) {
        $this->volume = $volume;
    }

    protected function setPesoBruto($pesoBruto) {
        $this->pesoBruto = $pesoBruto;
    }

    protected function setPesoLiquido($pesoLiquido) {
        $this->pesoLiquido = $pesoLiquido;
    }
    
    protected function setFilial($filial) {
        $this->filial = $filial;
    }
    
    protected function setFiltro($filtro, $value) {
        $this->filtro[$filtro] = $value;
    } 

    protected function setStatus($status) {
        $this->status = $status;
    }

    protected function setStatusNome($statusNome) {
        $this->statusNome = $statusNome;
    }

    protected function setstatusImagem($ProgramacaoStatus, $ProgramacaoStatusNome ) {
        
        if ($ProgramacaoStatus == '1') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '2') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '3') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/verde/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '4') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '5') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '6') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/cerde/verificado.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '7') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '8') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '9') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/azul/seta_esquerda.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '10') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/azul/ponto.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '12') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '13') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/verde/ponto.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '14') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/amarelo/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        if ($ProgramacaoStatus == '15') {
            $this->statusImagem = "<img src='../../view/tecnologia/img/status/azul/sustenido.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
        }
        
    }
    
    protected function getQueryFiltroTipo() {
        return " SELECT A.HANDLE, 
                        A.NOME C1,
                        A.SIGLA C2
                  FROM AM_TIPOCARREGAMENTO A
                  WHERE A.STATUS = 3";
    }
    
    protected function getQueryFiltroCliente() {
        return "SELECT TOP 1000 
                       A.HANDLE, 
                       A.APELIDO C1, 
                       A.CNPJCPF C2, 
                       A.NOME C3, 
                       A.EHCLIENTE C4
                  FROM MS_PESSOA A (NOLOCK)  
                 WHERE A.STATUS = 4
                   AND A.EHCLIENTE = 'S'
                   ORDER BY C1 ";
	}

    protected function getQueryFiltroTransportadora() {
        return "SELECT TOP 1000 
                       A.HANDLE, 
                       A.APELIDO C1, 
                       A.CNPJCPF C2, 
                       A.NOME C3, 
                       A.EHTRANSPORTADOR C4
                  FROM MS_PESSOA A (NOLOCK)  
                 WHERE A.STATUS = 4
                  AND  A.EHTRANSPORTADOR = 'S'
                  ORDER BY C1";
	}


    protected function getQueryFiltroProcesso() {
        return "SELECT A.HANDLE, 
                       A.NOME C1
                  FROM AM_TIPOPROCESSOCARREGAMENTO A (NOLOCK)   

                 ORDER BY C1";
    }
    
}
