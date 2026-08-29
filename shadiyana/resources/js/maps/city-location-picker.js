import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

/*
|--------------------------------------------------------------------------
| Fix Leaflet Marker Icons
|--------------------------------------------------------------------------
*/

import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: markerIcon2x,
    iconUrl: markerIcon,
    shadowUrl: markerShadow,
});


/*
|--------------------------------------------------------------------------
| City Location Picker
|--------------------------------------------------------------------------
*/

export function initializeCityLocationPicker() {

    const mapElement = document.getElementById('city-map');

    if (!mapElement) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Form Elements
    |--------------------------------------------------------------------------
    */

    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const searchInput = document.getElementById('location-search');
    const searchButton = document.getElementById('location-search-button');
    const searchMessage = document.getElementById('location-search-message');


    /*
    |--------------------------------------------------------------------------
    | Default Location
    |--------------------------------------------------------------------------
    | Multan, Pakistan
    |--------------------------------------------------------------------------
    */

    const defaultLocation = {
        lat: 30.1575,
        lng: 71.5249,
    };


    /*
    |--------------------------------------------------------------------------
    | Existing / Old Coordinates
    |--------------------------------------------------------------------------
    */

    const oldLatitude = parseFloat(latitudeInput?.value);
    const oldLongitude = parseFloat(longitudeInput?.value);


    const hasExistingCoordinates =
        !Number.isNaN(oldLatitude) &&
        !Number.isNaN(oldLongitude);


    /*
    |--------------------------------------------------------------------------
    | Initial Location
    |--------------------------------------------------------------------------
    */

    const initialLocation = hasExistingCoordinates
        ? [oldLatitude, oldLongitude]
        : [defaultLocation.lat, defaultLocation.lng];


    /*
    |--------------------------------------------------------------------------
    | Create Map
    |--------------------------------------------------------------------------
    */

    const map = L.map(mapElement, {
        center: initialLocation,
        zoom: hasExistingCoordinates ? 13 : 7,

        zoomControl: true,

        attributionControl: true,
    });


    /*
    |--------------------------------------------------------------------------
    | OpenStreetMap Tiles
    |--------------------------------------------------------------------------
    */

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,

            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors',
        }
    ).addTo(map);


    /*
    |--------------------------------------------------------------------------
    | Marker
    |--------------------------------------------------------------------------
    */

    let marker = null;


    /*
    |--------------------------------------------------------------------------
    | Set Coordinates
    |--------------------------------------------------------------------------
    */

    function setCoordinates(latitude, longitude, moveMap = true) {

        latitude = Number(latitude);
        longitude = Number(longitude);


        if (
            Number.isNaN(latitude) ||
            Number.isNaN(longitude)
        ) {
            return;
        }


        if (
            latitude < -90 ||
            latitude > 90 ||
            longitude < -180 ||
            longitude > 180
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Update Inputs
        |--------------------------------------------------------------------------
        */

        if (latitudeInput) {
            latitudeInput.value = latitude.toFixed(8);
        }

        if (longitudeInput) {
            longitudeInput.value = longitude.toFixed(8);
        }


        /*
        |--------------------------------------------------------------------------
        | Marker
        |--------------------------------------------------------------------------
        */

        if (!marker) {

            marker = L.marker(
                [latitude, longitude],
                {
                    draggable: true,
                }
            ).addTo(map);


            /*
            |--------------------------------------------------------------------------
            | Marker Drag Event
            |--------------------------------------------------------------------------
            */

            marker.on('dragend', function (event) {

                const position = event.target.getLatLng();

                setCoordinates(
                    position.lat,
                    position.lng,
                    false
                );

            });

        } else {

            marker.setLatLng([
                latitude,
                longitude,
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Move Map
        |--------------------------------------------------------------------------
        */

        if (moveMap) {

            map.setView(
                [latitude, longitude],
                Math.max(map.getZoom(), 13),
                {
                    animate: true,
                }
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Existing Coordinates
    |--------------------------------------------------------------------------
    */

    if (hasExistingCoordinates) {

        setCoordinates(
            oldLatitude,
            oldLongitude,
            false
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Map Click
    |--------------------------------------------------------------------------
    */

    map.on('click', function (event) {

        setCoordinates(
            event.latlng.lat,
            event.latlng.lng,
            false
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Manual Latitude / Longitude Changes
    |--------------------------------------------------------------------------
    */

    function updateMapFromInputs() {

        const latitude = parseFloat(
            latitudeInput?.value
        );

        const longitude = parseFloat(
            longitudeInput?.value
        );


        if (
            Number.isNaN(latitude) ||
            Number.isNaN(longitude)
        ) {
            return;
        }


        if (
            latitude < -90 ||
            latitude > 90 ||
            longitude < -180 ||
            longitude > 180
        ) {
            return;
        }


        setCoordinates(
            latitude,
            longitude,
            true
        );

    }


    latitudeInput?.addEventListener(
        'change',
        updateMapFromInputs
    );

    longitudeInput?.addEventListener(
        'change',
        updateMapFromInputs
    );


    /*
    |--------------------------------------------------------------------------
    | Search Message
    |--------------------------------------------------------------------------
    */

    function showSearchMessage(message, type = 'info') {

        if (!searchMessage) {
            return;
        }


        searchMessage.textContent = message;

        searchMessage.classList.remove(
            'hidden',
            'text-gray-500',
            'text-red-600',
            'text-green-600'
        );


        if (type === 'error') {

            searchMessage.classList.add(
                'text-red-600'
            );

        } else if (type === 'success') {

            searchMessage.classList.add(
                'text-green-600'
            );

        } else {

            searchMessage.classList.add(
                'text-gray-500'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Nominatim Search
    |--------------------------------------------------------------------------
    */

    async function searchLocation() {

        const query = searchInput?.value.trim();


        if (!query) {

            showSearchMessage(
                'Please enter a city or location.',
                'error'
            );

            return;
        }


        showSearchMessage(
            'Searching location...',
            'info'
        );


        if (searchButton) {
            searchButton.disabled = true;
        }


        try {

            const url =
                'https://nominatim.openstreetmap.org/search?' +
                new URLSearchParams({
                    q: query,
                    format: 'json',
                    limit: '1',
                    addressdetails: '1',
                });


            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                },
            });


            if (!response.ok) {
                throw new Error(
                    'Location search failed.'
                );
            }


            const results = await response.json();


            if (!results.length) {

                showSearchMessage(
                    'Location not found. Try another search.',
                    'error'
                );

                return;
            }


            const result = results[0];


            const latitude = parseFloat(
                result.lat
            );

            const longitude = parseFloat(
                result.lon
            );


            /*
            |--------------------------------------------------------------------------
            | Update Map
            |--------------------------------------------------------------------------
            */

            setCoordinates(
                latitude,
                longitude,
                true
            );


            /*
            |--------------------------------------------------------------------------
            | Search Message
            |--------------------------------------------------------------------------
            */

            showSearchMessage(
                result.display_name,
                'success'
            );


        } catch (error) {

            console.error(
                'Location search error:',
                error
            );


            showSearchMessage(
                'Unable to search this location right now.',
                'error'
            );


        } finally {

            if (searchButton) {
                searchButton.disabled = false;
            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Search Button
    |--------------------------------------------------------------------------
    */

    searchButton?.addEventListener(
        'click',
        searchLocation
    );


    /*
    |--------------------------------------------------------------------------
    | Enter Key
    |--------------------------------------------------------------------------
    */

    searchInput?.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                searchLocation();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Fix Map Size
    |--------------------------------------------------------------------------
    */

    setTimeout(() => {

        map.invalidateSize();

    }, 100);


    /*
    |--------------------------------------------------------------------------
    | Return Map Instance
    |--------------------------------------------------------------------------
    */

    return map;
}