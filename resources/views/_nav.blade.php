<main-nav inline-template>
  <div class="container" style="width: 100%">
    <nav class="nav">
      <div class="nav-left">
        <router-link to="/" class="nav-item">
          <h1 class="title">Quiz</h1>
        </router-link>
      </div>

      <span class="nav-toggle" @click="menuOpen = !menuOpen">
        <span></span>
        <span></span>
        <span></span>
      </span>

      <div :class="['nav-right', 'nav-menu', {'is-active': menuOpen}]">
        <router-link to="/" class="nav-item is-tab" exact>
          Home
        </router-link>
        <span class="nav-item">
          <router-link to="/add" class="button is-primary" exact>
            <span>Add a quiz</span>
          </router-link>
        </span>
      </div>
    </nav>
  </div>
</main-nav>
