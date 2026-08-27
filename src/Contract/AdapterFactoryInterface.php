<?php

declare(strict_types=1);

namespace Survos\RecordStore\Contract;

use Survos\RecordStore\Model\ConnectionConfiguration;

interface AdapterFactoryInterface
{
    public function supports(string $driver): bool;

    public function create(ConnectionConfiguration $connection): RecordStoreAdapterInterface;
}
