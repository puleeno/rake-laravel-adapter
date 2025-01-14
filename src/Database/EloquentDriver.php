<?php

namespace Rake\LaravelAdapter\Database;

use Ramphor\Rake\Abstracts\Driver;
use Ramphor\Sql as SqlBuilder;
use Illuminate\Support\Facades\DB;

class EloquentDriver extends Driver
{
    protected $prefix;

    public function __construct($prefix = '')
    {
        $this->prefix = $prefix;
    }

    public function name()
    {
        return 'eloquent';
    }

    public function prefix()
    {
        return $this->prefix;
    }

    public function query(SqlBuilder $query)
    {
        return DB::select($query->toSql(), $query->getBindings());
    }

    public function get(SqlBuilder $query)
    {
        $result = DB::select($query->toSql(), $query->getBindings());
        return array_shift($result);
    }

    public function var(SqlBuilder $query)
    {
        $result = $this->get($query);
        if (is_object($result)) {
            $vars = get_object_vars($result);
            return array_shift($vars);
        }
        return false;
    }

    public function row(SqlBuilder $query)
    {
        return $this->get($query);
    }

    public function exists(SqlBuilder $query)
    {
        return DB::select($query->toSql(), $query->getBindings()) ? true : false;
    }

    public function insert(SqlBuilder $query)
    {
        return DB::insert($query->toSql(), $query->getBindings());
    }

    public function raw_query($sql)
    {
        return DB::statement($sql);
    }
}
