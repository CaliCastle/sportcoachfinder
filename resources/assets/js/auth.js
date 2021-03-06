require('./bootstrap')

const Vue = require('vue')

Vue.component('loader', require('./components/Loader.vue'))

const app = new Vue({
    el: '#app',
    data() {
        return {
            firstName: '',
            lastName: '',
            email: '',
            password: '',
            passwordConfirmation: '',
            rememberMe: true,
            token: '',
            errors: [],
            registering: false,
            confirming: false,
            enteringInfo: false,
            essentialInfo: {
                sport: '',
                mobile: '',
                zipcode: '',
                gender: '',
                dateOfBirth: '1999-01-01'
            },
            confirmCodes: [
                null, null, null, null, null, null
            ],
            resendingConfirmation: false,
            redirectTo: null
        }
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
                    firstName: this.firstName,
                    lastName: this.lastName,
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
        },
        validConfirmationCode() {
            return this.confirmCodes.filter((code) => {
                return code != null && /^[0-9]*$/.test(code) && code !== ''
            }).length == this.confirmCodes.length
        },
        confirmationCode() {
            return this.confirmCodes.join('')
        }
    },
    methods: {
        initEssentialInfo() {
            createBirthdayInput('birthday')

            const input = document.querySelector('input#sport')
            axios.get(input.getAttribute('data-url')).then(response => {
                let data = response.data.sports
                if (data) {
                    createAutocompleteDropdown(input, data, selection => {
                        this.essentialInfo.sport = selection
                    })
                }

                return
            }).catch(error => {
                showErrorToast('Server Error', 'If this keeps happening, feel free to contact us!')
            })
        },
        autofillZipcode() {
            const input = document.querySelector('input[name="zipcode"]')
            postalCodeLookup(input)
        },
        submitInfo() {

        },
        completeAndRedirect() {
            setTimeout(() => {
                if (this.redirectTo != null) {
                    window.location.href = this.redirectTo
                }
            }, 100)
        },
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
                let redirect = response.data.redirect

                if (redirect != null) {
                    this.redirectTo = redirect
                }

                if (!this.registering) {
                    window.location.href = redirect
                    return
                }

                // Confirmation code
                this.confirming = true

                setTimeout(() => this.focusConfirmationCodeInput(), 550)
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

                setTimeout(() => this.$form.querySelector('input[name=email]').focus(), 500)

                return
            }

            this.submitForm()
        },
        /**
         * Register to API
         */
        register() {
            this.errors = []

            if (!this.registering) {
                this.registering = true

                setTimeout(() => this.$form.querySelector('input[name=firstName]').focus(), 500)

                return
            }

            this.submitForm()
        },
        toggleFormLoading(form, on = null) {
            form.parentNode.classList.toggle('loading', on)
        },
        checkFormLoading(e) {
            console.log(e)

            return false
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
        },
        focusConfirmationCodeInput() {
            document.querySelector('.confirmation-inputs input').focus()
        },
        confirmCodeEntered(e) {
            switch (e.key) {
                case "0":
                case "1":
                case "2":
                case "3":
                case "4":
                case "5":
                case "6":
                case "7":
                case "8":
                case "9":
                    const currentIndex = e.target.id.substring(5)
                    const nextInput = document.querySelector(`.confirmation-input #code-${Number.parseInt(currentIndex) + 1}`)

                    if (nextInput == null) {
                        this.submitConfirmationCode()
                        return
                    }

                    nextInput.focus()

                    return
                default:
                    break
            }

            e.target.value = null
        },
        deleteConfirmCode(e) {
            const current = e.target.id.substring(5)
            const previousInput = document.querySelector(`.confirmation-input #code-${Number.parseInt(current) - 1}`)

            if (previousInput != null) {
                previousInput.focus()
            }
        },
        submitConfirmationCode() {
            this.errors = []

            if (!this.validConfirmationCode) {
                return
            }

            const form = document.querySelector('.auth__form--confirm')

            this.toggleFormLoading(form, true)

            // Send api request
            axios({
                method: 'POST',
                url: form.action,
                data: {
                    code: this.confirmationCode
                }
            }).then(response => {
                if (response && response.data.status == "success") {
                    this.confirming = false
                    this.enteringInfo = true

                    this.initEssentialInfo()
                    setTimeout(() => this.autofillZipcode(), 300)
                } else {
                    showServerError()
                }
            }).catch(error => {
                const response = error.response

                switch (response.status) {
                    case 422:
                        this.errors = response.data.errors
                        return
                    case 500:
                        showServerError()
                }
            }).then(() => {
                this.toggleFormLoading(form, false)
            });
        },
        resendConfirmationCode() {
            if (this.resendingConfirmation) {
                return
            }

            const form = document.querySelector('.auth__form--confirm')

            this.toggleFormLoading(form, true)
            this.resendingConfirmation = true

            axios({
                method: 'PUT',
                url: form.action,
                data: {}
            }).then(response => {
                // Code resent
                showSuccessToast('Success', form.getAttribute('resend-message'))
            }).catch(error => {
                showServerError()
            }).then(() => {
                this.resendingConfirmation = false
                this.toggleFormLoading(form, false)
            })
        },
        passwordReset(e) {
            this.errors = []

            const form = e.target.closest('form.auth__form')

            this.toggleFormLoading(form, true)

            axios({
                method: form.method,
                url: form.action,
                data: {
                    email: this.email
                }
            }).then(response => {
                showSuccessToast('Success', response.data.status)
            }).catch(error => {
                const response = error.response

                switch (response.status) {
                    case 422:
                        this.errors = response.data.errors
                        return
                    case 500:
                        showServerError()
                }
            }).then(() => {
                this.toggleFormLoading(form, false)
            })
        },
        completePasswordReset(e) {
            this.errors = []

            const form = e.target.closest('form.auth__form')

            this.toggleFormLoading(form)

            axios({
                method: form.method,
                url: form.action,
                data: {
                    email: this.email,
                    token: this.token,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                }
            }).then(response => {
                showSuccessToast('Success', response.data.status)

                setTimeout(() => window.location.href = response.data.redirect, 1000)
            }).catch(error => {
                const response = error.response

                switch (response.status) {
                    case 422:
                        this.errors = response.data.errors
                        return
                    case 500:
                        showServerError()
                }
            }).then(() => {
                this.toggleFormLoading(form, false)
            })
        }
    }
})

window.vm = app

// Initialize events
function init() {

}

// When window is ready
(() => {
    init()
})()