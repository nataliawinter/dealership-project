
<?php

class Application_Model_DbTable_Cargo extends Zend_Db_Table_Abstract
{
    protected $_name = 'cargo';

    public function getCargo($id)
    {
        $id = (int) $id;
        $row = $this->fetchRow('idCargo = ' . $id);
        if (!$row) {
            throw new Exception("Não foi encontrado algum registro com o ID => $id");
        }
        return $row->toArray();
    }

    public function addcargo($cargo)
    {
        $data = [
            'Cargo' => $cargo,
        ];
        $this->insert($data);
    }

    public function updateCargo($id, $cargo)
    {
        $data = [
            'Cargo' => $cargo,
        ];
        $this->update($data, 'idCargo = ' . (int) $id);
    }

    public function deleteCargo($id)
    {
        $this->delete('idCargo =' . (int) $id);
    }

    public function pegaCargo()
    {
        $select = $this->select()->from('cargo', ['idCargo', 'Cargo']);
        return $this->fetchAll($select);
    }
}
