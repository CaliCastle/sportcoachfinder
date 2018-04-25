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
        $form() {
            return document.querySelector('.auth__form')
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
            const form = this.$form
            form.classList.add('loading')

            axios({
                method: form.method,
                url: form.action,
                data: this.loginData
            }).then(response => {
                // form.classList.remove('loading')
            }).catch(error => {
                console.log(error)
                form.classList.remove('loading')
            });
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