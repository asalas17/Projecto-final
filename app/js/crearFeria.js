    let map;
    let marker;

    function initMap() {
        const defaultPos = { lat: 9.7489, lng: -83.7534 };
        map = new google.maps.Map(document.getElementById('map'), {
            center: defaultPos,
            zoom: 7
        });

        const input = document.getElementById('map-search');
        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();
            if (!place.geometry || !place.geometry.location) {
                return;
            }
            map.setCenter(place.geometry.location);
            map.setZoom(15);
            if (marker) {
                marker.setPosition(place.geometry.location);
            } else {
                marker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: map
                });
            }
            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();
        });


        map.addListener('click', function (e) {
            if (marker) {
                marker.setPosition(e.latLng);
            } else {
                marker = new google.maps.Marker({
                    position: e.latLng,
                    map: map
                });
            }
            document.getElementById('lat').value = e.latLng.lat();
            document.getElementById('lng').value = e.latLng.lng();
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('crearFeriaModal').addEventListener('shown.bs.modal', function () {
            if (map) {
                google.maps.event.trigger(map, 'resize');
            }
        });

        var searchInput = document.getElementById('map-search');
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });


        const toggle = document.getElementById('imageSourceSwitch');
        const urlInput = document.getElementById('urlInput');
        const fileInput = document.getElementById('fileInput');
        const imageUrl = document.getElementById('image_url');
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

        var form = document.getElementById('crearFeriaForm');
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
                provincia: document.getElementById('provincia').value,
                ubicacion: document.getElementById('ubicacion').value,
                google_maps: {
                    lat: document.getElementById('lat').value,
                    lng: document.getElementById('lng').value
                }
            };
            document.getElementById('ubicacion_json').value = JSON.stringify(ubicacion);
        });
    });
