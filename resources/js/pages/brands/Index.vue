<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import BrandTitleSection from '@/components/brands/BrandTitleSection.vue';
import BrandFilterSection from '@/components/brands/BrandFilterSection.vue';
import BrandTableSection from '@/components/brands/BrandTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Brands',
        href: route('brands.index'),
    },
];
</script>

<template>

    <Head title="Brands" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <BrandTitleSection />
            <BrandFilterSection />
            <BrandTableSection />
        </div>
    </AppLayout>
</template>
