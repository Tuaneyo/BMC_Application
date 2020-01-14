<template>
    <div class="">
        <a href="#" class="p-2 position-relative dropdown-toggle" id="notification-dropdown" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-comment comment-icon ft-18">
                <span class="badge" id="this-badge" v-if="notifications[1]  > 0 ">{{ notifications[1] }}</span>
            </i>
        </a>
        <div class="dropdown-menu p-0 box-shadow news-dropdown" >
            <a class="dropdown-item text-center bg-white dropdown-link home-color-blue" href="/ondernemer/nieuws">Meldingen</a>
            <ul class="list-group news-list">
                <li class="list-group-item px-2" :class="notification.read_at == null ? 'bg-color-blue-light' : ''"
                    v-for="notification in notifications[0]" >
                    <a class="news-wrap" v-on:click="MarkAsRead(notification)" >
                        <div class="news-img">
                            <img src="https://adsd2019.clow.nl/ondernemer/uploads/avatar/default/user icon.png" v-if="notification.data.user.file == null" class="border-white">
                            <img v-bind:src="'https://adsd2019.clow.nl/ondernemer/uploads/avatar/' + notification.data.user.id  +  '/' +  notification.data.user.file " v-else="notification.data.user.file !== null ">
                        </div>
                        <div class="new-content">
                            <span class="font-weight-bold"> {{ notification.data.user.name }} {{ notification.data.user.lastname }} </span>
                            {{ notification.data.msg }}
                        </div>
                        <div class="news-icon">

                            <i class="fas fa-comment-alt"></i>
                            <span v-if="Math.round(moment.duration(moment(moment()).diff(notification.created_at)).asDays()) <= 0">
                                {{ Math.round(moment.duration(moment(moment()).diff(notification.created_at)).asHours()) }} h
                            </span>
                            <span v-if="Math.round(moment.duration(moment(moment()).diff(notification.created_at)).asDays()) > 0 && Math.round(moment.duration(moment(moment()).diff(notification.created_at)).asDays()) < 7">
                                {{ Math.round(moment.duration(moment(moment()).diff(notification.created_at)).asDays()) }} d
                            </span>
                            <span v-if="Math.round(moment.duration(moment(moment()).diff(notification.created_at)).asDays()) > 7">
                                {{ Math.round(moment.duration(moment(moment()).diff(notification.created_at)).asWeeks()) }} w
                            </span>
                        </div>
                        <span class="read-notification" v-if="notification.read_at == null">
                            <i class="fas fa-circle"></i>
                        </span>
                    </a>
                </li>
                <li class="list-group-item px-2 pt-1 " v-if="notifications[0] == 0">
                    <div class="d-flex p-3 grey-text flex-column aj-center text-center">
                        <span class="ft-30"><i class="fas fa-bell"></i></span>
                        <span>Op dit moment heb je nog geen berichten binnen gekregen.</span>
                    </div>

                </li>
            </ul>
            <a id="dropdown-close" class="dropdown-item text-right bg-white dropdown-link grey-text " href="#">Sluiten</a>
        </div>
    </div>
</template>

<script>
    export default {
       props : ['notifications'],
       methods: {
           MarkAsRead : function(notification){
               var data = {
                   id: notification.id
               };
               axios.post('/notification/read', data).then(response => {
                   window.location.href =  notification.data.loca
               });
           }
       }
    }
</script>
