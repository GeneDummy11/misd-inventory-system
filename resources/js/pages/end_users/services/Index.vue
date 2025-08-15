<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import ServiceTitleSection from '@/components/end_users/services/ServiceTitleSection.vue';
import ServiceFilterSection from '@/components/end_users/services/ServiceFilterSection.vue';
import ServiceTableSection from '@/components/end_users/services/ServiceTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Services',
        href: route('services.index'),
    },
];
</script>

<template>

    <Head title="Services" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <ServiceTitleSection />
            <ServiceFilterSection />
            <ServiceTableSection />
        </div>
    </AppLayout>
</template>
