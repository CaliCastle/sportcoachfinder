<template>
    <div class="form-loader line-scale-pulse-out-rapid" v-show="display" v-bind:style="{color: color}">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</template>

<script>
    export default {
        name: "Loader",
        props: ['color'],
        data() {
            return {
                display: true
            }
        }
    }
</script>