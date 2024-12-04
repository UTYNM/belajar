@extends('template.admin')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">MAP</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Shreyu</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">UPLOAD GEOJSON</h4>

                    @if (session('success'))
                        <p style="color: green;">{{ session('success') }}</p>

                        <h4>Data GeoJSON yang Di-upload:</h4>
                        <pre>{{ json_encode(session('geojson_data'), JSON_PRETTY_PRINT) }}</pre>
                    @endif

                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="geojson_file">Masukan File GeoJSON</label>
                        <input class="form-control mb-2" type="file" name="geojson_file" accept=".geojson" required>

                        <label for="nama_geo">Nama Geo</label>
                        <input class="form-control mb-2" type="text" name="nama_geo" placeholder="Masukkan Nama Geo"
                            required>

                        <label for="warna_geo">Warna Geo</label>
                        <input class="form-control mb-2" type="color" name="warna_geo" value="#42a5f5" required>

                        <button type="submit" class="btn btn-primary mb-2">Upload</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">Layer Control</h4>
                    <div id="layer-controls">
                        @foreach ($uploaded_geojsons as $geojson)
                            <div style="display: flex; align-items: center; margin-bottom: 8px;">
                                <input type="checkbox" id="layer-{{ $geojson->id }}" class="geojson-checkbox"
                                    data-layer-id="{{ $geojson->id }}" checked>
                                <span
                                    style="display: inline-block; width: 16px; height: 16px; background-color: {{ $geojson->warna_geo }}; border: 1px solid #000; margin-left: 8px; margin-right: 8px;"></span>
                                <label for="layer-{{ $geojson->id }}"
                                    style="margin-right: 8px;">{{ $geojson->nama_geo }}</label>
                                <i data-feather="alert-circle" class="icon-dual-danger" type="button"
                                    data-bs-toggle="modal" data-bs-target="#infoModal-{{ $geojson->id }}"></i>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">MAP</h4>
                    <div id="map" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($uploaded_geojsons as $geojson)
        <div class="modal fade" id="infoModal-{{ $geojson->id }}" tabindex="-1"
            aria-labelledby="infoModalLabel-{{ $geojson->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel-{{ $geojson->id }}">Informasi GeoJSON:
                            {{ $geojson->nama_geo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><b>Nama Geo:</b> {{ $geojson->nama_geo }}</p>
                        <p><b>Warna Geo:</b> <span
                                style="display: inline-block; width: 16px; height: 16px; background-color: {{ $geojson->warna_geo }}; border: 1px solid #000;"></span>
                            ({{ $geojson->warna_geo }})</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script>
        // Map base layer
        var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var map = L.map('map', {
            center: [-1.8358712300287032, 109.97504462294081],
            zoom: 13,
            layers: [peta1]
        });

        var baseMaps = {
            "Grayscale": peta1
        };

        // Object to store GeoJSON layers
        var uploadedGeoJSONLayers = {};

        // Add GeoJSON layers dynamically from backend data
        @foreach ($uploaded_geojsons as $geojson)
            var layer{{ $geojson->id }} = L.geoJSON(@json($geojson->geojson), {
                style: {
                    color: "{{ $geojson->warna_geo }}", // Use warna_geo from the database
                    fillColor: "{{ $geojson->warna_geo }}",
                    fillOpacity: 0.5
                },
                onEachFeature: function(feature, layer) {
                    if (feature.properties) {
                        let popupContent = `<b>Nama Geo:</b> {{ $geojson->nama_geo }}<br>`;
                        for (let key in feature.properties) {
                            popupContent += `<b>${key}:</b> ${feature.properties[key]}<br>`;
                        }
                        layer.bindPopup(popupContent);
                    }
                }
            }).addTo(map);

            // Store layer in object for later access
            uploadedGeoJSONLayers["GeoJSON {{ $geojson->id }}"] = layer{{ $geojson->id }};
        @endforeach

        // Layer control for toggling visibility
        L.control.layers(baseMaps, uploadedGeoJSONLayers).addTo(map);

        // Checkbox event handlers
        document.querySelectorAll('.geojson-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var layerId = this.dataset.layerId;
                var layer = uploadedGeoJSONLayers["GeoJSON " + layerId];
                if (this.checked) {
                    map.addLayer(layer);
                } else {
                    map.removeLayer(layer);
                }
            });
        });
    </script>

@endsection
