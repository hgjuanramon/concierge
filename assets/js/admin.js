window.CORE = (window.CORE || {});
var APP = {};
(function (window, document, $, undefined) {

    this.init = function (options) {
        this.settings.prefix = 'admin/';
        this.settings = $.extend({}, options, this.settings);
        return this;
    };
    this.run = function () {

        switch (this.settings.module) {
            case 'dashboard':
                break;
            case 'destination_touristic':

                if (this.settings.action === 'state') {
                    $('.list-state').on('change', '#state', function () {
                        var check = $(this);
                        var state_id = $(this).val();
                        var destination_id = $(this).data('destination-id');
                        var destination_state_id = $(this).data('destination-state-id');
                       
                        
                        var save_state = $.ajax({
                            url: APP.base_url(APP.settings.module + '/save_state'),
                            data: {destination_state_id: destination_state_id, destination_touristic_id: destination_id, state_id: state_id},
                            dataType: 'json',
                            type: 'post'
                        });

                        save_state.done(function (response) {
                            if (response.retval) {
                                check.data('destination-state-id', response.id);
                            } else {
                                alert(response.msg);
                            }
                        });
                    });

                }
                break;
        }

        this.init_common();
        this.Toolkit.attach_delete_event();
    };
    this.init_common = function () {

        var number_format = function (input) {
            // If the regex doesn't match, `replace` returns the string unmodified
            return (input.toString()).replace(
                    // Each parentheses group (or 'capture') in this regex becomes an argument 
                    // to the function; in this case, every argument after 'match'
                    /^([-+]?)(0?)(\d+)(.?)(\d+)$/g, function (match, sign, zeros, before, decimal, after) {

                        // Less obtrusive than adding 'reverse' method on all strings
                        var reverseString = function (string) {
                            return string.split('').reverse().join('');
                        };
                        // Insert commas every three characters from the right
                        var insertCommas = function (string) {

                            // Reverse, because it's easier to do things from the left
                            var reversed = reverseString(string);
                            // Add commas every three characters
                            var reversedWithCommas = reversed.match(/.{1,3}/g).join(',');
                            // Reverse again (back to normal)
                            return reverseString(reversedWithCommas);
                        };
                        // If there was no decimal, the last capture grabs the final digit, so
                        // we have to put it back together with the 'before' substring
                        return sign + (decimal ? insertCommas(before) + decimal + after : insertCommas(before + after));
                    }
            );
        };
    }

}).apply(APP, [window, window.document, jQuery]);
APP = $.extend({}, window.CORE, APP);