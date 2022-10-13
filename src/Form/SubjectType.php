<?php

namespace App\Form;

use App\Entity\Subject;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', StringType::class, [
                'required' => true,
                'constraint' => [new Length(['min' => 10])]
            ])
            ->add('content', TextType::class, [
                'required' => true,
                'constraint' => [new Length(['min' => 10])]
            ])
//            ->add('status')
//            ->add('owner')
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subject::class,
        ]);
    }
}