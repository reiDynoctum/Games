<?php

declare(strict_types=1);

namespace App\Utils;

class ReadingTime
{
    private const AVERAGE_READING_SPEED = 240;

    public static function calculate(string $text): int
    {
        $wordCount = count(explode(' ', $text));
        return (int) ceil($wordCount / self::AVERAGE_READING_SPEED);
    }
}
