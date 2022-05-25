<div>
<a class="buy-btn"  href="javascript:void(0)" wire:click="markall">Mark As Read</a>
@foreach ($notification as $datas)
    <div class="alert alert-success" role="alert">
        {{-- {{ dd($datas) }} --}}
        {{ $datas->data; }}
        <a class="buy-btn"  href="javascript:void(0)" wire:click="markasread({{ $datas->id }})">Mark All As Read</a>
        
    </div>
@endforeach

@foreach ($notificationRead as $datas)
    <div class="alert alert-secondary" role="alert">
        {{-- {{ dd($datas) }} --}}
        {{ $datas->data; }}
        
    </div>
@endforeach
</div>