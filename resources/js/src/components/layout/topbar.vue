<template>
    <div class="topbar-nav header navbar" role="banner">
            <nav class="topbar">
                <ul class="list-unstyled menu-categories" id="topAccordion">
                    <li class="menu single-menu" v-for="item in $page.props.menus.data" :key="item">
                        <Link v-if="item.route" :href="route(item.route)" class="dropdown-toggle autodroprown">
                            <div>
                                <i :class="item.icon" style="font-size: 17px;margin-right: 14px;"></i>
                                <span>{{ item.name }}</span>
                            </div>
                        </Link>
                        <a v-if="!item.route" href="javascript:;" class="dropdown-toggle">
                            <div class="">
                                <i :class="item.icon" style="font-size: 17px;margin-right: 14px;"></i>
                                <span>{{ item.name }}</span>
                            </div>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-chevron-down"
                            >
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>
                        <ul v-if="!item.route" class="collapse submenu list-unstyled">
                            <!-- <li><router-link to="/apps/chat">Chat</router-link></li> -->
                            <li class="sub-sub-submenu-list" v-for="menuItem in item.menuItems" :key="menuItem">
                                <Link v-if="menuItem.route" :href="route(menuItem.route)" >{{menuItem.name}}</Link>
                                <a v-if="!menuItem.route" href="javascript:;">
                                    {{menuItem.name}}
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-chevron-right"
                                    >
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </a>
                                <ul v-if="!menuItem.route"  class="collapse list-unstyled sub-submenu">
                                    <li v-for="subItem in menuItem.itemSubitems" :key="subItem"><Link :href="route(subItem.route)">{{subItem.name}}</Link></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                </ul>
            </nav>
    </div>
</template>
<script setup>
import {Link,usePage} from "@inertiajs/inertia-vue3";
const name ="Topbar"
</script>
