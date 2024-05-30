<?php

namespace App\View\Components;

use App\Models\Jawaban;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class notification_button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $jawabans = Jawaban::orderBy('id', 'desc')->get();
        return view('components.notification_button', compact('jawabans'));
    }
}
