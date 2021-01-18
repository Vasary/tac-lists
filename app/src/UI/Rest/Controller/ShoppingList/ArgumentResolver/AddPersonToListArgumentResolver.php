<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\ShoppingList\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\ShoppingList\Argument\AddPersonToList;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;

final class AddPersonToListArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return AddPersonToList::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = json_decode($request->getContent(), true, flags: JSON_THROW_ON_ERROR);

        $this->validate($data);

        yield new AddPersonToList(UuidV4::fromString($data['list']), UuidV4::fromString($data['person']));
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'list' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(message: 'List id should looks like UUID'),
                ],
                'person' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(message: 'Person id should looks like UUID'),
                ],
            ]);
    }
}
