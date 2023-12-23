<script setup>
import { defineAsyncComponent } from 'vue';
import { Link } from '@inertiajs/vue3';

const menu = [
    {
        summary: { name: 'Shop', icon: 'BuildingStorefront' },
        items: [
            { name: 'Products', icon: 'Gift' },
            { name: 'Orders', icon: 'BellAlert' },
            { name: 'Categories', icon: 'RectangleGroup' },
            { name: 'Customers', icon: 'CursorArrowRays' },
        ]
    },
    {
        summary: { name: 'Blog', icon: 'Window' },
        items: [
            { name: 'Posts', icon: 'DocumentText' },
            { name: 'Comments', icon: 'ChatBubbleBottomCenterText' },
            { name: 'Categories', icon: 'Wallet' },
            { name: 'Authors', icon: 'PencilSquare' },
        ]
    },
]

// 生成菜单项的网址和 active 状态的路由
menu.forEach(group => {
    group.items.forEach(item => {
        let routePrefix = `${group.summary.name.toLowerCase()}.${item.name.toLowerCase()}.`
        let routeName = routePrefix + 'index'

        item.href = route().has(routeName) ? route(routeName) : ''
        item.route = routePrefix + '*'
    })
});

// 导入图标文件
const modules = import.meta.glob('../Components/Icons/*.vue')

// 根据菜单项的图标名称，定义相应的组件
let iconPath = '../Components/Icons/'
menu.forEach(group => {
    group.summary.component = defineAsyncComponent(modules[`${iconPath}${group.summary.icon}.vue`])

    group.items.forEach(item => {
        item.component = defineAsyncComponent(modules[`${iconPath}${item.icon}.vue`])
    })
});
</script>

<template>
    <div class="py-12">
        <ul class="menu [&_li>*]:rounded-none">
            <li v-for="group in menu">
                <details open>
                    <summary>
                        <component :is="group.summary.component"></component>
                        {{ group.summary.name }}
                    </summary>
                    <ul>
                        <li v-for="item in group.items">
                            <Link :href="item.href" :class="{ active: route().current(item.route) }">
                                <component :is="item.component"></component>
                                {{ item.name }}
                            </Link>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</template>
