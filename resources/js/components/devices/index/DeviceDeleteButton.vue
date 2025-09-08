<script setup lang="ts">
import { Trash2, X } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';
import Button from '@/components/ui/button/Button.vue';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger, } from '@/components/ui/alert-dialog';
import { buttonVariants } from '@/components/ui/button';

const props = defineProps<{
    device_id: number;
}>();

function deleteDevice(deviceId: number) {
    router.delete(route('devices.destroy', { device: deviceId }), {
        preserveScroll: true,
        onSuccess: () => toast.success('Device deleted successfully.'),
        onError: () => toast.error('Failed to delete device.'),
    });
};
</script>

<template>
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
                        <AlertDialogAction @click="deleteDevice(device_id)"
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
</template>