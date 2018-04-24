// Pjax binding.
$(document).pjax('a[pjax]', '#pjax-container')

// Initialize events
function init() {
    Waves.attach('.waves-button')
    Waves.attach('.waves-button-light', ['.waves-button', '.waves-light'])
    Waves.init()
}

init()

// Re-init events when pjax ended.
$(document).on('ready pjax:success', function() {
    init()
})