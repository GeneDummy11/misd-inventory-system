<script setup lang="ts">
import { Download, FileUp, Plus } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import { buttonVariants } from '../../ui/button';
import Button from '@/components/ui/button/Button.vue';

</script>

<template>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-semibold">
                Devices/Equipment
            </h1>
        </div>
        <div class="space-x-2">
            <!-- Add new device button -->
            <Link :href="route('devices.create')" :class="buttonVariants({ variant: 'default' })" class="text-xs">
            <span>
                <Plus />
            </span>
            Add new device
            </Link>

            <!-- Import button -->
            <Link :href="route('devices.import')" :class="buttonVariants({ variant: 'default' })" class="text-xs">
            <span>
                <FileUp />
            </span>
            Import
            </Link>

            <!-- Export button -->
            <Button class="text-xs">
                <span>
                    <Download />
                </span>
                Export
            </Button>
        </div>
    </div>
</template>