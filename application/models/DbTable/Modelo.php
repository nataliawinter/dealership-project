<?php


//cria classe ve�culo
class Application_Model_DbTable_Modelo extends Zend_Db_Table_Abstract
{
	protected $_name = 'modelo';

	public function getModelo($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idModelo = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

	public function addModelo($modelo, $marca)
	{
		$data = [
			'Modelo' => $modelo,
			'Marca_idMarca' => $marca,
		];
		$this->insert($data);
	}

	public function updateModelo($id, $modelo, $marca)
	{
		$data = [
			'Modelo' => $modelo,
			'Marca_idMarca' => $marca,
		];
		$this->update($data, 'idModelo = '. (int)$id);
	}

	public function deleteModelo($id){
		$this->delete('idModelo =' . (int)$id);
	}

	public function pegaModelo(){

		$select = $this->select()->from('modelo', array('idModelo', 'Modelo'));

		return $this->fetchAll($select);

	}

	public function verificaMarca($id){

		$select = $this->select()->from('modelo', array('idModelo'))->where('Marca_idMarca = ?', $id);
		return $this->fetchAll($select);

	}

	public function pegaMarca($id){
	
        $select = $this->select()->from('modelo', array('marca' => 'Marca_idMarca'))->where('Marca_idMarca = ?', $id);
        $result = $this->fetchRow($select);
        return $result->marca;
	
	}
}



