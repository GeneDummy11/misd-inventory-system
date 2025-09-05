<script setup lang="ts">
import { Eye, Pencil, Trash2, X } from 'lucide-vue-next';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import Button from '@/components/ui/button/Button.vue';
import { PaginatedItemsResponse, Device, Status, EndUser } from '@/types/devices/device_interface';
import { getWarrantyStatus } from '@/utils/format_warranty';
import { type WarrantyStatus } from '@/utils/format_warranty';
import { formatDate } from '@/utils/format_date';
import { computed } from 'vue';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { buttonVariants } from '@/components/ui/button';
import { Link, router } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger, } from '@/components/ui/alert-dialog';
import DeviceUpdateStatusDialog from '@/components/devices/index/DeviceUpdateStatusDialog.vue';

const props = defineProps<{
    devices: PaginatedItemsResponse;
    statuses: Status[];
    end_users: EndUser[];
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

function deleteDevice(deviceId: number) {
    router.delete(route('devices.destroy', { device: deviceId }), {
        preserveScroll: true,
        onSuccess: () => toast.success('Device deleted successfully.'),
        onError: () => toast.error('Failed to delete device.'),
    });
};

</script>

<template>
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
                <TableCell>{{ device.end_user?.end_user_name ?? 'N/A' }}</TableCell>
                <TableCell :class="{
                    'text-red-600 font-semibold': device.warrantyStatus === 'Expired',
                    'text-yellow-600 font-semibold': device.warrantyStatus === 'Expiring Soon',
                    'text-green-600 font-semibold': device.warrantyStatus === 'Active'
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
                <TableCell class="flex justify-center items-center space-x-2">
                    <!-- Deploy Button -->
                    <DeviceUpdateStatusDialog :end_user_id="device.end_user_id"
                        :device_deployment_date="device.device_deployment_date" :status_id="device.status_id"
                        :statuses="statuses" :end_users="end_users" :device_id="device.id" />

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
                    <AlertDialog>
                        <AlertDialogTrigger>
                            <Button variant="destructive" class="w-[85px] text-xs">
                                <span>
                                    <Trash2 />
                                </span>
                                Delete
                            </Button>
                        </AlertDialogTrigger>

                        <AlertDialogContent>
                            <AlertDialogHeader>
                                <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                                <AlertDialogDescription>
                                    This action cannot be undone. This will permanently delete the
                                    device and
                                    remove its data.
                                </AlertDialogDescription>
                            </AlertDialogHeader>
                            <AlertDialogFooter>
                                <div class="flex justify-between w-full">
                                    <div>
                                        <AlertDialogCancel>
                                            <span>
                                                <X />
                                            </span>
                                            Cancel
                                        </AlertDialogCancel>
                                    </div>
                                    <div>
                                        <AlertDialogAction @click="deleteDevice(device.id)"
                                            :class="buttonVariants({ variant: 'destructive' })">
                                            <span>
                                                <Trash2 />
                                            </span>
                                            Delete
                                        </AlertDialogAction>
                                    </div>
                                </div>
                            </AlertDialogFooter>
                        </AlertDialogContent>
                    </AlertDialog>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>