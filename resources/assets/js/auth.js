const Vue = require('vue')

const app = new Vue({
    el: '#app',
    data: {
        email: '',
        password: '',
        rememberMe: false,
        errors: []
    }
})

// Initialize events
function init() {
}

// When window is ready
(() => {
    init()
})()