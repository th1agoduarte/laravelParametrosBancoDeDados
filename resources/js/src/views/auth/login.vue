<template>
    <div class="form full-form auth-cover">
        <div class="form-container">
            <div class="form-form">
                <div class="form-form-wrap">
                    <div class="form-container">
                        <div class="form-content">
                            <h1 class="">
                                Login <router-link to="/"><span class="brand-name">{{app_name}}</span></router-link>
                            </h1>
                            <form class="text-start">
                                <div class="form">
                                    <div id="username-field" class="field-wrapper input">
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
                                            class="feather feather-user"
                                        >
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <input v-model="data.form.email" type="text" class="form-control" placeholder="Email" />
                                        <div v-if="data.error" class="text-danger">
                                            {{ data.error.email }}
                                        </div>
                                    </div>

                                    <div id="password-field" class="field-wrapper input mb-2">
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
                                            class="feather feather-lock"
                                        >
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                        <input v-model="data.form.password" type="password" class="form-control" placeholder="Password" />
                                        <div v-if="data.error" class="text-danger">
                                            {{ data.error.password }}
                                        </div>
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper toggle-pass d-flex align-items-center">
                                            <p class="d-inline-block">Show Password</p>
                                            <label class="switch s-primary mx-2">
                                                <input type="checkbox" class="custom-control-input" @change="toggleShowPassword()" />
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        <div class="field-wrapper">
                                            <button type="button" @click="login" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>

                                    <!-- <div class="field-wrapper text-center keep-logged-in">
                                        <div class="checkbox-outline-primary custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="true" id="chkRemember" />
                                            <label class="custom-control-label" for="chkRemember">Keep me logged in</label>
                                        </div>
                                    </div>

                                    <div class="field-wrapper">
                                        <router-link to="/auth/pass-recovery" class="forgot-pass-link">Forgot Password?</router-link>
                                    </div> -->
                                </div>
                            </form>
                            <p class="terms-conditions">
                                <Footer />
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="form-image">
                <div class="l-image"></div>
            </div> -->
        </div>
    </div>
</template>

<script setup>
    import '@/assets/sass/authentication/auth.scss';
    import Footer from '@/components/layout/footer.vue';
    import { Inertia } from "@inertiajs/inertia";
    import { useForm,usePage } from "@inertiajs/inertia-vue3";
    import { useMeta } from '@/composables/use-meta';
    import { reactive } from '@vue/reactivity';
    import { onMounted } from '@vue/runtime-core';
    import { computed } from 'vue';
    const app_name = computed(() => usePage().props.value.app_name);
    useMeta({ title: `${app_name.value} | Login` });
    onMounted(() => {

    });

    const toggleShowPassword = () => {
        const passwordInput = document.querySelector('#password-field input');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    };

    const data = reactive({
        error: null,
        form: useForm({
            email: '',
            password: '',
        }),
    });

    const login = () => {
        data.form.post(route('login'), {
            replace: true,
            preserveState: true,
            preserveScroll: true,

            onSuccess: (page) => {

            },
            onError: (error) => {
                data.error = error;
            },
        });
    };

</script>
