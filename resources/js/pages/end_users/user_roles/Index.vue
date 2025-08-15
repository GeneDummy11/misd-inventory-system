<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import UserRoleTitleSection from '@/components/end_users/user_roles/UserRoleTitleSection.vue';
import UserRoleFilterSection from '@/components/end_users/user_roles/UserRoleFilterSection.vue';
import UserRoleTableSection from '@/components/end_users/user_roles/UserRoleTableSection.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Roles',
        href: route('user-roles.index'),
    },
];
</script>

<template>

    <Head title="User Roles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <UserRoleTitleSection />
            <UserRoleFilterSection />
            <UserRoleTableSection />
        </div>
    </AppLayout>
</template>
