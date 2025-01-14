<?php

namespace Rake\LaravelAdapter\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Relation extends Pivot
{
    protected $table = 'rake_relations';

    public $timestamps = false;
}