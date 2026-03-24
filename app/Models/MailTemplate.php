<?php

namespace App\Models;

use AhmedAliraqi\LaravelFilterable\Filterable;
use App\Emails\Contracts\HasEmailTemplateContract;
use App\Http\Filters\MailTemplateFilter;
use App\Support\Traits\Selectable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model implements TranslatableContract
{
    use Filterable;
    use HasFactory;
    use Selectable;
    use Translatable;

    /**
     * The filter class used for querying this model.
     *
     * @var class-string<MailTemplateFilter>
     */
    protected string $filter = MailTemplateFilter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model_type',
    ];

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['name', 'subject', 'content'];

    /**
     * The relations to eager load on every query.
     *
     * @var array<int, string>
     */
    protected $with = [
        'translations',
    ];

    public static function types(): array
    {
        $interface = HasEmailTemplateContract::class;

        $classes = get_declared_classes();

        $modelTypes = [];

        foreach ($classes as $class) {
            if (in_array($interface, class_implements($class))) {
                $modelTypes[$class] = __(str($class)->classBasename()->plural()->kebab()->toString().'.plural');
            }
        }

        return $modelTypes;
    }

    public static function variables($modelClass): array
    {
        /** @var HasEmailTemplateContract $model */
        $model = new $modelClass;

        return array_keys($model->emailReplacements());
    }
}
