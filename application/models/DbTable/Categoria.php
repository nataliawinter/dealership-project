
<?php

//cria classe ve�culo
class Application_Model_DbTable_Categoria extends Zend_Db_Table_Abstract {

    protected $_name = 'categoria';

    //seleciona no banco e pega o ve�culo
    public function getCategoria($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idCategoria = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    //adiciona um novo ve�culo

    public function addcategoria($categoria) {
        $data = array(
            'Categoria' => $categoria,
        );
        $this->insert($data);
    }

    //edita no ve�culo
    public function updateCategoria($id, $categoria) {
        $data = array(
            'Categoria' => $categoria,
        );
        $this->update($data, 'idCategoria = ' . (int) $id);
    }

    //vai deletar da tabela veiculo por ID
    public function deleteCategoria($id) {
        $this->delete('idCategoria =' . (int) $id);
    }

    public function pegaCategoria() {

        $select = $this->select()->from('categoria', array('idCategoria', 'Categoria'));

        return $this->fetchAll($select);
    }

}

