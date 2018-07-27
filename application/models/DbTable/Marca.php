<?php

class Application_Model_DbTable_Marca extends Zend_Db_Table_Abstract {

	protected $_name = 'marca';

	public function getMarca($id) {
		$id = (int) $id;
		$row = $this->fetchRow('idMarca = ' . $id);

		if (!$row) {
			throw new Exception("Não foi encontrado nenhuma linha com o ID = $id");
		}
		return $row->toArray();
	}

	public function addMarca($marca) {
		$data = array(
            'Marca' => $marca,
		);
		$this->insert($data);
	}

	public function updateMarca($id, $marca) {
		$data = array(
            'Marca' => $marca,
		);
		$this->update($data, 'idMarca= ' . $id);
	}

	public function deletemarca($id) {
		$this->delete('idMarca=' . $id);
	}

	public function pegaMarca() {
		$select = $this->select()->from('marca', array('idMarca', 'Marca'));

		return $this->fetchAll($select);
	}

//	public function verificaMarca($id){
//		
//		$select = $this->select()->from('modelo', array('idModelo'))->where('Marca_idMarca = ?', $id);
//		return $select;
//	}
}

