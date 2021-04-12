<?php

declare(strict_types=1);

namespace App\UI\Rest\ResponseBuilder;

use Symfony\Component\HttpFoundation\Response;

interface ResponseBuilderInterface
{
    public function build(object $data, int $responseCode = Response::HTTP_OK): Response;
}
