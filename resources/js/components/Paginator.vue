<script setup lang="ts">
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import { buttonVariants } from '@/components/ui/button';

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface PaginationMeta {
    from: number;
    to: number;
    total: number;
}

const props = defineProps<{
    links: PaginationLink[];
    meta: PaginationMeta;
}>();
</script>

<template>
    <div class="mt-3 flex justify-between align-center gap-2">
        <span v-if="meta.from !== null && meta.to !== null">
            Showing {{ meta.from }}–{{ meta.to }} of {{ meta.total }}
        </span>
        <span v-else class="text-gray-400">No results found</span>

        <div class="flex gap-2">
            <template v-for="(link, index) in links" :key="index">
                <Link v-if="link.url" :href="link.url" v-html="link.label" :class="[
                    buttonVariants({ variant: link.active ? 'default' : 'outline' }),
                    { 'font-bold': link.active }
                ]" preserve-scroll />
                <span v-else v-html="link.label" class="px-4 py-1 border rounded text-gray-400 cursor-not-allowed" />
            </template>
        </div>
    </div>
</template>
