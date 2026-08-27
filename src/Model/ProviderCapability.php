<?php

declare(strict_types=1);

namespace Survos\RecordStore\Model;

enum ProviderCapability: string
{
    case SchemaRead = 'schema.read';
    case RecordRead = 'record.read';
    case RecordWrite = 'record.write';
    case RecordUpsert = 'record.upsert';
}
