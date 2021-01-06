<?php

declare(strict_types=1);

namespace App\Application\Service\Builder;

use App\Domain\AbstractValueObjectInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class ResponseBuilder
{
    public function build(AbstractValueObjectInterface $data, array $request = []): Response
    {


        return
            new Response(
                '',
                Response::HTTP_OK,
                [
                    'Content-Type' => 'application/json'
                ]
            )
        ;
    }
}
