<template>
  <nav class="dark:bg-cool-gray-700 flex-1 overflow-y-auto bg-purple-600 py-6">
    <template
      class="space-y-2 px-6"
      v-for="(baseNav, index) in navigators"
      :key="index"
    >
      <template v-for="(secondNav, index2) in baseNav" :key="index2">
        <p
          v-if="secondNav.subItems.length"
          class="px-4 py-2 text-xs font-bold uppercase tracking-wider text-gray-50"
        >
          {{ secondNav.name }}
        </p>
        <ul
          v-for="(nav, index3) in secondNav.subItems"
          :key="index3"
          class="px-6"
        >
          <li class="my-[8px]">
            <v-app-link
              v-if="nav.url != '/api/documentation'"
              :href="nav.url"
              class="navigation-link"
            >
              <v-icon :name="nav.heroicon" :type="nav.icon" class="h-4 w-4" />
              <span class="text-sm"> {{ nav.name }} </span>
            </v-app-link>
            <a :href="nav.url" target="blank" v-else class="navigation-link">
              <v-icon :name="nav.heroicon" :type="nav.icon" class="h-4 w-4" />
              <span class="text-sm"> {{ nav.name }} </span>
            </a>
          </li>
        </ul>
      </template>
    </template>
  </nav>
</template>

<script setup>
import { usePage } from "@inertiajs/inertia-vue3";

const page = usePage();

const props = defineProps({
  navigators: [Array, String],
});

const navigators = props.navigators.map((v) => JSON.parse(v));

const isUrl = (...urls) => {
  let currentUrl = page.url.value.substr(1);

  if (urls[0] === "") {
    return currentUrl === "";
  }

  return urls.filter((url) => currentUrl.startsWith(url)).length;
};
</script>
