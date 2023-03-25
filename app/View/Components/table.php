<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class table extends Component
{
    protected $headers, $data, $delete, $offcanvasId;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $headers,
        $data,
        $delete,
        $offcanvasId
    ) {
        $this->headers = $headers;
        $this->data = $data;
        $this->delete = $delete;
        $this->offcanvasId = $offcanvasId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $headers = $this->headers;
        $data   = $this->data;
        $delete = $this->delete;
        $offcanvasId = $this->offcanvasId;
        return view('components.table', compact('headers', 'data', 'delete', 'offcanvasId'));
    }
}
