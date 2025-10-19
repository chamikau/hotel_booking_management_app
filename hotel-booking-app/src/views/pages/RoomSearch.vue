<template>
  <RoomSearchPage>
    <div class="room-search-page">
      <header class="header">
        <h1>BOOK A ROOM</h1>
        <p>Find your perfect room easily</p>
      </header>

      <!-- Search Form -->
      <section class="search-form">
        <input type="text" v-model="location" placeholder="Enter location" />
        <input type="date" v-model="checkIn" />
        <input type="date" v-model="checkOut" />
        <select v-model="guests">
          <option value="1">1 Guest</option>
          <option value="2">2 Guests</option>
          <option value="3">3 Guests</option>
          <option value="4">4 Guests</option>
        </select>
        <button @click="searchRooms">SEARCH FOR ROOM</button>
      </section>
    </div>
  </RoomSearchPage>
</template>

<script>
import RoomSearchPage from "../../components/RoomSearchPage.vue";

export default {
  name: "RoomSearch",
  components: { RoomSearchPage },
  data() {
    return {
      location: "",
      checkIn: "",
      checkOut: "",
      guests: 1,
    };
  },
  methods: {
    searchRooms() {
      // Navigate to Room.vue with search parameters
      this.$router.push({
        name: "Rooms",
        query: {
          location: this.location,
          checkIn: this.checkIn,
          checkOut: this.checkOut,
          guests: this.guests,
        },
      });
    },
  },
};
</script>

<style scoped>

</style>
