<script setup lang="ts">
import { Download, FileUp, Plus } from 'lucide-vue-next';
import Button from '../ui/button/Button.vue';

</script>

<template>
    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-semibold">
                Status
            </h1>
        </div>
        <div class="space-x-2">
            <Button>
                <span>
                    <Plus />
                </span>
                Add new status
            </Button>
            <Button>
                <span>
                    <FileUp />
                </span>
                Import
            </Button>
            <Button>
                <span>
                    <Download />
                </span>
                Export
            </Button>
        </div>
    </div>
</template>