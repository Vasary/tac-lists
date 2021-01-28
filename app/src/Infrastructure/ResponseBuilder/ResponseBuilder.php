<?php

declare(strict_types=1);

namespace App\Infrastructure\ResponseBuilder;

use App\Domain\ResponseBuilder\ResponseBuilderInterface;
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

    public function build(AbstractValueObjectInterface $data): Response
    {
        return
            new Response(
                $this->serializer->serialize($data, 'json'),
                Response::HTTP_OK,
                [
                    'Content-Type' => 'application/json',
                ]
            )
        ;
    }
}
