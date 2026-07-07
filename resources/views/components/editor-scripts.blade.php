<script src="https://cdn.tiny.cloud/1/p0niww7r5y6397opob90p9fp4h496wn3iihrzp4gnq97y19i/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    let currentPickerCallback;
    tinymce.init({
        selector: '#content',
        plugins: 'link image code table lists',
        image_title: true,
        automatic_uploads: true,
        images_upload_url: "{{ route('upload-handler') }}",
        images_upload_handler: function (blobInfo, progress) {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', "{{ route('upload-handler') }}");

                // إضافة الـ CSRF Token من الـ Meta Tag
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status === 403) {
                        reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                        return;
                    }
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }
                    const json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    resolve(json.location);
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            });
        },
        image_dimensions: true,
        image_description: true,
        image_advtab: true,

        image_list: '{{ route("get-images") }}',

        toolbar: 'undo redo | blocks | fontsize | block_formats | fontsize_formats | bold italic backcolor | link image | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | table | code',

        table_default_attributes: {
            // class: 'table'
        },
        table_class_list: [
            {title: 'none', value: ''},
            {title: 'Default (Bordered)', value: 'table table-bordered'},
            {title: 'Striped Rows', value: 'table table-striped'},
            {title: 'Hover Effect', value: 'table table-hover'},
            {title: 'Borderless', value: 'table table-borderless'}
        ],
        content_css: [
            '{{ asset("css/bootstrap.min.css") }}',
            '{{ asset("css/slicknav.min.css") }}',
            '{{ asset("css/swiper-bundle.min.css") }}',
            '{{ asset("css/all.css") }}',
            '{{ asset("css/animate.css") }}',
            '{{ asset("css/magnific-popup.css") }}',
            '{{ asset("css/custom.css") }}',
            '{{ asset("css/magicButtons.css") }}',
            '{{ asset("css/header2.css") }}',
            '{{ asset("css/footer.css") }}',
            '{{ asset("css/blog-details.css") }}'
        ]
    });

    document.querySelector('form').addEventListener('submit', function() {
        // Sync the TinyMCE content with the textarea
        tinymce.get('content').save();
    });
</script>
