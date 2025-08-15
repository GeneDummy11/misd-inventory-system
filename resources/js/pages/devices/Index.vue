<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import DeviceTitleSection from '@/components/devices/DeviceTitleSection.vue';
import DeviceFilterSection from '@/components/devices/DeviceFilterSection.vue';
import DeviceTableSection from '@/components/devices/DeviceTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Device/Equipment',
        href: route('devices.index'),
    },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <DeviceTitleSection />
            <DeviceFilterSection />
            <DeviceTableSection />
        </div>
    </AppLayout>
</template>
