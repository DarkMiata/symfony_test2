<?php

namespace DM\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
  {

  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
        ->add('nom')
        ->add('prenom')
        ->add('email')
        ->add('dateNaissance')
        ->add('save', SubmitType::class)
        ;
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
      'data_class' => 'DM\ContactBundle\Entity\Contact'
    ));
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix() {
    return 'dm_contactbundle_contact';
  }

  }
