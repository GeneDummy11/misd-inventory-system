<script setup lang="ts">
import NavFooter from '@/components/side_navigations/NavFooter.vue';
import NavMain from '@/components/side_navigations/NavMain.vue';
import NavUser from '@/components/side_navigations/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Brackets, ChartColumnBig, ChartNetwork, Disc3, FileChartColumn, Folder, Laptop, LaptopMinimalCheck, LayoutGrid, ListFilter, ListFilterPlus, Truck, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import NavInventory from './side_navigations/NavInventory.vue';
import NavEndUser from './side_navigations/NavEndUser.vue';
import NavOtherData from './side_navigations/NavOtherData.vue';

const data = {
    dashboardItems: [
        {
            title: 'Dashboard',
            href: route('dashboard'),
            icon: ChartColumnBig,
        },
    ],
    inventoryItems: [
        {
            title: 'Devices/Equipment',
            href: route('devices.index'),
            icon: Laptop,
        },
        {
            title: 'Licenses/Subscriptions',
            href: route('licenses.index'),
            icon: Disc3,
        }
    ],
    endUserItems: [
        {
            title: 'End-users',
            href: '/dashboard',
            icon: Users,
            items: [
                {
                    title: 'List of End-users',
                    href: route('end-users.index'),
                },
                {
                    title: 'Services',
                    href: route('services.index'),
                },
                {
                    title: 'Divisions',
                    href: route('divisions.index'),
                },
                {
                    title: 'User roles',
                    href: route('user-roles.index'),
                },
            ]
        },
    ],
    otherDataItems: [
        {
            title: 'Suppliers',
            href: route('suppliers.index'),
            icon: Truck,
        },
        {
            title: 'Device Types',
            href: route('device-types.index'),
            icon: ListFilter,
        },
        {
            title: 'License Types',
            href: route('license-types.index'),
            icon: ListFilterPlus,
        },
        {
            title: 'Brands',
            href: route('brands.index'),
            icon: LaptopMinimalCheck,
        },
        {
            title: 'Statuses',
            href: route('statuses.index'),
            icon: ChartNetwork,
        },
        {
            title: 'Arrangement',
            href: route('arrangements.index'),
            icon: Brackets,
        },
    ]

}

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="data.dashboardItems" />
            <NavInventory :items="data.inventoryItems" />
            <NavEndUser :items="data.endUserItems" />
            <NavOtherData :items="data.otherDataItems" />
        </SidebarContent>

        <SidebarFooter>
            <!-- <NavFooter :items="footerNavItems" /> -->
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
