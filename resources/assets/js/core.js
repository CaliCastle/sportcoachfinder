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

window.showErrorToast = showErrorToast
window.showServerError = showServerError
window.showSuccessToast = showSuccessToast
