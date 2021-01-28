<?php

declare(strict_types=1);

namespace App\UI\Rest\Validator\Location;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class LongitudeValidator extends ConstraintValidator
{
    private const EXPRESSION = '/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/';

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Longitude) {
            throw new UnexpectedTypeException($constraint, Longitude::class);
        }

        if (!is_float($value)) {
            throw new UnexpectedValueException($value, 'float');
        }

        if (!preg_match(self::EXPRESSION, (string) $value, $matches)) {
            $this
                ->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ string }}', (string) $value)
                ->addViolation();
        }
    }
}
