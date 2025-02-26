<template>
  <v-app-head :title="title" />

  <div
    :class="{ dark: dark }"
    class="flex min-h-screen w-full bg-gray-50 text-gray-700"
  >
    <aside
      ref="sidebar"
      class="
        fixed
        inset-y-0
        left-0
        z-20
        hidden
        h-screen
        w-[14rem]
        translate-x-0
        flex-col
        overflow-hidden
        shadow-2xl
        duration-300
        lg:z-0 lg:flex lg:translate-x-0
      "
    >
      <header class="flex h-[4rem] shrink-0 items-center border-b px-6">
        <v-app-link class="mx-auto text-xl font-bold tracking-tight" href="/">
          TITEN APP
        </v-app-link>
      </header>

      <!-- navigator -->
      <navigator :navigators="app.navigators" />

      <footer class="flex shrink-0 items-center gap-3 border-t px-6 py-3">
        <div
          class="h-11 w-11 rounded-full bg-cover bg-center"
          v-bind:style="{
            'background-image': 'url(' + auth.user.profile_picture + ')',
          }"
        ></div>

        <div>
          <p class="text-sm font-bold">
            {{ auth.user.username }}
          </p>

          <p
            class="
              text-xs text-gray-500
              hover:text-gray-700
              focus:text-gray-700
            "
          >
            <v-app-link href="/auth/logout" method="delete" as="button">
              Logout
            </v-app-link>
          </p>
        </div>
      </footer>
    </aside>
    <div class="flex w-full flex-1 space-y-6 lg:pl-[14rem]">
      <div class="w-full flex-1">
        <header class="flex h-[4rem] w-full shrink-0 items-center border-b">
          <div class="flex w-full items-center px-2 sm:px-4 md:px-6 lg:px-8">
            <button
              @click.prevent="toggleSidebar"
              type="button"
              class="
                text-primary-500
                focus:bg-primary-500/10
                flex
                h-10
                w-10
                shrink-0
                items-center
                justify-center
                rounded-full
                hover:bg-gray-500/5
                focus:outline-none
                lg:hidden
              "
            >
              <svg
                class="h-6 w-6"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                ></path>
              </svg>
            </button>

            <div class="flex flex-1 items-center justify-between">
              <div>
                <!-- breadcrumb -->
                <breadcrumb :items="app.breadcrumbs" />
              </div>

              <!-- theme toggle -->
              <div class="flex flex-row items-center">
                <!-- <div>
                  dynamic menu here
                </div> -->
                <div>
                  <button @click.prevent="toggleTheme" type="button">
                    <v-icon
                      v-if="!dark"
                      name="MoonIcon"
                      class="text-cool-gray-600 h-6 w-6"
                      type="outline"
                    />
                    <v-icon
                      v-else
                      name="SunIcon"
                      class="h-6 w-6"
                      type="outline"
                    />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </header>

        <div class="p-4">
          <!-- slot -->
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import navigator from "~/components/navigator.vue";
import breadcrumb from "~/components/breadcrumb.vue";

export default {
  components: {
    navigator,
    breadcrumb,
  },
  props: {
    app: Object,
    auth: Object,
    title: String,
  },
  data() {
    return { dark: false };
  },
  mounted() {
    this.dark = this.getTheme();
  },
  methods: {
    toggleSidebar() {
      // do sidebar logic here..
    },
    toggleTheme() {
      this.dark = !this.dark;
      this.setThemeToLocalStorage(this.dark);
    },
    setThemeToLocalStorage(value) {
      window.localStorage.setItem("dark", value);
    },
    getTheme() {
      // if the local storage have dark value
      if (window.localStorage.getItem("dark")) {
        return JSON.parse(window.localStorage.getItem("dark"));
      }

      // else return their preferences
      return (
        !!window.matchMedia &&
        window.matchMedia("(prefers-color-scheme: dark)").matches
      );
    },
  },
  watch: {
    "$page.props.flash": {
      handler: function (payload) {
        if (payload) {
          if (payload.success) {
            this.$toast.success(payload.success);
          }

          if (payload.error) {
            this.$toast.error(payload.error);
          }
        }
      },
      deep: true,
    },
  },
};
</script>
