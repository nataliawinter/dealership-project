<?php

class Application_Form_Veiculo extends Zend_Form {

    public function init() {

        $this->setName('addVeiculo');

        $id = new Zend_Form_Element_Hidden('idVeiculo');
        $id->addFilter('Int');

        $Placa = new Zend_Form_Element_Text('Placa');
        $Placa->setLabel('Placa: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $Cor = new Zend_Form_Element_Text('Cor');
        $Cor->setLabel('Cor: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $NroPortas = new Zend_Form_Element_Text('NroPortas');
        $NroPortas->setLabel('Numero de Portas: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');


        $ItensOpcionais = new Zend_Form_Element_Textarea('ItensOpcionais');
        $ItensOpcionais->setLabel('Itens Opcionais:')
                ->SetAttrib('cols', '16')
                ->SetAttrib('rows', '4');
        //$ItensOpcionais ->SetAttrib ('size', '40 ');


        $ValorPago = new Zend_Form_Element_Text('ValorPago');
        $ValorPago->setLabel('Valor Pago: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $ValorVenda = new Zend_Form_Element_Text('ValorVenda');
        $ValorVenda->setLabel('Valor da Venda: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $TotalGanho = new Zend_Form_Element_Text('TotalGanho');
        $TotalGanho->setLabel('Total Ganho: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $AnoModelo = new Zend_Form_Element_Text('AnoModelo');
        $AnoModelo->setLabel('Ano do Modelo: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $AnoFabricacao = new Zend_Form_Element_Text('AnoFabricacao');
        $AnoFabricacao->setLabel('Ano de Fabricacao: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $Combustivel = new Zend_Form_Element_Select("Combustivel");
        $Combustivel->setLabel("Combutivel: ");
        $Combustivel->addMultiOptions(array(' ' => 'Selecione', '1' => 'Gasolina', '2' => 'Alcool', '3' => 'Flex'));

        $EstadoDeUso = new Zend_Form_Element_Select("EstadoDeUso");
        $EstadoDeUso->setLabel("Estado de Uso: ");
        $EstadoDeUso->addMultiOptions(array(' ' => 'Selecione', '1' => 'Novo', '2' => 'Semi-Novo', '3' => 'Usado'));

        $Status = new Zend_Form_Element_Select("Status");
        $Status->setLabel("Status: ");
        $Status->addMultiOptions(array(' ' => 'Selecione', '1' => 'Vendido', '2' => 'Disponivel'));


        $Modelo_idModelo = new Zend_Form_Element_Select("Modelo");
        $Modelo_idModelo->setLabel('Modelo: ')
                ->setRequired('true');

        $Modelo = new Application_Model_DbTable_Modelo();
        foreach ($Modelo->pegaModelo() as $m) {
            $Modelo_idModelo->addMultiOption($m->idModelo, $m->Modelo);
        }

//        $model = new Zend_Form_Element_Select("Modelo");
        

//        $marca = new Zend_Form_Element_Select("Marca");
//        $marca->setLabel('Marca:')
//                ->setRequired('true');

         /*pego o id da marca que esta na tabela modelo*/
                       
//        $marcadoModelo = new Application_Model_DbTable_Modelo();
//        $guardaMarcaID = $marcadoModelo->pegaMarca();

        
                
//        $marcaSelect = new Application_Model_DbTable_Modelo();
//        foreach ($Modelo->pegamarcaModelo($pegamarcaModelo) as $m) {
//            $marca->addMultiOption($m->idModelo, $m->Modelo);
//        }

        
        
        $Categoria_idCategoria = new Zend_Form_Element_Select("Categoria");
        $Categoria_idCategoria->setLabel('Categoria: ')
                ->setRequired('true');

        $Categoria = new Application_Model_DbTable_Categoria();
        foreach ($Categoria->pegaCategoria() as $c) {
            $Categoria_idCategoria->addMultiOption($c->idCategoria, $c->Categoria);
        }


        //$Modelo_idModelo = new Zend_Form_Element_Select("Modelo_idModelo");
        //$Modelo_idModelo->setLabel("Modelo : ");
        //$selectStatus->addMultiOptions(array(' ' => 'Selecione', '1' => 'Vendido', '2' => 'Dispon�vel'));
        //$SelectModelo = new Zend_Form_Element_Text('Modelo');
        //$SelectModelo->setLabel('Modelo')
        //->setRequired(true)
        //->addFilter('StripTags')
        //->addFilter('StringTrim')
        //->addValidator('NotEmpty');


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('idVeiculo', 'submitbutton');
        $this->addElements(
                array(
                    $id, $Placa, $Cor, $NroPortas, $ItensOpcionais, $ValorPago, $ValorVenda, $TotalGanho,
                    $AnoModelo, $AnoFabricacao, $Combustivel, $EstadoDeUso, $Status, $Modelo_idModelo, $Categoria_idCategoria, $submit
                )
        );
    }

}