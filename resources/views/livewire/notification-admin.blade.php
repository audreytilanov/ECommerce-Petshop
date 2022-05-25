<div>
    <div class="dropdown-content-heading">
        <span class="text-left">{{ $notificationCount }} New Messages</span>
        <a href="javascript:void(0)" wire:click="markall">
            <i class="ti-bell pull-right"></i>
        </a>
    </div>
@foreach ( $notification as $datas)
    <li class="notification-unread">
        <div class="notification-content">
            <small class="notification-timestamp pull-right">{{$datas->created_at->format('H:i:s');}}</small>
            <div class="notification-text">{{$datas->data}}</div>
            <span>
                <a style="color: blue" wire:click="markasread({{ $datas->id }})">Mark as Read</a>
            </span>
        </div>
    </li>
@endforeach
    <div class="dropdown-content-body">
        <ul>
            <li class="text-center">
                <span>
                    <a wire:click="all" href="{{ route('admin.notification.all') }}">See All</a>
                </span>
            </li>
        </ul>
    </div>
</div>

{{-- <li class="notification-unread">
    <a href="#" wire:click="markasread({{ $data->id }})">
        <div class="notification-content">
            <small class="notification-timestamp pull-right">{{$datas->created_at->format('H:i:s');}}</small>
            <div class="notification-text">{{$datas->data}}</div>
        </div>
    </a>
</li> --}}

