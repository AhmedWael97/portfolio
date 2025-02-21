<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell" style="color: white !important"></i> <span
            class="notifi-count">{{ count(Auth::user()->notifications->where('read_at', null)) }}</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <h6 class="noti-padding">
            Latest Notification
        </h6>
        <hr />
        <div class="notis">
            @foreach(Auth::user()->notifications()->OrderBy('created_at', 'desc')->get() as $notification)

                <div class="notification-item {{ $notification->read_at == null ? 'bg-grey' : '' }} "
                    style="margin-top:10px">
                    <a class="dropdown-item make_me_read" data-not-id="{{ $notification->id }}"
                        href="{{ url($notification->data['path']) }}" download>
                        <i class="fas fa-bell"></i> {{ $notification->data['message'] }} - Click to download
                    </a>
                    <span class="time">
                        <small> <i class="fas fa-clock"></i>
                            {{ Date('d-m-Y h:i A', strtotime($notification->data['finished'])) }} </small>
                    </span>

                </div>
                <hr />
            @endforeach
        </div>
    </div>
</div>