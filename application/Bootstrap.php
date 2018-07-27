<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
	{
		$autoloader = new Zend_Application_Module_Autoloader(array(
            'basePath' => APPLICATION_PATH,
            'namespace' => ''
            ));
            return $autoloader;
	}


	public function _initView() {
		$this->bootstrap("layout");
		$layout = $this->getResource("layout");
		$view = $layout->getView();
		$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
		$view->jQuery()->addStylesheet("css/redmond/jquery-ui-1.8.9.custom.css")
		->setLocalPath('js/jquery-1.4.4.min.js')
		->setUiLocalPath("js/jquery-ui-1.8.9.custom.min.js");

		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view);
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
	}

}

