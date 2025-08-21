<template>
    <ContentLayout
    :title="name"
    :descriptionCurrentPage="name"
    :linksBreadcrumb="[]"
    >
        <div class="layout-px-spacing">
            <div class="row layout-spacing">
                <!-- Content -->
                <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
                    <div class="user-profile layout-spacing">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="d-flex justify-content-between">
                                    <h3 class="">Perfil</h3>
                                    <a href="#" @click.prevent="openSettings" class="mt-2 edit-profile">
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
                                            class="feather feather-edit-3"
                                        >
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="text-center user-info">
                                    <img
                                        v-if="props.user.photo"
                                        :src="props.user.photo"
                                        alt="profile"
                                        class="profile-preview"
                                    />
                                    <img
                                        v-else
                                        :src="`https://ui-avatars.com/api/?name=${props.user.name}&color=7F9CF5&background=EBF4FF`"
                                        alt="profile"
                                        class="profile-preview"
                                    />
                                    <p class="">{{user.name}}</p>
                                </div>
                                <div class="user-info-list">
                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item">
                                                <a href="mailto:example@mail.com"
                                                    ><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-mail"
                                                    >
                                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                        <polyline points="22,6 12,13 2,6"></polyline></svg
                                                    >{{ props.user.email }}</a
                                                >
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div v-if="data.showSettings" class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
                    <div class="skills layout-spacing">
                        <div class="">
                            <div class="panel-body">
                                <AccountSettings @cancel="closeSettings" :user="props.user" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </ContentLayout>
</template>

<script setup>
    import '@/assets/sass/scrollspyNav.scss';
    import '@/assets/sass/users/user-profile.scss';
    import ContentLayout from "@/layouts/content-layout.vue";
    import AccountSettings from "./account-setting.vue";
    import { useMeta } from '@/composables/use-meta';
    import { reactive } from '@vue/reactivity';
    useMeta({ title: 'Perfil' });
    const props = defineProps({
        user: {
            type: Object,
            required: true,
        },
    })
    const name  = "Perfil"
    const data = reactive({
        showSettings: false,
    })
    const openSettings = () => {
        data.showSettings = true;
    }
    const closeSettings = () => {
        data.showSettings = false;
    }
</script>
