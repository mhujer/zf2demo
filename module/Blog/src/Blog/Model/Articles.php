<?php
namespace Blog\Model;

use Blog\Model\Comments;

use Zend\Db\Adapter\Platform\Mysql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Predicate\Expression;

class Articles extends TableGateway
{
    /**
     * @var Comments
     */
    protected $comments;
    
    public function getArticlesSelect()
    {
        $commentsCount = new Select();
        $commentsCount
            ->from('articles_comments')
            ->columns(array('count' => new Expression('COUNT(articles_comments.id)')))
            ->where($this->table . '.id = articles_comments.article_id');
        $commentsCountSql = $commentsCount->getSqlString($this->getAdapter()->getPlatform());
        
        $sql = new Select();
        $sql->from($this->table)
            ->columns(array('id', 'name', 'text', 'published',
                'comments_count' => new Expression('(' . $commentsCountSql . ')')))
            ->join('admins', $this->table . '.admins_id = admins.id', array('admin_name' => 'name'), Select::JOIN_LEFT)
    		->order('published DESC');
    	return $sql;
    }
    
    public function getArticles()
    {
        $sql = $this->getArticlesSelect()->getSqlString($this->adapter->getPlatform());
        $r = $this->getAdapter()->query($sql);
        $data = iterator_to_array($r->execute());
        return $data;
    }

    public function fetchArticle($id)
    {
    	$id = (int) $id;
    	$select =  new Select();
    	$select->from($this->table)
    		->columns(array('id', 'name', 'text', 'published'))
    		->join('admins', $this->table . '.admins_id = admins.id', array('admin_name' => 'name'), Select::JOIN_LEFT)
    		->where(array($this->table . '.id = ?' => $id));
    		
        $sql = $select->getSqlString($this->getAdapter()->getPlatform());
        $r = $this->getAdapter()->query($sql);
        $article = $r->execute()->current();
        
    	if (!$article) {
    		throw new \Exception(sprintf('Article "%s" does not exits!', $id));
    	}
    	
    	$article['comments'] = $this->comments->fetchCommentsByArticleId($id);
    	
    	return $article;
    }
    
    public function setComments(Comments $comments)
    {
    	$this->comments = $comments;
    	return $this;
    }
}