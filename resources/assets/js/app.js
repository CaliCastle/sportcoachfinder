require('./bootstrap')

window.Vue = require('vue');

const Avatar = require('vue-avatar')

Vue.component('avatar', Avatar.Avatar)
Vue.component('loader', require('./components/Loader.vue'))

const app = new Vue({
    el: '#app',
    data() {
        return {
            profileOpen: false
        }
    },
    methods: {
        toggleUserProfileDropdown(force = null) {
            const profileEl = this.$el.querySelector('.ui-navigation-bar__user')

            profileEl.classList.toggle('active', force)
            this.$el.classList.toggle('dimmed', force)
            this.profileOpen = force == null ? !this.profileOpen : force
        },
        bodyClicked(e) {
            const hasClosestProfileDropdown = e.target.closest('.ui-navigation-bar__user')

            if (hasClosestProfileDropdown == null && this.profileOpen) {
                this.toggleUserProfileDropdown(false)
            }
        }
    }
});