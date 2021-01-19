<?php

namespace App\Infrastructure\Persistence\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Symfony\Component\String\UnicodeString;

final class UnicodeStringType extends Type
{
    const NAME = 'unicode_string';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'varchar';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UnicodeString
    {
        return new UnicodeString($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->toString();
    }

    public function getDefaultLength(AbstractPlatform $platform): int
    {
        return $platform->getVarcharDefaultLength();
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
