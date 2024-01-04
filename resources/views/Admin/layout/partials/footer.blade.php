<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>CALL LABS</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="#">CALL LABS</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i></a>

<script src="{{ asset('admin-assets/js/jquery.js') }}"></script>

<!-- Vendor JS Files -->

<script src="{{ asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('admin-assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/php-email-form/validate.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Template Main JS File -->
<script src="{{ asset('admin-assets/js/main.js') }}"></script>

@stack('after-scripts')
@stack('after-lab-scripts')
@stack('after-order-scripts')

<script></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {

        $(".js-example-basic-single").select2();
        $(".js-example-tags").select2({
            tags: true
        });

        $(".js-grouptest-tags").select2({
            tags: true
        })
        $('.js-grouptest').select2({
            tags: true
        });
    });

    $(document).ready(function() {
        $(".js-labs").select2({
            tags: true
        });
        $('.js-labs').on('select2:selecting', function(e) {
            var data = e.params.args.data;
            //console.log('data',data.id);

            $.ajax({
                method: 'POST',
                url: "{{ route('subtestprice') }}",
                data: {
                    id: data.id
                },
                success: function(res) {

                    //console.log('ress>>',res)
                    var dummy =
                        '<label for="inputEmail3" class="col-sm-2 col-form-label mt-3">Details</label><div class="col-sm-5 "><input type="text" class="form-control" id="inputText" name="subtest_id[]" value="' +
                        data.text +
                        '"></div><div class="col-sm-5"><input type="text" class="form-control" id="inputText" name="price[' +
                        data.id + ']" placeholder="Price" value="' + res.price +
                        '"></div>\r\n';
                    $('#details').append(dummy);
                }

            })
            //var price = $(this).find(":selected").data("price");
        });

        $('.js-labs').on('select2:unselecting', function(e) {
            console.log('removing: ', e.params.args.data);
        });
    });


    $('#js-labs').select2('data');

    $('.open-modal').click(function() {
        var itemId = $(this).data('id');
        var formData = {
            itemId: itemId,
        };
        $.ajax({
            url: "{{ route('show.order') }}",
            data: formData,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('res', response);

                // var relationshipData = response.package;

                $.each(response.test, function(index, item) {

                    // var html = ' ';
                    var html = '<tr> <td>' + item.subtest[0].sub_test_name + '</td><td>' +
                        item.lab_id + '</td><td>' + item.price + ' </tr>';

                    $('#itemDetailsTable').append(html);
                });
                // Open the modal
                $('#itemModal').modal('show');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    $(document).ready(function() {

        console.log($('.upload-file-preview').length)

        $('.custom-file-input').on('change', function() {
            var fileInput = $(this)[0].files[0];
            console.log('fileInput', fileInput)

            var orderId = $(this).data('orderid');
            var testId = $(this).data('testid');
            var user_id = $(this).data('user_id');

            if (fileInput) {
                var spinner = $(this).find('.upload-spinner');

                console.log('orderId', orderId)
                console.log('testId', testId)

                $(spinner).removeClass('d-none');
                var formData = new FormData();
                formData.append('file', fileInput);
                formData.append('orderId', orderId);
                formData.append('testId', testId);
                formData.append('user_id', user_id);

                //console.log('formData',formData)
                //return;
                $.ajax({
                    url: '{{ route('upload.report') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        // Handle the response from the server
                        //$('.upload-spinner').addClass('d-none');

                        if (response.success) {
                            alert(response.message);

                            fileUrl = response.file_url;
                            // Show the preview and remove button, hide the file input
                            $('#fileInput').hide();
                            $('.upload-file-preview, #removeFileBtn').show();
                            $('.upload-file-preview').attr('href', fileUrl);

                            window.location.reload();
                        } else {
                            alert('File upload failed: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $('.upload-spinner').addClass('d-none');
                        alert('An error occurred while uploading the file.');
                        console.log(xhr.responseText);
                    }
                });
            }
        });

        // Remove the file and show the file input again
        $('#removeFileBtn').on('click', function() {
            fileUrl = '';
            $('#fileInput').val('').show();
            $('.upload-file-preview, #removeFileBtn').hide();
            $('.fileupload').removeClass('d-none');
        });

        $('.open-report').on('click', function() {
            var recordId = $(this).data('record-id');
            var formData = {
                recordId: recordId,
            };
            $.ajax({
                type: 'GET',
                url: "{{ route('get-report') }}",
                data: formData, // Define a route to fetch the record details
                success: function(response) {
                    console.log(response)
                    $('#itemModal .modal-body').html(response.html);
                    $('#itemModal').modal('show');
                }
            });
        });


        $('#itemModal .modal-body').on('click', '#uploadButton', function() {
            console.log('>>>>')
            $('#report').show();
        });

        $('#itemModal .modal-body').on('change', '#newReport', function() {
            var fileInput = $(this)[0].files[0];
            console.log('fileInput', fileInput)
            var id = $(this).data('id');

            if (fileInput) {

                var formData = new FormData();
                formData.append('file', fileInput);
                formData.append('id', id);

                $.ajax({
                    url: '{{ route('upload.newreport') }}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        alert(response.message);
                        window.location.reload();
                        // Handle the response from the server
                        //$('.upload-spinner').addClass('d-none');


                    },
                })
            }
        })

        $('.status').on('change', function() {
            var order_status = $(this).val();
            var order_id = $(this).data('orderid');
            console.log(order_id);

            $.ajax({
                url: "{{ route('orderstatus.update') }}",
                method: 'post',
                data: {
                    order_status,
                    order_id
                },
                success: function(response, textStatus, xhr) {
                    if (xhr.status === 200) {
                        alert(response.message)
                    } else {
                        console.log(response)
                    }
                }
            })
        })
    });
</script>
</body>

</html>
