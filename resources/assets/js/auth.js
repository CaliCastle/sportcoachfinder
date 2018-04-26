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
               password: this.password
           }
        }
    },
    methods: {
        /*
        * Login to API
        * */
        login() {
            const form = this.$loginForm

            this.toggleFormLoading(form, true)

            axios({
                method: form.method,
                url: form.action,
                data: this.loginData
            }).then(response => {
                // form.classList.remove('loading')
            }).catch(error => {
                console.log(error)

            }).then(() => {
                this.toggleFormLoading(form, false)
            });
        },
        toggleFormLoading(form, on = null) {
            form.classList.toggle('loading', on)
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