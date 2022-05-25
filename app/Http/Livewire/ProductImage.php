<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Component
{
    use WithFileUploads;
    public $image = [];
    public $article = [];

    public function mount()
    {
        $this->image = [
            []
        ];

    }

    public function tambahImage()
    {
        $this->image[] = [];
    }

    public function deleteImage($index)
    {
        unset($this->image[$index]);
        $this->image = array_values($this->image);
    }

    public function save(){
        foreach ($this->image as $key => $images) {
            $filename = Str::random(10).$images[$key]->getClientOriginalName();
            $this->image[$key] = $images->store('admin/image/');
        }
        dd(json_encode($this->images));
        $this->images = json_encode($this->images);

        // Image::create(['image' => $this->images]);
        // foreach ($this->image as $key => $images) {
        //     // $this->images[$key] = $this->image->store('images');
        //     // dd($images[$key]->getClientOriginalName());
        //     $filename = Str::random(10).$images[$key]->getClientOriginalName();
        //     dd($images[$key]);
        //     $images[$key]->storeAs('admin/image/', $filename, 'asset');
        //     // dd($images[$key]);
        //     // Storage::disk('asset')->put('admin/image/'.$filename, file_get_contents($images));     

        // }
    }

    public function render()
    {
        return view('livewire.product-image');
    }
}
