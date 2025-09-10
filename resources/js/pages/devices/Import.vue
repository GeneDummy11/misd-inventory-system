<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import Label from '@/components/ui/label/Label.vue';
import { FileUp, SaveAll, X } from 'lucide-vue-next';
import { buttonVariants } from '@/components/ui/button';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger, } from '@/components/ui/alert-dialog';
import Button from '@/components/ui/button/Button.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Input from '@/components/ui/input/Input.vue';
import Papa from 'papaparse';
import { toast } from 'vue-sonner';

const file = ref<File | null>(null);
const isLoading = ref(false);
const errorMessage = ref<string | null>(null);
const previewData = ref<string[][]>([]);
const parsed = ref(false);

function importDevice() {
    if (!file.value) {
        errorMessage.value = 'Please select a CSV file.';
        return
    }

    isLoading.value = true;
    errorMessage.value = null;

    const formData = new FormData();
    formData.append('file', file.value);

    console.log(file.value);

    router.post(route('devices.store-import'), formData, {
        onSuccess: () => {
            toast.success('Device added successfully.')
        },
        onError: (errors) => {
            if (typeof errors === 'object') {
                const firstKey = Object.keys(errors)[0];
                const rawMessage = errors[firstKey];

                if (Array.isArray(rawMessage)) {
                    errorMessage.value = rawMessage[0] ?? 'Import failed. Please check your file format.';
                } else if (typeof rawMessage === 'string') {
                    errorMessage.value = rawMessage; // HTML-safe
                } else {
                    errorMessage.value = 'Import failed. Unexpected error format.';
                }
            } else if (typeof errors === 'string') {
                errorMessage.value = errors; // fallback for string errors
            } else {
                errorMessage.value = 'Import failed. Unexpected error format.';
            }
        },
        onFinish: () => {
            isLoading.value = false
        },
    });
}

function handleFileChange(e: Event) {
    const target = e.target as HTMLInputElement;
    const selectedFile = target.files?.[0] ?? null;

    if (!selectedFile) {
        errorMessage.value = 'No file selected.';
        file.value = null;
        previewData.value = [];
        parsed.value = false;
        return;
    }

    file.value = selectedFile;
    errorMessage.value = null;

    Papa.parse(selectedFile, {
        complete: (results) => {
            previewData.value = results.data as string[][];
            parsed.value = true;
        },
        error: () => {
            errorMessage.value = 'Failed to parse CSV file.';
            previewData.value = [];
            parsed.value = false;
        }
    });
}


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
                        <CardTitle>
                            <div class="flex space-x-2 items-center">
                                <FileUp />
                                <Label class="text-2xl font-bold">Import record/s from a csv file</Label>
                            </div>
                        </CardTitle>
                    </CardHeader>
                    <CardContent class="space-y-5">
                        <!-- File input -->
                        <Input type="file" name="file" accept=".csv, .xlsx, .xls" @change="handleFileChange" />

                        <!-- Errors -->
                        <div v-if="errorMessage" class="text-red-500 text-sm mt-2" v-html="errorMessage"></div>

                        <!-- Preview section -->
                        <div v-if="parsed && previewData.length" class="mt-4 overflow-auto">
                            <table class="table-auto border-collapse border border-gray-300 w-full">
                                <thead>
                                    <tr>
                                        <!-- Row number header -->
                                        <th class="border p-2 bg-gray-100">#</th>

                                        <!-- Existing headers -->
                                        <th v-for="(header, index) in previewData[0]" :key="index"
                                            class="border p-2 bg-gray-100">
                                            {{ header }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, rowIndex) in previewData.slice(1)" :key="rowIndex">
                                        <!-- Row number cell -->
                                        <td class="border p-2 font-semibold text-center">
                                            {{ rowIndex + 2 }} <!-- +2 to account for header row and 0-based index -->
                                        </td>

                                        <!-- Existing row cells -->
                                        <td v-for="(cell, cellIndex) in row" :key="cellIndex" class="border p-2">
                                            {{ cell }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <!-- Action buttons -->
                        <hr class="mt-10">
                        <div class="flex justify-between items-center">
                            <!-- Cancel Button -->
                            <Link :href="route('devices.index')" :class="buttonVariants({ variant: 'outline' })"
                                class="w-[120px]">
                            <X />
                            <span>Cancel</span>
                            </Link>

                            <!-- Save Button -->
                            <AlertDialog>
                                <AlertDialogTrigger>
                                    <Button variant="default" class="w-[120px]">
                                        <SaveAll />
                                        <span>Import</span>
                                    </Button>
                                </AlertDialogTrigger>

                                <AlertDialogContent>
                                    <AlertDialogHeader>
                                        <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                                        <AlertDialogDescription>
                                            This action will create new record/s.
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
                                                <AlertDialogAction @click="importDevice()">
                                                    <span>
                                                        <SaveAll />
                                                    </span>
                                                    Import
                                                </AlertDialogAction>
                                            </div>
                                        </div>
                                    </AlertDialogFooter>
                                </AlertDialogContent>
                            </AlertDialog>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
