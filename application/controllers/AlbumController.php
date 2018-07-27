<?php

class AlbumController extends Zend_Controller_Action
{

	public function init()
	{

	}

	function albumAction()
	{
		
		//select no banco na tabela albuns
		$albums = new Application_Model_DbTable_Albums();
		$this->view->albums = $albums->fetchAll();
				
		   	
	}

	//adiciona no album
	function addAction()
	{
		//instancio a classe do formulario e jogo para a variavel
		//$form
		$form = new Application_Form_Album();
		$form->submit->setLabel('ADICIONAR');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$artist = $form->getValue('artist');
				$title = $form->getValue('title');
				$title1 = $form->getValue('title1');
				$title2 = $form->getValue('title2');

				$albums = new Application_Model_DbTable_Albums();
				$albums->addAlbum($artist, $title, $title1, $title2);

				
				$this->_helper->redirector('album');
				
			} else {
				$form->populate($formData);
			}
		}

	}
///edita no album
	function editAction()
	{
		$form = new Application_Form_Album();
		$form->submit->setLabel('Save');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$id = (int)$form->getValue('id');
				$artist = $form->getValue('artist');
				$title = $form->getValue('title');
				$title1 = $form->getValue('title1');
				$title2 = $form->getValue('title2');
				$albums = new Application_Model_DbTable_Albums();
				$albums->updateAlbum($id, $artist, $title, $title1, $title2);
				$this->_helper->redirector('album');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$albums = new Application_Model_DbTable_Albums();
				$form->populate($albums->getAlbum($id));
			}
		}
	}

	
	//delet no album
	public function deleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('id');
				$albums = new Application_Model_DbTable_Albums();
				$albums->deleteAlbum($id);
			}
			$this->_helper->redirector('album');
		} else {
			$id = $this->_getParam('id', 0);
			$albums = new Application_Model_DbTable_Albums();
			$this->view->album = $albums->getAlbum($id);
		}
	}

	



	
}








