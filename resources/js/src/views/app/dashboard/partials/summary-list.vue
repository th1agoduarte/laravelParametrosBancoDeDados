<template>
  <div class="summary-list">
    <div class="w-icon">
      <svg v-if="props.icon === 'car'" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 512 512"><path d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288c0-17.7-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32s32-14.3 32-32zm288 32c17.7 0 32-14.3 32-32s-14.3-32-32-32s-32 14.3-32 32s14.3 32 32 32z" /></svg>
      <svg v-if="props.icon === 'email'" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail" data-v-5522efca=""><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
      <svg v-if="props.icon === 'report'" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text" data-v-5522efca=""><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
      <svg v-if="props.icon === 'system'" xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay" data-v-5522efca=""><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
    </div>
    <div class="w-summary-details">
      <div class="w-summary-info">
        <h6>Automaion: {{props.title}}</h6>
        <p class="summary-count">{{props.count}}</p>
      </div>
      <div class="w-summary-stats">
        <div class="progress">
          <div
            role="progressbar"
            aria-valuemin="0"
            aria-valuemax="100"
            :aria-valuenow="props.progress"
            class="progress-bar bg-gradient-secondary"
            :style="`width: ${props.progress}%`"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
  const props = defineProps({
    title: { type: String, require: true },
    count: { type: Number, require: false, default: 0 },
    progress: { type: Number, require: false, default: 0 },
    icon: { type: String, require: false, default: "car" },
  });
  const name = "summary-list";
</script>
