<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Item\Argument\ItemId;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;

final class ItemIdArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return ItemId::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        if (in_array($request->getMethod(), ['GET', 'DELETE'], true)) {
            $data['id'] = $request->get('id');
        } else {
            $data = json_decode($request->getContent(), true, flags: JSON_THROW_ON_ERROR);
        }

        $this->validate($data);

        yield new ItemId(UuidV4::fromString($data['id']));
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'id' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(),
                ],
            ]);
    }
}
