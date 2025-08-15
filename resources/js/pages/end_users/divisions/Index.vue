<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import DivisionTitleSection from '@/components/end_users/divisions/DivisionTitleSection.vue';
import DivisionFilterSection from '@/components/end_users/divisions/DivisionFilterSection.vue';
import DivisionTableSection from '@/components/end_users/divisions/DivisionTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Divisions',
        href: route('divisions.index'),
    },
];
</script>

<template>

    <Head title="Divisions" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <DivisionTitleSection />
            <DivisionFilterSection />
            <DivisionTableSection />
        </div>
    </AppLayout>
</template>
