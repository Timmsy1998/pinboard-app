<template>
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <button @click="toggleDarkMode"
                class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded-lg shadow-md hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-300 ease-in-out">
                Toggle Dark Mode
            </button>
        </div>
        <div class="mb-6 flex justify-center">
            <div class="flex flex-wrap gap-4">
                <label v-for="tag in tags" :key="tag"
                    class="inline-flex items-center bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md hover:bg-gray-200 dark:hover:bg-gray-700 focus-within:bg-gray-200 dark:focus-within:bg-gray-700 transition duration-300 ease-in-out">
                    <input type="checkbox" :value="tag" v-model="selectedTags"
                        class="form-checkbox h-5 w-5 text-blue-600 focus:ring-blue-500 focus:ring-2 rounded mr-2" />
                    <span class="text-gray-700 dark:text-gray-300">{{ tag }}</span>
                </label>
            </div>
        </div>
        <ul class="space-y-4">
            <li v-for="link in filteredLinks" :key="link.id"
                class="p-6 border rounded-lg shadow-lg bg-white dark:bg-gray-800 hover:shadow-xl transition duration-300 ease-in-out">
                <a :href="link.url" target="_blank"
                    class="text-xl font-semibold text-blue-600 dark:text-blue-400 hover:underline">{{
                        link.title }}</a>
                <p class="mt-2 text-gray-600 dark:text-gray-400">{{ link.comments }}</p>
                <div class="mt-2 flex flex-wrap gap-2">
                    <span v-for="tag in link.tags.split(' ')" :key="tag"
                        class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-semibold px-2.5 py-0.5 rounded">
                        {{ tag }}
                    </span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import axios from "axios";

export default {
    setup() {
        const tags = ref(["laravel", "vue", "php", "api"]);
        const selectedTags = ref([]);
        const links = ref([]);

        const filteredLinks = computed(() => {
            return links.value.filter((link) =>
                selectedTags.value.every((tag) => link.tags.includes(tag))
            );
        });

        onMounted(() => {
            axios.get("/api/links").then((response) => {
                links.value = response.data.map(link => {
                    link.tags = link.tags.replace('vue.js', 'vue');
                    return link;
                });
            });
        });

        const toggleDarkMode = () => {
            document.documentElement.classList.toggle('dark');
            document.body.classList.toggle('bg-gray-900');
            document.body.classList.toggle('text-gray-100');
        };

        return {
            tags,
            selectedTags,
            filteredLinks,
            toggleDarkMode,
        };
    },
};
</script>

<style scoped>
.container {
    max-width: 800px;
}

label {
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

label:hover {
    background-color: #e2e8f0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

li {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

li:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
}
</style>
