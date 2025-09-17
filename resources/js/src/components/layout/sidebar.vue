<template>
    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
        <nav ref="menu" id="sidebar">
            <div class="shadow-bottom"></div>
            <perfect-scrollbar class="list-unstyled menu-categories" tag="ul" :options="{ wheelSpeed: 0.5, swipeEasing: !0, minScrollbarLength: 40, maxScrollbarLength: 300, suppressScrollX: true }">
                <li class="menu" v-for="item in $page.props.menus.data" :key="item">
                    <Link v-if="item.route" :href="route(item.route)" class="dropdown-toggle" @click="toggleMobileMenu">
                        <div>
                            <i :class="item.icon" style="font-size: 17px;margin-right: 14px;"></i>
                            <span>{{ item.name }}</span>
                        </div>
                    </Link>
                    <a v-if="!item.route" class="dropdown-toggle" data-bs-toggle="collapse" :data-bs-target="`#${item.id}`" :aria-controls="`${item.id}`" aria-expanded="false">
                        <div>
                            <i :class="item.icon" style="font-size: 17px;margin-right: 14px;"></i>
                            <span>{{item.name}}</span>
                        </div>
                        <div>
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
                        </div>
                    </a>
                    <ul v-if="!item.route" :id="`${item.id}`" class="collapse submenu list-unstyled" data-bs-parent="#sidebar">
                        <li v-for="menuItem in item.menuItems" :key="menuItem">
                            <Link  v-if="menuItem.route" :href="route(menuItem.route)" @click="toggleMobileMenu">{{menuItem.name}}</Link>
                            <a v-if="!menuItem.route" class="dropdown-toggle" :href="`#${menuItem.id}`" :data-bs-parent="`#${item.id}`" data-bs-toggle="collapse" role="button" aria-expanded="false">
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

                            <ul v-if="!menuItem.route" :id="`${menuItem.id}`" class="collapse list-unstyled sub-submenu">
                                <li v-for="subItem in menuItem.itemSubitems" :key="subItem">
                                    <Link :href="route(subItem.route)" @click="toggleMobileMenu">{{subItem.name}}</Link>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
            </perfect-scrollbar>
        </nav>
    </div>
    <!--  END SIDEBAR  -->
</template>

<script setup>
    import {Link,usePage} from "@inertiajs/vue3";
    import { onMounted, ref } from 'vue';
    import { useStore } from 'vuex';
    import '@/assets/sass/app.scss';
    const store = useStore();

    const menu_collapse = ref('dashboard');

    onMounted(() => {
        const selector = document.querySelector('#sidebar a[href="' + window.location.pathname + '"]');
        if (selector) {
            const ul = selector.closest('ul.collapse');
            if (ul) {
                let ele = ul.closest('li.menu').querySelectorAll('.dropdown-toggle');
                if (ele) {
                    ele = ele[0];
                    setTimeout(() => {
                        ele.click();
                    });
                }
            } else {
                selector.click();
            }
        }
    });

    const toggleMobileMenu = () => {
        if (window.innerWidth < 991) {
            store.commit('toggleSideBar', !store.state.is_show_sidebar);
        }
    };
</script>
