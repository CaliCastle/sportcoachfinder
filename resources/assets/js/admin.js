require('./bootstrap')
const Vue = require('vue')
import ToggleButton from 'vue-js-toggle-button'

window.Vue = Vue

Vue.use(ToggleButton)

Waves.attach('.waves-button')
Waves.attach('.waves-button-light', ['.waves-button', '.waves-light'])
Waves.init()

function submitForm(vm, form) {
    // Remove all errors
    form.errors = []

    toggleFormLoading(form, true)

    // Send api request
    axios({
        method: form.getAttribute('method'),
        url: form.action,
        data: vm.formData
    }).then(response => {
        let redirect = response.data.redirect

        if (redirect) {
            window.location.href = redirect
            return
        }

        showSuccessToast('Success', response.data.message)
    }).catch(error => {
        const response = error.response

        switch (response.status) {
            case 422:
                form.errors = response.data.errors
                return
            case 500:
                showErrorToast('Server Error', 'If this keeps happening, contact dev!')
        }
    }).then(() => {
        toggleFormLoading(form, false)
    });
}

window.submitForm = submitForm

function toggleFormLoading(form, force = null) {
    form.parentNode.classList.toggle('loading', force)
}