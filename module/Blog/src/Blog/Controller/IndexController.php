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
    
    public function articleAction()
    {
    	$articleId = (int) $this->getEvent()->getRouteMatch()->getParam('id');
    	$article = $this->getArticlesTable()->fetchArticle($articleId);
    	
    	$commentForm = new \Blog\Form\AddCommentForm;
    	/*if ($this->getRequest()->isPost()) {
    		$postData = $this->getRequest()->post()->toArray();
            if ($commentForm->isValid($postData)) {
            	$comments = $this->getLocator()->get('Blog\Model\Comments');
            	$commentId = $comments->addComment(
            		$articleId,
            		$commentForm->getValue('name'),
            		$commentForm->getValue('email'),
            		$commentForm->getValue('text')
            	);
            	$this->redirect()->toRoute('article', array('id' => $articleId));
            }
    	}*/
    	
    	return array(
    		'article' => $article,
    		'article_name' => $article['name'],
    		'commentForm' => $commentForm,
    	);
    }
}
