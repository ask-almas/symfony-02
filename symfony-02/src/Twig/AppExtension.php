<?php
/**
 * Created by PhpStorm.
 * User: asus)
 * Date: 31.10.2018
 * Time: 10:43
 */

namespace App\Twig;


use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension{
    public function getFilters()
    {
       return [
           new TwigFilter('price', [$this, 'priceFilter'])
       ];
    }

    public function priceFilter($number){
        return '$'.number_format($number, 2, '.', ',');
    }
}