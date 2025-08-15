<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import SupplierTitleSection from '@/components/suppliers/SupplierTitleSection.vue';
import SupplierFilterSection from '@/components/suppliers/SupplierFilterSection.vue';
import SupplierTableSection from '@/components/suppliers/SupplierTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Suppliers',
        href: route('suppliers.index'),
    },
];
</script>

<template>

    <Head title="Suppliers" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <SupplierTitleSection />
            <SupplierFilterSection />
            <SupplierTableSection />
        </div>
    </AppLayout>
</template>
