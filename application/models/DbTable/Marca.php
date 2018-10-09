<?php

class Application_Model_DbTable_Marca extends Zend_Db_Table_Abstract
{
	protected $_name = 'marca';

	public function getMarca($id)
	{
		$id = (int) $id;
		$row = $this->fetchRow('idMarca = ' . $id);

		if (!$row) {
			throw new Exception("Não foi encontrado alguma linha com o ID = $id");
		}
		return $row->toArray();
	}

	public function addMarca($marca)
	{
		$data = ['Marca' => $marca];
		$this->insert($data);
	}

	public function updateMarca($id, $marca)
	{
		$data = ['Marca' => $marca];
		$this->update($data, 'idMarca= ' . $id);
	}

	public function deletemarca($id)
	{
		$this->delete('idMarca=' . $id);
	}

	public function pegaMarca()
	{
		$select = $this->select()->from('marca', ['idMarca', 'Marca']);
		return $this->fetchAll($select);
	}
}
