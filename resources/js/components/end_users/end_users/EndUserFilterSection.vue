<script setup lang="ts">
import { ListFilter } from 'lucide-vue-next';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
</script>

<template>
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <span>
                <ListFilter />
            </span>
            <div>
                <Select>
                    <SelectTrigger>
                        <SelectValue placeholder="Select a fruit" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Fruits</SelectLabel>
                            <SelectItem value="apple">
                                Apple
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
            <div>
                <Select>
                    <SelectTrigger>
                        <SelectValue placeholder="Select a fruit" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Fruits</SelectLabel>
                            <SelectItem value="apple">
                                Apple
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
            <div>
                <Select>
                    <SelectTrigger>
                        <SelectValue placeholder="Select a fruit" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Fruits</SelectLabel>
                            <SelectItem value="apple">
                                Apple
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
            <div>
                <Select>
                    <SelectTrigger>
                        <SelectValue placeholder="Select a fruit" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Fruits</SelectLabel>
                            <SelectItem value="apple">
                                Apple
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
            <div>
                <Select>
                    <SelectTrigger>
                        <SelectValue placeholder="Select a fruit" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Fruits</SelectLabel>
                            <SelectItem value="apple">
                                Apple
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <div
                class="w-[400px] relative flex items-center h-10 rounded-md border border-input bg-white dark:bg-black pl-3 pr-3 text-sm ring-offset-background focus-within:ring-1 focus-within:ring-ring focus-within:ring-offset-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-muted-foreground mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                </svg>
                <input type="search" placeholder="Search..."
                    class="w-full bg-transparent p-2 placeholder:text-muted-foreground focus-visible:outline-none disabled:cursor-not-allowed disabled:opacity-50" />
            </div>
        </div>
    </div>
</template>