<?php

namespace Rake\LaravelAdapter\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'rake_resources';

    protected $fillable = [
        'rake_id',
        'tooth_id',
        'guid',
        'resource_type',
        'content_text',
        'init_hash',
        'new_guid',
        'new_type',
        'imported',
        'skipped',
        'retry'
    ];

    protected $casts = [
        'imported' => 'boolean',
        'skipped' => 'boolean',
        'retry' => 'integer'
    ];

    public function children()
    {
        return $this->belongsToMany(
            Resource::class,
            'rake_relations',
            'parent_id',
            'resource_id'
        );
    }

    public function parents()
    {
        return $this->belongsToMany(
            Resource::class,
            'rake_relations',
            'resource_id',
            'parent_id'
        );
    }
}
