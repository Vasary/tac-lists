<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Category\Argument\Create;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
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

        yield new Create(u($data['name']), u($data['color']));
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'name' => [
                    new Assert\NotBlank(),
                    new Assert\Length(
                        min: 2,
                        max: 255,
                        minMessage: 'Name is too short',
                        maxMessage: 'Name is too long'
                    ),
                ],
                'color' => [
                    new Assert\NotBlank(),
                    new Assert\Length(
                        min: 7,
                        max: 7,
                        minMessage: 'Color show be like #FFFFFF',
                        maxMessage: 'Color show be like #FFFFFF'
                    ),
                ],
            ]);
    }
}
