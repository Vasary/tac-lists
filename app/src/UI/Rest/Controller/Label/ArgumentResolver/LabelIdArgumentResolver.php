<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Label\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Label\Argument\LabelId;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\String\u;

final class LabelIdArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return LabelId::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = ['id' => $request->get('id')];

        $this->validate($data);

        yield new LabelId(u($data['id']));
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