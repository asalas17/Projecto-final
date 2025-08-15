document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('imageSourceSwitch');
    const urlInput = document.getElementById('urlInput');
    const fileInput = document.getElementById('fileInput');
    const imageUrl = document.getElementById('imagen_url');
    const imageFile = document.getElementById('image_file');
    const imagePreview = document.getElementById('imagePreview');
    const imageError = document.getElementById('imageError');

    toggle.addEventListener('change', function () {
        if (this.checked) {
            urlInput.classList.add('d-none');
            fileInput.classList.remove('d-none');
            imageUrl.value = '';
        } else {
            fileInput.classList.add('d-none');
            urlInput.classList.remove('d-none');
            imageFile.value = '';
        }
        imagePreview.src = '';
        imagePreview.classList.add('d-none');
    });

    imageUrl.addEventListener('input', function () {
        const url = this.value.trim();
        if (url) {
            imagePreview.src = url;
            imagePreview.classList.remove('d-none');
        } else {
            imagePreview.classList.add('d-none');
        }
    });

    imageFile.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('d-none');
        }
    });

    const form = document.getElementById('crearProductoForm');
    form.addEventListener('submit', function (e) {
        const usingFile = toggle.checked;
        const url = imageUrl.value.trim();
        const file = imageFile.files[0];

        if (usingFile && !file) {
            e.preventDefault();
            imageError.textContent = 'Subí una imagen o cambiá la opción.';
            return;
        }
        if (!usingFile && !url) {
            e.preventDefault();
            imageError.textContent = 'Ingresá la URL de la imagen o cambiá la opción.';
            return;
        }
        imageError.textContent = '';
    });
});