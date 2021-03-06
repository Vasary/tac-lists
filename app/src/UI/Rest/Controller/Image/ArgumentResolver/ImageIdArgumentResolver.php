<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Image\ArgumentResolver;

use App\UI\Rest\ArgumentResolver\AbstractArgumentResolver;
use App\UI\Rest\Controller\Image\Argument\ImageId;
use Generator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;

final class ImageIdArgumentResolver extends AbstractArgumentResolver
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return ImageId::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $data = ['id' => $request->get('id')];

        $this->validate($data);

        yield new ImageId(UuidV4::fromString($data['id']));
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
