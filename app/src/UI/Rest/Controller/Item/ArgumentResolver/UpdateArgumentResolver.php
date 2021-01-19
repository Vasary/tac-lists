<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Item\Argument\Update;
use App\UI\Rest\Validator\Location\Latitude;
use App\UI\Rest\Validator\Location\Longitude;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdateArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return Update::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = json_decode($request->getContent(), true, flags: JSON_THROW_ON_ERROR);

        $this->validate($data);

        yield new Update(
            UuidV4::fromString($data['id']),
            UuidV4::fromString($data['template']),
            UuidV4::fromString($data['list']),
            UuidV4::fromString($data['unit']),
            $data['order'],
            $data['value'],
            $data['points'],
            $data['images'],
        );
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'id' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(),
                ],
                'template' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(),
                ],
                'list' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(),
                ],
                'unit' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(),
                ],
                'order' => [
                    new Assert\Type('integer'),
                    new Assert\GreaterThan(-1),
                ],
                'value' => [
                    new Assert\Type('integer'),
                    new Assert\NotBlank(),
                    new Assert\GreaterThan(0)
                ],
                'points' => [
                    new Assert\Type('array'),
                    new Assert\Count(min: 0, max: 25),
                    new Assert\All([
                        new Assert\Collection([
                            'longitude' => new Longitude(),
                            'latitude' => new Latitude(),
                            'comment' => new Assert\Length(min: 0, max: 255)
                        ])
                    ])
                ],
                'images' => [
                    new Assert\Type('array'),
                    new Assert\Count(min: 0, max: 25),
                    new Assert\All([
                        new Assert\Url()
                    ])
                ]
            ]);
    }
}
