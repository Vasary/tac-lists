<?php

declare(strict_types=1);

namespace App\UI\Rest\Validator\Location;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
final class Longitude extends Constraint
{
    public string $message = 'Invalid longitude value {{ string }}';
}
