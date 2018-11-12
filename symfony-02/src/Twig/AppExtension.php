<?php
/**
 * Created by PhpStorm.
 * User: asus)
 * Date: 31.10.2018
 * Time: 10:43
 */

namespace App\Twig;


use App\Entity\LikeNotification;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension implements GlobalsInterface {

    /**
     * @var string
     */
    private $locale;

    public function __construct(string $locale){
        $this->locale = $locale;
    }

    public function getGlobals(){
        return [
            'locale' => $this->locale
        ];
    }

    public function getFilters(){
       return [
           new TwigFilter('price', [$this, 'priceFilter'])
       ];
    }

    public function priceFilter($number){
        return '$'.number_format($number, 2, '.', ',');
    }

    public function getTests(){
        return [
            new \Twig_SimpleTest(
                'like', function ($ogj){
                    return $ogj instanceof LikeNotification;
                }
            )
        ];
    }
}