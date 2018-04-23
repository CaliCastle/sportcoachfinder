// Initialize events
function init() {

}

// When window is ready
(() => {
    init();
})();

// Re-init events when pjax ended.
$(document).on('ready pjax:end', function() {
    init();
});