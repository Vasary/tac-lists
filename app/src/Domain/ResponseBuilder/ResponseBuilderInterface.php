<?php

declare(strict_types=1);

namespace App\Domain\ResponseBuilder;

use App\Domain\ValueObject\AbstractValueObjectInterface;
use Symfony\Component\HttpFoundation\Response;

interface ResponseBuilderInterface
{
    public function build(AbstractValueObjectInterface $data): Response;
}
