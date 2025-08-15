<script setup lang="ts">
import { Eye, HandHelping, Pencil, Trash2 } from 'lucide-vue-next';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import Button from '@/components/ui/button/Button.vue';
</script>

<template>
    <div>
        <Table>
            <TableCaption>A list of your recent invoices.</TableCaption>
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[100px]">
                        Invoice
                    </TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead>Method</TableHead>
                    <TableHead class="text-right">
                        Amount
                    </TableHead>
                    <TableHead>Sample</TableHead>
                    <TableHead>Sample</TableHead>
                    <TableHead>Sample</TableHead>
                    <TableHead class="text-center">Action</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow>
                    <TableCell class="font-medium">
                        INV001
                    </TableCell>
                    <TableCell>Paid</TableCell>
                    <TableCell>Credit Card</TableCell>
                    <TableCell class="text-right">
                        $250.00
                    </TableCell>
                    <TableCell>Sample</TableCell>
                    <TableCell>Sample</TableCell>
                    <TableCell>Sample</TableCell>
                    <TableCell class="text-center">
                        <div class="flex justify-center items-center space-x-2">
                            <Button variant="outline" class="w-[100px]">
                                <span>
                                    <Eye />
                                </span>
                                Show
                            </Button>
                            <Button variant="outline" class="w-[100px]">
                                <span>
                                    <Pencil />
                                </span>
                                Edit
                            </Button>
                            <Button variant="destructive" class="w-[100px]">
                                <span>
                                    <Trash2 />
                                </span>
                                Delete
                            </Button>
                        </div>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>