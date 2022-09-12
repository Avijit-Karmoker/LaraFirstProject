<?php

namespace App\Http\Livewire\Variation;

use App\Models\Size;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class Addsize extends Component
{
    public $size;
    public $measure;
    public function insert_size()
    {
        Size::insert([
            'size' => Str::upper($this->size),
            'user_id' => auth()->id(),
            'measure' => $this->measure,
            'created_at' => Carbon::now(),
        ]);
        $this->reset('size');
        $this->reset('measure');
        session()->flash('success', 'Size successfully added.');
    }

    public function delete_size($id)
    {
        Size::find($id)->delete();
    }

    public function render()
    {
        $sizes = Size::where('user_id', auth()->id())->latest()->get();
        return view('livewire.variation.addsize', compact('sizes'));
    }
}
