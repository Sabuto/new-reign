channel.bind('new_message', function(data) {
    var thread = $('#' + data.div_id);
    var thread_id = data.thread_id;
    var thread_plain_text = data.text;

    if(thread.length)
    {
        // add new message to thread
        thread.append(data.html);

        //make sure the thread is set to read

        $.ajax({
            url: "/messages/" + thread_id +"/read"
        });
    } else {
        var message = '<p>' + data.sender_name + ' said: ' + data.text + '</p><p><a href="' + data.thread_url + '">View Message</a></p>';

        // notify the user
        toastr.info(message, data.subject);

        // set the unread count
        $.ajax({
            url: "messages/unread"
        }).success(function(data) {
            var div = $('#unread_messages');

            var count = data.msg_count;
            if(count == 0)
            {
                $(div).addClass('hidden');
            } else {
                $(div).text(count).removeClass('hidden');

                //if on message.index - add alert class and update latest message
                $('#thread_list_' + thread_id).addClass('panel-info');
                $('#thread_list_' + thread_id + '_text').prepend(thread_plain_text);
            }
        });
    }
});