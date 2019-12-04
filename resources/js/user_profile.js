require('./bootstrap');
window.Vue = require('vue');

var form_register = new Vue({
    el: '#form_register_user',
    data:{
        user: []
    },
    methods:{
        onclickSaveUser: function () {
            var formData = new FormData($('#form_register_user')[0]);
            axios.post('/admin/user/post-user', formData,{
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")
                }
            }).then(response => {
                var data = response.data;
                if(data.success == false){
                    Object.keys(data.errors).forEach(function (key) {
                        key_error = key.replace(/\./g,'_');
                        console.log(key_error);
                        $('.'+key_error+'_error').text(data.errors[key]);
                    });
                }else{
                    swal({
                        text: data.message,
                        type: 'success',
                        confirmButtonColor: '#2699fb',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        window.location.replace("/admin/user/list");
                    });
                }

            }).catch(error => console.log(error))
        }
    }
});

var list_user = new Vue({
    el: '#list_user',
    data:{
        userIds:[],
        isDisabled: true,
        checkedAll: false
    },
    methods: {
        checkedDeleteUser : function (event) {
            if(event.target.checked){
                this.userIds.push(event.target.value);
            }else{
               var position = this.userIds.indexOf(event.target.value);
                this.userIds.splice(position, 1);
            }
            if(this.userIds.length > 0){
                this.isDisabled = false;
            }else {
                this.isDisabled = true;
            }
        },
        checkedDeleteAllUser: function (event) {
            if(event.target.checked) {
                this.checkedAll = true;
                $('.cbox-deleted-user').each(function () {
                    list_user.userIds.push($(this).val());
                });
            }else{
                this.checkedAll = false;
                this.userIds = [];
            }
        },
        onclickDeleteUser : function () {
            var deleteForm = new FormData();
            deleteForm.append('user_id', this.userIds)
            axios.post('/admin/user/delete-user', deleteForm,{
                headers: {
                    "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")
                }
            }).then(response => {
                var data = response.data;
                if(data.success == true){
                    swal({
                        text: data.message,
                        type: 'success',
                        confirmButtonColor: '#2699fb',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        window.location.reload();
                    });
                }
            }).catch(error => console.log(error))
        }
    }
});