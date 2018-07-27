<?php

class EmpregadoController extends Zend_Controller_Action {

	public function init() {

	}

	function empregadoAction() {

		//select no banco da tabela albuns
		$empregado = new Application_Model_DbTable_Empregado();
		$this->view->empregado = $empregado->fetchAll();
	}

	///adiciona MARCA
	function addempregadoAction() {

		//instancio a classe do formulario e jogo para a variavel
		$form = new Application_Form_Empregado();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$nomeCompleto = $form->getValue('NomeCompleto');
				$email = $form->getValue('Email');

				$guardaDataNasc = explode('/', $form->getValue('DataNasc'));
				$dataNasc = $guardaDataNasc[2] . '-' . $guardaDataNasc[1] . '-' . $guardaDataNasc[0];
//				$dataNasc = $form->getValue('DataNasc');
				
				$cpf = $form->getValue('Cpf');
				$rg = $form->getValue('Rg');
				$nroCarteiraTrab = $form->getValue('NroCarteiraTrab');
				$telefone = $form->getValue('Telefone');
				$celular = $form->getValue('Celular');
				$salario = $form->getValue('Salario');
				$rua = $form->getValue('Rua');
				$bairro = $form->getValue('Bairro');
				$numero = $form->getValue('Numero');
				$cep = $form->getValue('Cep');
				$cargo_idCargo = $form->getValue('Cargo');
				$tipoContrato = $form->getValue('TipoContrato');
				
				$guardaDataInicio = explode('/', $form->getValue('DataInicio'));
				$dataInicio = $guardaDataInicio[2] . '-' . $guardaDataInicio[1] . '-' . $guardaDataInicio[0];
//				$dataInicio = $form->getValue('DataInicio');
						
				$cidade = $form->getValue('Cidade');
				$estado = $form->getValue('Estado');
				$pais = $form->getValue('Pais');

				$empregados = new Application_Model_DbTable_Empregado();

				$empregados->addEmpregado($nomeCompleto, $email, $dataNasc, $cpf,
				$rg, $nroCarteiraTrab, $telefone, $celular, $salario, $rua, $bairro,
				$numero, $cep, $cargo_idCargo, $tipoContrato, $dataInicio, $cidade,
				$estado, $pais);
				$this->_helper->redirector('empregado');
			} else {
				$form->populate($formData);
			}
		}
	}

	function editempregadoAction() {
			
		$form = new Application_Form_Empregado();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$id = (int) $form->getValue('idEmpregado');

				$NomeCompleto = $form->getValue('NomeCompleto');
				$Email = $form->getValue('Email');
				$DataNasc = $form->getValue('DataNasc');
				$Cpf = $form->getValue('Cpf');
				$Rg = $form->getValue('Rg');
				$NroCarteiraTrab = $form->getValue('NroCarteiraTrab');
				$Telefone = $form->getValue('Telefone');
				$Celular = $form->getValue('Celular');
				$Salario = $form->getValue('Salario');
				$Rua = $form->getValue('Rua');
				$Bairro = $form->getValue('Bairro');
				$Numero = $form->getValue('Numero');
				$Cep = $form->getValue('Cep');
				$Cargo_idCargo = $form->getValue('Cargo');
				$tipoContrato = $form->getValue('TipoContrato');
				$dataInicio = $form->getValue('DataInicio');
				$Cidade = $form->getValue('Cidade');
				$Estado = $form->getValue('Estado');
				$Pais = $form->getValue('Pais');

				$empregados = new Application_Model_DbTable_Empregado();
				$empregados->updateEmpregado($id, $nomeCompleto, $email, $dataNasc, $cpf,
				$rg, $nroCarteiraTrab, $telefone, $celular, $salario, $rua, $bairro,
				$numero, $cep, $cargo_idCargo, $tipoContrato,
				$dataInicio, $cidade, $estado, $pais);

				$this->_helper->redirector('empregado');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idEmpregado', 0);
			if ($id > 0) {
				$empregado = new Application_Model_DbTable_Empregado();
				$form->populate($empregado->getEmpregado($id));
			}
		}
	}
	//
	//    //delet na tabela empregado
	//    public function deleteempregadoAction() {
	//        if ($this->getRequest()->isPost()) {
	//            $del = $this->getRequest()->getPost('del');
	//            if ($del == 'Yes') {
	//                $id = $this->getRequest()->getPost('idEmpregado');
	//                $empregados = new Application_Model_DbTable_Empregado();
	//                $empregados->deleteEmpregado($id);
	//            }
	//            $this->_helper->redirector('empregado');
	//        } else {
	//            $id = $this->_getParam('idEmpregado', 0);
	//            $empregados = new Application_Model_DbTable_Empregado();
	//            $this->view->empregado = $empregados->getEmpregado($id);
	//        }
	//    }

	public function deleteempregadoAction(){
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');

			$id = $this->getRequest()->getPost('idEmpregado');

			$modeloVeiculo = '';
			$Veiculo = new Application_Model_DbTable_Venda();
			$verificandoModelo = $Veiculo->verificaEmpregado($id);

			foreach ($verificandoModelo as $m){
				$modeloVeiculo = $modeloVeiculo . $m->idVenda;
			}

			/*assina variavel para jogar na view*/
			$this->view->vendaEmpregado = $modeloVeiculo;

			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idEmpregado');
				$empregados = new Application_Model_DbTable_Empregado();
				$empregados->deleteEmpregado($id);
			}
			$this->_helper->redirector('empregado');
		} else {
			$id = $this->_getParam('idEmpregado', 0);

			$modeloVeiculo = '';
			$Veiculo = new Application_Model_DbTable_Venda();
			$verificandoModelo = $Veiculo->verificaEmpregado($id);

			foreach ($verificandoModelo as $m){
				$modeloVeiculo = $modeloVeiculo . $m->idVenda;
			}

			/*assina variavel para jogar na view*/
			$this->view->vendaEmpregado = $modeloVeiculo;
				
			$empregados = new Application_Model_DbTable_Empregado();
			$this->view->empregado = $empregados->getEmpregado($id);
		}
	}

}

