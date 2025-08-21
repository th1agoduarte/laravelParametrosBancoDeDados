<template>
  <div class="dropdown nav-item user-profile-dropdown btn-group">
    <a
      href="javascript:;"
      id="ddluser"
      data-bs-toggle="dropdown"
      aria-expanded="false"
      class="btn dropdown-toggle btn-icon-only user nav-link"
    >
        <img
            v-if="$page.props.user.photo"
            :src="$page.props.user.photo"
            alt="profile"
            class="profile-preview"
        />
        <img
            v-else
            :src="`https://ui-avatars.com/api/?name=${$page.props.user.name}&color=7F9CF5&background=EBF4FF`"
            alt="profile"
            class="profile-preview"
        />
    </a>
    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="ddluser">
      <li role="presentation">
        <Link :href="route('app.profile')" class="dropdown-item">
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
          Profile
        </Link>
      </li>
      <li role="presentation">
        <Link :href="route('logout')" class="dropdown-item">
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
            class="feather feather-log-out"
          >
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
          Logout
        </Link>
      </li>
    </ul>
  </div>
</template>
<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import { usePage } from "@inertiajs/inertia-vue3";
const name="statusprofile"
</script>


