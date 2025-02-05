<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'formatPrice']),
            new TwigFilter('stars', [$this, 'stars'], ['is_safe' => ['html']]),
            new TwigFilter('dateFr', [$this, 'formatDate']),
            new TwigFilter('formatPhone', [$this, 'formatPhone']),
        ];
    }

    public function formatPrice($number, $symbol = '€', $decimals = 0, $decPoint = ',', $thousandsSep = ' ')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = $price. ' '.$symbol; //il faudrait améliorer encore ce code car le symbole ne se met pas à la fin si le nombre est en dollar par exemple.

        return $price;
    }

    public function stars($note)
    {
        $html = '';
        for ($i = 0; $i < $note; $i++) {
            $html .= '<box-icon name="star" type="solid"></box-icon>';
        }
        for ($i = 0; $i < 5 - $note; $i++) {
            $html .= '<box-icon name="star"></box-icon>';
        }

        return $html;
    }

    public function formatDate(\DateTime|string $date): string
    {
        if (is_string($date) && $date == 'now') {
            $date = new \DateTime();
        }
        if ($date instanceof \DateTime) {
            return $date->format('d/m/Y H:i');
        }
        return 'erreur de date';
    }

    public function formatPhone($telephone)
    {

        if (strlen($telephone) == 10) {
            $telephone = str_split($telephone, 2);
            return implode(' ', $telephone);
        }

        if (str_starts_with($telephone, '+33')) {
            $telephone = substr($telephone, 3);
            $telephone = '+33 (0)' . substr($telephone, 0, 1). ' ' . substr($telephone, 1, 2) . ' ' . substr($telephone, 3, 2) . ' ' . substr($telephone, 5, 2) . ' ' . substr($telephone, 7, 2);
        }

        return $telephone;
    }

}