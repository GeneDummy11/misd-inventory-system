<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import LicenseTitleSection from '@/components/licenses/LicenseTitleSection.vue';
import LicenseFilterSection from '@/components/licenses/LicenseFilterSection.vue';
import LicenseTableSection from '@/components/licenses/LicenseTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Licenses/Subscriptions',
        href: route('licenses.index'),
    },
];
</script>

<template>

    <Head title="Licenses/Subscriptions" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <LicenseTitleSection />
            <LicenseFilterSection />
            <LicenseTableSection />
        </div>
    </AppLayout>
</template>
