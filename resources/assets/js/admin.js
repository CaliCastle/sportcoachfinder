require('./bootstrap')

// Vue bindings
const Vue = require('vue')
import ToggleButton from 'vue-js-toggle-button'
window.Vue = Vue

const Avatar = require('vue-avatar')

Vue.component('avatar', Avatar.Avatar)
Vue.component('loader', require('./components/Loader.vue'))
Vue.use(ToggleButton)

// Keyword marker
const Mark = require('mark.js')
window.Mark = Mark

// Global submit form
function submitForm(vm, form) {
    // Remove all errors
    vm.errors = {}

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
        if (error) {
            const response = error.response

            switch (response.status) {
                case 422:
                    vm.errors = response.data.errors
                    return
                case 500:
                    showErrorToast('Server Error', 'If this keeps happening, contact dev!')
            }
        }
    }).then(() => {
        toggleFormLoading(form, false)
    })
}

window.submitForm = submitForm

function toggleFormLoading(form, force = null) {
    form.parentNode.classList.toggle('loading', force)
}

new Vue({
    el: '#side-menu',
    data: {
        croppie: null
    },
    methods: {
        selectAvatar(e) {
            e.target.parentElement.querySelector('input[type="file"]').click()
        },
        avatarSelected($ev) {
            const file = $ev.target.files[0]
            let reader = new FileReader()
            reader.addEventListener('load', this.showAvatarCropper)
            reader.readAsDataURL(file)
        },
        showAvatarCropper(e) {
            const imageUrl = e.target.result

            let img = document.createElement('img')
            img.src = imageUrl

            swal({
                content: img,
                title: 'Change Avatar',
                closeOnClickOutside: false,
                closeOnEsc: false,
                buttons: {
                    cancel: true,
                    confirm: true,
                }
            }).then((response) => {
                if (response && this.croppie != null) {
                    this.croppie.result('blob').then(this.submitAvatar)
                }
            })

            setTimeout(() => {
                this.croppie = new Croppie(img, {
                    viewport: {
                        width: 270,
                        height: 270,
                        type: 'square'
                    },
                    boundary: {width: 300, height: 300}
                })
            }, 100)
        },
        submitAvatar(blob) {
            const data = new FormData()
            data.append('avatar', blob)

            axios.post(document.querySelector('input[name="avatar"]').getAttribute('data-url'), data).then((response) => {
                if (response) {
                    window.location.reload(true)
                }
            }).catch((error) => {
                showServerError()
            })
        }
    }
})