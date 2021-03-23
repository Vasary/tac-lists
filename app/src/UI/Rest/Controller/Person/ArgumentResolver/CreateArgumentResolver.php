<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Person\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Person\Argument\Create;
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

        yield new Create(u($data['id']), u($data['region']));
    }

    protected function getForm(): Assert\Collection
    {
        return
            new Assert\Collection([
                'id' => [
                    new Assert\NotBlank(message: 'Person ID should be not blank'),
                    new Assert\Uuid(message: 'ID should looks like UUID'),
                ],
                'region' => [
                    new Assert\NotBlank(),
                    new Assert\Length(exactly: 2, exactMessage: 'Region length must be 2 char'),
                ],
            ]);
    }
}
