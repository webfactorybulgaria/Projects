<?php

namespace TypiCMS\Modules\Projects\Models;

use TypiCMS\Modules\Core\Shells\Traits\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Laracasts\Presenter\PresentableTrait;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Core\Shells\Models\Base;
use TypiCMS\Modules\History\Shells\Traits\Historable;

class Project extends Base
{
    use Historable;
    use Translatable;
    use PresentableTrait;

    protected $presenter = 'TypiCMS\Modules\Projects\Shells\Presenters\ModulePresenter';

    protected $dates = ['date'];

    protected $fillable = [
        'category_id',
        'image',
        'date',
        'website',
        // Translatable columns
        'title',
        'slug',
        'status',
        'summary',
        'body',
    ];

    /**
     * Translatable model configs.
     *
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'slug',
        'status',
        'summary',
        'body',
    ];

    protected $appends = ['thumb', 'category_name'];

    /**
     * Get public uri.
     *
     * @return string|null
     */
    public function uri($locale = null)
    {
        $locale = $locale ?: config('app.locale');
        $page = TypiCMS::getPageLinkedToModule($this->getTable());
        if ($page) {
            return $page->uri($locale).'/'.$this->category->translate($locale)->slug.'/'.$this->translate($locale)->slug;
        }

        return '/';
    }

    /**
     * A project belongs to a category.
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('TypiCMS\Modules\Categories\Shells\Models\Category');
    }

    /**
     * A project has many galleries.
     *
     * @return MorphToMany
     */
    public function galleries()
    {
        return $this->morphToMany('TypiCMS\Modules\Galleries\Shells\Models\Gallery', 'galleryable')
            ->withPivot('position')
            ->orderBy('position')
            ->withTimestamps();
    }

    /**
     * Append thumb attribute.
     *
     * @return string
     */
    public function getThumbAttribute()
    {
        return $this->present()->thumbSrc(null, 22);
    }

    /**
     * Append category_name attribute from translation table.
     *
     * @return string
     */
    public function getCategoryNameAttribute()
    {
        if (isset($this->category) and $this->category) {
            return $this->category->title;
        }
    }
}
