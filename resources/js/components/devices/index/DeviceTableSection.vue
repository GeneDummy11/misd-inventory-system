<script setup lang="ts">
import { Eye, HandHelping, Pencil, Trash2 } from 'lucide-vue-next';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import Button from '@/components/ui/button/Button.vue';
import { PaginatedItemsResponse, Device } from '@/types/devices/device_interface';
import { getWarrantyStatus } from '@/utils/format_warranty';
import { type WarrantyStatus } from '@/utils/format_warranty';
import { formatDate } from '@/utils/format_date';
import { computed } from 'vue';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { buttonVariants } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    devices: PaginatedItemsResponse;
}>();

//Delcaration for warranty status process
type DeviceWithWarrantyStatus = Device & {
    warrantyStatus: WarrantyStatus
}

const mappedDevices = computed<DeviceWithWarrantyStatus[]>(() =>
    props.devices.data.map(device => ({
        ...device,
        warrantyStatus: getWarrantyStatus(device.device_warranty_expiration_date)
    }))
)

</script>

<template>
    <div>
        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead>ID</TableHead>
                    <TableHead>Device Type</TableHead>
                    <TableHead>Device Name</TableHead>
                    <TableHead>Serial Number</TableHead>
                    <TableHead>Property Number</TableHead>
                    <TableHead>Arrangement</TableHead>
                    <TableHead>End-User</TableHead>
                    <TableHead>Warranty</TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead class="text-center w[100px]">Action</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-for="device in mappedDevices" :key="device.id" class="text-xs">
                    <TableCell>{{ device.id }}</TableCell>
                    <TableCell>{{ device.device_type.device_type_name }}</TableCell>
                    <TableCell>{{ device.device_name }}</TableCell>
                    <TableCell>{{ device.device_serial_number }}</TableCell>
                    <TableCell>{{ device.device_property_number }}</TableCell>
                    <TableCell>{{ device.arrangement.arrangement_name }}</TableCell>
                    <TableCell>{{ device.end_user.end_user_name }}</TableCell>
                    <TableCell :class="{
                        'text-red-600': device.warrantyStatus === 'Expired',
                        'text-orange-600': device.warrantyStatus === 'Expiring Soon',
                        'text-green-600': device.warrantyStatus === 'Active'
                    }">
                        <TooltipProvider>
                            <Tooltip>
                                <TooltipTrigger>{{ device.warrantyStatus }}</TooltipTrigger>
                                <TooltipContent>
                                    <p>{{ formatDate(device.device_warranty_expiration_date) }}</p>
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>
                    </TableCell>
                    <TableCell>{{ device.status.status_name }}</TableCell>
                    <TableCell class="text-center">
                        <div class="flex justify-center items-center space-x-2">
                            <!-- Deploy Button -->
                            <Button class="w-[85px] text-xs">
                                <span>
                                    <HandHelping />
                                </span>
                                Deploy
                            </Button>

                            <!-- Show Button -->
                            <Link :href="route('devices.show', { device: device })"
                                :class="buttonVariants({ variant: 'outline' })" class="text-xs">
                            <span>
                                <Eye />
                            </span>
                            Show
                            </Link>

                            <!-- Edit Button -->
                            <Link :href="route('devices.edit', { device: device })"
                                :class="buttonVariants({ variant: 'outline' })" class="text-xs">
                            <span>
                                <Pencil />
                            </span>
                            Edit
                            </Link>

                            <!-- Delete Button -->
                            <Button variant="destructive" class="w-[85px] text-xs">
                                <span>
                                    <Trash2 />
                                </span>
                                Delete
                            </Button>
                        </div>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>