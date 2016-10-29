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
