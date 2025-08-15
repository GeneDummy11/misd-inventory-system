<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import DeviceTypeTitleSection from '@/components/device_types/DeviceTypeTitleSection.vue';
import DeviceTypeFilterSection from '@/components/device_types/DeviceTypeFilterSection.vue';
import DeviceTypeTableSection from '@/components/device_types/DeviceTypeTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Device Type',
        href: route('device-types.index'),
    },
];
</script>

<template>

    <Head title="Device Type" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <DeviceTypeTitleSection />
            <DeviceTypeFilterSection />
            <DeviceTypeTableSection />
        </div>
    </AppLayout>
</template>
