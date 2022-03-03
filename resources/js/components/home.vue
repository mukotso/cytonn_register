<template>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img
                    class="object-cover w-full h-96"
                    src="https://source.unsplash.com/user/erondu/3000x900"
                    alt="image"
                />
            </div>
            <div class="swiper-slide">
                <img
                    class="object-cover w-full h-96"
                    src="https://source.unsplash.com/collection/190727/3000x900"
                    alt="image"
                />
            </div>
            <div class="swiper-slide">
                <img
                    class="object-cover w-full h-96"
                    src="https://source.unsplash.com/collection/190728/3000x900"
                    alt="image"
                />
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

</template>

<script>
export default {
    name: "home"
}
</script>

<style scoped>

</style>
