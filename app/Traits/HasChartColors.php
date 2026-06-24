<?php

namespace App\Traits;

trait HasChartColors
{
    /**
     * Generate premium colors for charts
     *
     * @param int $count
     * @return array
     */
    protected function generateColors(int $count): array
    {
        $colors = [
            '#005a71', // primary
            '#ffb86f', // orange
            '#81d1f0', // light blue
            '#bec8cd', // gray-blue
            '#dae2fd', // soft indigo
            '#ffdcbd', // light orange
            '#bec6e0', // slate blue
            '#ffe8d6', // cream orange
            '#ba1a1a', // red
            '#006a6a', // teal
            '#6750a4', // purple
            '#036b1d', // green
            '#805600', // yellow-brown
            '#a23c00', // deep orange
            '#535f70', // slate grey
        ];

        // If count exceeds colors available, repeat the colors
        $colorsCount = count($colors);
        if ($count > $colorsCount) {
            $repeatedColors = [];
            for ($i = 0; $i < $count; $i++) {
                $repeatedColors[] = $colors[$i % $colorsCount];
            }
            return $repeatedColors;
        }

        return array_slice($colors, 0, $count);
    }
}
