<template>
  <div class="body">
    <app-header> </app-header>
    <div class="main-content-box container">
			
      <app-branding> </app-branding>

			<!--main content div-->
      <router-view> </router-view>
			

		</div>
    <app-footer></app-footer>
  </div>
</template>

<script>
import Header from './component/Header.vue';
import Footer from './component/Footer.vue';
import Branding from './component/Branding.vue';
import Home from './home.vue';
import About from './about.vue';
export default {
  components :{
    'app-header': Header,
    'app-footer': Footer,
    'app-branding': Branding,
    'Home': Home,
    'About': About
  },
  data () {
    return {
      
    }
  }
}
</script>

<style>

</style>
