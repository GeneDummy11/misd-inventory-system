<script setup lang="ts">
import { Eye, HandHelping, Pencil, Trash2 } from 'lucide-vue-next';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import Button from '@/components/ui/button/Button.vue';
import { type PaginatedItemsResponse } from '@/types/devices/device_interface';

const props = defineProps<{
    devices: PaginatedItemsResponse;
}>();

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
                <TableRow v-for="device in devices.data" :key="device.id">
                    <TableCell>{{ device.id }}</TableCell>
                    <TableCell>{{ device.device_type.device_type_name }}</TableCell>
                    <TableCell>{{ device.device_name }}</TableCell>
                    <TableCell>{{ device.device_serial_number }}</TableCell>
                    <TableCell>{{ device.device_property_number }}</TableCell>
                    <TableCell>{{ device.arrangement.arrangement_name }}</TableCell>
                    <TableCell>{{ device.end_user.end_user_name }}</TableCell>
                    <TableCell>FOR INPUT</TableCell>
                    <TableCell>{{ device.status.status_name }}</TableCell>
                    <TableCell class="text-center">
                        <div class="flex justify-center items-center space-x-2">
                            <Button class="w-[85px] text-xs">
                                <span>
                                    <HandHelping />
                                </span>
                                Deploy
                            </Button>
                            <Button variant="outline" class="w-[85px] text-xs">
                                <span>
                                    <Eye />
                                </span>
                                Show
                            </Button>
                            <Button variant="outline" class="w-[85px] text-xs">
                                <span>
                                    <Pencil />
                                </span>
                                Edit
                            </Button>
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