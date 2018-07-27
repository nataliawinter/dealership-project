
<?php

class Application_Model_DbTable_Venda extends Zend_Db_Table_Abstract {

	protected $_name = 'venda';

	//seleciona no banco e pega a venda
	public function getVenda($id) {
		$id = (int) $id;
		$row = $this->fetchRow('idVenda = ' . $id);

		if (!$row) {
			throw new Exception("Nenhum resultado para  $id");
		}
		return $row->toArray();
	}

	public function addVenda($formaPagamento, $valorVenda, $dataVenda,
	$pago, $dataPagto, $veiculo_idVeiculo, $cliente_idCliente, $empregado_idEmpregado, $banco) {

		$data = array(
            'FormaPagamento' => $formaPagamento,
            'ValorVenda' => $valorVenda,
            'DataVenda' => $dataVenda,
            'Pago' => $pago,
            'DataPagto' => $dataPagto,
            'Veiculo_idveiculo' => $veiculo_idVeiculo,
            'Cliente_idCliente' => $cliente_idCliente,
            'Empregado_idEmpregado' => $empregado_idEmpregado,
            'Banco' => $banco
		);

		$this->insert($data);
	}

	public function updateVenda($id, $formaPagamento, $valorVenda, $dataVenda, $pago, $dataPagto, $veiculo_idVeiculo, $cliente_idCliente, $empregado_idEmpregado, $banco) {

		$data = array(
            'FormaPagamento' => $formaPagamento,
            'ValorVenda' => $valorVenda,
            'DataVenda' => $dataVenda,
            'Pago' => $pago,
            'DataPagto' => $dataPagto,
            'Veiculo_idveiculo' => $veiculo_idVeiculo,
            'Cliente_idCliente' => $cliente_idCliente,
            'Empregado_idEmpregado' => $empregado_idEmpregado,
        	'Banco' => $banco
		);

		$this->update($data, 'idVenda = ' . (int) $id);
	}

	public function deleteVenda($id) {
		$this->delete('idVenda =' . (int) $id);
	}

	public function pegaVenda() {

		$select = $this->select()->from('venda', array('idVenda', 'ValorVenda'));

		return $this->fetchAll($select);
	}

	public function verificaVeiculo($id){

		$select = $this->select()->from('venda', array('idVenda'))->where('Veiculo_idVeiculo = ?', $id);
		return $this->fetchAll($select);
	}

	public function verificaVenda($id){

		$select = $this->select()->from('venda', array('idVenda'))->where('Cliente_idCliente = ?', $id);
		return $this->fetchAll($select);

	}

	public function verificaEmpregado($id){

		$select = $this->select()->from('venda', array('idVenda'))->where('Empregado_idEmpregado = ?', $id);
		return $this->fetchAll($select);

	}

	public function totalVenda() {

		$select = $this->select()->from('venda', array('soma' => 'sum(ValorVenda)'))->where('Pago = 1');
		$result = $this->fetchRow($select);
		return $result->soma;
	}

}


