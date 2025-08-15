<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import StatusTitleSection from '@/components/statuses/StatusTitleSection.vue';
import StatusFilterSection from '@/components/statuses/StatusFilterSection.vue';
import StatusTableSection from '@/components/statuses/StatusTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Statuses',
        href: route('statuses.index'),
    },
];
</script>

<template>

    <Head title="Statuses" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <StatusTitleSection />
            <StatusFilterSection />
            <StatusTableSection />
        </div>
    </AppLayout>
</template>
