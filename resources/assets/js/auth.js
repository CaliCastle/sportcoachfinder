require('./bootstrap')

const Vue = require('vue')

Vue.component('loader', require('./components/Loader.vue'))

const app = new Vue({
    el: '#app',
    data: {
        email: '',
        password: '',
        rememberMe: false,
        errors: []
    },
    computed: {
        $loginForm() {
            return document.querySelector('.auth__form.login')
        },
        loginData() {
           return {
               email: this.email,
               password: this.password,
               remember: this.rememberMe
           }
        }
    },
    methods: {
        /*
        * Login to API
        * */
        login() {
            const form = this.$loginForm

            // Remove all errors
            this.errors = []

            this.toggleFormLoading(form, true)

            axios({
                method: form.method,
                url: form.action,
                data: this.loginData
            }).then(response => {
                window.location.href = response.data.redirect
            }).catch(error => {
                let response = error.response

                switch (response.status) {
                    case 422:
                        this.errors = response.data.errors
                        break
                    case 500:
                        showErrorToast('Server Error', 'If this keeps happening, feel free to contact us!')
                }
            }).then(() => {
                this.toggleFormLoading(form, false)
            });
        },
        toggleFormLoading(form, on = null) {
            form.classList.toggle('loading', on)
        },
        hasError(field) {
            return this.errors.hasOwnProperty(field)
        },
        inputFocused(e) {
            e.target.parentElement.classList.add('focused')
        },
        inputBlurred(e) {
            e.target.parentElement.classList.remove('focused')
        },
        submitForm() {
            this.login()
        }
    }
})

// Initialize events
function init() {

}

// When window is ready
(() => {
    init()
})()