<script setup lang="ts">
import { Eye, HandHelping, Pencil, SaveAll, Trash2, X } from 'lucide-vue-next';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import Button from '@/components/ui/button/Button.vue';
import { PaginatedItemsResponse, Device } from '@/types/devices/device_interface';
import { getWarrantyStatus } from '@/utils/format_warranty';
import { type WarrantyStatus } from '@/utils/format_warranty';
import { formatDate } from '@/utils/format_date';
import { computed } from 'vue';
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip';
import { buttonVariants } from '@/components/ui/button';
import { Link, router } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger, } from '@/components/ui/alert-dialog';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger, } from '@/components/ui/dialog';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import Textarea from '@/components/ui/textarea/Textarea.vue';

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

function deleteDevice(deviceId: number) {
    router.delete(route('devices.destroy', { device: deviceId }), {
        preserveScroll: true,
        onSuccess: () => toast.success('Device deleted successfully.'),
        onError: () => toast.error('Failed to delete device.'),
    });
};

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
                    <TableCell class="text-center">
                        <div class="flex justify-center items-center space-x-2">
                            <!-- Deploy Button -->
                            <Dialog>
                                <DialogTrigger>
                                    <Button class="w-[130px] text-xs">
                                        <span>
                                            <HandHelping />
                                        </span>
                                        Update Status
                                    </Button>
                                </DialogTrigger>

                                <DialogContent>
                                    <DialogHeader>
                                        <DialogTitle>Update device status</DialogTitle>
                                    </DialogHeader>

                                    <!-- Centered parent container -->
                                    <div class="flex flex-col items-center space-y-4">
                                        <div class="flex flex-col w-full max-w-sm">
                                            <Label class="mb-2 text-xs">Device status</Label>
                                            <Select>
                                                <SelectTrigger class="w-full">
                                                    <SelectValue placeholder="Select a fruit" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectGroup>
                                                        <SelectLabel>Fruits</SelectLabel>
                                                        <SelectItem value="apple">Apple</SelectItem>
                                                    </SelectGroup>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        <div class="flex flex-col w-full max-w-sm">
                                            <Label class="mb-2 text-xs">End-user</Label>
                                            <Select>
                                                <SelectTrigger class="w-full">
                                                    <SelectValue placeholder="Select a fruit" />
                                                </SelectTrigger>
                                                <SelectContent>
                                                    <SelectGroup>
                                                        <SelectLabel>Fruits</SelectLabel>
                                                        <SelectItem value="apple">Apple</SelectItem>
                                                    </SelectGroup>
                                                </SelectContent>
                                            </Select>
                                        </div>

                                        <div class="flex flex-col w-full max-w-sm">
                                            <Label class="mb-2 text-xs">Remarks</Label>
                                            <Textarea placeholder="Remarks"></Textarea>
                                        </div>
                                    </div>

                                    <DialogFooter>
                                        <div class="flex justify-between w-full">
                                            <div>
                                                <Link :href="route('devices.show', { device: device })"
                                                    :class="buttonVariants({ variant: 'outline' })" class="text-xs">
                                                <span>
                                                    <X />
                                                </span>
                                                Cancel
                                                </Link>
                                            </div>
                                            <div>
                                                <Link :href="route('devices.show', { device: device })"
                                                    :class="buttonVariants({ variant: 'default' })" class="text-xs">
                                                <span>
                                                    <SaveAll />
                                                </span>
                                                Update
                                                </Link>
                                            </div>
                                        </div>
                                    </DialogFooter>
                                </DialogContent>
                            </Dialog>


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
                        </div>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>