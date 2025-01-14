<?php

namespace Rake\LaravelAdapter\Models;

use Illuminate\Database\Eloquent\Model;

class CrawledUrl extends Model
{
    protected $table = 'rake_crawled_urls';

    protected $fillable = [
        'url',
        'rake_id',
        'tooth_id',
        'crawled',
        'skipped',
        'retry'
    ];

    protected $casts = [
        'crawled' => 'boolean',
        'skipped' => 'boolean',
        'retry' => 'integer'
    ];
}