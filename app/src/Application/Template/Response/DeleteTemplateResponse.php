<?php

declare(strict_types=1);

namespace App\Application\Template\Response;

use App\Domain\Response\AbstractResponse;
use Symfony\Component\Uid\UuidV4;

final class DeleteTemplateResponse extends AbstractResponse
{
    public function __construct(public UuidV4 $id, public int $code) {}
}
