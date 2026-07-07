<script src="https://cdn.tiny.cloud/1/p0niww7r5y6397opob90p9fp4h496wn3iihrzp4gnq97y19i/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    let currentPickerCallback;

    if (!document.getElementById('tinymce-office-theme')) {
        const officeThemeStyle = document.createElement('style');
        officeThemeStyle.id = 'tinymce-office-theme';
        officeThemeStyle.textContent = `
            .tox.tox-tinymce {
                border: 1px solid #cfd7e3;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 8px 24px rgba(15, 23, 42, 0.10);
                background: #eef2f7;
            }

            .tox .tox-editor-header {
                background: #f4f6f9;
                border-bottom: 1px solid #d8deea;
                padding-top: 0;
            }

            .tox .tox-menubar {
                background: linear-gradient(180deg, #f7f9fc 0%, #edf2f8 100%);
                border-bottom: 1px solid #cfd8e6;
                padding: 0 12px;
                min-height: 50px;
                display: flex;
                align-items: end;
                gap: 6px;
                overflow-x: auto;
                scrollbar-width: thin;
            }

            .tox .tox-menubar .tox-mbtn {
                border: 1px solid transparent;
                border-bottom: none;
                border-radius: 10px 10px 0 0;
                height: 40px;
                padding: 0 16px;
                font-size: 14px;
                font-weight: 600;
                color: #2a3442;
                margin-bottom: -1px;
                letter-spacing: 0.1px;
            }

            .tox .tox-menubar .tox-mbtn:hover {
                background: #e8eef8;
                border-color: #d7e1ef;
                color: #1f2937;
            }

            .tox .tox-menubar .tox-mbtn.office-tab-active {
                background: #ffffff;
                color: #1d4ea3;
                border-color: #c9d5e8;
                box-shadow: inset 0 3px 0 #2f6fda;
            }

            .tox .tox-menubar .tox-mbtn:focus-visible {
                outline: 2px solid #7fa7ea;
                outline-offset: -2px;
            }

            .tox .tox-toolbar-overlord {
                background: #ffffff !important;
                border-bottom: 1px solid #d8deea;
                padding: 8px 10px;
            }

            .tox .tox-toolbar,
            .tox .tox-toolbar__primary {
                background: transparent !important;
            }

            .tox .tox-tbtn,
            .tox .tox-tbtn--select,
            .tox .tox-listboxfield .tox-listbox--select,
            .tox .tox-listboxfield .tox-listbox--select:focus {
                border-radius: 6px;
                border-color: #d1d8e4 !important;
                min-height: 32px;
            }

            .tox .tox-toolbar__group {
                border-right: 1px solid #dfe5ef;
                padding-right: 10px;
                margin-right: 8px;
            }

            .tox .tox-toolbar__group:last-child {
                border-right: none;
                margin-right: 0;
                padding-right: 0;
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
        plugins: 'link image code table lists advlist',
        menubar: 'home insert pagelayout references review view section developer',
        menu: {
            home: { title: 'Home', items: 'undo redo | bold italic underline strikethrough | forecolor backcolor | blocks fontfamily fontsize | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat' },
            insert: { title: 'Insert', items: 'link image table | hr charmap' },
            pagelayout: { title: 'Page Layout', items: 'blocks lineheight' },
            references: { title: 'References', items: 'code' },
            review: { title: 'Review', items: 'spellcheckdialog' },
            view: { title: 'View', items: 'visualaid | code' },
            section: { title: 'Section', items: 'blocks' },
            developer: { title: 'Developer', items: 'code' }
        },
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

        toolbar: [
            'undo redo | cut copy paste pastetext | blocks fontfamily fontsize',
            'bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | removeformat code'
        ],

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
        ],
        setup: function (editor) {
            editor.on('init', function () {
                const container = editor.getContainer();
                if (!container) {
                    return;
                }

                const tabButtons = container.querySelectorAll('.tox-menubar .tox-mbtn');
                if (tabButtons.length === 0) {
                    return;
                }

                const setActiveTab = function (targetButton) {
                    tabButtons.forEach((button) => button.classList.remove('office-tab-active'));
                    targetButton.classList.add('office-tab-active');
                };

                setActiveTab(tabButtons[0]);

                tabButtons.forEach((button) => {
                    button.addEventListener('click', function () {
                        setActiveTab(button);
                    });
                });
            });
        }
    });

    document.querySelector('form').addEventListener('submit', function() {
        // Sync the TinyMCE content with the textarea
        tinymce.get('content').save();
    });
</script>
