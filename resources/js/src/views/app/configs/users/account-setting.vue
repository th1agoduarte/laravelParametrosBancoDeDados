<template>
    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <form id="general-info" class="section general-info">
                    <div class="info">
                        <h6 class="">Informações gerais</h6>
                        <div class="row">
                            <div class="col-lg-11 mx-auto">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                        <div class="upload mt-4 pe-md-4">
                                            <input ref="fl_profile" type="file" class="d-none" accept="image/*" @change="change_file" />
                                            <img
                                                v-if="data.user.photo"
                                                :src="data.user.photo"
                                                alt="profile"
                                                class="profile-preview"
                                                @click="$refs.fl_profile.click()"
                                            />
                                            <img
                                                v-else
                                                :src="`https://ui-avatars.com/api/?name=${data.user.name}&color=7F9CF5&background=EBF4FF`"
                                                alt="profile"
                                                class="profile-preview"
                                                @click="$refs.fl_profile.click()"
                                            />
                                            <p class="mt-2">Upload Foto</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="form-group">
                                                <label for="fullName">Name</label>
                                                <input v-model="data.user.name" class="form-control mb-4" id="fullName" placeholder="Name"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input v-model="data.user.email" type="email" class="form-control mb-4" id="email" placeholder="email" />
                                            </div>
                                            <div class="form-group">
                                                <label for="update-password">Change Password</label>
                                                <input v-model="data.user.password" type="password" class="form-control mb-4" id="update-password" placeholder="New Password" />
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm-update-password">Confirm Password</label>
                                                <input v-model="data.user.password_confirmation" type="password" class="form-control mb-4" id="confirm-update-password" placeholder="Confirm Password" />
                                            </div>
                                            <button type="button" class="btn btn-success" @click="save()">Save</button>
                                            <button type="button" class="btn btn-danger ms-3" @click="cancel()">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
    import '@/assets/sass/scrollspyNav.scss';
    import '@/assets/sass/users/account-setting.scss';
    import { useMeta } from '@/composables/use-meta';
    import { Inertia } from "@inertiajs/inertia";
    import { useForm } from "@inertiajs/inertia-vue3";
    import {  reactive, onMounted,defineProps } from "vue";
    const props = defineProps({
        user: { type: Object, require: true, default: {} },
    });
    onMounted(() => {
        data.user.name = props.user.name;
        data.user.email = props.user.email;
    });

    const data = reactive({
        user: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            photo: ''
        },
        form: useForm({
            name: '',
            email: '',
            password: null,
            photo: null,
            password_confirmation: null,
        }),
    });

    const emit = defineEmits(['save', 'cancel']);
    const save = () => {
        data.form.name = data.user.name;
        data.form.email = data.user.email;

        data.form.password = data.user.password && data.user.password !='' ? data.user.password : null;
        data.form.password_confirmation = data.user.password_confirmation && data.user.password_confirmation !='' ? data.user.password_confirmation : null;
        data.form.photo = data.user.photo ? data.user.photo && data.user.photo != '' : null;

        if (validPassword()) {
            data.form.post(route('app.profile.update', props.user.id), {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => {
                    new window.Swal({
                        icon: "success",
                        title: "Changes made successfully!",
                        text: "The data has been updated successfully!",
                        padding: "2em",
                    });
                    emit('cancel');
                },
            });
        }
    };

    const validPassword = () => {
        return data.user.password === data.user.password_confirmation;
    };

    const cancel = () => {
        emit('cancel');
    };

</script>
