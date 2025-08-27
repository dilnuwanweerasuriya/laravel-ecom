<?php

if (!function_exists('tailwindColor')) {
    /**
     * Convert a color name to a Tailwind CSS background class.
     *
     * @param string $colorName
     * @return string
     */
    function tailwindColor(string $colorName): string
    {
        $map = [
            'black' => 'bg-black',
            'raven black' => 'bg-black',
            'white' => 'bg-white',
            'cotton white' => 'bg-white',
            'silver' => 'bg-gray-300',
            'gray' => 'bg-gray-500',
            'light gray' => 'bg-gray-200',
            'blue' => 'bg-blue-500',
            'navy blue' => 'bg-blue-900',
            'red' => 'bg-red-500',
            'green' => 'bg-green-500',
            'yellow' => 'bg-yellow-400',
            'purple' => 'bg-purple-500',
            'pink' => 'bg-pink-500',
            'maroon' => 'bg-red-900'
        ];

        $key = strtolower(trim($colorName));

        return $map[$key] ?? 'bg-gray-200'; // fallback
    }
}
