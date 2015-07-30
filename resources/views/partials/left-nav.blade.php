@inject('count', 'App\Http\Controllers\CountController)

<div class="ag ag1">
    <div class="menu-item">
        <p>Earn</p>
        <ul>
            <li>Crimes</li>
            <li>Whores</li>
            <li>GTA</li>
            <li>OC</li>
        </ul>
    </div>

    <div class="menu-item">
        <p>Info</p>
        <ul>
            <li><a href="{{route('news.index')}}">News</a></li>
            <li><a href="{{route('events.index')}}">Events @if(Auth::user()->eventsRead == 0)<span id="eventCount" class="badge">{{$count->events()}}</span>@endif</a></li>
            <li><a href="{{route('messages')}}">Inbox @include('messages.unread-count')</a></li>
            <li>OC</li>
        </ul>
    </div>
</div>