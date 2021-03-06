<?php

namespace Rw\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConsonantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('letter'  , 'text')
            ->add('name'    , 'text')
            ->add('initial' , 'text')
            ->add('final'   , 'text')
			->add('classe'   , 'text')
			->add('draw'	, new DrawType(), array(
			'required' => false))
			->add('picture'	, new PictureType(), array(
			'required' => false))
			->add('police'	, new PoliceType(), array(
			'required' => false))
			->add('police2'	, new Police2Type(), array(
			'required' => false))
			->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rw\CoreBundle\Entity\Consonant'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rw_corebundle_consonant';
    }
}
