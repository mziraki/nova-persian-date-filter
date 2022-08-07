<?php

namespace MZiraki\PersianDateFilter;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class PersianDateFilter extends Filter
{
    public $component = 'persian-date-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Illuminate\Database\Eloquent\Builder   $query
     * @param mixed                                   $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query;
    }

    /**
     * Set datePicker Color. See https://talkhabi.github.io/vue-persian-datetime-picker/guide/theme.
     *
     * @param $color
     *
     * @return $this
     */
    public function color($color)
    {
        return $this->withMeta(compact('color'));
    }

    /**
     * Set datePicker Locale. See https://talkhabi.github.io/vue-persian-datetime-picker/guide/localization.
     *
     * @param $locale
     *
     * @return $this
     */
    public function locale($locale)
    {
        return $this->withMeta(compact('locale'));
    }

    /**
     * Set calendar type.
     *
     * @param $type string date|datetime
     *
     * @return $this
     */
    public function type($type)
    {
        return $this->withMeta(compact('type'));
    }
}
