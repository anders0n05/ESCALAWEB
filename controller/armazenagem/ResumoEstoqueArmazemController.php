<?php
include_once('../../model/armazenagem/ResumoEstoqueArmazemModel.php');

/**
 * Description of EstoqueArmazem
 *
 * @author leonardo.laurindo
 */
class ResumoEstoqueArmazemController extends ResumoEstoqueArmazemModel
{

    private $conexao;

    function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    private function loadByQuery($query)
    {
//        $this->setHandle($query['HANDLE']);
        $this->setProduto($query['CODIGOREFERENCIA']);
        $this->setDescricaoProduto($query['PRODUTO']);
        $this->setDisponível(number_format($query['DISPONIVELQUANTIDADE'], 4, ',', '.'));
        $this->setReservado(number_format($query['RESERVADOQUANTIDADE'], 4, ',', '.'));
        $this->setBloqueado(number_format($query['BLOQUEADOQUANTIDADE'], 4, ',', '.'));
        $this->setTotal(number_format($query['SALDOQUANTIDADE'], 4, ',', '.'));
        $this->setPesoBruto(number_format($query['SALDOPESOBRUTO'], 4, ',', '.'));
        $this->setValorMercadoria(number_format($query['SALDOVALOR'], 4, ',', '.'));
    }

    private function getTableRow()
    {
        return "<tr>
                    <td>{$this->getProduto()}</td>
                    <td>{$this->getDescricaoProduto()}</td>   
                    <td class=\"text-right\">{$this->getDisponível()}</td>                    
                    <td class=\"text-right\">{$this->getReservado()}</td>
                    <td class=\"text-right\">{$this->getBloqueado()}</td>
                    <td class=\"text-right\">{$this->getTotal()}</td>
                    <td class=\"text-right\">{$this->getPesoBruto()}</td>
                    <td class=\"text-right\">{$this->getValorMercadoria()}</td>
                </tr>";
    }

    public function getRegistro($filtro = '')
    {
        $result = Array('ERRO' => false,
            'DADOS' => null);
        try {
            $filtro .= " AND EXISTS(SELECT X.HANDLE
                                      FROM MS_USUARIOPESSOA X
                                     WHERE X.PESSOA = A.CLIENTE 
                                       AND X.USUARIO = {$_SESSION['handleUsuario']}) ";

            $query = $this->conexao->prepare($this->getQuery($filtro));
            $query->execute();

            $result['DADOS'] = $this->processaRegistro($query);
        } catch (Exception $e) {
            $result['ERRO'] = true;
            $result['DADOS'] = Array("<div class=\"alert alert-warning\">{$e->getMessage()}</div>");
        }

        return $result;
    }

    private function processaRegistro($query)
    {
        $result = Array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $this->loadByQuery($row);

            $result[] = $this->getTableRow();
        }
        return $result;
    }

    public function montaFiltro()
    {
        $this->montaFiltroProduto();
        $this->montaFiltroCliente();
        $this->montaFiltroNaturezaMercadoria();
        $this->montaFiltroLote();
    }

    private function montaFiltroProduto()
    {
        $this->filtro['PRODUTO'] = Array();
        $query = $this->conexao->prepare($this->getQueryFiltroProduto());
        $query->execute();
        if ($query) {
            $this->filtro['PRODUTO'] = $query->fetchAll();
        }
    }

    private function montaFiltroCliente()
    {
        $this->filtro['CLIENTE'] = Array();
        $query = $this->conexao->prepare($this->getQueryFiltroClientePessoa());
        $query->execute();
        $dados = $query->fetchAll();
        if ($dados) {
            $this->filtro['CLIENTE'] = $dados;
        } else {
            $query = $this->conexao->prepare($this->getQueryFiltroCliente());
            $query->execute();
            if ($query) {
                $this->filtro['CLIENTE'] = $query->fetchAll();
            }
        }
    }

    private function montaFiltroNaturezaMercadoria()
    {
        $this->filtro['NATUREZAMERCADORIA'] = Array();
        $query = $this->conexao->prepare($this->getQueryFiltroNaturezaMercadoria());
        $query->execute();
        if ($query) {
            $this->filtro['NATUREZAMERCADORIA'] = $query->fetchAll();
        }
    }

    private function montaFiltroLote()
    {
        $this->filtro['LOTE'] = Array();
        $query = $this->conexao->prepare($this->getQueryFiltroLote());
        $query->execute();
        if ($query) {
            $this->filtro['LOTE'] = $query->fetchAll();
        }
    }
}