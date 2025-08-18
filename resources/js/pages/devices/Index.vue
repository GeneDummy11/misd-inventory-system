<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { type EndUser, Status, PaginatedItemsResponse, DeviceType, Arrangement } from '@/types/devices/device_interface';
import { Head } from '@inertiajs/vue3';
import DeviceTitleSection from '@/components/devices/index/DeviceTitleSection.vue';
import DeviceFilterSection from '@/components/devices/index/DeviceFilterSection.vue';
import DeviceTableSection from '@/components/devices/index/DeviceTableSection.vue';
import Paginator from '@/components/Paginator.vue';

const props = defineProps<{
    devices: PaginatedItemsResponse;
    end_users: EndUser[];
    device_types: DeviceType[];
    arrangements: Arrangement[];
    statuses: Status[];
}>();

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
            <DeviceFilterSection :device_types="device_types" :arrangements="arrangements" :statuses="statuses" />
            <DeviceTableSection :devices="devices" />
            <Paginator :links="devices.links" :meta="{
                from: devices.from,
                to: devices.to,
                total: devices.total
            }" />
        </div>
    </AppLayout>
</template>
