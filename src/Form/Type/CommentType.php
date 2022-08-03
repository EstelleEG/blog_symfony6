<?php

namespace App\Form\Type;

use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //inputs fields to type a comment
        $builder
            ->add('content', TextareaType::class, [ //type in forms
                'label' => 'Votre message'
            ])
            ->add('article', HiddenType::class)//we use a 'hidden input' to indicate on which article we post the comment
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer'
            ]);

            $builder->get('article')
            ->addModelTransformer(new CallbackTransformer(
                fn (Article $article) => $article->getId(),
                fn (Article $article) => $article->getTitle()));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class, //'Comment' est la class qui contains the datas
            //'csrf_token_id' => 'comment-add'
        ]);
    }
}