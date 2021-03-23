<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Template\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Template\Argument\Create;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\String\u;

final class CreateArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return Create::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = json_decode($request->getContent(), true, flags: JSON_THROW_ON_ERROR);

        $this->validate($data);

        yield new Create(u($data['name']), UuidV4::fromString($data['category']), u($data['icon']), $data['images']);
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'name' => [
                    new Assert\NotBlank(),
                    new Assert\Length(
                        min: 3,
                        max: 255,
                        minMessage: 'Name is too short',
                        maxMessage: 'Name is too long'
                    ),
                ],
                'category' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(message: 'Category id must have UUID type'),
                ],
                'icon' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 3, max: 255),
                ],
                'images' => [
                    new Assert\Type('array'),
                    new Assert\Count(min: 1, max: 25),
                    new Assert\All([
                        new Assert\Url(message: 'Invalid image URL'),
                    ]),
                ],
            ]);
    }
}
