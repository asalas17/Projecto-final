let editMap;
let editMarker;
let editMapInitialized = false;

function initEditMap() {
    const defaultPos = { lat: 9.7489, lng: -83.7534 };
    editMap = new google.maps.Map(document.getElementById('edit_map'), {
        center: defaultPos,
        zoom: 7
    });

    const input = document.getElementById('edit_map-search');
    const autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function () {
        const place = autocomplete.getPlace();
        if (!place.geometry || !place.geometry.location) {
            return;
        }
        editMap.setCenter(place.geometry.location);
        editMap.setZoom(15);
        if (editMarker) {
            editMarker.setPosition(place.geometry.location);
        } else {
            editMarker = new google.maps.Marker({
                position: place.geometry.location,
                map: editMap
            });
        }
        document.getElementById('edit_lat').value = place.geometry.location.lat();
        document.getElementById('edit_lng').value = place.geometry.location.lng();
    });

    editMap.addListener('click', function (e) {
        if (editMarker) {
            editMarker.setPosition(e.latLng);
        } else {
            editMarker = new google.maps.Marker({
                position: e.latLng,
                map: editMap
            });
        }
        document.getElementById('edit_lat').value = e.latLng.lat();
        document.getElementById('edit_lng').value = e.latLng.lng();
    });

    editMapInitialized = true;
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.editarFeriaBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('edit_feria_id').value = this.dataset.id;
            document.getElementById('edit_nombre').value = this.dataset.nombre || '';
            document.getElementById('edit_descripcion').value = this.dataset.descripcion || '';
            document.getElementById('edit_fecha_inicio').value = this.dataset.fecha_inicio.replace(' ', 'T');
            document.getElementById('edit_fecha_fin').value = this.dataset.fecha_fin.replace(' ', 'T');
            document.getElementById('edit_provincia').value = this.dataset.provincia || '';
            document.getElementById('edit_ubicacion').value = this.dataset.ubicacion || '';
            document.getElementById('edit_lat').value = this.dataset.lat || '';
            document.getElementById('edit_lng').value = this.dataset.lng || '';

            const urlInput = document.getElementById('edit_image_url');
            const fileInput = document.getElementById('edit_image_file');
            const imagePreview = document.getElementById('edit_imagePreview');
            const toggle = document.getElementById('edit_imageSourceSwitch');

            urlInput.value = this.dataset.imageUrl || '';
            fileInput.value = '';
            toggle.checked = false;
            document.getElementById('edit_fileInput').classList.add('d-none');
            document.getElementById('edit_urlInput').classList.remove('d-none');

            if (this.dataset.imageUrl) {
                imagePreview.src = this.dataset.imageUrl;
                imagePreview.classList.remove('d-none');
            } else if (this.dataset.imagePath) {
                imagePreview.src = '/' + this.dataset.imagePath.replace(/^\/+/, '');
                imagePreview.classList.remove('d-none');
            } else {
                imagePreview.src = '';
                imagePreview.classList.add('d-none');
            }
        });
    });

    document.getElementById('editarFeriaModal').addEventListener('shown.bs.modal', function () {
        if (typeof google !== 'undefined' && !editMapInitialized) {
            initEditMap();
        }
        if (editMap) {
            google.maps.event.trigger(editMap, 'resize');
            const lat = parseFloat(document.getElementById('edit_lat').value);
            const lng = parseFloat(document.getElementById('edit_lng').value);
            if (!isNaN(lat) && !isNaN(lng)) {
                const pos = { lat: lat, lng: lng };
                editMap.setCenter(pos);
                editMap.setZoom(15);
                if (editMarker) {
                    editMarker.setPosition(pos);
                } else {
                    editMarker = new google.maps.Marker({ position: pos, map: editMap });
                }
            }
        }
    });

    var searchInput = document.getElementById('edit_map-search');
    if (searchInput) {
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    }

    const toggle = document.getElementById('edit_imageSourceSwitch');
    const urlInput = document.getElementById('edit_urlInput');
    const fileInput = document.getElementById('edit_fileInput');
    const imageUrl = document.getElementById('edit_image_url');
    const imageFile = document.getElementById('edit_image_file');
    const imagePreview = document.getElementById('edit_imagePreview');
    const imageError = document.getElementById('edit_imageError');

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

    var form = document.getElementById('editarFeriaForm');
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
        var ubicacion = {
            provincia: document.getElementById('edit_provincia').value,
            ubicacion: document.getElementById('edit_ubicacion').value,
            google_maps: {
                lat: document.getElementById('edit_lat').value,
                lng: document.getElementById('edit_lng').value
            }
        };
        document.getElementById('edit_ubicacion_json').value = JSON.stringify(ubicacion);
    });
});