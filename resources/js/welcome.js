$(function () {
    const imgUrl = $('#img-url').data('img-url');
    const cartUrl = $('#cart-url').data('cart-url');
    const guestUrl = $('#products-wrapper').data('guest-url');
    const defaultImage = $('#img-url').data('default-image');

    $('div.products-count a').click(function (event) {
        event.preventDefault();
        $('a.products-actual-count').text($(this).text());
        getProducts($(this).text());
    });

    $('a#filter-button').click(function (event) {
        event.preventDefault();
        getProducts($('a.products-actual-count').first().text());
    });

    $('button.add-cart-button').click(function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: cartUrl + '/' + $(this).data('id'),
        }).done(function () {
            Swal.fire({
                title: 'Brawo',
                text: 'Produkt dodany do koszyka',
                icon: 'success',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-cart-plus"></i> Przejdź do koszyka',
                cancelButtonText: '<i class="fas fa-shopping-bag"></i> Kontynuuj zakupy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = cartUrl;
                }
            })
        }).fail(function (data) {
            Swal.fire('Opss...', 'Wystąpił błąd', 'error');
        });
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
                        '                                    <button class="btn btn-success btn-sm add-cart-button" ' + getDisabled() + ' data-id="' + product.id + '">\n' +
                        '                                      <i class="fas fa-cart-plus"></i> Dodaj do koszyka\n' +
                        '                                    </button>\n' +
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

    function getDisabled() {
        if (guestUrl) {
            return 'disabled';
        }
        return '';
    }
});
