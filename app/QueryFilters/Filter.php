<?php


namespace App\QueryFilters;
use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
    public function handle($request, Closure $next)
    {
       // dd(class_basename($this));//something_else
      //  parent::handle($request,$next);
        if(! request()->has($this->filterName())){
            return $next($request);
        }
        $builder = $next($request);

        return $this->applyFilter($builder);
    }
    protected abstract function applyFilter($builder);
    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }
}
