


$('.register_btn').on('click', function(e) {
    e.preventDefault;
    console.log('>>>working')

    var email = $('#email').val();
    var name = $('#name').val();
    var phone = $('#phone').val();
    var valid = true;
    var iconUrl = '<i class="icofont-spinner-alt-6 text-2xl text-black" style="padding:2px"></i>';

    if (name === '') {
        $('.error_name').html('<i class=\"icofont-info-circle\"></i> &nbsp;Name is required.');
        valid = false;
    } else {
        $('.error_name').html('');
    }

    if (email === '') {
        $('.error_email').html('<i class=\"icofont-info-circle\"></i> &nbsp;Email is required.');
        valid = false;
    } else {
        $('.error_email').html('');
    }
    if (phone === '') {
        $('.error_phone').html('<i class=\"icofont-info-circle\"></i> &nbsp;Phone is required.');
        valid = false;
    }

    if (phone) {
        if (!$.isNumeric(phone)) {
            $('.error_phone').html('<i class=\"icofont-info-circle\"></i> &nbsp;Phone should be numeric.');
            valid = false;
        } else if (phone.trim().length > 10 || phone.trim().length < 10) {
            $('.error_phone').html(
                '<i class=\"icofont-info-circle\"></i> &nbsp;Phone should be at least 10 digits.');
            valid = false;
        } else {
            $('.error_phone').html('');
        }
    }

    if (name !== '' && phone !== '' && email !== '') {
        valid = true;
        console.log('>>>', APP_URL)
    }

    if (valid) {

        $('#loader').removeClass('hidden');

        $.ajax({
            'url': APP_URL + '/signup',
            'method': 'POST',
            'data': {
                'name': name,
                'email': email,
                'phone': phone
            },
            success: function(response, textStatus, xhr) {
                if (xhr.status === 201) {
                    $('#loader').addClass('hidden');

                    Swal.fire({
                        icon: 'success',
                        html: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = APP_URL + response.redirectTo;
                        }
                    })
                } else {
                    console.log('eerrr')
                    Swal.fire({
                        icon: 'error',
                        html: response.message,
                    })
                }
            }

        })
    }
});





