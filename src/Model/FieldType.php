<?php

declare(strict_types=1);

namespace Survos\RecordStore\Model;

enum FieldType: string
{
    case Text = 'text';
    case Integer = 'integer';
    case Decimal = 'decimal';
    case Boolean = 'boolean';
    case Date = 'date';
    case DateTime = 'datetime';
    /** A time with no date. Stores are split on whether this exists at all, so it normalizes
     *  separately rather than being flattened into DateTime with a meaningless date part. */
    case Time = 'time';
    case Choice = 'choice';
    case Reference = 'reference';
    case Attachment = 'attachment';
    case Unknown = 'unknown';
}
