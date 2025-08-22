<script setup lang="ts">
import { buttonVariants } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import Button from '@/components/ui/button/Button.vue';
import { type EndUser, Status, DeviceType, Arrangement, Supplier, Brand } from '@/types/devices/device_interface';
import { toast } from 'vue-sonner'

const props = defineProps<{
    device_types: DeviceType[];
    statuses: Status[];
    arrangements: Arrangement[];
    suppliers: Supplier[];
    end_users: EndUser[];
    brands: Brand[];
}>();

const form = useForm({
    device_name: '',
    device_model: '',
    device_description: '',
    device_serial_number: '',
    device_property_number: '',
    device_delivery_date: '',
    device_aquisition_cost: '',
    device_remarks: '',
    device_deployment_date: '',
    end_user_id: '',
    device_type_id: '',
    brand_id: '',
    status_id: '',
    supplier_id: '',
    arrangement_id: '',
});

const handleSubmit = () => {
    form.post(route('devices.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset(),
                toast.success('Device added successfully.')
        },
        onError: (errors) => console.error(errors),
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Devices/Equipment',
        href: route('devices.index'),
    },
    {
        title: 'Add a device',
        href: route('devices.create'),
    },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto items-center">
            <div class="flex w-full max-w-4xl flex-col">
                <Card>
                    <CardHeader>
                        <CardTitle class="text-2xl font-bold">Add new device</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <h1 class="text-lg font-semibold mb-5">Device details</h1>
                        <form class="space-y-6" @submit.prevent="handleSubmit">
                            <div class="grid w-full gap-2">
                                <Label for="device_name">Device name</Label>
                                <Input id="device_name" v-model="form.device_name" type="text" placeholder="Device name"
                                    required />
                                <InputError :message="form.errors.device_name" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid w-full gap-2">
                                    <Label for="device_type_id">Type</Label>
                                    <Select v-model="form.device_type_id">
                                        <SelectTrigger class="w-full">
                                            <SelectValue placeholder="Select device type" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="device_type in device_types" :key="device_type.id"
                                                    :value="device_type.id">
                                                    {{ device_type.device_type_name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.device_type_id" class="mt-2" />
                                </div>

                                <div class="grid w-full gap-2">
                                    <Label for="status_id">Status</Label>
                                    <Select v-model="form.status_id">
                                        <SelectTrigger class="w-full">
                                            <SelectValue placeholder="Select status" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="status in statuses" :key="status.id"
                                                    :value="status.id">
                                                    {{ status.status_name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.status_id" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid w-full gap-2">
                                    <Label for="device_serial_number">Serial number</Label>
                                    <Input id="device_serial_number" v-model="form.device_serial_number" type="text"
                                        placeholder="Serial number" />
                                    <InputError :message="form.errors.device_serial_number" class="mt-2" />
                                </div>
                                <div class="grid w-full gap-2">
                                    <Label for="device_property_number">Property number</Label>
                                    <Input id="device_property_number" v-model="form.device_property_number" type="text"
                                        placeholder="Property number" />
                                    <InputError :message="form.errors.device_property_number" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid w-full gap-2">
                                    <Label for="device_aquisition_cost">Cost</Label>
                                    <Input id="device_aquisition_cost" v-model="form.device_aquisition_cost"
                                        type="number" step="0.01" min="0" placeholder="Cost" />
                                    <InputError :message="form.errors.device_aquisition_cost" class="mt-2" />
                                </div>
                                <div class="grid w-full gap-2">
                                    <Label for="device_delivery_date">Delivery date</Label>
                                    <Input id="device_delivery_date" v-model="form.device_delivery_date" type="date" />
                                    <InputError :message="form.errors.device_delivery_date" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid w-full gap-2">
                                    <Label for="supplier_id">Supplier</Label>
                                    <Select v-model="form.supplier_id">
                                        <SelectTrigger class="w-full">
                                            <SelectValue placeholder="Select supplier" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="supplier in suppliers" :key="supplier.id"
                                                    :value="supplier.id">
                                                    {{ supplier.supplier_name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.supplier_id" class="mt-2" />
                                </div>
                                <div class="grid w-full gap-2">
                                    <Label for="supplier_id">Arrangement</Label>
                                    <Select v-model="form.arrangement_id">
                                        <SelectTrigger class="w-full">
                                            <SelectValue placeholder="Select arrangement" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="arrangement in arrangements" :key="arrangement.id"
                                                    :value="arrangement.id">
                                                    {{ arrangement.arrangement_name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.supplier_id" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid w-full gap-2">
                                    <Label for="device_model">Model</Label>
                                    <Input id="device_model" v-model="form.device_model" type="text" placeholder="Model"
                                        required />
                                    <InputError :message="form.errors.device_model" class="mt-2" />
                                </div>
                                <div class="grid w-full gap-2">
                                    <Label for="supplier_id">Brand</Label>
                                    <Select v-model="form.brand_id">
                                        <SelectTrigger class="w-full">
                                            <SelectValue placeholder="Select brand" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="brand in brands" :key="brand.id" :value="brand.id">
                                                    {{ brand.brand_name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.brand_id" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid w-full gap-2">
                                <Label for="device_description">Description</Label>
                                <Textarea id="device_description" v-model="form.device_description"
                                    placeholder="Description" />
                                <InputError :message="form.errors.device_description" class="mt-2" />
                            </div>
                            <div class="grid w-full gap-2">
                                <Label for="device_remarks">Remarks</Label>
                                <Textarea id="device_remarks" v-model="form.device_remarks" placeholder="Remarks" />
                                <InputError :message="form.errors.device_remarks" class="mt-2" />
                            </div>
                            <hr>
                            <h1 class="text-lg font-semibold mb-5">Deployment details</h1>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="grid w-full gap-2">
                                    <Label for="user_id">End-user</Label>
                                    <Select v-model="form.end_user_id">
                                        <SelectTrigger class="w-full">
                                            <SelectValue placeholder="Select end-user" />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem v-for="end_user in end_users" :key="end_user.id"
                                                    :value="end_user.id">
                                                    {{ end_user.end_user_name }}
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <InputError :message="form.errors.end_user_id" class="mt-2" />
                                </div>

                                <div class="grid w-full gap-2">
                                    <Label for="device_deployment_date">Deployment date</Label>
                                    <Input id="device_deployment_date" v-model="form.device_deployment_date"
                                        type="date" />
                                    <InputError :message="form.errors.device_deployment_date" class="mt-2" />
                                </div>
                            </div>
                            <hr class="mt-10">
                            <div class="flex justify-between items-center">
                                <Link :href="route('devices.index')" :class="buttonVariants({ variant: 'outline' })"
                                    class="w-[120px]">
                                <span>Cancel</span>
                                </Link>
                                <Button variant="default" :disabled="form.processing" class="w-[120px]">Save</Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
