<?php

namespace App\Domain\Template\Model;

use App\Domain\Shared\Traits\TimestampedEntity;
use App\Domain\Shared\Traits\UUIDIdentifier;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

class TemplateImage
{
    use TimestampedEntity, UUIDIdentifier;

    protected UnicodeString $link;
    protected Template $template;

    public function __construct(UnicodeString $link, Template $template, UuidV4 $id)
    {
        $this->id = $id;
        $this->link = $link;
        $this->template = $template;
    }

    public function link(): UnicodeString
    {
        return $this->link;
    }

    public function template(): Template
    {
        return $this->template;
    }
}
