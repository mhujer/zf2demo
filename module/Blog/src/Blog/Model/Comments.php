<?php
namespace Blog\Model;

use Zend\Db\Adapter\Platform\Mysql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Predicate\Expression;

class Comments extends TableGateway 
{
    public function fetchCommentsByArticleId($articleId)
    {
    	$select =  new Select();
    	$select
    		->from($this->table)
    		->columns(array('id', 'name', 'email', 'text', 'commented_on'))
    		->where(array($this->table . '.article_id = ?' => (int) $articleId));
    	$sql = $select->getSqlString($this->adapter->getPlatform());
    	
        $r = $this->adapter->query($sql)->execute();
        return iterator_to_array($r);
    }
    
    public function addComment($articleId, $name, $email, $text)
    {
    	return $this->insert(
	    	array(
	    		'article_id' => (int) $articleId,
	    		'name' => $name,
	    		'email' => $email,
	    		'text' => $text,
	    		'commented_on' => new Expression('NOW()'),
	    	)
    	);
    }
}