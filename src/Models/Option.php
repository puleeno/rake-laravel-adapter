

namespace Rake\LaravelAdapter\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'rake_options';

    protected $fillable = [
        'option_name',
        'option_value',
        'autoload'
    ];

    protected $casts = [
        'autoload' => 'boolean',
        'option_value' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (is_array($model->option_value)) {
                $model->option_value = serialize($model->option_value);
            }
        });

        static::retrieved(function ($model) {
            if (is_string($model->option_value)) {
                $model->option_value = unserialize($model->option_value);
            }
        });
    }
}
