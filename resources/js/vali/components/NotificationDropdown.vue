<template>
  <li class="dropdown">
    <a class="app-nav__item"
       @click="getNotifications"
       href="#" data-toggle="dropdown"
       aria-label="Show notifications">
      <i class="fas fa-bell fa-lg"></i>
      <span class="badge badge-danger navbar-badge"
            v-if="notifications.unread_count > 0">{{ notifications.unread_count }}</span>
    </a>
    <ul class="app-notification dropdown-menu dropdown-menu-right">
      <li class="app-notification__title" v-if="! notifications.data.length">
        {{ $t('notifications.empty') }}
      </li>
      <li class="app-notification__title" v-else>
        {{ $t('notifications.plural') }}
      </li>
      <div class="app-notification__content">
        <li v-for="notification in notifications.data">
          <a class="app-notification__item" :href="notification.dashboard_url">
            <span class="app-notification__icon">
                <img :src="notification.image" :alt="notification.title">
            </span>
            <div>
              <p class="app-notification__message">{{ notification.body }}</p>
              <p class="app-notification__meta">{{ notification.created_at }}</p>
            </div>
          </a>
        </li>
      </div>
    </ul>
  </li>
</template>

<script>
export default {
  data() {
    return {
      auth: null,
      notifications: {
        data: [],
        unread_count: 0,
      },
    }
  },
  created() {
    this.getAuthUser();
    this.getUnreadNotifications();
  },
  methods: {
    getAuthUser() {
      axios.get('/api/profile')
          .then(response => {
            this.auth = response.data.data;
            Echo.join(`user-${this.auth.id}`)
                .listenToAll(() => {
                  this.getUnreadNotifications();
                })
          })
    },
    getUnreadNotifications() {
      axios.get('/api/notifications/count')
          .then(response => {
            this.notifications.unread_count = response.data.notifications_count;
          })
    },
    getNotifications() {
      axios.get('/api/notifications')
          .then(response => {
            this.notifications = response.data;
          })
    }
  }
}
</script>
<style scoped>
.dropdown {
  position: relative;
}

.badge {
  position: absolute;
  top: 10px;
}

img {
  border-radius: 50%;
  width: 40px;
  height: 40px;
  object-fit: contain;
}
</style>
