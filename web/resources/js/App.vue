<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <h1>この下にRouteView</h1>
      <div class="container">
        <RouterView />
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue";
import Footer from "./components/Footer.vue";

export default {
  components: {
    Navbar,
    Footer
  }
};
</script>