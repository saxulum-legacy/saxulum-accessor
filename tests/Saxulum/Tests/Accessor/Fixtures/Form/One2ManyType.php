<?php

namespace Saxulum\Tests\Accessor\Fixtures\Form;

use Saxulum\Tests\Accessor\Fixtures\Mapping\One2Many;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class One2ManyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('manies', 'collection', array(
                'type' => new Many2OneType(),
                'allow_add' => true,
                'by_reference' => false,
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => get_class(new One2Many()),
        ));
    }

    public function getName()
    {
        return 'one2many';
    }
}
