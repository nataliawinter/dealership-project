<?php

class Application_Model_DbTable_Usuario extends Zend_Db_Table_Abstract {

    protected $_name = 'usuario';

    public function getUsuario($id) {
        $id = (int) $id;
        $row = $this->fetchRow('idUsuario = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addUsuario($nome, $email, $senha, $permissoes) {

        $data = array(
            'Nome' => $nome,
            'Email' => $email,
            'Senha' => $senha,
            'Permissao' => $permissoes,
        );
        $this->insert($data);
    }

    public function updateUsuario($id, $nome, $email, $senha, $permissoes) {

        $data = array(
            'Nome' => $nome,
            'Email' => $email,
            'Senha' => $senha,
            'Permissao' => $permissoes,
        );

        $this->update($data, 'idUsuario = ' . (int) $id);
    }

    public function deleteUsuario($id) {
        $this->delete('idUsuario = ' . (int) $id);
    }

    public function pegaPermissao($nome, $senha) {

        $select = $this->select()->from('usuario', array('idUsuario', 'Nome', 'Email', 'Permissao'))->where('Nome = ?', $nome, 'AND Senha = ?', $senha);
        return $this->fetchAll($select);
//        $result = $this->fetchAll($select);
//        echo $result;
//        exit();
//        return $result->Permissao;
                
        
    }

}

