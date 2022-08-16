<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class ExportQuery extends Model
{
    public const STATUS_WAITING = 'waiting';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_DONE = 'done';

    protected $guarded = [];

    protected $table = 'export_query';
}
