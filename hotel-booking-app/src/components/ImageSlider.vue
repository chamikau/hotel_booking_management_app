<template>
  <div class="slider">
    <img :src="images[current]" alt="Slider Image" />
  </div>
</template>

<script>
export default {
  name: "ImageSlider",
  props: {
    images: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      current: 0,
    };
  },
  mounted() {
    setInterval(() => {
      this.current = (this.current + 1) % this.images.length;
    }, 3000); // Change image every 3 seconds
  },
};
</script>

<style scoped>
.slider {
  width: 100%;
  height: 400px;
  overflow: hidden;
  border-radius: 10px;
  margin-bottom: 30px;
  position: relative;
}

.slider img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: opacity 1s ease-in-out;
  position: absolute;
  top: 0;
  left: 0;
}
</style>
