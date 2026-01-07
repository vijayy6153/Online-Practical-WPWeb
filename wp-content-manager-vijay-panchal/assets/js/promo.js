jQuery(function ($) {

    ///// If AJAX disabled, do nothing
    if (!DCM.useAjax) {
        return;
    }

    $.ajax({
        url: DCM.ajaxUrl,
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'dcm_load_promos',
            nonce: DCM.nonce
        },
        success: function (response) {

            if (!response.success || !response.data.length) {
                $('#dcm-promo-wrapper').html('<p>No promotions available.</p>');
                return;
            }

            let html = '';

            response.data.forEach(function (item) {

                html += '<div class="promo-item">';

                ///// Left: Image
                html += '<div class="promo-image">';
                if (item.image) {
                    html += '<img src="' + item.image + '" loading="lazy" alt="">';
                }
                html += '</div>';

                ///// Right: Content
                html += '<div class="promo-content-area">';

                html += '<h3>' + item.title + '</h3>';
                html += '<div class="promo-content">' + item.content + '</div>';

                if (item.cta_url && item.cta_text) {
                    html += '<a href="' + item.cta_url + '" class="promo-cta">' +
                            item.cta_text + '</a>';
                }

                html += '</div>'; ///// content area
                html += '</div>'; ///// promo-item
            });

            $('#dcm-promo-wrapper').html(html);
        },
        error: function () {
            $('#dcm-promo-wrapper').html('<p>Error loading promotions.</p>');
        }
    });
});
