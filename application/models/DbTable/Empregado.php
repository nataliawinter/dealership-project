<?php

class Application_Model_DbTable_Empregado extends Zend_Db_Table_Abstract {

	protected $_name = 'empregado';

	public function getEmpregado($id) {
		$id = (int) $id;
		$row = $this->fetchRow('idEmpregado = ' . $id);

		if (!$row) {
			throw new Exception("Não foi encontrado nenhuma linha com o ID = $id");
		}
		return $row->toArray();
	}

	public function addEmpregado($nomeCompleto, $email, $dataNasc,
	$cpf, $rg, $nroCarteiraTrab, $telefone, $celular, $salario,
	$rua, $bairro, $numero, $cep, $cargo_idCargo, $tipoContrato, $dataInicio, $cidade, $estado, $pais) {
		$data = array(
            'NomeCompleto' => $nomeCompleto,
            'Email' => $email,
            'DataNasc' => $dataNasc,
            'Cpf' => $cpf,
            'Rg' => $rg,
            'NroCarteiraTrab' => $nroCarteiraTrab,
            'Telefone' => $telefone,
            'Celular' => $celular,
            'Salario' => $salario,
            'Rua' => $rua,
            'Bairro' => $bairro,
            'Numero' => $numero,
            'Cep' => $cep,
            'Cargo_idCargo' => $cargo_idCargo,
	        'TipoContrato' => $tipoContrato,
			'DataInicio' => $dataInicio,
            'Cidade' => $cidade,
            'Estado' => $estado,
            'Pais' => $pais
		);
		$this->insert($data);
	}

	public function updateEmpregado($id, $nomeCompleto, $email, $dataNasc,
	$cpf, $rg, $nroCarteiraTrab, $telefone, $celular, $salario,
	$rua, $bairro, $numero, $cep, $cargo_idCargo, $tipoContrato, $dataInicio, $cidade, $estado, $pais) {
		$data = array(
            'NomeCompleto' => $nomeCompleto,
            'Email' => $email,
            'DataNasc' => $dataNasc,
            'Cpf' => $cpf,
            'Rg' => $rg,
            'NroCarteiraTrab' => $nroCarteiraTrab,
            'Telefone' => $telefone,
            'Celular' => $celular,
            'Salario' => $salario,
            'Rua' => $rua,
            'Bairro' => $bairro,
            'Numero' => $numero,
            'Cep' => $cep,
            'Cargo_idCargo' => $cargo_idCargo,
	        'TipoContrato' => $tipoContrato,
			'DataInicio' => $dataInicio,
            'Cidade' => $cidade,
            'Estado' => $estado,
            'Pais' => $pais
		);
		$this->update($data, 'idEmpregado = ' . (int) $id);
	}

	public function deleteEmpregado($id) {
		$this->delete('idEmpregado=' . (int) $id);
	}

	public function pegaEmpregado() {
			
		$select = $this->select()->from('empregado', array('idEmpregado', 'NomeCompleto'));

		return $this->fetchAll($select);
	}
	
	public function verificaCargo($id){

		$select = $this->select()->from('empregado', array('idEmpregado'))->where('Cargo_idCargo = ?', $id);
		return $this->fetchAll($select);

	}
		
	public function totalSalario() {

        $select = $this->select()->from('empregado', array('soma' => 'sum(Salario)'));
        $result = $this->fetchRow($select);
        return $result->soma;
    
	}

	public function insereComissao($comissao, $idEmpregado){
	
		$select = $this->select()->from('empregado', array('TotalComissao' => 'AcumulaComissao'))->where('idEmpregado = ?', $idEmpregado);
		$result = $this->fetchRow($select);

		$totalComissao = $result->TotalComissao;

		/*pega a comissao atual e soma com mais essa comissao*/
		$somaComissaoAtual = $totalComissao + $comissao;
		
		$data = array(
			'AcumulaComissao' => $somaComissaoAtual
		);
		
		$this->update($data, 'idEmpregado = ' . $idEmpregado);
	
	}
}

