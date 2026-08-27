<?php

declare(strict_types=1);

namespace Survos\RecordStore\Model;

enum SortDirection: string
{
    case Ascending = 'ASC';
    case Descending = 'DESC';
}
