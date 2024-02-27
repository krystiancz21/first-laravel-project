$(function () {
    const imgUrl = $('#img-url').data('img-url');
    const defaultImage = $('#img-url').data('default-image');

    $('div.products-count a').click(function(event) {
        event.preventDefault();
        $('a.products-actual-count').text($(this).text());
        getProducts($(this).text());
    });

    $('a#filter-button').click(function (event) {
        event.preventDefault();
        getProducts($('a.products-actual-count').first().text());
    });

    function getProducts(paginate) {
        const form = $('form.sidebar-filter').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form + "&" + $.param({paginate: paginate})
        })
            .done(function (response) {
                $('div#products-wrapper').empty();
                $.each(response.data, function (index, product) {
                    const html = '<div class="col-6 col-md-6 col-lg-4 mb-3">\n' +
                        '                                <div class="card h-100 border-0">\n' +
                        '                                    <div class="card-img-top">\n' +
                        '                                        <img src="' + getImage(product) + '" class="img-fluid mx-auto d-block" alt="Product image">\n' +
                        '                                    </div>\n' +
                        '                                    <div class="card-body text-center">\n' +
                        '                                        <h4 class="card-title">\n' +
                                                                    product.name +
                        '                                        </h4>\n' +
                        '                                        <h5 class="card-price small">\n' +
                        '                                            <i> ' + product.price + ' PLN</i>\n' +
                        '                                        </h5>\n' +
                        '                                    </div>\n' +
                        '                                </div>\n' +
                        '                            </div>';
                    $('div#products-wrapper').append(html);
                });
            })
    }

    function getImage(product) {
        if (!!product.image_path) {
            return imgUrl + product.image_path;
        }
        return defaultImage;
    }
});
