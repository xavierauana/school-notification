<?php

namespace Anacreation\School\Notification\Models;

use Anacreation\School\Contracts\HasContentInterface;
use Anacreation\School\Models\Language;
use Anacreation\School\traits\HasContentTrait;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model implements HasContentInterface
{
    use HasContentTrait;

    const IDENTIFIER = "message";

    public function getMessage(string $languageCode
    ): ?string {
        return $this->getContent(Notice::IDENTIFIER, $languageCode);
    }

    public function createMessage(string $languageCode, string $content
    ) {
        $language = Language::whereIsActive(true)->whereCode($languageCode)
                            ->first();
        if ($language) {
            $this->createContent(Notice::IDENTIFIER, "text",
                $language,
                $content);
        }
    }

}
