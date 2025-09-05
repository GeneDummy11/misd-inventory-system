<script setup lang="ts">
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle, DialogTrigger, } from '@/components/ui/dialog';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import InputError from '@/components/InputError.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import { HandHelping, SaveAll } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { toast } from 'vue-sonner';
import { EndUser, Status } from '@/types/devices/device_interface';
import Button from '@/components/ui/button/Button.vue';

const props = defineProps<{
    end_user_id: number;
    device_id: number;
    status_id: number;
    device_deployment_date: string;
    statuses: Status[];
    end_users: EndUser[];
}>();

const form = useForm<{
    end_user_id: string;
    device_deployment_date: string;
    status_id: number | null;
}>({
    end_user_id: '',
    device_deployment_date: '',
    status_id: null,
});

const isDialogOpen = ref(false);

function updateDeviceStatus(deviceId: number) {
    form.put(route('devices.update-device-status', { device: deviceId }), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset(),
                toast.success('Device status updated successfully.')
        },
        onError: (errors) => console.error(errors),
    });
};

</script>

<template>
    <Dialog :open="isDialogOpen" @update:open="(val: boolean) => isDialogOpen = val">
        <DialogTrigger as-child>
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
                    <Label class="mb-2 text-xs" for="status_id">Status</Label>
                    <Select v-model="form.status_id">
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Select status" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem v-for="status in statuses" :key="status.id" :value="status.id">
                                    {{ status.status_name }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.status_id" class="mt-2" />
                </div>

                <div class="flex flex-col w-full max-w-sm">
                    <Label class="mb-2 text-xs" for="user_id">End-user</Label>
                    <Select v-model="form.end_user_id">
                        <SelectTrigger class="w-full">
                            <SelectValue placeholder="Select end-user" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectGroup>
                                <SelectItem v-for="end_user in end_users" :key="end_user.id" :value="end_user.id">
                                    {{ end_user.end_user_name }}
                                </SelectItem>
                            </SelectGroup>
                        </SelectContent>
                    </Select>
                    <InputError :message="form.errors.end_user_id" class="mt-2" />
                </div>

                <div class="flex flex-col w-full max-w-sm">
                    <Label class="mb-2 text-xs" for="device_deployment_date">Deployment
                        date</Label>
                    <Input id="device_deployment_date" v-model="form.device_deployment_date" type="date" />
                    <InputError :message="form.errors.device_deployment_date" class="mt-2" />
                </div>

                <div class="flex flex-col w-full max-w-sm">
                    <Label class="mb-2 text-xs">Remarks</Label>
                    <Textarea placeholder="Remarks"></Textarea>
                </div>
            </div>

            <DialogFooter class="px-10">
                <Button variant="default" class="w-[120px]" @click="updateDeviceStatus(device_id)">
                    <SaveAll />
                    <span>Update</span>
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>