<?php
namespace Blog\Form;

use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Fieldset;
    
    
class AddCommentForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setName('comment');
        
        $this->add(array(
        	'name' => 'name',
        	'attributes' => array(
                'type'  => 'text',
        		'label' => 'Name',
            ),
        ));
        
        /*$this->addElement(new Element\Text(array(
        	'name' => 'email',
        	'label' => 'E-mail',
        	'required' => true,
        	'filters' => array('StripTags', 'StringTrim'),
        	'validators' => array('EmailAddress'),
        	'description' => 'Won\'t be published',
        )));
        
        $this->addElement(new Element\Textarea(array(
        	'name' => 'text',
        	'label' => 'Text',
        	'required' => true,
        	'filters' => array('StripTags', 'StringTrim'),
        	'cols' => 50,
        	'rows' => 10,
        )));*/
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add comment',
            ),
        ));
    }
}