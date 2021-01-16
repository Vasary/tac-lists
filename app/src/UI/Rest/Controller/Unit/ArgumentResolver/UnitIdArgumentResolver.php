<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Unit\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Unit\Argument\UnitId;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\String\u;

final class UnitIdArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return UnitId::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = ['id' => $request->get('id')];

        $this->validate($data);

        yield new UnitId(u($data['id']));
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'id' => [
                    new Assert\NotBlank(),
                    new Assert\Uuid(message: 'ID should looks like UUID'),
                ],
            ]);
    }
}
