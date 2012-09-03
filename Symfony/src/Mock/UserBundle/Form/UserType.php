<?php

namespace Mock\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('salt')
            ->add('password')
            ->add('access_token')
            ->add('access_token_secret')
            ->add('verifier')
            ->add('oauth_session_handle')
        ;
    }

    public function getName()
    {
        return 'mock_userbundle_usertype';
    }
}
