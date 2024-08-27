<template>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-center">Links</h1>
        <div class="mb-6 flex justify-center">
            <div class="flex flex-wrap gap-4">
                <label v-for="tag in tags" :key="tag"
                    class="inline-flex items-center bg-gray-100 p-2 rounded-lg shadow-md">
                    <input type="checkbox" :value="tag" v-model="selectedTags"
                        class="form-checkbox h-5 w-5 text-blue-600" />
                    <span class="ml-2 text-gray-700">{{ tag }}</span>
                </label>
            </div>
        </div>
        <ul class="space-y-4">
            <li v-for="link in filteredLinks" :key="link.id" class="p-6 border rounded-lg shadow-lg bg-white">
                <a :href="link.url" target="_blank" class="text-xl font-semibold text-blue-600 hover:underline">{{
                    link.title }}</a>
                <p class="mt-2 text-gray-600">{{ link.comments }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const tags = ref(['laravel', 'vue', 'vue.js', 'php', 'api']);
        const selectedTags = ref([]);
        const links = ref([]);

        const filteredLinks = computed(() => {
            return links.value.filter(link =>
                selectedTags.value.every(tag => link.tags.includes(tag))
            );
        });

        onMounted(() => {
            axios.get('/api/links').then(response => {
                links.value = response.data;
            });
        });

        return {
            tags,
            selectedTags,
            filteredLinks,
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