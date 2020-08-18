jQuery(document).ready(function ($) {
    $('.radio-switcher input:radio').on('change', function (e) {
        e.preventDefault();
        $(this).closest('.inside').find('.switch-wrapper').hide();
        $(this).closest('.inside').find('.wpzoom_' + $(this).val()).show();
    });

    $('.radio-switcher input:radio:checked').trigger('change');

    $('.preview-video-input').on('input', function(e){
        var $that = $(this);

        _.debounce(function () {
                wp.ajax.post(
                    'get_oembed_response',
                    {
                        '_nonce': $that.data('nonce'),
                        'url': $that.val()
                    }).done(function (data) {
                    var $html = data.response ? data.response : '';
                    $that.closest('.wpzoom_external_hosted').find('.wpzoom_video_external_preview').html('<div>' + $html + '</div>');
                });
            }, 500)();
        }
    ).trigger('input');
});