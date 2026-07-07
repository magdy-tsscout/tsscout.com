<script src="https://cdn.tiny.cloud/1/p0niww7r5y6397opob90p9fp4h496wn3iihrzp4gnq97y19i/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    let currentPickerCallback;

    if (!document.getElementById('tinymce-office-theme')) {
        const officeThemeStyle = document.createElement('style');
        officeThemeStyle.id = 'tinymce-office-theme';
        officeThemeStyle.textContent = `
            .tox.tox-tinymce {
                border: 1px solid #d5dde8;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
                background: #f3f5f8;
            }

            .tox .tox-editor-header {
                background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
                border-bottom: 1px solid #d5dde8;
                padding-top: 6px;
            }

            .tox .tox-toolbar-overlord,
            .tox .tox-toolbar,
            .tox .tox-toolbar__primary {
                background: transparent !important;
            }

            .tox .tox-edit-area {
                background: #e9edf3;
                padding: 28px 0;
            }

            .tox .tox-statusbar {
                border-top: 1px solid #d5dde8;
                background: #f8fafc;
            }
        `;
        document.head.appendChild(officeThemeStyle);
    }

    tinymce.init({
        selector: '#content',
        plugins: 'link image code table lists',
        menubar: true,
        toolbar_mode: 'wrap',
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
        content_style: `
            body {
                background: #e9edf3;
                padding: 28px 0;
            }
            body#tinymce {
                max-width: 900px;
                margin: 0 auto !important;
                padding: 48px 56px !important;
                background: #ffffff;
                border: 1px solid #d5dde8;
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
                min-height: calc(100vh - 56px);
            }
            @media (max-width: 992px) {
                body#tinymce {
                    max-width: calc(100% - 24px);
                    padding: 28px 22px !important;
                }
            }
        `,
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
