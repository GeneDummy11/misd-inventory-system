<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import ArrangementTitleSection from '@/components/arrangements/ArrangementTitleSection.vue';
import ArrangementFilterSection from '@/components/arrangements/ArrangementFilterSection.vue';
import ArrangementTableSection from '@/components/arrangements/ArrangementTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Arrangements',
        href: route('arrangements.index'),
    },
];
</script>

<template>

    <Head title="Arrangements" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <ArrangementTitleSection />
            <ArrangementFilterSection />
            <ArrangementTableSection />
        </div>
    </AppLayout>
</template>
