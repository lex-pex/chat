
$(document).ready(function () {

    var chat = {};
    var current_length = 0;
    var user_name = '';
    var input_text = '';
    var input_field = $('#input');

    chat.fetchMessages = function () {
        $.ajax({
            url: '/server/index.php',
            type: 'post',
            data: { method: 'fetch', length : current_length },
            success: function (data) {
                var list = JSON.parse(data);
                // only in case that new message over old ones shows up
                if(list.length > 0) {
                    current_length += list.length;
                    appendMessages(list);
                }
            }
        });
    };

    /**
     * Send Message Event Handler
     */
    $('form').submit(function (e) {
        e.preventDefault();
        user_name = $('#user_name').val();
        input_text = input_field.val();
        if(validateUserName(user_name) && validateInput(input)) {
            $.post(
                '/server/index.php',
                { method: 'send', name: user_name, text: input_text }
            );
            input_field.val('');
        }
    });

    /**
     * _________ Server socket start ________
     */
    chat.fetchMessages();
    chat.interval = setInterval(chat.fetchMessages, 2500);


    // ______ Client-side display helpers ______ //

    function appendMessages(list) {
        list.forEach(function(m) {
            $('#messages').append(
                '<div class="message"><small class="user-name">' + m.name + '</small>' + m.text + '</div>'
            );
        });
    }

    function validateUserName(name) {
        if(name.length < 2) {
            alert('Enter you Name');
            return false;
        }
        return true;
    }

    function validateInput(text) {
        if(text.length < 3 || text.length >= 256) {
            alert('Text has to be between 3 and 256 chars');
            return false;
        }
        return true;
    }

});






















