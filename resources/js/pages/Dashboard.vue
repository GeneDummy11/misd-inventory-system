<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import BarChart from '@/components/analytics/BarChart.vue';
import PieChart from '@/components/analytics/PieChart.vue';
import { Badge } from "@/components/ui/badge";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div>
                <h1 class="font-semibold">
                    Devices/Equipment Graphs
                </h1>
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-5">
                    <BarChart />
                </div>
                <div
                    class="flex items-center justify-center relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-5">
                    <PieChart />
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-5">
                    <h1 class="font-semibold">
                        Important alerts:
                    </h1>
                    <div class="mt-2 space-x-2 border-b-2 p-2">
                        <label>
                            <span class="pr-2">
                                <Badge variant="destructive">
                                    Danger
                                </Badge>
                            </span>
                            25 Laptops with expired warranty
                        </label>
                    </div>
                    <div class="mt-2 space-x-2 border-b-2 p-2">
                        <label>
                            <span class="pr-2">
                                <Badge class="bg-yellow-500">
                                    Warning
                                </Badge>
                            </span>
                            50 Laptops will expire warranty on 2026
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="font-semibold">
                    Software/Subscriptions Graphs
                </h1>
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-5">
                    <BarChart />
                </div>
                <div
                    class="flex items-center justify-center relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-5">
                    <PieChart />
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-5">
                    <h1 class="font-semibold">
                        Important alerts:
                    </h1>
                    <div class="mt-2 space-x-2 border-b-2 p-2">
                        <label>
                            <span class="pr-2">
                                <Badge variant="destructive">
                                    Danger
                                </Badge>
                            </span>
                            25 Laptops with expired warranty
                        </label>
                    </div>
                    <div class="mt-2 space-x-2 border-b-2 p-2">
                        <label>
                            <span class="pr-2">
                                <Badge class="bg-yellow-500">
                                    Warning
                                </Badge>
                            </span>
                            50 Laptops will expire warranty on 2026
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
