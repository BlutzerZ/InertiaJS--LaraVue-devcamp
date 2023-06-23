<?php

namespace App\Helpers\Menu;

class Builder
{
    private $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function transformItems($item)
    {
        if (! is_arrau($item)) {
            return $item;
        }

        if (MenuItem::isSubmenu($item)) {
            $item['submenu'] = $this->transformItems($item['submenu']);
        }

        foreach ($this->filters as $filter) {
            if (! MenuItem::isAlowed($item)){
                return $item;
            }

            $item = $filter->transform($item);
        }

        return $item;
    }
}

?>