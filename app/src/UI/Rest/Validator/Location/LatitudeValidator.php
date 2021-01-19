<?php

declare(strict_types=1);

namespace App\UI\Rest\Validator\Location;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class LatitudeValidator extends ConstraintValidator
{
    private const EXPRESSION = '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/';

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Latitude) {
            throw new UnexpectedTypeException($constraint, Latitude::class);
        }

        if (!is_float($value)) {
            throw new UnexpectedValueException($value, 'float');
        }

        if (!preg_match(self::EXPRESSION, (string)$value, $matches)) {
            $this
                ->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ string }}', (string)$value)
                ->addViolation();
        }
    }
}