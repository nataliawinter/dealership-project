<?php

class Application_Model_DbTable_Albums extends Zend_Db_Table_Abstract
{
	protected $_name = 'albums';

	public function getAlbum($id)
	{
		$id = (int) $id;
		$row = $this->fetchRow('id = ' . $id);
		if (!$row) {
			throw new Exception("Não foi encontrado algum registro com o ID => $id");
		}
		return $row->toArray();
	}

	public function addAlbum($artist, $title, $title1, $title2)
	{
		$data = [
			'artist' => $artist,
			'title' => $title,
			'title1' => $title1,
			'title2' => $title2,
		];
		$this->insert($data);
	}

	public function updateAlbum($id, $artist, $title, $title1, $title2)
	{
        $data = [
		    'artist' => $artist,
            'title' => $title,
            'title1' => $title1,
            'title2' => $title2,
		];
        $this->update($data, 'id = ' . (int) $id);
	}

	public function deleteAlbum($id)
	{
		$this->delete('id =' . (int)$id);
	}
}
