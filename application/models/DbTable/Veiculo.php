
<?php

class Application_Model_DbTable_Veiculo extends Zend_Db_Table_Abstract {

    protected $_name = 'veiculo';

    public function getVeiculo($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idVeiculo = ' . $id);

        if (!$row) {
            throw new Exception("Nenhum resultado para  $id");
        }
        return $row->toArray();
    }

    public function addVeiculo($placa, $cor, $NroPortas, $ItensOpcionais, $ValorPago, $ValorVenda, $TotalGanho, $AnoModelo, $AnoFabricacao, $Combustivel, $EstadoDeUso, $Status, $Modelo_idModelo, $Categoria_idCategoria) {

        $data = array(
            'Placa' => $placa,
            'cor' => $cor,
            'NroPortas' => $NroPortas,
            'ItensOpcionais' => $ItensOpcionais,
            'ValorPago' => $ValorPago,
            'ValorVenda' => $ValorVenda,
            'TotalGanho' => $TotalGanho,
            'AnoModelo' => $AnoModelo,
            'AnoFabricacao' => $AnoFabricacao,
            'Combustivel' => $Combustivel,
            'EstadoDeUso' => $EstadoDeUso,
            'Status' => $Status,
            'Modelo_idModelo' => $Modelo_idModelo,
            'Categoria_idCategoria' => $Categoria_idCategoria,
        );

        $this->insert($data);
    }

    public function updateVeiculo($id, $placa, $cor, $NroPortas, $ItensOpcionais, $ValorPago, $ValorVenda, $TotalGanho, $AnoModelo, $AnoFabricacao, $Combustivel, $EstadoDeUso, $Status, $Modelo_idModelo, $Categoria_idCategoria) {

        $data = array(
            'Placa' => $placa,
            'Cor' => $cor,
            'NroPortas' => $NroPortas,
            'ItensOpcionais' => $ItensOpcionais,
            'ValorPago' => $ValorPago,
            'ValorVenda' => $ValorVenda,
            'TotalGanho' => $TotalGanho,
            'AnoModelo' => $AnoModelo,
            'AnoFabricacao' => $AnoFabricacao,
            'Combustivel' => $Combustivel,
            'EstadoDeUso' => $EstadoDeUso,
            'Status' => $Status,
            'Modelo_idModelo' => $Modelo_idModelo,
            'Categoria_idCategoria' => $Categoria_idCategoria,
        );
        $this->update($data, 'idVeiculo= ' . (int) $id);
    }

    public function deleteveiculo($id) {
        $this->delete('idVeiculo=' . (int) $id);
    }

    public function getVeiculoValor() {
        $result = $this->getAdapter()->fetchAll('
			SELECT Modelo.Modelo, Veiculo.Placa, Veiculo.ValorVenda
			FROM Veiculo, Modelo
			WHERE Modelo.idModelo = Veiculo.Modelo_idModelo
		');
        return $result;
    }

    public function pegaVeiculo() {

        $select = $this->select()->from('veiculo', array('idVeiculo', 'Placa'));

        return $this->fetchAll($select);
    }

    public function verificaModelo($id) {

        $select = $this->select()->from('veiculo', array('idVeiculo'))->where('Modelo_idModelo = ?', $id);
        return $this->fetchAll($select);
    }

    public function verificaCategoria($id) {

        $select = $this->select()->from('veiculo', array('idVeiculo'))->where('Categoria_idCategoria = ?', $id);
        return $this->fetchAll($select);
    }

    /* soma o valor do totalGanho de todos os carros */

    public function totalVeiculosGanho() {

        $select = $this->select()->from('veiculo', array('soma' => 'sum(TotalGanho)'));
        $result = $this->fetchRow($select);
        return $result->soma;
    }

}

