$(function () {
    $('.delete').click(function () {
        const deleteUrl = $('#delete-url').data('delete-url');
        Swal.fire({
            title: 'Czy na pewno chcesz usunąć rekord?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "DELETE",
                    url: deleteUrl + $(this).data("id")
                })
                    .done(function (data) {
                        window.location.reload();
                    })
                    .fail(function (data) {
                        Swal.fire({
                            title: 'Błąd!',
                            text: data.responseJSON.message,
                            icon: data.responseJSON.error,
                            confirmButtonText: 'OK'
                        })
                    });
            }
        })

    });
});
