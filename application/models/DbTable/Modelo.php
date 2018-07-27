<?php


//cria classe veículo
class Application_Model_DbTable_Modelo extends Zend_Db_Table_Abstract
{
	protected $_name = 'modelo';

	//seleciona no banco e pega o veículo
	public function getModelo($id)
	{
		$id = (int)$id;
		$row = $this->fetchRow('idModelo = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

	//adiciona um novo veículo

	public function addModelo($modelo, $marca)
	{
		$data = array(
			'Modelo' => $modelo,
			'Marca_idMarca' => $marca,
		);
		$this->insert($data);

	}

	//edita no veículo
	public function updateModelo($id, $modelo, $marca)
	{
		$data = array(
		'Modelo' => $modelo,
		'Marca_idMarca' => $marca,

		);
		$this->update($data, 'idModelo = '. (int)$id);
	}

	//vai deletar da tabela veiculo por ID
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



