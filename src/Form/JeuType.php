<?php

namespace App\Form;

use App\Entity\Editeur;
use App\Entity\Jeu;
use App\Repository\EditeurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class JeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //dd($options['codePostal']);
        $codePostal = $options['codePostal'];
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du jeu',
                'help' => 'Le nom du jeu',
                'constraints' => [new Length(['min' => 2, 'max' => 100, 'minMessage' => 'Le nom doit faire au moins {{ limit }} caractères', 'maxMessage' => 'Le nom doit faire au plus {{ limit }} caractères'])],
            ])
            ->add('duree', TextareaType::class, [
                'label' => 'Durée d\'une partie',
                'help' => 'La durée en moyenne d\'une partie',
                'constraints' => [new NotBlank(['message' => 'La durée moyenne d\'une partie ne peut pas être vide'])
                ]])
            ->add('mini')
            ->add('maxi')
            ->add('photo1')
            ->add('photo2')
            ->add('photo3')
            ->add('prix', TextType::class, [
                'required' => false,
            ])
            ->add('stock')
            ->add('avis')
            ->add('editeur', EntityType::class, [
                'class' => Editeur::class,
                'choice_label' => 'nom',
                'query_builder' => function (EditeurRepository $fr) use ($codePostal) {
                    return $fr->createQueryBuilder('e')
                        ->where('e.cp = :codePostal')
                        ->setParameter('codePostal', $codePostal)
                        ;
                },
            ])
            /*->add('new_editeur', EditeurType::class, [
                'mapped' => false,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
            'codePostal' => null,
        ]);
    }
}
