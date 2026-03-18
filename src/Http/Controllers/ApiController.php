<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Slides\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Slides\Models\Slide;

final class ApiController extends BaseApiController
{
    /** @return LengthAwarePaginator<int, mixed> */
    public function index(Request $request): LengthAwarePaginator
    {
        $query = Slide::query()->selectFields();
        $data = QueryBuilder::for($query)
            ->allowedSorts('status_translated', 'position', 'body_translated')
            ->allowedFilters(
                AllowedFilter::custom('body', new FilterOr()),
            )
            ->allowedIncludes('image')
            ->paginate($request->integer('per_page'));

        $data->setCollection(collect($data->items())->map(function ($item) {
            if (property_exists($item, 'body_translated')) {
                $item->body_translated = mb_trim(strip_tags(html_entity_decode((string) $item->body_translated)), '"');
            }

            return $item;
        }));

        return $data;
    }

    protected function updatePartial(Slide $slide, Request $request): void
    {
        foreach ($request->only('status', 'position') as $key => $content) {
            if ($slide->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $slide->setTranslation($key, $lang, $value);
                }
            } else {
                $slide->{$key} = $content;
            }
        }

        $slide->save();
    }

    public function destroy(Slide $slide): JsonResponse
    {
        $slide->delete();

        return response()->json(status: 204);
    }
}
