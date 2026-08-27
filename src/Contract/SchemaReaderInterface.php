<?php

declare(strict_types=1);

namespace Survos\RecordStore\Contract;

use Survos\RecordStore\Model\ApplicationReference;
use Survos\RecordStore\Model\ApplicationSchema;

interface SchemaReaderInterface
{
    public function schema(ApplicationReference $application): ApplicationSchema;
}
