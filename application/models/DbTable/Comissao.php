<?php

class Application_Model_DbTable_Comissao extends Zend_Db_Table_Abstract {

	protected $_name = 'comissao';

	public function getComissao($id) {
		$id = (int) $id;
		$row = $this->fetchRow('idComissao = ' . $id);

		if (!$row) {
			throw new Exception("Nao foi encontrado nenhuma linha com o ID = $id");
		}
		return $row->toArray();
	}

	public function addComissao($de, $ate, $valor) {
		$data = array(
            'De' => $de,
            'Ate' => $ate,
            'Valor' => $valor
		);
		$this->insert($data);
	}

	public function updateComissao($id, $de, $ate, $valor) {
		$data = array(
            'De' => $de,
            'Ate' => $ate,
            'Valor' => $valor
		);
		$this->update($data, 'idComissao = ' . (int) $id);
	}

	public function deleteComissao($id) {
		$this->delete('idComissao=' . (int) $id);
	}

	public function pegaComissao() {

		$select = $this->select()->from('comissao', array('idComissao', 'Valor'));

		return $this->fetchAll($select);
	}
	
	/*verifica qual o valor que o empregado ira ganhar de comissao em cima do carro*/
	public function pegaValorComissao($comissao){
		$select = $this->select()->from('comissao', array('ValorTotal' => 'Valor'))->where('De < ' . $comissao . ' AND Ate > ' . $comissao);
		$result = $this->fetchRow($select);
		
        return $result->ValorTotal;
	}
}

