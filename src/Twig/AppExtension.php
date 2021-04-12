<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('app_filter', [$this, 'filter']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('app_order_query_sting', [$this, 'order'])
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

    public function order(array $requestArray, string $orderKey, string $orderDirection): string
    {
        return http_build_query($requestArray + ['order' => $orderKey, 'dir' => $orderDirection]);
    }
}
