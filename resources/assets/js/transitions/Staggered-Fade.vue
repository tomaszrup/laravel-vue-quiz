<template>
  <transition-group
    name="staggered-fade"
    mode="out-in"
    v-on:before-enter="beforeEnter"
    v-on:enter="enter"
    tag="div"
  >
    <slot></slot>
  </transition-group>
</template>
<script>
export default {
  methods: {
    beforeEnter: function (el) {
        el.style.opacity = 0;
    },
    enter: function (el, done) {
      var delay = el.dataset.index * 100;
      setTimeout(function () {
        Velocity(
          el,
          { opacity: 1, transform: "translateY(200px)" },
          { complete: done }
        );
      }, delay);
    },
  }
}
</script>
