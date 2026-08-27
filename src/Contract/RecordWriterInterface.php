<?php

declare(strict_types=1);

namespace Survos\RecordStore\Contract;

use Survos\RecordStore\Model\TableReference;
use Survos\RecordStore\Model\UpsertRequest;
use Survos\RecordStore\Model\WriteResult;

interface RecordWriterInterface
{
    public function upsert(TableReference $table, UpsertRequest $request): WriteResult;
}
