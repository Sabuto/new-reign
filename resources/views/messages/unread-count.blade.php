@if(Auth::check())
    <?php
    $count = Auth::user()->newMessagesCount();
    $cssClass = $count == 0 ? 'hidden' : '';
    ?>
    <span id="unread_messages" class="label label-danger {{$cssClass}}">{!! $count !!}</span>
@endif