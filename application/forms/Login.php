<?php
 
class Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setName('Nome');
 
        $nome = new Zend_Form_Element_Text('Nome');
        $nome->setLabel('Login:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
 
        $senha = new Zend_Form_Element_Password('Senha');
        $senha->setLabel('Senha:')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
 
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Logar')
               ->setAttrib('idusuario', 'submitbutton');
 
        $this->addElements(array($nome, $senha, $submit));
    }
}