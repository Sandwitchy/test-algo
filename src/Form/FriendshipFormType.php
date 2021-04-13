<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Enum\FriendshipType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FriendshipFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('friendship_type', ChoiceType::class, [
                "choices" => [
                    "est ami(e) avec" => FriendshipType::IS_FRIEND_WITH,
                    "est ami(e) avec moi" => FriendshipType::IS_MY_FRIEND,
                    "je suis ami(e) avec" => FriendshipType::I_AM_FRIEND_WITH
                ],
                "label" => "Lien d'amitié",
                "attr" => [
                    "class" => "form-control",
                    "id" => "friendship_type"
                ]
            ])
            ->add('first_character',TextType::class, [
                "required" => false,
                "label" => "Personne",
                "attr" => [
                    "class" => "form-control",
                    "id" => "first_character"
                ]
            ])
            ->add('second_character',TextType::class, [
                "required" => false,
                "label" => "2e personne",
                "attr" => [
                    "class" => "form-control",
                    "id" => "second_character"
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'validation_groups' => false,
            'allow_extra_fields' => false,
        ]);
    }
}
