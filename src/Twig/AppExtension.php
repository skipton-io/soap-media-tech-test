<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('app_filter', [$this, 'filter']),
        ];
    }

    public function filter(array $array, string $column = ''): array
    {
        if (empty($column)) {
            return [];
        }

        $return = [];
        foreach ($array as $row) {

            switch ($column) {
                case 'username':
                    $return[$row->getUser()->getId()] = $row->getUser()->getUsername();
                    break;

                case 'score':
                    $return[] = $row->getScore();
                    break;

                case 'difficulty':
                    $return[$row->getDifficulty()->getId()] = $row->getDifficulty()->getValue();
                    break;
            }
        }

        $return = array_unique($return);
        asort($return);

        return $return;
    }
}
