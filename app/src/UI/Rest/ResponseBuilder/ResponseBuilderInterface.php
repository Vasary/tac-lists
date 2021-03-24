<?php

declare(strict_types=1);

namespace App\UI\Rest\ResponseBuilder;

use App\Domain\ValueObject\AbstractValueObjectInterface;
use Symfony\Component\HttpFoundation\Response;

interface ResponseBuilderInterface
{
    public function build(AbstractValueObjectInterface $data, int $responseCode = Response::HTTP_OK): Response;
}
