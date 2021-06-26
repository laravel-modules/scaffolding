<template>
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" @click="getNotifications">
      <i class="far fa-bell"></i>
      <span class="badge badge-danger navbar-badge"
            v-if="notifications.unread_count > 0">{{ notifications.unread_count }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <div v-if="! notifications.data.length">
        <span @click.stop class="dropdown-item dropdown-header">{{ $t('notifications.empty') }}</span>
        <div class="dropdown-divider"></div>
      </div>
      <div v-else>
        <span @click.stop class="dropdown-item dropdown-header">{{ $t('notifications.plural') }}</span>
        <div class="dropdown-divider"></div>
      </div>
      <div class="notification-items">
        <div v-for="notification in notifications.data">
          <a :href="notification.dashboard_url" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img :src="notification.image" :alt="notification.title" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{ notification.title }}
                </h3>
                <p class="text-sm">{{ notification.body }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                  {{ notification.created_at }}
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </div>
    </div>
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
.notification-items {
  max-height: 400px;
  overflow-y: auto;
}

.dropdown-menu-lg .dropdown-item {
  padding: .5rem .5rem;
}

.dropdown-header.active, .dropdown-header:active, .dropdown-header:hover {
  color: #6c757d;
  text-decoration: none;
  background-color: transparent;
  user-select: none;
}
</style>
