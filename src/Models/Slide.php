<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Slides\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use TypiCMS\Modules\Core\Models\File;
use TypiCMS\Modules\Core\Models\History;
use TypiCMS\Modules\Core\Models\Page;
use TypiCMS\Modules\Core\Traits\HasAdminUrls;
use TypiCMS\Modules\Core\Traits\HasConfigurableOrder;
use TypiCMS\Modules\Core\Traits\HasContentPresenter;
use TypiCMS\Modules\Core\Traits\HasImagePresenter;
use TypiCMS\Modules\Core\Traits\HasSelectableFields;
use TypiCMS\Modules\Core\Traits\HasSlugScope;
use TypiCMS\Modules\Core\Traits\Historable;
use TypiCMS\Modules\Core\Traits\Publishable;
use TypiCMS\Translatable\HasTranslations;

/**
 * @property int $id
 * @property int $position
 * @property int|null $page_id
 * @property int|null $image_id
 * @property string|null $website
 * @property array<array-key, mixed> $status
 * @property array<array-key, mixed> $body
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, History> $history
 * @property-read int|null $history_count
 * @property-read File|null $image
 * @property-read Page|null $page
 * @property-read mixed $thumb
 * @property-read mixed $translations
 */
class Slide extends Model implements Sortable
{
    use HasAdminUrls;
    use HasConfigurableOrder;
    use HasContentPresenter;
    use HasImagePresenter;
    use HasSelectableFields;
    use HasSlugScope;
    use HasTranslations;
    use Historable;
    use Publishable;
    use SortableTrait;

    protected $guarded = [];

    protected $appends = ['thumb'];

    /** @var array<string> */
    public array $translatable = [
        'status',
        'body',
    ];

    /** @var array<string> */
    public array $sortable = [
        'order_column_name' => 'position',
    ];

    /** @return Attribute<string, null> */
    protected function thumb(): Attribute
    {
        return Attribute::make(get: fn () => $this->imageUrl(null, 54));
    }

    public function slideLink(): string
    {
        return $this->website ?? $this->page?->url() ?? '';
    }

    public function presentTitle(): string
    {
        return __('Edit');
    }

    public function titleAttribute(): string
    {
        if ($this->website) {
            return $this->website;
        }

        if ($this->page) {
            return $this->page->title;
        }

        return '';
    }

    /** @return BelongsTo<Page, $this> */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /** @return BelongsTo<File, $this> */
    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'image_id');
    }
}
