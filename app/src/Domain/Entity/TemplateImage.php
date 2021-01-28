<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\TimestampedEntity;
use App\Domain\Entity\Traits\UUIDIdentifier;
use Symfony\Component\String\UnicodeString;

class TemplateImage
{
    use TimestampedEntity;
    use UUIDIdentifier;

    protected UnicodeString $link;

    protected Template $template;

    public function __construct(UnicodeString $link, Template $template)
    {
        $this->link = $link;
        $this->template = $template;
    }

    public function link(): UnicodeString
    {
        return $this->link;
    }

    public function template(): string
    {
        return $this->template;
    }
}
