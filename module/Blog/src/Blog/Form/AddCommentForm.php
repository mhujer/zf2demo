<?php
namespace Blog\Form;

use Zend\Filter\FilterChain;

use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\InputFilter;
    
    
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
            ),
        	'options' => array(
        		'label' => 'Name',
            ),
        ));
        
        $this->add(array(
        	'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
            ),
        	'options' => array(
        		'label' => 'E-mail',
            ),
        ));
        
        $this->add(array(
        	'name' => 'text',
        	'attributes' => array(
                'type'  => 'textarea',
		        'cols' => 50,
		        'rows' => 10,
            ),
        	'options' => array(
        		'label' => 'Text',
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
        
        $inputFilter = new \Zend\InputFilter\InputFilter();
        
        $name = new \Zend\InputFilter\Input('name');
        $filterChain = new FilterChain();
        $filterChain->attachByName('StripTags');
        $name->setFilterChain($filterChain);
        $inputFilter->add($name);
        
        $email = new \Zend\InputFilter\Input('email');
        $inputFilter->add($email);
        
        
        $inputFilter->add(new \Zend\InputFilter\Input('text'));
        $this->setInputFilter($inputFilter);
    }
}