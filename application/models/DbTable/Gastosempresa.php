<?php

class Application_Model_DbTable_Gastosempresa extends Zend_Db_Table_Abstract
{
	protected $_name = 'gastosempresa';

	public function getGastosempresa($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idGastosempresa = ' . $id);
		if (!$row) {
			throw new Exception("Não foi encontrado algum registro com o ID => $id");
		}
		return $row->toArray();
	}
	
	public function addGastosempresa($detalhes, $valor, $data)
	{
		$data = [
			'Detalhes' => $detalhes,
			'Valor' => $valor,
			'Data' => $data
		];
		$this->insert($data);
	}
	
	public function updateGastosempresa($id, $detalhes, $valor, $data)
	{
		$data = [
			'Detalhes' => $detalhes,
			'Valor' => $valor,
			'Data' => $data
		];
		$this->update($data, 'idGastosempresa = ' . (int) $id);
	}
	
	public function deleteGastosempresa($id)
	{
		$this->delete('idGastosempresa =' . (int) $id);
	}
		
	public function totalGastosEmpresa()
	{
        $select = $this->select()->from('gastosempresa', ['soma' => 'sum(Valor)']);
        $result = $this->fetchRow($select);
        return $result->soma;
	}
}
