<?php
namespace Admin\Form;
use Zend\Ldap\Attribute;

use Zend\Form\Form;
use Zend\Form\Element as El;
use Zend\Filter as Filter;
use Zend\InputFilter;
use Zend\Validator as Validator;
    
    
class Article extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setName('comment');
        
        $this->add(new El\Text('name', array(
            'label' => 'Name',
        )));
        
        $this->add($text = new El\Textarea('text', array(
            'label' => 'Text',
        )));
        $text->setAttributes(
        	array(
        		'cols' => 80,
		    	'rows' => 20,
        	));
        
        $submit = new El\Submit('submit');
        $submit->setLabel('Send');
        $submit->setValue('Save');
        $this->add($submit);
        
        $inputFilter = new \Zend\InputFilter\InputFilter();
        
        $name = new \Zend\InputFilter\Input('name');
        $filterChain = new Filter\FilterChain();
        $filterChain->attachByName('StripTags');
        $name->setFilterChain($filterChain);
        $inputFilter->add($name);
        
        $email = new \Zend\InputFilter\Input('text');
        $inputFilter->add($email);
        $this->setInputFilter($inputFilter);
    }
}