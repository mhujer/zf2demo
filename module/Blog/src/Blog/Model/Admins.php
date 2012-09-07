<?php
namespace Blog\Model;

use Zend\Db\Adapter\Platform\Mysql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Predicate\Expression;

class Admins extends TableGateway
{
    public function fetchToCodebook()
    {
    	$sql = $this->getAdapter()->select();
    	$sql->from($this->tableName, array('id', 'name'))
    		->order('name ASC');
    	return $this->getAdapter()->fetchPairs($sql);
    }
    
    public function fetchAllForAdmin()
    {
    	$sql = $this->getAdapter()->select();
    	$sql->from($this->tableName, array('id', 'name', 'email', 'last_login'))
    		->order('name ASC');
    	return $this->getAdapter()->fetchAll($sql);
    }
    
    public function addAdmin(array $data)
    {
    	$data['salt'] = $this->generateSalt();
    	$data['password'] = $this->hashPassword($data['password'], $data['salt']);
    	return parent::insert($data);
    }
    
    public function updateAdmin($adminId, array $data)
    {
    	if ($data['password']) { //new password -> changeIt
    		$adminRow = $this->find($adminId)->current();
    		$data['password'] = $this->hashPassword($data['password'], $adminRow->salt);
    	}
    	return $this->update($data, 'id = ' . $adminId);
    }
    
    public function hashPassword($password, $salt)
    {
    	return sha1($password . $salt);
    }
    
    private function generateSalt()
    {
    	$salt = sha1(microtime(true) . uniqid('', true));
    	return substr($salt, 0, 10);
    }
}