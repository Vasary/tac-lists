<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\ShoppingList\Argument\Rename;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\String\u;

final class RenameArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return Rename::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = json_decode($request->getContent(), true, flags: JSON_THROW_ON_ERROR);

        $this->validate($data);

        yield new Rename(UuidV4::fromString($data['list']), u($data['name']));
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'name' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 3, max: 255),
                ],
                'list' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(),
                ]
            ]);
    }
}
