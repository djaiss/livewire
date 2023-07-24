<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function render(): View
    {
        return view('layouts.app')
            ->with('user', [
                'name' => auth()->user()->name,
                'avatar' => auth()->user()->avatar,
            ]);
    }
}
