<?php

declare(strict_types=1);

namespace App\Tests\Behat\Trait;

trait ParserContext
{
    private function parseArray(string $value): array
    {
        return
            array_map(
                function (string $predicate) {
                    $predicate = trim($predicate);

                    return
                        is_numeric($predicate)
                            ? $this->parseNumeric($predicate)
                            : $this->parseString($predicate)
                        ;
                },
                explode(',', $value)
            )
        ;
    }

    private function parseString(string $predicate): string | bool
    {
        return
            0 < preg_match('/^(true|false)$/', $predicate)
                ? $this->parseBool($predicate)
                : $predicate
        ;
    }

    private function parseBool(string $predicate): bool
    {
        return 'true' === $predicate;
    }

    private function parseNumeric(string $predicate): int | float
    {
        return
            0 < preg_match('/[+-]?([0-9]*[.])[0-9]+/', $predicate)
                ? (float) $predicate
                : (int) $predicate
        ;
    }
}