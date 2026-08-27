<?php

declare(strict_types=1);

namespace Survos\RecordStore\Contract;

use Survos\RecordStore\Model\RecordPage;
use Survos\RecordStore\Model\RecordQuery;
use Survos\RecordStore\Model\TableReference;

interface RecordReaderInterface
{
    public function query(TableReference $table, RecordQuery $query): RecordPage;
}
