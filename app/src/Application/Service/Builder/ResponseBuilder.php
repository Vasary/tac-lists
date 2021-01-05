<?php

declare(strict_types=1);

namespace App\Application\Service\Builder;

use App\Domain\AbstractValueObjectInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class ResponseBuilder
{
    protected SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function build(AbstractValueObjectInterface $data, array $request = []): Response
    {
        return
            new Response(
                $this->serializer->serialize($data, 'json'),
                Response::HTTP_OK,
                [
                    'Content-Type' => 'text/json'
                ]
            )
        ;
    }
}
