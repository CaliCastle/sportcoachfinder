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

window.showErrorToast = showErrorToast