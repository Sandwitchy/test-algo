<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Enum\FriendshipType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FriendshipFormType extends AbstractType
{
    const FRIENDSHIP_TYPE = "friendship_type";
    const FIRST_CHARACTER = "first_character";
    const SECOND_CHARACTER = "second_character";

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
                    "idToSelect" => "friendship_type",
                    "onchange" => "changeFriendshipType()"
                ]
            ])
            ->add('first_character',TextType::class, [
                "required" => false,
                "label" => "Personne",
                "attr" => [
                    "class" => "form-control",
                    "idToSelect" => "first_character"
                ]
            ])
            ->add('second_character',TextType::class, [
                "required" => false,
                "label" => "2e personne",
                "attr" => [
                    "class" => "form-control",
                    "idToSelect" => "second_character",
                ]
            ])
            ->add("character_to_test", TextType::class, [
                "required" => false,
                "label" => "test",
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Nom de la personne"
                ]
            ])
            ->add("submit", SubmitType::class, [
                "label" => "Envoyer",
                "attr" => [
                    "class" => "btn btn-primary mb-0 mt-auto btn-block"
                ]
            ])
            ->add("clear", SubmitType::class, [
                "label" => "Nettoyer cache",
                "attr" => [
                    "class" => "btn btn-danger mb-0 mt-auto btn-block"
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
