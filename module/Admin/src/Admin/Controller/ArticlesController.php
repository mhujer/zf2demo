<?php
namespace Admin\Controller;
use Blog\Model\Articles;

use Zend\Mvc\Controller\AbstractActionController;
class ArticlesController extends AbstractActionController
{
    /**
     * @var Articles
     */
    public $articlesTable;
    public function indexAction()
    {
        $articles = 
        $res['articles'] = $this->getArticlesTable()->getArticles();
        return $res;
    }
    
    public function updateAction()
    {
        $articleId = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $article = $this->getArticlesTable()->fetchArticle($articleId);
        $articleForm = new \Admin\Form\Article;
        if ($this->getRequest()->isPost()) {
            $postData = $_POST; //$this->getRequest()->post()->toArray();
            $articleForm->setData($postData);
            if ($articleForm->isValid()) {
                $validatedData = $articleForm->getData();
                $commentId = $this->getArticlesTable()->update($validatedData, array('id' => $articleId));
                $this->flashMessenger()->addMessage('Article updated.');
                $this->redirect()->toRoute('admin/articles');
            }
        } else {
            $articleForm->setData($article);
        }
        
        return array(
            'article' => $article,
            'article_name' => $article['name'],
            'form' => $articleForm,
        );
        return array();
    }
    
    public function deleteAction()
    {
        return array();
    }
    
    /**
     * @return Articles
     */
    public function getArticlesTable()
    {
        if (!$this->articlesTable) {
            $sm = $this->getServiceLocator();
            $this->articlesTable = $sm->get('Blog\Model\Articles');
        }
        return $this->articlesTable;
    }
}