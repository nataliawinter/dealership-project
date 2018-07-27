
<?php

//cria classe ve�culo
class Application_Model_DbTable_Cargo extends Zend_Db_Table_Abstract {

    protected $_name = 'cargo';

    //seleciona no banco e pega o ve�culo
    public function getCargo($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idCargo = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    //adiciona um novo ve�culo

    public function addcargo($cargo) {
        $data = array(
            'Cargo' => $cargo,
        );
        $this->insert($data);
    }

    //edita no ve�culo
    public function updateCargo($id, $cargo) {
        $data = array(
            'Cargo' => $cargo,
        );
        $this->update($data, 'idCargo = ' . (int) $id);
    }

    //vai deletar da tabela veiculo por ID
    public function deleteCargo($id) {
        $this->delete('idCargo =' . (int) $id);
    }

    public function pegaCargo() {

        $select = $this->select()->from('cargo', array('idCargo', 'Cargo'));
        return $this->fetchAll($select);
    }

}

