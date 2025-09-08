<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import Label from '@/components/ui/label/Label.vue';
import { FileUp, SaveAll, X } from 'lucide-vue-next';
import { buttonVariants } from '@/components/ui/button';
import Input from '@/components/ui/input/Input.vue';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger, } from '@/components/ui/alert-dialog';
import Button from '@/components/ui/button/Button.vue';


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

function importDevice() { };
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
                        <Input id="picture" type="file" />
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
