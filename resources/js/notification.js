require('./bootstrap');
window.Vue = require('vue');

var form_notification = new Vue({
    el: "#form_notification",
    data: {
        notification: []
    },
    methods: {
        onclickSaveNotification: function () {
            var formData = new FormData($('#form_notification')[0]);
            axios.post('/admin/notification/post-notification', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")
                }
            }).then(response => {
                var data = response.data;
                if (data.success == false) {
                    Object.keys(data.errors).forEach(function (key) {
                        key_error = key.replace(/\./g, '_');
                        console.log(key_error);
                        $('.' + key_error + '_error').text(data.errors[key]);
                    });
                } else {
                    swal({
                        text: data.message,
                        type: 'success',
                        confirmButtonColor: '#2699fb',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        window.location.replace("/admin/notification/list");
                    });
                }

            }).catch(error => console.log(error))
        }
    }
});
