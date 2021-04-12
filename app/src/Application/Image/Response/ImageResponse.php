<?php

declare(strict_types=1);

namespace App\Application\Image\Response;

use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class ImageResponse
{
    public function __construct(public UuidV4 $id, public UnicodeString $link)
    {
    }
}
