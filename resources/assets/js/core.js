import flatpickr from "flatpickr"

require("flatpickr/dist/themes/light.css");
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

function createBirthdayInput(id) {
    let field = document.getElementById(id)
    let picker = flatpickr(field, {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        maxDate: new Date().fp_incr(-10)
    })
}

function createAutocompleteDropdown(inp, arr, selection = null) {
    /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
    let currentFocus;

    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", e => {
        showList(true, e.target);
    });
    inp.addEventListener("focus", e => {
        showList(false, e.target);
    });
    inp.addEventListener("blur", e => {
        setTimeout(() => closeAllLists(), 200)
    });

    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            e.preventDefault();
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            e.preventDefault();
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function showList(filter, target) {
        let a, i, val = target.value;

        if (filter == true && !val) {
            return false;
        }

        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", target.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        target.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (!filter) {
                setItem(i, a)
            } else {
                if (arr[i].includes(val)) {
                    setItem(i, a)
                }
            }
        }
    }

    function setItem(i, a) {
        /*create a DIV element for each matching element:*/
        const b = document.createElement("DIV");
        /*make the matching letters bold:*/
        b.innerHTML += arr[i];
        /*insert a input field that will hold the current array item's value:*/
        b.innerHTML += `<input type="hidden" value="${arr[i]}">`;
        /*execute a function when someone clicks on the item value (DIV element):*/
        b.addEventListener("click", e => {
            /*insert the value for the autocomplete text field:*/
            const value = e.target.getElementsByTagName("input")[0].value;
            if (selection) {
                selection(value);
            } else {
                inp.value = value;
            }
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
        });
        a.appendChild(b);
    }

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
}

window.showErrorToast = showErrorToast
window.showServerError = showServerError
window.showSuccessToast = showSuccessToast
window.postalCodeLookup = postalCodeLookup
window.createBirthdayInput = createBirthdayInput
window.createAutocompleteDropdown = createAutocompleteDropdown