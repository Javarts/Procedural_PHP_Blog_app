<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        language: 'en_GB',
        plugins: 'link code image imagetools autolink autosave codesample spellchecker hr lists anchor save textcolor colorpicker textpattern emoticons',
        toolbar1: 'alignleft alignright aligncenter alignjustify | bullist numlist outdent indent | undo redo | cut copy paste | link | image | hr ',
        toolbar2: 'fontsizeselect | bold italic | forecolor backcolor emoticons',
        fontsize_formats: '10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 20pt 24pt 36pt',
        image_title: true, 
        automatic_uploads: true,
        file_picker_types: 'image', 
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        }
    });
</script>