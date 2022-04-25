<?php 
namespace App\Form;

use App\Data\SearchData;
use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType 
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('q',TextType::class,[
            'label' => 'Search',
            'required' =>false,
            'attr' =>[
                'placeholder' => 'Search'
            ]
        ])
        ->add('year', EntityType::class, [
            'required' =>false,
            'class' => Vehicle::class,
            'query_builder' => function (VehicleRepository $er) {
                return $er->createQueryBuilder('u')
                    ->select("u")
                    ->groupBy("u.year")
                    ->orderBy('u.year', 'ASC');
            },
            'choice_label' => 'year',
            
        ])
        
        ->add('bikeProducer', EntityType::class, [
            'required' =>false,
            'class' => Vehicle::class,
            'query_builder' => function (VehicleRepository $er) {
                return $er->createQueryBuilder('v')
                    ->select("v")
                    ->groupBy("v.bikeProducer")
                    ->orderBy('v.bikeProducer', 'ASC');
            },
            'choice_label' => 'bikeProducer',
        ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
        
    }

    public function getBlockPrefix()
    {
        return '';
    }
}