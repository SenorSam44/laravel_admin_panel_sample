@props(['model_related_to', 'model_id', 'tag'])

<form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="position-relative">
        <div id="image-container">
{{--            <img src="{{ asset('assets') }}/img/bruce-mars.jpg" id="image-preview"--}}
{{--             class="w-100 border-radius-lg shadow-sm" alt="Image">--}}
            <button
                type="button"
                class="btn btn-light border-radius-lg shadow-sm m-3 ml-5"
                id="image-preview">
                <i class="material-icons" style="width: 60px; height: 60px; font-size: 60px">addbox</i>
            </button>
            <input type="file" id="image-upload" name="files[]" multiple style="display: none">
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('input[name="files[]"]').on('change', function (e) {
            const files = e.target.files;
            const previews = $('#file-previews');

            if (!document.querySelector('#file-previews')){
                previews.html('');
                previews.addClass('row');
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const previewHtml = `
                    <div class="file-preview col-md-4 my-3 position-relative">
                        <img class="w-100 p-4 border border-dark rounded" src="${e.target.result}" alt="${file.name}">
                        <p>${file.name}</p>
                        <button type="button" class="btn btn-danger delete-file position-absolute rounded-circle p-0" style="top: -1em; right: 0; width: 30px; height: 30px;"
                                data-file="${file.name}">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                `;

                    previews.append(previewHtml);
                };

                reader.readAsDataURL(file);
            }

            // Create FormData for all selected files
            let formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('model_related_to', "{{$model_related_to}}");
            formData.append('model_id', "{{$model_id}}");


            // Make an AJAX call to upload all selected files
            $.ajax({
                type: 'POST',
                url: '{{ route('files.upload') }}', // Replace with your route URL
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // Handle success response (e.g., show success message)
                    toastr.success(data["message"]);
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    // Handle error response (e.g., show error message)
                    console.error(error);
                    toastr.success(error);
                }
            });
        });

        $('#file-previews').on('click', '.delete-file', function () {
            const deleteButton = $(this); // Store a reference to the button element
            // Implement code to remove the file preview and remove the file from the input
            const fileId = $(this).data('file-id');

            // Send a DELETE request to the server to delete the file
            $.ajax({
                type: 'DELETE',
                url: '/files/'+fileId, // Replace with your route URL
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}", // Include CSRF token
                },
                success: function (data) {
                    console.log(data);
                    toastr.success(data["message"]);
                    // Handle success response (e.g., remove the deleted file from the DOM)
                    deleteButton.parent().remove(); // Use deleteButton to remove the parent element

                },
                error: function (xhr, status, error) {
                    // Handle error response (e.g., display an error message)
                    console.error(error);
                    toastr.success(error);
                }
            });
        });
    });
</script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('input[name="files[]"]').on('change', function (e) {--}}
{{--                const files = e.target.files;--}}
{{--                const previews = $('#file-previews');--}}
{{--                previews.html('');--}}
{{--                previews.addClass('row')--}}

{{--                for (let i = 0; i < files.length; i++) {--}}
{{--                    const file = files[i];--}}
{{--                    const reader = new FileReader();--}}

{{--                    reader.onload = function (e) {--}}
{{--                        const previewHtml = `--}}
{{--                    <div class="file-preview col-md-4 my-3 position-relative">--}}
{{--                        <img class="w-100 p-4 border border-dark rounded" src="${e.target.result}" alt="${file.name}">--}}
{{--                        <button class="btn btn-danger position-absolute rounded-circle p-0" style="top: -1em; right: 0; width: 30px; height: 30px;"  data-file="${file.name}">--}}
{{--                            <i class="material-icons">close</i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                `;--}}

{{--                        previews.append(previewHtml);--}}
{{--                    };--}}

{{--                    reader.readAsDataURL(file);--}}
{{--                }--}}

{{--                for(let i= 0; i<files.length; i++){--}}
{{--                    let formData = new FormData($(this)[0]);--}}
{{--                    formData =--}}
{{--                    $.ajax({--}}
{{--                        type: 'POST',--}}
{{--                        url: '{{ route('files.upload') }}', // Replace with your route URL--}}
{{--                        data: formData,--}}
{{--                        processData: false,--}}
{{--                        contentType: false,--}}
{{--                        success: function (data) {--}}
{{--                            // Handle success response (e.g., show success message)--}}
{{--                            console.log(data);--}}
{{--                        },--}}
{{--                        error: function (xhr, status, error) {--}}
{{--                            // Handle error response (e.g., show error message)--}}
{{--                            console.error(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}

{{--            $('#file-previews').on('click', '.delete-file', function () {--}}
{{--                const fileName = $(this).data('file');--}}
{{--                // Implement code to remove the file preview and remove the file from the input--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}

<script>
    const imageContainer = document.getElementById('image-container');
    const imagePreview = document.getElementById('image-preview');
    const imageUpload = document.getElementById('image-upload');

    imageContainer.addEventListener('click', () => {
        imageUpload.click();
    });

    // imageUpload.addEventListener('change', () => {
    //     const file = imageUpload.files[0];
    //     if (file) {
    //         const imageUrl = URL.createObjectURL(file);
    //         imagePreview.src = imageUrl;

            // You can also use JavaScript to send the file to the server for storage.
            // Example AJAX request to upload the file to the server using Laravel:
            // const formData = new FormData();
            // formData.append('image', file);
            // fetch('/upload-image', {
            //     method: 'POST',
            //     body: formData,
    //         // });
    //     }
    // });
</script>

</aside>
