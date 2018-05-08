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

window.showErrorToast = showErrorToast
window.showServerError = showServerError
window.showSuccessToast = showSuccessToast
window.highlightText = highlight