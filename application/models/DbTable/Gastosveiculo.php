<?php

class Application_Model_DbTable_Gastosveiculo extends Zend_Db_Table_Abstract
{
	protected $_name = 'gastosveiculo';

	public function getGastosveiculo($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idGastosveiculo = ' . $id);
		if (!$row) {
			throw new Exception("Não foi encontrado algum registro com o ID => $id");
		}
		return $row->toArray();
	}

	public function addGastosveiculo($descricao, $totalgasto, $pago, $veiculo_idVeiculo, $datagasto)
	{
		$data = [
			'Descricao' => $descricao,
			'TotalGasto' => $totalgasto,
			'Pago' => $pago,
		    'veiculo_idVeiculo' => $veiculo_idVeiculo,
		    'DataGasto' => $datagasto
		];
		$this->insert($data);
	}

	public function updateGastosveiculo($id, $descricao, $totalgasto, $pago, $veiculo_idVeiculo, $datagasto)
	{
		$data = [
			'Descricao' => $descricao,
			'TotalGasto' => $totalgasto,
			'Pago' => $pago,
		    'veiculo_idVeiculo' => $veiculo_idVeiculo,
		    'DataGasto' => $datagasto
		];
		$this->update($data, 'idGastosveiculo = ' . (int) $id);
	}

	public function deleteGastosveiculo($id)
	{
		$this->delete('idGastosveiculo =' . (int) $id);
	}
	
	public function totalGastosVeiculo()
	{
        $select = $this->select()->from('gastosveiculo', ['soma' => 'sum(TotalGasto)']);
        $result = $this->fetchRow($select);
        return $result->soma;
	}
}
