<script setup lang="ts">
import { ListFilter, RefreshCcw } from 'lucide-vue-next';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Arrangement, DeviceFilters, DeviceType, Status } from '@/types/devices/device_interface';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';

const props = defineProps<{
    device_types: DeviceType[];
    arrangements: Arrangement[];
    statuses: Status[];
    filters?: DeviceFilters;
}>();

const selectedDeviceType = ref<string | null>(props.filters?.device_type_id ?? null);
const selectedArrangement = ref<string | null>(props.filters?.arrangement_id ?? null);
const selectedStatus = ref<string | null>(props.filters?.status_id ?? null);

watch([selectedDeviceType, selectedStatus, selectedArrangement], () => {
    router.get('/devices', {
        device_type_id: selectedDeviceType.value,
        status_id: selectedStatus.value,
        arrangement_id: selectedArrangement.value,
    }, {
        preserveState: true,
        replace: true,
    });
});

function resetFilter() {
    selectedDeviceType.value = null;
    selectedArrangement.value = null;
    selectedStatus.value = null;

    router.get('/devices', {
        device_type_id: selectedDeviceType.value,
        status_id: selectedStatus.value,
        arrangement_id: selectedArrangement.value,
    }, {
        preserveState: true,
        replace: true,
    });
}

</script>

<template>
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <span>
                <ListFilter />
            </span>
            <div>
                <Select v-model="selectedDeviceType">
                    <SelectTrigger class="w-[150px]">
                        <SelectValue placeholder="Device Type" />
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
            </div>
            <div>
                <Select v-model="selectedStatus">
                    <SelectTrigger class="w-[150px]">
                        <SelectValue placeholder="Status" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem v-for="status in statuses" :key="status.id" :value="status.id">
                                {{ status.status_name }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
            <div>
                <Select v-model="selectedArrangement">
                    <SelectTrigger class="w-[150px]">
                        <SelectValue placeholder="Arrangement" />
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
            </div>
            <div>
                <Button variant="outline" class="w-[120px]" @click="resetFilter()">
                    <span>
                        <RefreshCcw />
                    </span>
                    Reset Filter
                </Button>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <div
                class="w-[400px] relative flex items-center h-10 rounded-md border border-input bg-white dark:bg-black pl-3 pr-3 text-sm ring-offset-background focus-within:ring-1 focus-within:ring-ring focus-within:ring-offset-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-muted-foreground mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                </svg>
                <input type="search" placeholder="Search..."
                    class="w-full bg-transparent p-2 placeholder:text-muted-foreground focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50" />
            </div>
        </div>
    </div>
</template>