<template>

</template>

<script>
export default {
    name: "NavBar",
    props:['user'],
    data(){
    return{
    open: false,
}

},
    methods: {
    toggle() {
    this.open = !this.open
}

}

}
</script>

