<?php

namespace Rw\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LessonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',     'text')
            ->add('summary',   'textarea')
            ->add('content',   'text', array('required' => false))
			->add('title1',    'text', array('required' => false))
            ->add('article1',  'textarea', array('required' => false))
			->add('title2',    'text', array('required' => false))
            ->add('article2',  'textarea', array('required' => false))
			->add('title3',    'text', array('required' => false))
            ->add('article3',  'textarea', array('required' => false) )
			->add('title4',    'text', array('required' => false))
            ->add('article4',  'textarea', array('required' => false))
			->add('title5',    'text', array('required' => false))
            ->add('article5',  'textarea', array('required' => false))
			->add('title6',    'text', array('required' => false))
            ->add('article6',  'textarea', array('required' => false))
            ->add('published', 'checkbox', array('required' => false))
			->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rw\CoreBundle\Entity\Lesson'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rw_corebundle_lesson';
    }
}
