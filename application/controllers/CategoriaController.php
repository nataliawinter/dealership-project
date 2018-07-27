<?php

class CategoriaController extends Zend_Controller_Action {

    public function init() {
        
    }

    function categoriaAction() {
        //select no banco da tabela Categoria
        $categoria = new Application_Model_DbTable_Categoria();
        $this->view->categoria = $categoria->fetchAll();
    }

    public function addcategoriaAction() {
        $form = new Application_Form_Categoria();
        $form->submit->setLabel('salvar');
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $categoria = $form->getValue('Categoria');

                $categorias = new Application_Model_DbTable_Categoria();
                $categorias->addcategoria($categoria);
                $this->_helper->redirector('Categoria');
            } else {
                $form->populate($formData);
            }
        }
    }

    function editcategoriaAction() {
        $form = new Application_Form_Categoria();
        $form->submit->setLabel('salvar');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                $id = (int) $form->getValue('idCategoria');
                $categoria = $form->getValue('Categoria');

                $categorias = new Application_Model_DbTable_Categoria();
                $categorias->updatecategoria($id, $categoria);
                $this->_helper->redirector('categoria');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('idCategoria', 0);
            if ($id > 0) {
                $categoria = new Application_Model_DbTable_Categoria();
                $form->populate($categoria->getCategoria($id));
            }
        }
    }

    //	public function deletecategoriaAction() {
    //		if ($this->getRequest()->isPost()) {
    //			$del = $this->getRequest()->getPost('del');
    //			if ($del == 'Yes') {
    //				$id = $this->getRequest()->getPost('idCategoria');
    //				$Categorias = new Application_Model_DbTable_Categoria();
    //				$Categorias->deletecategoria($id);
    //			}
    //			$this->_helper->redirector('categoria');
    //		} else {
    //			$id = $this->_getParam('idCategoria', 0);
    //			$Categorias = new Application_Model_DbTable_Categoria();
    //			$this->view->categoria = $Categorias->getCategoria($id);
    //		}
    //	}

    public function deletecategoriaAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');

            $id = $this->getRequest()->getPost('idCategoria');

            $categoriaVeiculo = '';
            $Veiculo = new Application_Model_DbTable_Veiculo();
            $verificandoCategoria = $Veiculo->verificaCategoria($id);

            foreach ($verificandoCategoria as $c) {
                $categoriaVeiculo = $categoriaVeiculo . $c->idVeiculo;
            }

            /* assina variavel para jogar na view */
            $this->view->categoriaVeiculo = $categoriaVeiculo;

            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('idCategoria');
                $Categorias = new Application_Model_DbTable_Categoria();
                $Categorias->deletecategoria($id);
            }
            $this->_helper->redirector('categoria');
        } else {

            $id = $this->_getParam('idCategoria', 0);

            $categoriaVeiculo = '';
            $Veiculo = new Application_Model_DbTable_Veiculo();
            $verificandoCategoria = $Veiculo->verificaCategoria($id);

            foreach ($verificandoCategoria as $c) {
                $categoriaVeiculo = $categoriaVeiculo . $c->idVeiculo;
            }

            /* assina variavel para jogar na view */
            $this->view->categoriaVeiculo = $categoriaVeiculo;

            $Categorias = new Application_Model_DbTable_Categoria();
            $this->view->categoria = $Categorias->getCategoria($id);
        }
    }

}

