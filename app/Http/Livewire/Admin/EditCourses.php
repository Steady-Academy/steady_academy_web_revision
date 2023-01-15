<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class EditCourses extends Component
{
    public function render()
    {
        return view('livewire.admin.edit-courses')->extends('admin.layouts.app');
    }
}
