<?php
class Application_Form_Usuario extends Zend_Form
{
	public function init()
	{
		$this->setName('addusuario');
		$id = new Zend_Form_Element_Hidden('idUsuario');
		$id->addFilter('Int');

		$nome = new Zend_Form_Element_Text('Nome');
		$nome->setLabel('Login: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$senha = new Zend_Form_Element_Password('Senha');
		$senha->setLabel('Senha: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$permissoes = new Zend_Form_Element_Select("Permissao");
		$permissoes->setLabel("Permissao: ")
		->setRequired(true)
		->addValidator('NotEmpty')
		->addFilter('StringTrim');
		$permissoes->addMultiOptions([
			' ' => 'Selecione', 
			'1' => 'Proprietario', 
			'2' => 'Financeiro', 
			'3' => 'Gerente', 
			'4' => 'Vendedor',
			'5' => 'Atendente',
		]);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements([$id, $nome, $email, $senha, $permissoes, $submit]);
	}
}