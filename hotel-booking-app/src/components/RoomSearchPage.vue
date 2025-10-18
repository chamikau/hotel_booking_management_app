<template>
  <div class="common-page">
    <!-- Top Image Slider -->
    <ImageSlider :images="sliderImages" />

    <!-- Page Content -->
    <main>
      <slot></slot> <!-- Content from child pages goes here -->
    </main>

    <!-- Footer -->
    <footer>
      <p>&copy; 2025 My Booking App. All Rights Reserved.</p>
    </footer>
  </div>
</template>

<script>
import ImageSlider from "./ImageSlider.vue"; // <-- Make a separate slider component

export default {
  name: "CommonPage",
  components: { ImageSlider },
  data() {
    return {
      sliderImages: [],
    };
  },
  created() {
    const imgFolder = require.context("@/assets/images", false, /\.jpg$/);
    this.sliderImages = imgFolder.keys().map(imgFolder);

  },
};
</script>

<style scoped>
.common-page {
  font-family: 'Arial', sans-serif;
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

main {
  padding: 20px 0;
}

footer {
  text-align: center;
  margin-top: 50px;
  padding: 15px 0;
  border-top: 1px solid #ccc;
  color: #555;
}
</style>
