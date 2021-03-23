<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\ShoppingList\Argument\ListId;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;

final class ListIdArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return ListId::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = ['id' => $request->get('id')];

        $this->validate($data);

        yield new ListId(UuidV4::fromString($data['id']));
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'id' => [
                    new Assert\NotBlank(message: 'List id should be not blank'),
                    new Assert\Uuid(),
                ],
            ]);
    }
}
