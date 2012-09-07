<?php

namespace Blog\Controller;

use Blog\Form\AddCommentForm;

use Zend\Paginator\Paginator;

use Zend\Mvc\Controller\ActionController,
	Blog\Model\Articles;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
	
	protected $articlesTable;
	
    public function indexAction()
    {
    	$select = $this->getArticlesTable()->getArticlesSelect();
    	
    	
    	$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getArticlesTable()->getAdapter()));
        $paginator->setItemCountPerPage(3);
        $paginator->setCurrentPageNumber($this->getEvent()->getRouteMatch()->getParam('p'));
        return array(
        	'articles' => $paginator,
        );
    }
    
    /**
	 * @return \Blog\Model\Articles
	 */
    public function getArticlesTable()
    {
        if (!$this->articlesTable) {
            $sm = $this->getServiceLocator();
            $this->articlesTable = $sm->get('Blog\Model\Articles');
        }
        return $this->articlesTable;
    }
    
    protected $commentsTable;
    
    /**
	 * @return \Blog\Model\Comments
	 */
    public function getCommentsTable()
    {
        if (!$this->commentsTable) {
            $sm = $this->getServiceLocator();
            $this->commentsTable = $sm->get('Blog\Model\Comments');
        }
        return $this->commentsTable;
    }
    
    public function articleAction()
    {
    	$articleId = (int) $this->getEvent()->getRouteMatch()->getParam('id');
    	$article = $this->getArticlesTable()->fetchArticle($articleId);
    	
    	$commentForm = new \Blog\Form\AddCommentForm;
    	if ($this->getRequest()->isPost()) {
    		$postData = $_POST; //$this->getRequest()->post()->toArray();
    		$commentForm->setData($postData);
            if ($commentForm->isValid()) {
            	$validatedData = $commentForm->getData();
            	$commentId = $this->getCommentsTable()->addComment(
            		$articleId,
            		$validatedData['name'],
            		$validatedData['email'],
            		$validatedData['text']
            	);
            	$this->redirect()->toRoute('blog/article', array('id' => $articleId));
            }
    	}
    	
    	return array(
    		'article' => $article,
    		'article_name' => $article['name'],
    		'commentForm' => $commentForm,
    	);
    }
}
