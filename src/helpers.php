<?php

class ColorAdapter
{
    private static $instance = null;

    private static $foreground = [
        'black' => '0;30',
        'dark_gray' => '1;30',
        'red' => '0;31',
        'bold_red' => '1;31',
        'green' => '0;32',
        'bold_green' => '1;32',
        'brown' => '0;33',
        'yellow' => '1;33',
        'blue' => '0;34',
        'bold_blue' => '1;34',
        'purple' => '0;35',
        'bold_purple' => '1;35',
        'cyan' => '0;36',
        'bold_cyan' => '1;36',
        'white' => '1;37',
        'bold_gray' => '0;37',
    ];

    private static $background = [
        'black' => '40',
        'red' => '41',
        'magenta' => '45',
        'yellow' => '43',
        'green' => '42',
        'blue' => '44',
        'cyan' => '46',
        'light_gray' => '47',
    ];

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function fg_color($color, $string)
    {
        if (!isset(self::$foreground[$color]))
        {
            throw new Exception('Foreground color is not defined');
        }

        return "\033[" . self::$foreground[$color] . "m" . $string . "\033[0m";
    }

    public static function bg_color($color, $string)
    {
        if (!isset(self::$background[$color]))
        {
            throw new Exception('Background color is not defined');
        }

        return "\033[" . self::$background[$color] . 'm' . $string . "\033[0m";
    }

    public static function all_fg()
    {
        foreach (self::$foreground as $color => $code)
        {
            echo "$color - " . self::fg_color($color, 'Hello, world!') . PHP_EOL;
        }
    }

    public static function all_bg()
    {
        foreach (self::$background as $color => $code)
        {
            echo "$color - " . self::bg_color($color, 'Hello, world!') . PHP_EOL;
        }
    }
}

function introduct(string $title, string $desc = null): void
{
    echo "\n\n" . ColorAdapter::getInstance()->fg_color('bold_green', $title) . "\n";
    if ($desc) echo ColorAdapter::getInstance()->fg_color('dark_gray', $desc) . "\n";

    echo ColorAdapter::getInstance()->fg_color('bold_blue', '====== ВЫВОД ======') . "\n";
}