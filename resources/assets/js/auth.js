require('./bootstrap')

const Vue = require('vue')

Vue.component('loader', require('./components/Loader.vue'))

const app = new Vue({
    el: '#app',
    data: {
        name: '',
        email: '',
        password: '',
        rememberMe: true,
        errors: [],
        registering: false,
        confirming: false
    },
    mounted() {
        this.registering = registering
    },
    computed: {
        $form() {
            return document.querySelector('.auth__form')
        },
        formData() {
            if (this.registering) {
                return {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    remember: this.rememberMe
                }
            }

            return {
                email: this.email,
                password: this.password,
                remember: this.rememberMe
            }
        }
    },
    methods: {
        submitForm() {
            const form = this.$form

            if (this.email == '') {
                form.querySelector('input[name=email]').focus()
                return
            }

            if (this.password == '') {
                form.querySelector('input[name=password]').focus()
                return
            }

            // Remove all errors
            this.errors = []

            this.toggleFormLoading(form, true)

            // Send api request
            axios({
                method: 'POST',
                url: this.getFormUrl(form),
                data: this.formData
            }).then(response => {
                if (!this.registering) {
                    window.location.href = response.data.redirect
                    return
                }

                // Confirmation code

            }).catch(error => {
                const response = error.response

                switch (response.status) {
                    case 422:
                        this.errors = response.data.errors
                        return
                    case 500:
                        showErrorToast('Server Error', 'If this keeps happening, feel free to contact us!')
                }
            }).then(() => {
                this.toggleFormLoading(form, false)
            });
        },
        /*
        * Login to API
        * */
        login() {
            if (this.registering) {
                this.registering = false
                return
            }

            this.submitForm()
        },
        register() {
            this.errors = []

            if (!this.registering) {
                this.registering = true

                setTimeout(() => this.$form.querySelector('input[name=name]').focus(), 500)

                return
            }

            this.submitForm()
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
        getFormUrl(form) {
            return this.registering ? form.getAttribute('register-action') : form.getAttribute('login-action')
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