<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Message;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class MessageType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;

    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('to_id', EntityType::class, [
                'label' => 'Destinataire',
                'class' => User::class,
                'query_builder' => function (UserRepository $er) {
                    $user = $this->security->getUser();
                    return $er->sender($user); },
                'attr' => ['data-select' => 'true']
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message'
            ])
            ->add('fichierFile', VichFileType::class, [
                'required' => false,
                'label' => 'Fichier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
