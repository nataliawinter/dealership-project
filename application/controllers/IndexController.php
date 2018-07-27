<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    function indexAction() {



        $usuario = Zend_Auth::getInstance()->getIdentity();
        $this->view->usuario = $usuario;

        return $this->_helper->redirector('login');
    }

    public function loginAction() {
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages = $this->_flashMessenger->getMessages();
        $form = new Form_Login();
        $this->view->form = $form;
        //Verifica se existem dados de POST
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            //Formulario corretamente preenchido?
            if ($form->isValid($data)) {
                $nome = $form->getValue('Nome');
                $senha = $form->getValue('Senha');

                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                //Inicia o adaptador Zend_Auth para banco de dados
                $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
                $authAdapter->setTableName('usuario')
                        ->setIdentityColumn('Nome')
                        ->setCredentialColumn('Senha')
                        ->setCredentialTreatment('Senha');
                //Define os dados para processar o login
                $authAdapter->setIdentity($nome)
                        ->setCredential($senha);
                //Efetua o login
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                $Veiculo = new Application_Model_DbTable_Usuario();
                $verificandoCategoria = $Veiculo->pegaPermissao($nome, $senha);
                
                require_once ('Zend/Session/Namespace.php');

                $sessaoUsuario = new Zend_Session_Namespace('USUARIO');
                foreach ($verificandoCategoria as $c) {
                    $sessaoUsuario->idUsuario = $c->idUsuario;
                    $sessaoUsuario->Nome = $c->Nome;
                    $sessaoUsuario->Email = $c->Email;
                    $sessaoUsuario->Permissao = $c->Permissao;
                }

                //Verifica se o login foi efetuado com sucesso
                if ($result->isValid()) {
                    //Armazena os dados do usu�rio em sess�o, apenas desconsiderando
                    //a senha do usu�rio
                    $info = $authAdapter->getResultRowObject(null, 'senha');
                    $storage = $auth->getStorage();
                    $storage->write($info);

                    //Redireciona para o Controller protegido
                    return $this->_helper->redirector->goToRoute(array('controller' => 'noticias'), null, true);
                } else {
                    //Dados inv�lidos
                    $this->_helper->FlashMessenger('<h3>Usuario ou senha invalidos!</h3>');
                    $this->_redirect('/index');
                }
            } else {
                //Formul�rio preenchido de forma incorreta
                $form->populate($data);
            }
        }
    }

    public function logoutAction() {
	
		Zend_Session::destroy(true);
	
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        return $this->_helper->redirector('index');
    }

}

