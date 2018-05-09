import flatpickr from "flatpickr";

window.flatpickr = flatpickr

const GoogleApiUrl = "https://maps.googleapis.com/maps/api/js?key="

window.GoogleApiUrl = GoogleApiUrl

Waves.attach('.waves-button')
Waves.attach('.waves-button-light', ['.waves-button', '.waves-light'])
Waves.init()

function showErrorToast(title, message, timeout = 5500, position = 'topLeft') {
    iziToast.error({
        title,
        message,
        position,
        timeout,
        layout: 2
    })
}

function showSuccessToast(title, message, timeout = 5500, position = 'topLeft') {
    iziToast.success({
        title,
        message,
        position,
        timeout,
        layout: 2
    })
}

function showServerError() {
    showErrorToast('Server Error', 'If this keeps happening, feel free to contact us!')
}

function highlight(text) {
    var inputText = document.getElementById("inputText");
    var innerHTML = inputText.innerHTML;
    var index = innerHTML.indexOf(text);
    if (index >= 0) {
        innerHTML = innerHTML.substring(0, index) + "<span class='highlight'>" + innerHTML.substring(index, index + text.length) + "</span>" + innerHTML.substring(index + text.length);
        inputText.innerHTML = innerHTML;
    }
}

function postalCodeLookup(input) {
    if (navigator.geolocation) {
        var a = input,
            fallback = setTimeout(function () {
                fail('10 seconds expired');
            }, 10000);

        navigator.geolocation.getCurrentPosition(function (pos) {
            clearTimeout(fallback);
            var point = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
            new google.maps.Geocoder().geocode({'latLng': point}, function (res, status) {
                if (status == google.maps.GeocoderStatus.OK && typeof res[0] !== 'undefined') {
                    var zip = res[0].formatted_address.match(/,\s\w{2}\s(\d{5})/);
                    if (zip) {
                        a.value = zip[1];
                    } else fail('Unable to look-up postal code');
                } else {
                    fail('Unable to look-up geolocation');
                }
            });
        }, function (err) {
            fail(err.message);
        });
    } else {
        alert('Unable to find your location.');
    }

    function fail(err) {
        console.log('err', err);
        a.value('Try Again.');
    }
}

window.showErrorToast = showErrorToast
window.showServerError = showServerError
window.showSuccessToast = showSuccessToast
window.highlightText = highlight

window.postalCodeLookup = postalCodeLookup