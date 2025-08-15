<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import LicenseTypeTitleSection from '@/components/license_types/LicenseTypeTitleSection.vue';
import LicenseTypeFilterSection from '@/components/license_types/LicenseTypeFilterSection.vue';
import LicenseTypeTableSection from '@/components/license_types/LicenseTypeTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'License Type',
        href: route('license-types.index'),
    },
];
</script>

<template>

    <Head title="License Type" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <LicenseTypeTitleSection />
            <LicenseTypeFilterSection />
            <LicenseTypeTableSection />
        </div>
    </AppLayout>
</template>
