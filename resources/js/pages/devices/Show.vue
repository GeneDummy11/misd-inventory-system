<script setup lang="ts">
import { buttonVariants } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import Label from '@/components/ui/label/Label.vue';
import { Device } from '@/types/devices/device_interface';
import { formatDate } from '@/utils/format_date';
import { formatToPHP } from '@/utils/format_currency';
import { ChevronLeft, Eye } from 'lucide-vue-next';

const props = defineProps<{
    device: Device;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Devices/Equipment',
        href: route('devices.index'),
    },
    {
        title: 'Device details',
        href: route('devices.show', { device: props.device.id }),
    },
];
</script>

<template>

    <Head title="Device details" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto items-center">
            <div class="flex w-full max-w-4xl flex-col">
                <Card>
                    <CardHeader>
                        <CardTitle>
                            <div class="flex space-x-2 items-center">
                                <Eye />
                                <Label class="text-2xl font-bold">Show device</Label>
                            </div>
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <h1 class="text-lg font-semibold mb-5">{{ device.device_name }}</h1>

                        <h1 class="text-lg font-semibold mb-5">Device details</h1>

                        <div class="grid grid-cols-3 gap-6 mb-2">
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Type</Label>
                                <Label class="text-md">{{ device.device_type.device_type_name }}</Label>
                            </div>

                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Status</Label>
                                <Label class="text-md">{{ device.status.status_name }}</Label>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6 mb-2">
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Serial number</Label>
                                <Label class="text-md">{{ device.device_serial_number }}</Label>
                            </div>
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Property number</Label>
                                <Label class="text-md">{{ device.device_property_number }}</Label>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6 mb-2">
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Cost</Label>
                                <Label class="text-md">{{ formatToPHP(device.device_acquisition_cost) }}</Label>
                            </div>
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Delivery date</Label>
                                <Label class="text-md">{{ formatDate(device.device_delivery_date) }}</Label>
                            </div>
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Warranty expiration date</Label>
                                <Label class="text-md">{{ formatDate(device.device_warranty_expiration_date) }}</Label>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6 mb-2">
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Supplier</Label>
                                <Label class="text-md">{{ device.supplier.supplier_name }}</Label>
                            </div>
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Arrangement</Label>
                                <Label class="text-md">{{ device.arrangement.arrangement_name }}</Label>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-6 mb-2">
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Model</Label>
                                <Label class="text-md">{{ device.device_model }}</Label>
                            </div>
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Brand</Label>
                                <Label class="text-md">{{ device.brand.brand_name }}</Label>
                            </div>
                        </div>
                        <div class="grid w-full gap-2 mb-2">
                            <Label class="text-gray-500">Description</Label>
                            <Label class="text-md">{{ device.device_description }}</Label>
                        </div>
                        <div class="grid w-full gap-2">
                            <Label class="text-gray-500">Remarks</Label>
                            <Label class="text-md">{{ device.device_remarks }}</Label>
                        </div>
                        <hr>
                        <h1 class="text-lg font-semibold mb-5 mt-5">Deployment details</h1>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">End-User</Label>
                                <Label class="text-md">{{ device.end_user?.end_user_name ?? 'N/A' }}</Label>
                            </div>

                            <div class="grid w-full gap-2">
                                <Label class="text-gray-500">Deployment date</Label>
                                <Label class="text-md">
                                    <div
                                        v-if="device.device_deployment_date && device.device_deployment_date !== '1970-01-01'">
                                        {{ formatDate(device.device_deployment_date) }}
                                    </div>
                                    <div v-else>
                                        N/A
                                    </div>
                                </Label>
                            </div>
                        </div>
                        <hr class="mt-10 mb-5">
                        <div class="flex justify-between items-center">
                            <Link :href="route('devices.index')" :class="buttonVariants({ variant: 'outline' })"
                                class="w-[120px]">
                            <ChevronLeft />
                            <span>Back</span>
                            </Link>
                        </div>

                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
