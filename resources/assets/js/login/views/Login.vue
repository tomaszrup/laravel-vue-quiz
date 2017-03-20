<script>
export default {
  created() {
    window.addEventListener('scroll', this.scrollHandler);
  },
  data() {
    return {
      showLogin: false,
      showRegister: false,
      level: -1
    }
  },
  methods: {
    scrollHandler() {
      for (var i = 0; i < 4; i++) {
        var el = document.getElementById(i);
        if(el.getBoundingClientRect().top < window.innerHeight - 200) {
          if(this.level < i) this.level = i;
        }
      }
    },
    scrollDown() {
      this.$SmoothScroll(document.getElementById('content'), 1000);
    }
  }
}
</script>

<style lang="css">
</style>

<template>
</template>
