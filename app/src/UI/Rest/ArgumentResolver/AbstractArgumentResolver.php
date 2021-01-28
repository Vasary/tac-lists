<?php

declare(strict_types=1);

namespace App\UI\Rest\ArgumentResolver;

use App\UI\Rest\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractArgumentResolver implements ArgumentValueResolverInterface
{
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    abstract protected function getForm(): Collection;

    protected function validate(array $data): void
    {
        $violations = $this->validator->validate($data, $this->getForm());

        $errors = [];
        foreach ($violations as $violation) {
            /* @var ConstraintViolation $violation */
            $errors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        if (0 !== count($errors)) {
            throw new BadRequestException($errors);
        }
    }
}
