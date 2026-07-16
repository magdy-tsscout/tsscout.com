<script src="https://cdn.tiny.cloud/1/p0niww7r5y6397opob90p9fp4h496wn3iihrzp4gnq97y19i/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
    let currentPickerCallback;
    const siteBodyClasses = (document.body && document.body.className)
        ? document.body.className.trim().replace(/\s+/g, ' ')
        : '';

    if (!document.getElementById('tinymce-extra-tools-style')) {
        const extraToolsStyle = document.createElement('style');
        extraToolsStyle.id = 'tinymce-extra-tools-style';
        extraToolsStyle.textContent = `
            .tox.tox-tinymce.tools-collapsed .tox-toolbar-overlord .tox-toolbar:last-of-type {
                display: none;
            }

            .tox.tox-tinymce .tox-tbtn.tox-tbtn--select.editor-compact-select {
                width: 80px !important;
                max-width: 80px !important;
                min-width: 80px !important;
            }

            .tox.tox-tinymce .tox-menubar {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                white-space: nowrap;
            }

            @media (max-width: 768px) {
                .tox.tox-tinymce .tox-tbtn.tox-tbtn--select.editor-compact-select {
                    width: auto !important;
                    max-width: none !important;
                    min-width: 96px !important;
                }

                .tox.tox-tinymce .tox-toolbar,
                .tox.tox-tinymce .tox-toolbar__primary {
                    flex-wrap: nowrap;
                    overflow-x: auto;
                }

                .tox.tox-tinymce .tox-toolbar__group {
                    flex-wrap: nowrap;
                    margin-right: 4px;
                }
            }
        `;
        document.head.appendChild(extraToolsStyle);
    }

    tinymce.init({
        selector: '#content',
        body_class: siteBodyClasses,
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks visualchars code fullscreen insertdatetime media table help wordcount autosave directionality nonbreaking pagebreak quickbars emoticons codesample',
        menubar: 'file edit view insert format tools table help',
        menu: {
            file: { title: 'File', items: 'newdocument restoredraft | preview | print' },
            edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
            view: { title: 'View', items: 'code | visualaid visualchars visualblocks | preview fullscreen' },
            insert: { title: 'Insert', items: 'image media link anchor emoticons charmap nonbreaking pagebreak insertdatetime codesample' },
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats blocks fontfamily fontsize | forecolor backcolor | removeformat' },
            tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
            table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
            help: { title: 'Help', items: 'help' }
        },
        toolbar_mode: 'wrap',
        autosave_ask_before_unload: true,
        autosave_interval: '20s',
        quickbars_selection_toolbar: 'bold italic underline | blocks | forecolor backcolor | quicklink blockquote',
        quickbars_insert_toolbar: 'image media table hr',
        mobile: {
            menubar: false,
            toolbar_mode: 'sliding',
            toolbar: [
                'blocks fontfamily fontsize | toggleextratools',
                'bold italic underline | alignleft aligncenter alignright | link image table fullscreen',
                'numlist bullist | outdent indent | removeformat code | preview help'
            ]
        },
        image_title: true,
        automatic_uploads: true,
        images_upload_url: "{{ route('admin.upload-handler') }}",
        images_upload_handler: function (blobInfo, progress) {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', "{{ route('admin.upload-handler') }}");

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

        image_list: '{{ route("admin.get-images") }}',

        toolbar: [
            'cut copy paste pastetext | blocks fontfamily fontsize | toggleextratools',
            'bold italic underline strikethrough forecolor backcolor | alignleft aligncenter alignright alignjustify | link anchor image media table fullscreen',
            'superscript subscript | ltr rtl | blockquote | outdent indent | numlist bullist checklist | removeformat code | emoticons charmap nonbreaking pagebreak insertdatetime codesample | searchreplace visualchars visualblocks | preview wordcount help'
        ],

        table_default_attributes: {
            class: 'table'
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
                padding: 12px;
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
            '{{ asset("css/blog-details.css") }}',
            '{{ asset("css/editor-content.css?v=1") }}'
        ],
        setup: function (editor) {
            editor.ui.registry.addButton('toggleextratools', {
                text: 'Tools',
                tooltip: 'Show or hide extra tools',
                onAction: function () {
                    const container = editor.getContainer();
                    if (!container) {
                        return;
                    }
                    container.classList.toggle('tools-collapsed');
                }
            });

            editor.on('init', function () {
                const container = editor.getContainer();
                if (!container) {
                    return;
                }

                const compactSelects = container.querySelectorAll('.tox-toolbar:first-of-type .tox-tbtn--select');
                compactSelects.forEach((selectButton, index) => {
                    if (index < 3) {
                        selectButton.classList.add('editor-compact-select');
                    }
                });

                container.classList.add('tools-collapsed');
            });
        }
    });

    document.querySelector('form').addEventListener('submit', function() {
        // Sync the TinyMCE content with the textarea
        tinymce.get('content').save();
    });
</script>
