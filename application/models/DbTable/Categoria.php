<?php

class Application_Model_DbTable_Categoria extends Zend_Db_Table_Abstract
{
    protected $_name = 'categoria';

    public function getCategoria($id)
    {
        $id = (int) $id;
        $row = $this->fetchRow('idCategoria = ' . $id);
        if (!$row) {
            throw new Exception("Não foi encontrado algum registro com o ID => $id");
        }
        return $row->toArray();
    }

    public function addcategoria($categoria)
    {
        $data = [
            'Categoria' => $categoria,
        ];
        $this->insert($data);
    }

    public function updateCategoria($id, $categoria)
    {
        $data = [
            'Categoria' => $categoria,
        ];
        $this->update($data, 'idCategoria = ' . (int) $id);
    }

    public function deleteCategoria($id)
    {
        $this->delete('idCategoria =' . (int) $id);
    }

    public function pegaCategoria()
    {
        $select = $this->select()->from('categoria', ['idCategoria', 'Categoria']);
        return $this->fetchAll($select);
    }

}
