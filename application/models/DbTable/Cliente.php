<?php

class Application_Model_DbTable_Cliente extends Zend_Db_Table_Abstract {

	protected $_name = 'cliente';

	public function getCliente($id) {
		$id = (int) $id;
		$row = $this->fetchRow('idCliente = ' . $id);
		if (!$row) {
			throw new Exception("Could not find row $id");
		}
		return $row->toArray();
	}

	public function addCliente($nomeCompleto, $cpf, $rg,
	$data, $telefone, $celular, $email, $rua, $bairro, $numero, $cep, $cidade, $estado, $pais) {
		$data = array(
            'NomeCompleto' => $nomeCompleto,
            'Cpf' => $cpf,
            'Rg' => $rg,
            'DataNasc' => $data,
            'Telefone' => $telefone,
            'Celular' => $celular,
            'Email' => $email,
            'Rua' => $rua,
            'Bairro' => $bairro,
            'Numero' => $numero,
            'Cep' => $cep,
            'Cidade' => $cidade,
            'Estado' => $estado,
            'Pais' => $pais,
		);
		$this->insert($data);
	}

	public function updateCliente($id, $nomeCompleto, $cpf, $rg,
	$data, $telefone, $celular, $email, $rua, $bairro, $numero, $cep, $cidade, $estado, $pais) {

		$data = array(
            'NomeCompleto' => $nomeCompleto,
            'Cpf' => $cpf,
            'Rg' => $rg,
            'DataNasc' => $data,
            'Telefone' => $telefone,
            'Celular' => $celular,
            'Email' => $email,
            'Rua' => $rua,
            'Bairro' => $bairro,
            'Numero' => $numero,
            'Cep' => $cep,
            'Cidade' => $cidade,
            'Estado' => $estado,
            'Pais' => $pais,
		);

		$this->update($data, 'idCliente = ' . (int) $id);
	}

	public function deleteCliente($id) {
		$this->delete('idCliente =' . (int) $id);
	}

	public function pegaCliente() {

		$select = $this->select()->from('cliente', array('idCliente', 'NomeCompleto'));
		return $this->fetchAll($select);

	}

}

