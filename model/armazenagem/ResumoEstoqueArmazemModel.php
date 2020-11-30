<?php
/**
 * Description of EstoqueArmazem
 *
 * @author leonardo.laurindo
 */
class ResumoEstoqueArmazemModel {
    
    protected $handle;
    protected $produto;
    protected $descricaoProduto;
    protected $naturezaMercadoria;
    protected $cliente;
    protected $notaFiscal;
    protected $dataEmissão;
    protected $nrPedido;
    protected $lote;
    protected $validade;
    protected $unidade;
    protected $disponível;
    protected $reservado;
    protected $bloqueado;
    protected $total;
    protected $pesoBruto;
    protected $valorMercadoria;
    
    protected $filtro = Array("PRODUTO" => Array(), 
                              "CLIENTE" => Array(),
                              "NATUREZAMERCADORIA" => Array(),                              
                              "LOTE" => Array());
    
    protected $filtroSelecionado = Array("PRODUTO" => Array(), 
                                         "CLIENTE" => Array(),
                                         "NATUREZAMERCADORIA" => Array(),
                                         "LOTE" => Array(),
                                         "NRPEDIDO" => '',
                                         "DATAEMISSAO" => '',
                                         "NOTAFISCAL" => '',                                         
                                         "VALIDADE" => '');
       
    public function __construct() {
        
    }
    
    public function getQuery($filtro = '') {
        return "SELECT B0.CODIGOREFERENCIA CODIGOREFERENCIA, 
                       B0.NOME PRODUTO, 
                       SUM(A.DISPONIVELQUANTIDADE) DISPONIVELQUANTIDADE,
                       SUM(A.BLOQUEADOQUANTIDADE) BLOQUEADOQUANTIDADE, 
                       SUM(A.RESERVADOQUANTIDADE) RESERVADOQUANTIDADE, 
                       SUM(A.RECEBIMENTOQUANTIDADE) ENTRADAVIRTUALQUANTIDADE, 
                       SUM(A.SALDOQUANTIDADE) SALDOQUANTIDADE,
                       SUM(A.SALDOQUANTIDADEVOLUME) SALDOQUANTIDADEVOLUME, 
                       SUM(A.SALDOPESOLIQUIDO) SALDOPESOLIQUIDO, 
                       SUM(A.SALDOPESOBRUTO) SALDOPESOBRUTO,                                                                                                                                                                                                                                
                       SUM(A.SALDOQUANTIDADE) SALDOQUANTIDADE, 
                       SUM(A.SALDOPESOLIQUIDO) SALDOPESOLIQUIDO,
                       SUM(A.SALDOPESOBRUTO) SALDOPESOBRUTO,
                       SUM(A.SALDOVALOR) SALDOVALOR
                  FROM AM_SALDOESTOQUE A (NOLOCK)  
                  LEFT JOIN MT_ITEM B0 (NOLOCK) ON A.ITEM = B0.HANDLE 
                  LEFT JOIN MS_PESSOA B1 (NOLOCK) ON A.CLIENTE = B1.HANDLE 
                  LEFT JOIN AM_DEPOSITOLOCALIZACAO B2 (NOLOCK) ON A.ENDERECO = B2.HANDLE 
                  LEFT JOIN AM_DEPOSITO B3 (NOLOCK) ON B2.DEPOSITO = B3.HANDLE 
                  LEFT JOIN AM_TIPOAREA B4 (NOLOCK) ON B2.TIPOAREA = B4.HANDLE 
                  LEFT JOIN AM_UNITIZACAO B5 (NOLOCK) ON A.UNITIZACAO = B5.HANDLE 
                  LEFT JOIN MT_UNIDADEMEDIDA B6 (NOLOCK) ON A.UNIDADEMEDIDA = B6.HANDLE 
                  LEFT JOIN AM_ORDEMITEMLOTE B7 (NOLOCK) ON A.ITEMLOTE = B7.HANDLE 
                  LEFT JOIN AM_LOTE B8 (NOLOCK) ON B7.LOTE = B8.HANDLE 
                  LEFT JOIN AM_ORDEMCONTEINER B9 (NOLOCK) ON B7.ORDEMCONTEINER = B9.HANDLE 
                  LEFT JOIN PA_CONTEINER B10 (NOLOCK) ON B9.CONTEINER = B10.HANDLE 
                  LEFT JOIN AM_ORDEMITEM B11 (NOLOCK) ON B7.ORDEMITEM = B11.HANDLE 
                  LEFT JOIN AM_ORDEMDOCUMENTO B12 (NOLOCK) ON B11.ORDEMDOCUMENTO = B12.HANDLE 
                  LEFT JOIN GD_TIPOORIGINARIO B13 (NOLOCK) ON B12.TIPO = B13.HANDLE 
                  LEFT JOIN AM_ORDEM B14 (NOLOCK) ON B7.ORDEM = B14.HANDLE 
                  LEFT JOIN MT_NATUREZAMERCADORIA B15 (NOLOCK) ON B15.HANDLE = B0.NATUREZAMERCADORIA
                  LEFT JOIN AM_TIPOORDEM  B16 (NOLOCK) ON B16.HANDLE = B14.TIPO
                 WHERE A.SALDOQUANTIDADE > 0
                 AND B16.EHNAOEXIBIRSALDOWEB <> 'S'
                    $filtro
                    GROUP BY B0.CODIGOREFERENCIA, B0.NOME
                 ORDER BY B0.CODIGOREFERENCIA ASC";
    }       

    public function getHandle() {
        return $this->handle;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function getDescricaoProduto() {
        return $this->descricaoProduto;
    }

    public function getNaturezaMercadoria() {
        return $this->naturezaMercadoria;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getNotaFiscal() {
        return $this->notaFiscal;
    }

    public function getDataEmissão() {
        return $this->dataEmissão;
    }

    public function getNrPedido() {
        return $this->nrPedido;
    }

    public function getLote() {
        return $this->lote;
    }

    public function getValidade() {
        return $this->validade;
    }

    public function getUnidade() {
        return $this->unidade;
    }

    public function getDisponível() {
        return $this->disponível;
    }

    public function getReservado() {
        return $this->reservado;
    }

    public function getBloqueado() {
        return $this->bloqueado;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getPesoBruto() {
        return $this->pesoBruto;
    }

    public function getValorMercadoria() {
        return $this->valorMercadoria;
    }

    public function getFiltro($filtro) {
        return $this->filtro[$filtro];
    }

    protected function setHandle($handle) {
        $this->handle = $handle;
    }

    protected function setProduto($produto) {
        $this->produto = $produto;
    }

    protected function setDescricaoProduto($descricaoProduto) {
        $this->descricaoProduto = $descricaoProduto;
    }

    protected function setNaturezaMercadoria($naturezaMercadoria) {
        $this->naturezaMercadoria = $naturezaMercadoria;
    }

    protected function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    protected function setNotaFiscal($notaFiscal) {
        $this->notaFiscal = $notaFiscal;
    }

    protected function setDataEmissão($dataEmissão) {
        $this->dataEmissão = $dataEmissão;
    }

    protected function setNrPedido($nrPedido) {
        $this->nrPedido = $nrPedido;
    }

    protected function setLote($lote) {
        $this->lote = $lote;
    }

    protected function setValidade($validade) {
        $this->validade = $validade;
    }

    protected function setUnidade($unidade) {
        $this->unidade = $unidade;
    }

    protected function setDisponível($disponível) {
        $this->disponível = $disponível;
    }

    protected function setReservado($reservado) {
        $this->reservado = $reservado;
    }

    protected function setBloqueado($bloqueado) {
        $this->bloqueado = $bloqueado;
    }

    protected function setTotal($total) {
        $this->total = $total;
    }

    protected function setPesoBruto($pesoBruto) {
        $this->pesoBruto = $pesoBruto;
    }

    protected function setValorMercadoria($valorMercadoria) {
        $this->valorMercadoria = $valorMercadoria;
    }

    protected function setFiltro($filtro, $value) {
        $this->filtro[$filtro] = $value;
    } 
    
    protected function getQueryFiltroProduto() {
        return "SELECT TOP 1000 
                       A.HANDLE, 
                       A.CODIGOREFERENCIA C1, 
                       A.NOME C2, 
                       B0.NOME C3
                  FROM MT_ITEM A (NOLOCK)  
                  LEFT JOIN MT_TIPOITEM B0 (NOLOCK) ON A.TIPO = B0.HANDLE
                 WHERE A.EMPRESA = {$_SESSION['empresa']}
                   AND A.STATUS = 4                   
                   AND EXISTS(SELECT Z0.HANDLE 
                                FROM AM_SALDOESTOQUE Z0 
                               WHERE Z0.ITEM = A.HANDLE 
                                 AND Z0.SALDOQUANTIDADE > 0
                                 AND (NOT EXISTS (SELECT Z1.HANDLE FROM MS_USUARIOPESSOA Z1 (NOLOCK) WHERE Z1.USUARIO = {$_SESSION['handleUsuario']}) OR
				                          
                                          EXISTS (SELECT Z2.HANDLE FROM MS_USUARIOPESSOA Z2 (NOLOCK) WHERE Z2.USUARIO = {$_SESSION['handleUsuario']} AND Z2.PESSOA = Z0.CLIENTE)))
                 ORDER BY C1";
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

                   AND (NOT EXISTS (SELECT Z.HANDLE FROM MS_USUARIOPESSOA Z (NOLOCK) WHERE Z.USUARIO = {$_SESSION['handleUsuario']}) OR
				            
                            EXISTS (SELECT Z.HANDLE FROM MS_USUARIOPESSOA Z (NOLOCK) WHERE Z.USUARIO = {$_SESSION['handleUsuario']} AND Z.PESSOA = A.HANDLE))";
	}

    protected function getQueryFiltroClientePessoa() {
        return "SELECT C.HANDLE, 
                      C.APELIDO C1, 
                      C.CNPJCPF C2, 
                      C.NOME C3,
                      C.EHCLIENTE C4
                 FROM MS_USUARIO A
                 INNER JOIN MS_USUARIOPESSOA B ON B.USUARIO = A.HANDLE
                 INNER JOIN MS_PESSOA C ON B.PESSOA = C.HANDLE
                 WHERE A.HANDLE = {$_SESSION['handleUsuario']}
                   AND C.STATUS = 4
                 ORDER BY C1";
    }
    
    protected function getQueryFiltroNaturezaMercadoria() {
        return "SELECT TOP 1000 
                       A.HANDLE, 
                       A.NOME C1, 
                       A.CODIGO C2
                  FROM MT_NATUREZAMERCADORIA A (NOLOCK)   
                 WHERE A.STATUS = 4

                 ORDER BY C1";
    }
    
    protected function getQueryFiltroLote() {
        return "SELECT TOP 1000 
                       A.HANDLE, 
                       A.NOME C1
                  FROM AM_LOTE A  (NOLOCK)  
                 WHERE 1 = 1 
                 ORDER BY C1";
    }
}
