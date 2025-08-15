<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import EndUserTitleSection from '@/components/end_users/end_users/EndUserTitleSection.vue';
import EndUserFilterSection from '@/components/end_users/end_users/EndUserFilterSection.vue';
import EndUserTableSection from '@/components/end_users/end_users/EndUserTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'List of End-users',
        href: route('end-users.index'),
    },
];
</script>

<template>

    <Head title="List of End-users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <EndUserTitleSection />
            <EndUserFilterSection />
            <EndUserTableSection />
        </div>
    </AppLayout>
</template>
