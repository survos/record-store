# survos/record-store

Provider-neutral contracts and models for **application-backend record stores** — Grist,
Quickbase, and anything else that looks like "tables of records behind an HTTP API".

Framework-agnostic on purpose: **no Symfony kernel, no container, no dependencies beyond
PHP itself.** That is what lets the same code run inside a Symfony application and inside
a WordPress plugin.

```bash
composer require survos/record-store
```

## What is here

This package has no adapters and talks to nothing. It defines the shape that adapters
implement:

| | |
|---|---|
| `Contract\RecordStoreAdapterInterface` | the whole surface: schema + read + write |
| `Contract\SchemaReaderInterface` | `schema(ApplicationReference): ApplicationSchema` |
| `Contract\RecordReaderInterface` | `query(TableReference, RecordQuery): RecordPage` |
| `Contract\RecordWriterInterface` | `upsert(TableReference, UpsertRequest): WriteResult` |
| `Contract\AdapterFactoryInterface` | `supports(driver)`, `create(ConnectionConfiguration)` |
| `Registry\RecordStoreRegistry` | resolves a named connection and table to an adapter |

Plus the value objects the contracts speak in: `Record`, `RecordPage`, `RecordQuery`,
`RecordSort`, `SortDirection`, `UpsertRequest`, `WriteResult`, `FieldSchema`, `FieldType`,
`TableReference`, `TableSchema`, `ApplicationReference`, `ApplicationSchema`,
`ConnectionConfiguration`, `ProviderCapability`.

## The point of it

Two backends, one interface:

```php
use Survos\RecordStore\Contract\RecordStoreAdapterInterface;
use Survos\RecordStore\Model\{Record, RecordQuery, TableReference, UpsertRequest};

function publishBio(RecordStoreAdapterInterface $store, TableReference $table, int|string $id, string $bio): void
{
    $store->upsert($table, new UpsertRequest(
        records: [new Record(fields: ['Bio' => $bio], id: $id)],
    ));
}
```

That function works unchanged against Grist and against Quickbase. Choosing between them
is configuration, not code — which is the entire reason this package exists separately
from the adapters.

## Capabilities, not assumptions

Backends differ, and pretending otherwise produces surprises. `ProviderCapability` lets an
adapter declare what it actually supports, and
`Exception\UnsupportedRecordStoreOperation` is thrown rather than silently approximated
when something is asked for that a backend cannot do.

```php
$adapter->capabilities();   // ProviderCapability[] — SchemaRead, RecordRead, RecordWrite, RecordUpsert
$adapter->provider();       // 'grist', 'quickbase', …
```

## Implementations

- [`survos/grist-php`](https://github.com/survos/grist-php)
- [`survos/quickbase-php`](https://github.com/survos/quickbase-php)
- [`survos/record-store-bundle`](https://github.com/survos/record-store-bundle) — Symfony
  integration: configuration, service wiring, console commands

Writing another adapter means implementing `RecordStoreAdapterInterface` and an
`AdapterFactoryInterface`. Nothing else here needs to change.
