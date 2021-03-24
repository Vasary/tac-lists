<?php

declare(strict_types=1);

namespace App\UI\Rest\ResponseBuilder;

use App\Domain\ValueObject\AbstractValueObjectInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class ResponseBuilder implements ResponseBuilderInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function build(AbstractValueObjectInterface $data, int $responseCode = Response::HTTP_OK): Response
    {
        return
            new Response(
                $this->serializer->serialize($data, 'json'),
                $responseCode,
                [
                    'Content-Type' => 'application/json',
                ]
            )
        ;
    }
}
